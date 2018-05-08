<?php

class RoutesParser {

    const ROUTES = [
        ['url' => '/users/:id/',                    'method' => 'get',    'controller' => 'users',    'action' => 'show'],
        ['url' => '/users/new/',                    'method' => 'get',    'controller' => 'users',    'action' => 'new'],
        ['url' => '/users/:id/edit/',               'method' => 'get',    'controller' => 'users',    'action' => 'edit'],
        ['url' => '/users/',                        'method' => 'post',   'controller' => 'users',    'action' => 'create'],
        ['url' => '/users/:id/',                    'method' => 'patch',  'controller' => 'users',    'action' => 'update'],
        ['url' => '/users/:id/',                    'method' => 'delete', 'controller' => 'users',    'action' => 'destroy'],

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
        ['url' => '/photos/:id/likes:id/',          'method' => 'delete', 'controller' => 'likes',    'action' => 'destroy']
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
            $array = ['controller' => $match['controller'], 'action' => $match['action']];
            return ($array);
        }
        echo 'y a PAS match' . PHP_EOL;
        return NULL; //
    }

    private function find_a_match() {
        foreach (self::ROUTES as $route) {
            if ($this->compare_method($route['method']) && $this->compare_url($route['url']))
                return $route;
        }
        return NULL;
    }

    private function compare_url($route_url) {
        $regex_url = $this->regex_parser($route_url);
        $url_slash = $this->trailing_slash($this->url);
        echo 'regex_url = ' . $regex_url . PHP_EOL;
        echo '$url_slash = ' . $url_slash . PHP_EOL;
        echo 'preg_match = ' . preg_match($regex_url, $url_slash) . PHP_EOL;
        return preg_match($regex_url, $url_slash);
    }

    private function regex_parser($str) {
        $str = str_replace('/', '\/', $str);
        $str = str_replace(':id', '\d+', $str);
        return '/' . $str . '$/';
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

$a = new RoutesParser('/photos/48769/comments/6987/', 'PATCH');
$titi = $a->redirection_instructions();
echo "FINAL :" . PHP_EOL;
print_r ($titi);
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
