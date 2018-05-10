<?php

require_once 'config/router.php';

Router::go_to($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
