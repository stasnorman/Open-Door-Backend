<?php
namespace Controller;

use Service\GenresService;

class GenresController {
    private $genresService;

    public function __construct(GenresService $genresService) {
        $this->genresService = $genresService;
    }

    public function getAllGenres() {
        $genres = $this->genresService->getAllGenres();
        echo json_encode($genres);
    }

    public function getGenreById($id) {
        $genre = $this->genresService->getGenreById($id);
        if ($genre) {
            echo json_encode($genre);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Genre not found']);
        }
    }
}
?>
