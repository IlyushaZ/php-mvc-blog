<?php

namespace Application\Core;
use Application\Core\Model;

abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;

    public function __construct($route) {
        $this->route = $route;
//        $_SESSION['admin'] = 1;
        if (!$this->checkAcl()) {
            View::error(403);
        }

        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        $path = 'Application\Models\\'.ucfirst($name);
        if(class_exists($path)) {
            return new $path;
        }
    }

    public function checkAcl() {
        $this->acl = require 'Application/acl/'.$this->route['controller'].'.php';
        if ($this->isAcl('all')) {
            return true;
        } elseif ($this->isAcl('admin') and isset($_SESSION['admin'])) {
            return true;
        }
        return false;
    }

    public function isAcl($key) {
        return in_array($this->route['action'], $this->acl[$key]);
    }

}