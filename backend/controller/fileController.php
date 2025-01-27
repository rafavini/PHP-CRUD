<?php

include_once __DIR__ . '/../db/database.php';

class FileController
{
    private $conn;

    public function __construct()
    {
        $objDb = new Database;
        $this->conn = $objDb->connect();
    }

    public function SalvarImagem($fileName)
    {   
        try {
            $sql = "INSERT INTO images(fileName) values(:fileName)";
            $db = $this->conn->prepare($sql);
            $db->bindParam(":fileName", $fileName);
            if ($db->execute()) {
                return true;
            } else {
                return false;
            }

            return $resposta;
        } catch (Exception $e) {
            echo json_encode(['status' => 0, 'message' => 'Erro ao validar usuário: ' . $e->getMessage()]);
        }
    }

    public function GetAllImages(){
        try {
            $sql = "SELECT * FROM images";
            $db = $this->conn->prepare($sql);
            $db->execute();
            $images = $db->fetchAll(PDO::FETCH_ASSOC);
            return $images;
        } catch (Exception $e) {
            echo json_encode(['status' => 0, 'message' => 'Erro ao validar usuário: ' . $e->getMessage()]);
        }
    }
}
