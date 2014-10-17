<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="include/html/css/style.css" />
	</head>
	<body>
		<form name="login" action="submit" method="post">
			Username/Email: <input type="text" name="ident" value="<?php (isset($com[1])?print $com[1]:''); ?>">
			Password: <input type="password" name="password">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
