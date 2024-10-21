<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';        // Хост базы данных
    private $db_name = 'burnfeniks_opendoor'; // Имя базы данных
    private $username = '046351469_open';// Имя пользователя
    private $password = '046351469_open';// Пароль пользователя
    private $conn;                      // Соединение с базой данных

    // Метод для получения подключения к базе данных
    public function getConnection() {
        $this->conn = null;

        try {
            // Создаем новое соединение с базой данных через PDO с указанием кодировки utf8mb4
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            
            // Устанавливаем режим обработки ошибок
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Устанавливаем кодировку для всех запросов
            $this->conn->exec("SET NAMES 'utf8mb4'");
        
        } catch (PDOException $exception) {
            // Обрабатываем ошибки подключения
            echo "Connection error: " . $exception->getMessage();
        }
        

        // Возвращаем соединение (или null, если не удалось подключиться)
        return $this->conn;
    }
}
?>
