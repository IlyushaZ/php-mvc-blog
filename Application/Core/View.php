<?php

namespace Application\Core;

class View
{
    public $layout = 'default';
    public $route;
    public $path;

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars=[]) {
        extract($vars);
        ob_start();
        require 'Application/Views/'.$this->path.'.php';
        $content = ob_get_clean();
        require 'Application/Views/layouts/'.$this->layout.'.php';
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public static function redirect($path) {
        header('location: /'.$path);
        exit;
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }

    public static function error($code) {
        http_response_code($code);
        require 'Application/Views/errors/'.$code.'.php';
        exit;
    }

}