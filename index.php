<?php

require_once __DIR__ . '/config/init.php';

Router::go_to($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
