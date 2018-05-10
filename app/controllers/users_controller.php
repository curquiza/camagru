<?php

class UsersController extends BaseController {

    public static function new() {
        echo 'Controller: user - Action: new' . PHP_EOL;
    }

    public static function show() {
        echo 'Controller: user - Action: show' . PHP_EOL;
        $view = new View('layout', 'application');
        $view->assign('user_id', $_GET['user_id']);
    }
}
