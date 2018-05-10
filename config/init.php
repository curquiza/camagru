<?php

define('ROOT', getcwd() . '/');
echo ROOT . PHP_EOL;

function require_file($path) {
    require_once ROOT . $path . '.php';
}

function require_folder($dir) {
    $files = glob(ROOT . $dir . '/*.php');
    foreach($files as $file) {
        echo $file . PHP_EOL;
        require_once $file;
    }
}

require_file('config/database');
require_file('config/router');
require_folder('app/models');
require_folder('app/controllers');
