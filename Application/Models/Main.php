<?php

namespace Application\Models;
use Application\Core\Model;

class Main extends Model
{
    public $error;

    public function validateMessage($post) {
        if (iconv_strlen($post['name'])<2 or iconv_strlen($post['name'])>20) {
            $this->error = 'Указано слишком короткое имя';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Укажите действительный E-mail';
            return false;
        } elseif (iconv_strlen($post['message'])<20 or iconv_strlen($post['message'])>500) {
            $this->error = 'Длина сообщения должна составлять от 20 до 500 символов';
            return false;
        }
        return true;
    }

    public function countPosts() {
        return $this->db->getColumn('SELECT COUNT(id) FROM Posts');
    }

    public function getAllPosts() {
        return $this->db->getRow('SELECT id, name, description, text, author, datetime  FROM Posts ORDER BY id DESC');
    }
}