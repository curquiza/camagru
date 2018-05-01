<?php

// $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

$controller = 'users_controller';
$class = 'UsersController';
$method = 'new';
$params = array();

require_once 'app/controllers/' . $controller . '.php';
call_user_func_array([$class, $method], $params);

?>
<!-- <!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/spectre.css">
	<link rel="stylesheet" href="css/spectre-exp.css">
	<link rel="stylesheet" href="css/spectre-icons.css">
</head>

<body>
	<h1> COCO </h1>
</body>
</html> -->
