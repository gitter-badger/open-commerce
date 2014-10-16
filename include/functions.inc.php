<?
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
	
	function deleteUser($userObj, $userID){
		$userObj->id = $userID;	

		if ($userObj->delete()){
			return true;
		} else {
			throw new Exception('Delete function has failed!');
		}
	}
?>