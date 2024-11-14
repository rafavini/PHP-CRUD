<?php
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header('Location: ../../index.php');
    exit();
}

require_once __DIR__ . '/../../backend/controller/userController.php';
$userController = new UserController();

$usuario = [
    'id' => '',
    'nome' => '',
    'email' => ''
];
$buttonTitle = "";
// Verifica se é edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $buttonTitle = "Atualizar";
    $usuario = $userController->getUserById($id);
    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit();
    }
}else{
    $buttonTitle = "Cadastrar";
}

// Lógica para processar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    
    if (isset($_GET['id'])) {
        // Editar usuário
        $userController->updateUser($_GET['id'], $nome, $email);
    } else {
        // Cadastrar novo usuário
        $userController->createUser($nome, $email);
    }
    header("location: ../home/index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET['id']) ? 'Editar Usuário' : 'Cadastrar Usuário'; ?></title>
</head>
<body>

<h2><?php echo isset($_GET['id']) ? 'Editar Usuário' : 'Cadastrar Usuário'; ?></h2>

<form method="POST">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
    <br>

    <button type="submit"><?php echo $buttonTitle;?></button>
</form>

</body>
</html>
