<?php

namespace Application\Models;
use Application\Core\Model;
use Imagick;

class Admin extends Model
{
    public function validateLogin($post) {
        $config = require 'Application/Config/admin.php';

        if($post['login']==$config['login'] and $post['password']==$config['password']) {
            return true;
        }
        $this->error = 'Неверные имя пользователя или пароль';
        return false;
    }

    public function validatePost($post, $type) {
        $nameLen = iconv_strlen($post['name']);
        $descLen = iconv_strlen($post['description']);
        $textLen = iconv_strlen($post['text']);

        if ($nameLen<3 or $nameLen>30) {
            $this->error = 'Название должно содержать от 3 до 30 символов';
            return false;
        } elseif ($descLen<15 or $descLen>50)  {
            $this->error = 'Описание должно содержать от 15 до 50 символов';
            return false;
        } elseif ($textLen<10 or $textLen>3000) {
            $this->error = 'Длина текста должна составлять от 100 до 3000 символов';
            return false;
        }
        if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
            $this->error = 'Изображение не выбрано';
            return false;
        }
        return true;
    }

    public function addPost($post) {
        $params = [
            'id' => '',
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text'],
            'author' => 'Кристина',
            'datetime' => date('Y/m/d H:i:s')
        ];

        $this->db->makeQuery('INSERT INTO Posts VALUES (:id, :name, :description, :text, :author, :datetime)', $params);

        return $this->db->lastInsertId();
    }

    public function postUploadImage($path, $id) {
        $img = new Imagick($path);
        $img->cropThumbnailImage(1080, 540);
        $img->setImageCompressionQuality(80);
        $img->writeImage('Public/materials/'.$id.'.jpg');
//        move_uploaded_file($path,'Public/materials/'.$id.'.jpg');
    }

    public function postExists($id) {
        $params = [
            'id' => $id
        ];
        return $this->db->getColumn('SELECT id FROM Posts WHERE id = :id', $params);
    }

    public function editPost($post, $id) {
        $params = [
            'id' => $id,
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text']
        ];
        $this->db->makeQuery('UPDATE Posts SET name = :name, description = :description, text = :text WHERE id = :id',
            $params);
    }

    public function deletePost($id) {
        $params = [
            'id' => $id
        ];
        $this->db->makeQuery('DELETE FROM Posts WHERE id = :id', $params);
        unlink('Public/materials/'.$id.'.jpg');
    }

    public function getPostData($id) {
        $params = [
            'id' => $id
        ];
        return $this->db->getRow('SELECT * FROM Posts WHERE id = :id', $params);
    }
}