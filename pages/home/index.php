<?php
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header('Location: ../../index.php');
    exit();
}
require_once __DIR__ . '/../../backend/controller/userController.php';

$userController = new UserController();
$usuarios = $userController->getAllClient();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="../cadastrar/index.php"><button>Cadastrar</button></a>
    <h2>Lista de Usuários</h2>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo htmlspecialchars($usuario['nome']) ?></td>
                <td><?php echo htmlspecialchars($usuario['email']) ?></td>
                <td>
                    <!-- Link para Editar, direcionando para uma página ou endpoint de edição -->
                    <a href="../cadastrar/index.php?id=<?php echo $usuario['id']; ?>"><button>Editar</button></a>
                <form method="POST">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id']; ?>">
                    <button type="submit" name="deletar">Deletar</button>
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php
if (isset($_POST['deletar'])) {
    if (isset($_POST['id_usuario'])) {
        $id_usuario = $_POST['id_usuario'];
        $userController->deleteUser($id_usuario);
        header('Location: '.$_SERVER['PHP_SELF']);
    }
}

?>