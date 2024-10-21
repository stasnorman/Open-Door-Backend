<?php
namespace Service;

use Model\User;

class UserService {
    private $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function authenticate($username, $password) {
        // Получаем пользователя из модели
        $user = $this->userModel->getUserByUsername($username);

        // Проверяем, существует ли пользователь и корректен ли пароль
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        // Возвращаем null, если аутентификация не удалась
        return null;
    }
}
?>
