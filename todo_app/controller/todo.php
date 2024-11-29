<?php
namespace Src\Todo\Controller;
require_once __DIR__ . "/../infra/db/connection.php";
use function Src\Infra\db\connection;

function postTodo($title) {
    if(!isset($title) || strlen($title) == 0) {
        echo 'Title and description are required';
        return false;
    }

    $db = connection();

    


    $query = $db->prepare("INSERT INTO todos (title) VALUES (?)");
    $query->execute([$title]);

    return true;
}

function getTodosList() {
    $db = connection();
            
    $todos = $db->query("SELECT * FROM todos ORDER BY completed ASC");
    $result = $todos->fetchAll();
    return $result;
    
}

function deleteTodo( $id ) {
    $db = connection(); 
    
    $query = $db->prepare("DELETE FROM todos WHERE id = ?");
    $query->execute([$id]);
}

function updateStatusTodo($id) {
    $db = connection();

    $query = $db->prepare("UPDATE todos SET completed = 1 WHERE id = ?");
    $query->execute([$id]);
}
