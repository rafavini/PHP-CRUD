
<?php 
require_once __DIR__ . '/backend/controller/loginController.php';
$loginController = new LoginController();
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';    

    if (empty($email) || empty($nome)) {
        $error_message = '<p class="error-message">Todos os campos são obrigatórios.</p>';
    } else {
        if ($loginController->ValidaSenha($email, $nome)) {
            $success_message  = "Login bem-sucedido!";
            header("location: ./pages/home/index.php");
        } else {
            $error_message = '<p class="error-message">Usuário ou senha inválidos.</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./loginStyle.css">
</head>

<body>
    <form method="post">
    <h1>Login</h1>

    <?php 
        if ($error_message) {
            echo '<div class="message error-message">' . $error_message . '</div>';
        } else if ($success_message) {
            echo '<div class="message success-message">' . $success_message . '</div>';
        }
        ?>
   
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="nome">Nome:</label>
        <input type="password" name="nome" id="nome" required>
        <input type="submit" value="Entrar">
    </form>

</body>
</html>

