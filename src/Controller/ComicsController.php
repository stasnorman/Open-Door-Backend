<?php
namespace Controller;

use Service\ComicsService;

class ComicsController {
    private $comicsService;

    public function __construct(ComicsService $comicsService) {
        $this->comicsService = $comicsService;
    }

    // Получение всех комиксов
    public function getAllComics() {
        header('Content-Type: application/json; charset=utf-8');
        $comics = $this->comicsService->getAllComics();
        echo json_encode($comics, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    // Получение одного комикса по ID
    public function getComicById($id) {
        header('Content-Type: application/json; charset=utf-8');
        $comic = $this->comicsService->getComicById($id);
        if ($comic) {
            echo json_encode($comic, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Comic not found'], JSON_UNESCAPED_UNICODE);
        }
    }

    // Создание нового комикса
    public function createComic() {
        header('Content-Type: application/json; charset=utf-8');
        $input = json_decode(file_get_contents('php://input'), true);

        if ($this->comicsService->createComic($input)) {
            http_response_code(201); // Created
            echo json_encode(['message' => 'Comic created successfully'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'Failed to create comic'], JSON_UNESCAPED_UNICODE);
        }
    }

    // Полное или частичное обновление комикса (PUT или PATCH)
    public function updateComic($id, $isPatch = false) {
        header('Content-Type: application/json; charset=utf-8');
        $input = json_decode(file_get_contents('php://input'), true);

        if ($this->comicsService->updateComic($id, $input, $isPatch)) {
            http_response_code(200); // OK
            echo json_encode(['message' => 'Comic updated successfully'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'Failed to update comic'], JSON_UNESCAPED_UNICODE);
        }
    }

    // Удаление комикса
    public function deleteComic($id) {
        header('Content-Type: application/json; charset=utf-8');
        if ($this->comicsService->deleteComic($id)) {
            http_response_code(200); // OK
            echo json_encode(['message' => 'Comic deleted successfully'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'Failed to delete comic'], JSON_UNESCAPED_UNICODE);
        }
    }
}
