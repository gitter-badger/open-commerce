<?php
    require './vendor/autoload.php';
	require './include/config.inc.php';
	require './include/functions.inc.php';
	
    $haml = new MtHaml\Environment('php');
    $executor = new MtHaml\Support\Php\Executor($haml, array(
        'cache' => sys_get_temp_dir().'/haml',
    ));

	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
	$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
	 
	for($i= 0;$i < sizeof($scriptName);$i++) {
		if ($requestURI[$i] == $scriptName[$i]) {
			unset($requestURI[$i]);
		}
	}

	$com = array_values($requestURI);
	//d($com);
	
	if(empty($com[0])) {
        include './include/lang/home.lang';
        $executor->display('./include/html/home.haml', $lang);
    } else {
        switch($com[0]) {
            case $com[0] :
                if (file_exists('./include/html/'.$com[0].'.haml')) {
                    include './include/lang/'.$com[0].'.lang';
                    $executor->display('./include/html/'.$com[0].'.haml', $lang);
                } else {
                    header('HTTP/1.1 404 Not Found');
                }
                break;

            default:
                header('HTTP/1.1 404 Not Found');
                break;
        }
    }
?>