<?php
namespace Service;

class JWTService {
    private $secret;

    public function __construct($secret) {
        $this->secret = $secret;
    }

    // Кодирование данных в Base64Url
    private function base64UrlEncode($data) {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    // Декодирование данных из Base64Url
    private function base64UrlDecode($data) {
        $base64 = str_replace(['-', '_'], ['+', '/'], $data);
        $padding = strlen($base64) % 4;
        if ($padding > 0) {
            $base64 .= str_repeat('=', 4 - $padding);
        }
        return base64_decode($base64);
    }

    // Создание JWT токена
    public function createToken($payload) {
        $header = ['alg' => 'HS256', 'typ' => 'JWT'];
        
        // Кодируем заголовок и полезную нагрузку
        $headerEncoded = $this->base64UrlEncode(json_encode($header));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));

        // Создаем подпись
        $signature = hash_hmac('SHA256', "$headerEncoded.$payloadEncoded", $this->secret, true);
        $signatureEncoded = $this->base64UrlEncode($signature);

        // Возвращаем итоговый токен
        return "$headerEncoded.$payloadEncoded.$signatureEncoded";
    }

    // Проверка JWT токена
    public function validateToken($jwt) {
        // Разбиваем токен на части
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return false;
        }

        // Получаем части токена
        [$headerEncoded, $payloadEncoded, $signatureProvided] = $parts;

        // Проверяем подпись
        $signature = hash_hmac('SHA256', "$headerEncoded.$payloadEncoded", $this->secret, true);
        $signatureEncoded = $this->base64UrlEncode($signature);

        // Проверяем, совпадает ли подпись
        if ($signatureProvided !== $signatureEncoded) {
            return false;
        }

        // Декодируем полезную нагрузку
        $payload = json_decode($this->base64UrlDecode($payloadEncoded), true);

        // Проверяем срок действия токена
        if (isset($payload['exp']) && time() >= $payload['exp']) {
            return false;
        }

        return $payload;
    }
}
?>
