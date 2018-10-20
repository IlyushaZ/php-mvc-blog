<?php

return [
    'main/index/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'contact' => [
        'controller' => 'main',
        'action' => 'contact'
    ],
    'about' => [
        'controller' => 'main',
        'action' => 'about'
    ],
    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
    ],
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],
    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit'
    ],
    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],
    'admin/posts/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'posts'
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts'
    ],
    '' => [
        'controller' => 'Main',
        'action' => 'index']
];


