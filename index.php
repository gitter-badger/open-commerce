<?php
	require "./include/config.inc.php";
	
	///////////////////
	//Update User Info
	//$user->id = "4";	
	//$user->Age = "32";
	//$saved = $user->Save();
	//
	//Delete User
	//$user->id = "17";	
	//$delete = $user->Delete();
	//////////////////

	$create = newUser(new User(),"test@gmail.com","test1","test1");
	d($create, "newUser Returned:");
	
	
	function d($var,$txt){
		echo '<pre>';
		echo '<h1>' . $txt. '</h1>';
		var_dump($var);
		echo '</pre>';
	}
	
	function newUser($user, $email, $username, $password){
		$users = $user->all();
		foreach($users as $each){
			if (array_search($email, array_values($each))){
				return false;
			}
		}
		$user->email = $email;
		$user->username  = $username;
		$user->password = $password;

		if ($user->Create()){
			return $user;
		} else {
			return -1;
		}
	}
?>