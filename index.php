<?php
	require "./include/config.inc.php";
	
	/*
	*	Testing search function
	*-------------------
	$userID = null;
	$email = null;
	$username = "test1";
	$search = getUser(new User(), $userID, $email, $username);
	if ($debug) d($search, "getUser Returned: ");
	*/
	
	/*
	*	Todo list
	*-------------------
	*Delete User
	*$user->id = "17";	
	*$delete = $user->Delete();
	*/

	/*
	*	Create new user
	*	$create = newUser(new User(), $email, $username, $password, $salt);
	*-------------------
	try {
		$create = newUser(new User(), $email, $username, $password, $salt);
		if ($debug) d($create, "newUser Returned: ");
	} catch (Exception $e) {
		if ($debug) echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	*/
	
	/*
	*	Update user field
	*	$update = updateUser(new User(), $userID, $field, $value);
	*--------------------
	try {
		$update = updateUser(new User(), $userID, $field, $value);
		if ($debug) d($update, "updateUser Returned: ");
	} catch (Exception $e) {
		if ($debug) echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	*/
	
	
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
	
	function getUser($userObj, $userID, $email, $username){
		if ($userID == NULL){
			$allUsers = $userObj->all();
			foreach ($allUsers as $each){
				if ($email == NULL && $username == NULL){
					return -1;
					//throw new Exception('Did not provide search criteria!');
				} else if ($email != NULL){
					if (array_search($email, array_values($each))){
						$userObj->id = $each['id'];
					}
				} else if ($username != NULL){
					if (array_search($username, array_values($each))){
						$userObj->id = $each['id'];
					}
				}
			}
		} else {
			$userObj->id = $userID;
		}
		$userObj->find();
		return get_object_vars($userObj);
	}
?>