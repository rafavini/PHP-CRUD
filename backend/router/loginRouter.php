<?php

require_once __DIR__ . '/../controller/loginController.php';
$loginController = new LoginController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_GET['acao']) {
        case 'validarLogin':
            $output = $loginController->ValidaSenha($_POST['email'], $_POST["nome"]);
            var_dump($output);
            $output ? 
            header('Location: ../../pages/home/index.php') : 
            header('Location: ../../index.php');
            break;
        // case 'todos':
        //     getTodosList();
        //     break;
        // case 'update':
        //     updateStatusTodo($_POST['id']);
        //     header('Location: /ex4/view/index.php', true, 301);
        //     break;
        // case 'remove':
        //     deleteTodo($_POST['id']);
        //     header('Location: /ex4/view/index.php', true, 301);
        //     break;
        default:
            echo 'Not found';
            break;
    }
}