<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Разрешаем CORS запросы

// Проверка, что скрипт вызывается через HTTP
if (php_sapi_name() === 'cli') {
    die(json_encode(['error' => 'Direct access not allowed']));
}

// Конфигурация базы данных
$config = [
    'host' => '95.213.255.80',
    'db'   => 's1126_1v1',
    'user' => 'u1126_BrDnq9Ff94',
    'pass' => 'GGOGDcFSi2H@BcVVK0G.Lief'
];

try {
    // Подключение к БД
    $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset=utf8";
    $pdo = new PDO($dsn, $config['user'], $config['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Запрос топ-3 игроков
    $stmt = $pdo->query("SELECT name, value FROM lvl_base ORDER BY value DESC LIMIT 3");
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Ответ в JSON
    echo json_encode([
        'success' => true,
        'data' => $players
    ], JSON_UNESCAPED_UNICODE);
    
} catch(PDOException $e) {
    // Обработка ошибок
    echo json_encode([
        'success' => false,
        'error' => 'Database error',
        'message' => $e->getMessage()
    ]);
}
?>
