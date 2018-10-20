<?php

namespace Application\Core;
use Application\lib\Database;

abstract class Model
{
    public $db;
    public $error;

    public function __construct() {
       $this->db = new Database();
    }
}