<?php

include_once __DIR__ . '/../db/database.php';


class UserController
{
    private $conn;
    public $errorMsg;

    public function __construct()
    {
        $objDb = new Database;
        $this->conn = $objDb->connect();
    }

    public function getAllClient()
    {
        if (!isset($_SESSION["id_usuario"])) {
            $errorMsg = 'Acesso negado. Usuário não autenticado.';
            return false;
        }
        try {
            $sql = "SELECT * FROM usuarios";
            $db = $this->conn->prepare($sql);
            $db->execute();
            $users = $db->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            return false;
        }
    }

    public function getUserById($id)
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION["id_usuario"])) {
            return false; // Ou lançar uma exceção personalizada
        }

        try {
            // Prepara e executa a consulta
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Retorna o usuário encontrado, ou `false` se não houver resultado
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ?: false;
        } catch (Exception $e) {
            error_log("Erro ao buscar usuário: " . $e->getMessage());
            return false;
        }
    }

    public function updateUser($id, $nome, $email)
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION["id_usuario"])) {
            return false; // Ou lançar uma exceção personalizada
        }

        try {
            // Prepara e executa a atualização
            $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);

            // Retorna `true` se a atualização foi bem-sucedida, `false` caso contrário
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }
    public function deleteUser($id)
    {
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION["id_usuario"])) {
            return false; // Ou lançar uma exceção personalizada
        }

        try {
            // Prepara e executa a atualização
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    public function createUser()
{
    // Verifica se o usuário está autenticado
    if (!isset($_SESSION["id_usuario"])) {
        return false;
    }

    try {
        // Verifica se os campos obrigatórios estão preenchidos
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);

        // Prepara a consulta SQL para inserir o novo usuário
        $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);

        // Executa a consulta e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    } catch (Exception $e) {
        error_log("Erro ao criar usuário: " . $e->getMessage());
        return false;
    }
}

}
