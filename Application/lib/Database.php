<?php

namespace Application\lib;
use PDO;

class Database
{
    protected $db;

    public function __construct() {
        $config = require 'Application/Config/database.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'',
            $config['user'], $config['password']);
//        echo 'success';
    }

    public function makeQuery($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function getRow($sql, $params=[]) {
        $result = $this->makeQuery($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getColumn($sql, $params=[]) {
        $result = $this->makeQuery($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}