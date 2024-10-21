<?php
namespace Model;

use PDO;

class User {
    private $conn;
    private $table = 'users'; // Имя таблицы пользователей

    public function __construct($db) {
        $this->conn = $db; // Сохраняем подключение к базе данных
    }

    // Метод для получения пользователя по имени пользователя
    public function getUserByUsername($username) {
        // SQL-запрос для поиска пользователя по имени
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        
        // Подготовка запроса
        $stmt = $this->conn->prepare($query);
        
        // Привязываем значение параметра username
        $stmt->bindParam(':username', $username);
        
        // Выполняем запрос
        $stmt->execute();
        
        // Возвращаем результат в виде ассоциативного массива
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
