<?php
header('Content-Type: application/json');
// Убедитесь, что путь к файлу swagger.json корректен
echo file_get_contents(__DIR__ . '/../swagger/swagger.json');
