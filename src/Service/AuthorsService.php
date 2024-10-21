<?php
namespace Service;

use PDO;

class AuthorsService {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Получить всех авторов
    public function getAllAuthors() {
        $query = "SELECT * FROM authors";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получить автора по ID
    public function getAuthorById($id) {
        $query = "SELECT * FROM authors WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
