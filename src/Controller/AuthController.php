<?php
namespace Controller;

use Service\UserService;
use Service\JWTService;

class AuthController {
    private $userService;
    private $jwtService;

    // Конструктор принимает сервисы для работы с пользователями и JWT
    public function __construct(UserService $userService, JWTService $jwtService) {
        $this->userService = $userService;
        $this->jwtService = $jwtService;
    }

    // Метод для обработки логина пользователя
    public function login($username, $password) {
        // Аутентифицируем пользователя через UserService
        $user = $this->userService->authenticate($username, $password);

        // Если пользователь успешно аутентифицирован
        if ($user) {
            // Формируем полезную нагрузку для JWT
            $payload = [
                'iss' => 'http://your-domain.com', // Издатель токена
                'iat' => time(), // Время выпуска токена
                'exp' => time() + 3600, // Время истечения (через 1 час)
                'data' => [
                    'id' => $user['id'],
                    'username' => $user['username']
                ]
            ];

            // Генерируем JWT токен через JWTService
            $token = $this->jwtService->createToken($payload);

            // Возвращаем сгенерированный токен
            return json_encode(['jwt' => $token]);
        } else {
            // Если аутентификация не удалась, возвращаем ошибку
            http_response_code(401);
            return json_encode(['message' => 'Invalid username or password']);
        }
    }
}
?>
