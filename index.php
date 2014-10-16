<?php
	require "./include/config.inc.php";
	require "./include/functions.inc.php";
	
	/*
	*	Testing
	*-------------------
	*/
	//$userID = "2";
	//$email = null;
	//$username = "test1";
	//$search = getUser(new User(), $userID, $email, $username);
	//if ($debug) d($search, "getUser Returned: ");
	

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
	
	/*
	*	Delete user
	*	$delete = deleteUser(new User(), $userID);
	*--------------------
	try {
		$delete = deleteUser(new User(), $userID);
		if ($debug) d($delete, "deleteUser Returned: ");
	} catch (Exception $e) {
		if ($debug) echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	*/
?>