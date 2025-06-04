<?php

include_once __DIR__ . '/../config/database.php';


class UsuarioController
{
    private $conn;
    private $db;
    public $errorMsg;

    public function __construct()
    {
        
        // $objDb = new Database;
        // $this->conn = $objDb->connect();
        $this->db = new Database();
        
    }

    public function GetAllUsers()
    {
        // Prepare a SQL query to select all records from the book table
        $this->db->query("SELECT * FROM usuario");
        // Execute the prepared query
        $this->db->execute();
        // Return the results of the query
        return $this->db->results();
    }

    public function getUserById($id)
    {
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

    public function createUser($nome, $email)
    {
        try {

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

    public function getUsersByPage($offset, $limit) {
        $sql = "SELECT * FROM usuario ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $this->db->query($sql);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        $this->db->execute();
        return $this->db->results();
    }


    public function listarPaginado($limit, $offset) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = new Usuario($row['id'], $row['nome']);
        }
        return $usuarios;
    }

    public function contarTotal() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM $this->table");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
}
