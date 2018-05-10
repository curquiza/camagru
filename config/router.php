<?php

class RoutesParser {

    const ROUTES = [
        ['url' => '/users/:id/',                    'method' => 'get',    'controller' => 'users',    'action' => 'show'],
        ['url' => '/users/new/',                    'method' => 'get',    'controller' => 'users',    'action' => 'new'],
        ['url' => '/users/:id/edit/',               'method' => 'get',    'controller' => 'users',    'action' => 'edit'],
        ['url' => '/users/',                        'method' => 'post',   'controller' => 'users',    'action' => 'create'],
        ['url' => '/users/:id/',                    'method' => 'patch',  'controller' => 'users',    'action' => 'update'],
        ['url' => '/users/:id/',                    'method' => 'delete', 'controller' => 'users',    'action' => 'destroy'],
        // + user/:id/photos/

        ['url' => '/photos/',                       'method' => 'get',    'controller' => 'photos',   'action' => 'index'],
        ['url' => '/photos/:id/',                   'method' => 'get',    'controller' => 'photos',   'action' => 'show'],
        ['url' => '/photos/new/',                   'method' => 'get',    'controller' => 'photos',   'action' => 'new'],
        ['url' => '/photos/',                       'method' => 'post',   'controller' => 'photos',   'action' => 'create'],
        ['url' => '/photos/:id/',                   'method' => 'delete', 'controller' => 'photos',   'action' => 'destroy'],

        ['url' => '/photos/:id/comments/',          'method' => 'get',    'controller' => 'comments', 'action' => 'index'],
        ['url' => '/photos/:id/comments/:id/edit/', 'method' => 'get',    'controller' => 'comments', 'action' => 'edit'],
        ['url' => '/photos/:id/comments/',          'method' => 'post',   'controller' => 'comments', 'action' => 'create'],
        ['url' => '/photos/:id/comments/:id/',      'method' => 'patch',  'controller' => 'comments', 'action' => 'update'],
        ['url' => '/photos/:id/comments/:id/',      'method' => 'delete', 'controller' => 'comments', 'action' => 'delete'],

        ['url' => '/photos/:id/likes/',             'method' => 'post',   'controller' => 'likes',    'action' => 'create'],
        ['url' => '/photos/:id/likes/:id/',         'method' => 'delete', 'controller' => 'likes',    'action' => 'destroy']
    ];

    private $url;
    private $method;

    function __construct($url, $method) {
        $this->url = $url;
        $this->method = $method;
        echo 'URL = ' . $url . PHP_EOL;
        echo 'METHOD = ' . $method . PHP_EOL;
    }

    public function redirection_instructions() {
        $match = $this->find_a_match();
        if (isset($match)) {
            echo 'y a match' . PHP_EOL;
            $array = ['controller' => $match['controller'], 'action' => $match['action'], 'params' => $_GET];
            return ($array);
        }
        echo 'y a PAS match' . PHP_EOL;
    }

    private function find_a_match() {
        foreach (self::ROUTES as $route) {
            if ($this->compare_method($route['method']) && $this->compare_url($route['url']))
                return $route;
        }
    }

    private function compare_url($route_url) {
        $regex_url = $this->regex_parser($route_url);
        $url_sanitized = $this->sanitize_url();
        echo 'regex_url = ' . $regex_url . PHP_EOL;
        echo '$url_sanitized = ' . $url_sanitized . PHP_EOL;
        echo 'preg_match = ' . preg_match($regex_url, $url_sanitized) . PHP_EOL;
        return preg_match($regex_url, $url_sanitized);
    }

    private function regex_parser($str) {
        $str = str_replace('/', '\/', $str);
        $str = str_replace(':id', '\d+', $str);
        return '/' . $str . '$/';
    }

    private function sanitize_url() {
        $sanatized_url = $this->url_without_params();
        return $this->trailing_slash($sanatized_url);
    }

    private function url_without_params() {
        if (strpos($this->url, '?') !== false)
            return substr($this->url, 0, strpos($this->url, '?'));
        else
            return $this->url;
    }

    private function trailing_slash($url) {
        if (substr($url, -1) != '/')
            return $url . '/';
        return $url;
    }

    private function compare_method($route_method) {
        return (strtoupper($route_method) === $this->method);
    }

}

class Router {

    public static function go_to($uri, $method) {
        $url_parser = new RoutesParser($uri, $method);
        $redirect_info = $url_parser->redirection_instructions();
        self::redirection($redirect_info);
    }

    private static function redirection($redirect_info) {
        if (isset($redirect_info)) {
            self::require_controller($redirect_info);
            self::call_controller_method($redirect_info);
        }
        else
            ; // renvoyer sur page 404
    }

    private static function require_controller($redirect_info) {
        require_once('app/controllers/' . $redirect_info['controller'] . '_controller.php');
    }

    private static function call_controller_method($redirect_info) {
        $array = [self::controller_name($redirect_info['controller']), $redirect_info['action']];
        call_user_func_array($array, $redirect_info['params']);
    }

    private static function controller_name($name) {
        return ucfirst($name) . 'Controller';
    }
}

?>
