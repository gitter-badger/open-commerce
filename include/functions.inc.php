<?php
	function d($var,$txt=""){
		echo '<pre><code>';
		echo '<b>' . $txt. '</b>';
		print_r($var);
		echo '</code></pre>';
	}
	
	function newUser($userObj, $email, $username, $password){
		$allUsers = $userObj->all();
		foreach($allUsers as $each){
			if (array_search($email, array_values($each))){
				return false;
			}
		}
		
		$userObj->email = $email;
		$userObj->username  = $username;
		$userObj->salt = time();
		$userObj->password = hash_hmac('sha256', $password, $userObj->salt);
		
		
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
		if ($userObj->find()){
			return get_object_vars($userObj);
		} else {
			return 0;
		}
	}
	
	function deleteUser($userObj, $userID){
		$userObj->id = $userID;	

		if ($userObj->delete()){
			return true;
		} else {
			throw new Exception('Delete function has failed!');
		}
	}
	
	function userLogin($userObj, $ident, $password){
		static $userData;
		if(!filter_var($ident, FILTER_VALIDATE_EMAIL)){
			$userData = getUser($userObj, null, null, $ident);
		} else {
			$userData = getUser($userObj, null, $ident, null);
		}
		
		if ($userData != 0 && $userData != -1){
			if ($userData['password'] == $password){
				session_start();
				setcookie("OCc", session_id(), strtotime('+30 days'));
				updateUser($userObj, $userData['id'], "session", session_id());
			} else {
				throw new Exception('Login failed.');
			}
		} else {
			throw new Exception('Login failed.');
		}
	}
?>