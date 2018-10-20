<?php

namespace Application\Controllers;

use Application\Core\Controller;
use Application\Core\View;
use Application\Models\Admin;

class MainController extends Controller
{
    public function indexAction() {
        $vars = [
            'list' => $this->model->getAllPosts()
        ];
        $this->view->render('Главная', $vars);
    }

    public function contactAction() {
        if (!empty($_POST)) {
            if (!$this->model->validateMessage($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $this->view->message('ok', 'Сообщение отправлено');
            mail('ilyusha.god@yandex.ru', 'Сообщение из блога',
                $_POST['name'].PHP_EOL.$_POST['email'].PHP_EOL.$_POST['message']);
        }
        $this->view->render('Обратная связь');
    }

    public function aboutAction() {
        $this->view->render('Обо мне');
    }

    public function postAction() {
        $adminModel = new Admin;
        if (!$adminModel->postExists($this->route['id'])) {
            View::error(404);
        }
        $vars = [
            'data' => $adminModel->getPostData($this->route['id']),
        ];
        $this->view->render('Пост', $vars);
    }
}