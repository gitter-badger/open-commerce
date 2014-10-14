<?php
	require "./include/config.inc.php";
	$user = new User();
	$needle = "string";
	
	$haystack = $user->all();
	
	foreach($haystack as $each){
		if (array_search($needle, array_values($each))){
			return true;
		}
	}

	d($search, "Results:");
	
	function d($var,$txt){
		echo '<pre>';
		echo '<h1>' . $txt. '</h1>';
		var_dump($var);
		echo '</pre>';
	}
?>