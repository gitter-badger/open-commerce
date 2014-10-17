<?php
	require "./include/config.inc.php";
	require "./include/functions.inc.php";
	
	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
	$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
	 
	for($i= 0;$i < sizeof($scriptName);$i++){
		if ($requestURI[$i] == $scriptName[$i]){
			unset($requestURI[$i]);
		}
	}

	$com = array_values($requestURI);
	//d($com);
	
	if(empty($com[0]))
		include "./include/html/home.inc";
	else switch($com[0]){
		case 'login' :
			include "./include/html/login.inc";
			break;

		case 'commandTwo' :
			echo 'You entered command: '.$com[0];
			break;

		default:
			header('HTTP/1.1 404 Not Found');
			break;
	}

?>