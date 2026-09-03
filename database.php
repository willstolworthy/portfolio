<?php

$autoload = __DIR__ . "/vendor/autoload.php";
if (!is_file($autoload)) {
    http_response_code(500);
    exit('Composer dependencies are missing: run composer install / upload vendor/.');
}
require_once $autoload;

Dotenv\Dotenv::createImmutable(__DIR__)->load();

$debug = ($_ENV['APP_DEBUG'] ?? 'false') === 'true';
if ($debug) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

try {
    $dsn = "mysql:host={$_ENV['DB_HOST']}"
         . ";port=" . ($_ENV['DB_PORT'] ?? '3306')
         . ";dbname={$_ENV['DB_NAME']}"
         . ";charset=" . ($_ENV['DB_CHARSET'] ?? 'utf8mb4');

    $pdo = new PDO(
        $dsn,
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    error_log('DB connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit($debug ? 'Database unavailable: ' . $e->getMessage() : 'Database unavailable.');
}
