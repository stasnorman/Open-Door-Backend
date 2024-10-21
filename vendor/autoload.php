<?php
/**
 * Автозагрузчик для классов, использующих стандарт PSR-4
 */

// Автозагрузка классов из пространства имен 'Service'
spl_autoload_register(function ($class) {
    $prefix = 'Service\\';
    $base_dir = __DIR__ . '/../src/Service/';
    $len = strlen($prefix);
    
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Автозагрузка классов из пространства имен 'Controller'
spl_autoload_register(function ($class) {
    $prefix = 'Controller\\';
    $base_dir = __DIR__ . '/../src/Controller/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Автозагрузка классов из пространства имен 'Config' (например, для базы данных)
spl_autoload_register(function ($class) {
    $prefix = 'Config\\';
    $base_dir = __DIR__ . '/../src/Config/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Если у вас есть другие пространства имен, добавляйте их аналогичным образом
