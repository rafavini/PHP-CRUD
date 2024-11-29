<?php
    require_once __DIR__ . '/../controller/todo.php';

    use function Src\Todo\Controller\getTodosList;

    $todos = getTodosList();

    $error = false;

    if(isset($_GET['err'])) {
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../view/styles/style.css">
    <title>Todo</title>
</head>
<body>
    <form method="POST" action="../controller/index.php?controller=create" class="form-floating form">
        <div class="input-group">
            <?php echo "<input type='text' name='title' placeholder='Title' class='form-control error-$error' placeholder='Title'>" ?>
            <button type="submit" class="btn btn-outline-secondary btn-icon">
                <span class="material-symbols-outlined">
                    add
                </span>
            </button>
        </div>
    </form>
    <div class="todos-group">
    <?php
        foreach($todos as $todo) {
            $id = $todo['id'];
            $status = $todo['completed'];
            
            echo /*html*/ "
                <div class='todo-group'>
                    <form action='../controller/index.php?controller=remove' method='POST' class='todo-item'>
                        <input type='hidden' name='id' value='$id'/>
                        <div class='todo-title'>
                            <p>{$todo['created_at']}</p>
                            <h3 class='status-$status'>{$todo['title']}</h3>
                        </div>
                        <div>
                            <button class='btn btn-primary btn-icon'>
                                <span class='material-symbols-outlined'>
                                    delete
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <form action='../controller/index.php?controller=update' method='POST'>
                        <input type='hidden' name='id' value='$id'/>
                        <button class='btn btn-primary btn-icon'>
                        <span class='material-symbols-outlined'>
                            check
                        </span>
                        </button>
                    </form>
                </div>
            ";
        }
    ?>
    </div>
</body>
</html>