<?php
namespace Service;

use PDO;

class GenresService {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Получить все жанры
    public function getAllGenres() {
        $query = "SELECT * FROM genres";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получить жанр по ID
    public function getGenreById($id) {
        $query = "SELECT * FROM genres WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
