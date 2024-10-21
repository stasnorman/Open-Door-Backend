<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Config\Database;
use Service\ComicsService;
use Controller\ComicsController;

// Создаем объект базы данных и подключаемся
$database = new Database();
$db = $database->getConnection();

// Создаем сервис и контроллер для работы с комиксами
$comicsService = new ComicsService($db);
$comicsController = new ComicsController($comicsService);

// Получаем метод запроса и маршрут
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Удаляем базовый путь (если API находится в поддиректории, например, /public)
$basePath = '/public';
$uri = substr($uri, strlen($basePath));

// Разбиваем путь на части
$uriParts = explode('/', trim($uri, '/'));

// Проверка метода и пути
if ($method === 'GET') {
    if ($uriParts[0] === 'comics') {
        // Если путь "/comics" без параметров, возвращаем все комиксы
        if (!isset($uriParts[1]) || $uriParts[1] === '') {
            $comicsController->getAllComics();
        }
        // Если путь "/comics/{id}", возвращаем комикс по ID
        elseif (isset($uriParts[1]) && is_numeric($uriParts[1])) {
            $comicsController->getComicById($uriParts[1]);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Endpoint not found']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
    }
} elseif ($method === 'POST' && $uriParts[0] === 'comics') {
    $comicsController->createComic();
} elseif ($method === 'PUT' || $method === 'PATCH') {
    if ($uriParts[0] === 'comics' && isset($uriParts[1]) && is_numeric($uriParts[1])) {
        $comicsController->updateComic($uriParts[1], $method === 'PATCH');
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
    }
} elseif ($method === 'DELETE' && $uriParts[0] === 'comics' && isset($uriParts[1])) {
    $comicsController->deleteComic($uriParts[1]);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Method Not Allowed']);
}
