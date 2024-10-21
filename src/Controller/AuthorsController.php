<?php
namespace Controller;

use Service\AuthorsService;

class AuthorsController {
    private $authorsService;

    public function __construct(AuthorsService $authorsService) {
        $this->authorsService = $authorsService;
    }

    public function getAllAuthors() {
        $authors = $this->authorsService->getAllAuthors();
        echo json_encode($authors);
    }

    public function getAuthorById($id) {
        $author = $this->authorsService->getAuthorById($id);
        if ($author) {
            echo json_encode($author);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Author not found']);
        }
    }
}
?>
