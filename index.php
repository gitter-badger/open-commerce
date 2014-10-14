<?php
	require "./include/config.inc.php";
	//$userObj = new User();
	
	/*
	*	Todo list
	*-------------------
	*Update User Info
	*$user->id = "4";	
	*$user->Age = "32";
	*$saved = $user->Save();
	*
	*Delete User
	*$user->id = "17";	
	*$delete = $user->Delete();
	*/

	/*
	*	Create new user
	*/
	try {
		$create = newUser(new User(), $email, $username, $password, $salt);
		if ($debug) d($create, "newUser Returned: ");
	} catch (Exception $e) {
		if ($debug) echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
	/*
	*	Update user field
	*/
	try {
		$update = updateUser(new User(), "1", "field", "value");
		if ($debug) d($update, "updateUser Returned: ");
	} catch (Exception $e) {
		if ($debug) echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	/*------------------------------------------------------
	*					BEGIN FUNCTIONS
	*------------------------------------------------------*/
	function d($var,$txt){
		echo '<pre><code>';
		echo '<b>' . $txt. '</b>';
		var_dump($var);
		echo '</code></pre>';
	}
	
	function newUser($userObj, $email, $username, $password, $salt){
		$allUsers = $userObj->all();
		foreach($allUsers as $each){
			if (array_search($email, array_values($each))){
				return false;
			}
		}
		
		$userObj->email = $email;
		$userObj->username  = $username;
		$userObj->password = hash_hmac('sha256', $password, $salt);

		if ($userObj->create()){
			return true;
		} else {
			throw new Exception('Create function has failed!');
		}
	}
	
	function updateUser($userObj, $userID, $field, $value){
		$userObj->id = $userID;	
		$userObj->$field = $value;

		if ($userObj->save()){
			return true;
		} else {
			throw new Exception('Update function has failed!');
		}
	}
?>