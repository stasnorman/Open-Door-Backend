<?php
/**
 * Универсальный автозагрузчик для классов, использующих стандарт PSR-4
 */

spl_autoload_register(function ($class) {
    // Массив пространств имен и их соответствующих директорий
    $namespaces = [
        'Service\\' => __DIR__ . '/../src/Service/',
        'Controller\\' => __DIR__ . '/../src/Controller/',
        'Config\\' => __DIR__ . '/../src/Config/',
        // Добавляйте другие пространства имен по необходимости
    ];

    // Проход по каждому пространству имен
    foreach ($namespaces as $prefix => $base_dir) {
        $len = strlen($prefix);
        
        // Проверка, начинается ли имя класса с текущего пространства имен
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        // Получение относительного имени класса
        $relative_class = substr($class, $len);

        // Построение полного пути к файлу
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Проверка существования файла и его подключение
        if (file_exists($file)) {
            require $file;
            break;
        }
    }
});

