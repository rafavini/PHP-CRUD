<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="nome">Nome:</label>
        <input type="password" name="nome" id="nome" required>
        <br>
        <input type="submit" value="Entrar">
    </form>
</body>

</html>
<?php
require_once __DIR__ . '/backend/controller/loginController.php';
$loginController = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';    

    if (empty($email) || empty($nome)) {
        echo "Todos os campos são obrigatórios.";
    } else {
        if ($loginController->ValidaSenha($email, $nome)) {
            echo "Login bem-sucedido!";
            echo $_SESSION["id_usuario"];
            header("location: ./pages/home/index.php");
        } else {
            echo "Usuário ou senha inválidos.";
        }
    }
}
?>