<?php
namespace Service;

use PDO;

class ComicsService {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Получение всех комиксов
    public function getAllComics() {
        $query = "SELECT * FROM comics";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получение комикса по ID
    public function getComicById($id) {
        $query = "SELECT * FROM comics WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Создание нового комикса
    public function createComic($data) {
        $query = "INSERT INTO comics (image_url, name, price, description, author_id, genre_id, published_date, stock)
                  VALUES (:image_url, :name, :price, :description, :author_id, :genre_id, :published_date, :stock)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':image_url' => $data['image_url'],
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':author_id' => $data['author_id'],
            ':genre_id' => $data['genre_id'],
            ':published_date' => $data['published_date'],
            ':stock' => $data['stock']
        ]);
    }

    // Обновление комикса
    public function updateComic($id, $data, $isPatch = false) {
        $comic = $this->getComicById($id);

        if (!$comic) {
            return false;
        }

        // В зависимости от того, используется ли PATCH или PUT, обновляем только переданные данные
        $data = array_merge($comic, $data);

        $query = "UPDATE comics SET image_url = :image_url, name = :name, price = :price, description = :description, 
                  author_id = :author_id, genre_id = :genre_id, published_date = :published_date, stock = :stock
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id' => $id,
            ':image_url' => $data['image_url'],
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':author_id' => $data['author_id'],
            ':genre_id' => $data['genre_id'],
            ':published_date' => $data['published_date'],
            ':stock' => $data['stock']
        ]);
    }

    // Удаление комикса
    public function deleteComic($id) {
        $query = "DELETE FROM comics WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
