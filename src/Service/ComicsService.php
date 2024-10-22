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
        $query = "
            SELECT 
                comics.id, comics.image_url, comics.name, comics.price, comics.description, 
                comics.published_date, comics.stock,
                authors.id AS author_id, authors.name AS author_name,
                genres.id AS genre_id, genres.genre_name AS genre_name
            FROM 
                comics
            JOIN 
                authors ON comics.author_id = authors.id
            JOIN 
                genres ON comics.genre_id = genres.id
        ";
        
        $statement = $this->conn    ->prepare($query);
        $statement->execute();
        
        $comics = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // Преобразование в нужную структуру
        $result = [];
        foreach ($comics as $comic) {
            $result[] = [
                'id' => (int) $comic['id'],
                'image_url' => $comic['image_url'],
                'name' => $comic['name'],
                'price' => (float) $comic['price'],
                'description' => $comic['description'],
                'author' => [
                    'id' => (int) $comic['author_id'],
                    'name' => $comic['author_name']
                ],
                'genre' => [
                    'id' => (int) $comic['genre_id'],
                    'name' => $comic['genre_name']
                ],
                'published_date' => $comic['published_date'],
                'stock' => (int) $comic['stock']
            ];
        }
        
        return $result;
    }
    

    // Получение комикса по ID
    public function getComicById($id) {
        $query = "
            SELECT 
                comics.id, comics.image_url, comics.name, comics.price, comics.description, 
                comics.published_date, comics.stock,
                authors.id AS author_id, authors.name AS author_name,
                genres.id AS genre_id, genres.genre_name AS genre_name
            FROM 
                comics
            JOIN 
                authors ON comics.author_id = authors.id
            JOIN 
                genres ON comics.genre_id = genres.id
            WHERE 
                comics.id = :id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $comic = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($comic) {
            return [
                'id' => (int) $comic['id'],
                'image_url' => $comic['image_url'],
                'name' => $comic['name'],
                'price' => (float) $comic['price'],
                'description' => $comic['description'],
                'author' => [
                    'id' => (int) $comic['author_id'],
                    'name' => $comic['author_name']
                ],
                'genre' => [
                    'id' => (int) $comic['genre_id'],
                    'name' => $comic['genre_name']
                ],
                'published_date' => $comic['published_date'],
                'stock' => (int) $comic['stock']
            ];
        } else {
            return null;  // Если запись не найдена, можно вернуть null или пустой массив
        }
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
