<?php

use function Src\Todo\Controller\deleteTodo;
use function Src\Todo\Controller\getTodosList;
use function Src\Todo\Controller\postTodo;
use function Src\Todo\Controller\updateStatusTodo;

require_once __DIR__ . '/todo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_GET['controller']) {
        case 'create':
            $output = postTodo($_POST['title']);
            $output ? 
            header('Location: /ex4/view/index.php', true, response_code: 301) : 
            header('Location: /ex4/view/index.php?err=true', true, response_code:0);
            
            break;
        case 'todos':
            getTodosList();
            break;
        case 'update':
            updateStatusTodo($_POST['id']);
            header('Location: /ex4/view/index.php', true, 301);
            break;
        case 'remove':
            deleteTodo($_POST['id']);
            header('Location: /ex4/view/index.php', true, 301);
            break;
        default:
            echo 'Not found';
            break;
    }
}