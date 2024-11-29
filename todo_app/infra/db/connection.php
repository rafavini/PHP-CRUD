<?php
namespace Src\Infra\db;
use Exception;
use PDO;

if($_SERVER['REQUEST_METHOD']) return;

function connection() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=todo_db', 'root', '');
        return $db;
    } catch(Exception $e) {
        echo ''. $e->getMessage() .'';
    }
}
