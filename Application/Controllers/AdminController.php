<?php

namespace Application\Controllers;
use Application\Core\Controller;
use Application\Core\View;
use Application\Models\Main;
use Application\lib\Pagination;

class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
//        var_dump($this->route);
    }

    public function loginAction() {
        if (isset($_SESSION['admin'])) {
            View::redirect('admin/posts');
        }

        if (!empty($_POST)) {
            if (!$this->model->validateLogin($_POST)) {
                $this->view->message('Error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('admin/add');
//            View::redirect('admin/posts');
        }

        $this->view->render('Вход');
    }

    public function addAction() {
        if (!empty($_POST)) {
            if (!$this->model->validatePost($_POST, 'add')) {
                $this->view->message('Error', $this->model->error);
            }
            $id = $this->model->addPost($_POST);
            if (!$id) {
                $this->view->message('error', 'Ошибка добавления поста');
            }
            $this->view->message('OK', 'Пост добавлен');
            $this->model->postUploadImage($_FILES['img']['tmp_name'], $id);
            $this->view->message('OK', 'success');
        }

        $this->view->render('Добавить пост');
    }

    public function editAction() {
        if (!$this->model->postExists($this->route['id'])) {
            View::error(404);
        }

        if (!empty($_POST)) {
            if (!$this->model->validatePost($_POST, 'edit')) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->editPost($_POST, $this->route['id']);
            $this->view->message('OK', 'Пост отредактирован');
        }
        if (isset($_FILES['img']['tmp_name'])) {
            $this->model->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
        }

        $vars = [
            'data' => $this->model->getPostData($this->route['id'])
        ];
        $this->view->render('Редактировать пост', $vars);

    }


    public function postsAction() {
        $mainModel = new Main();
        $pagination = new Pagination($this->route, (int)$mainModel->countPosts(), 6);

        $vars = [
            'pagination' => $pagination->getPagination(),
            'list' => $mainModel->getAllPosts($this->route)
        ];

        $this->view->render('Посты', $vars);
    }


    public function deleteAction() {
        if (!$this->model->postExists($this->route['id'])) {
            View::error(404);
        }
        $this->model->deletePost($this->route['id']);
        exit('Пост удален');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        View::redirect('');
    }
}