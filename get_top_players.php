<?php
header('Content-Type: application/json');

// Параметры подключения к базе данных
$server = "95.213.255.80";
$database = "s1126_1v1";
$username = "u1126_BrDnq9Ff94";
$password = "GGOGDcFSi2H@BcVVK0G.Lief";

try {
    // Подключение к базе данных
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

    // Запрос для получения топ-3 игроков
    $stmt = $conn->prepare("SELECT name, value FROM lvl_base ORDER BY value DESC LIMIT 3");
    $stmt->execute();

    // Получаем результаты
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Отправляем результаты в формате JSON
    echo json_encode($results);
} catch(PDOException $e) {
    // В случае ошибки отправляем сообщение об ошибке
    echo json_encode(['error' => 'Ошибка подключения к базе данных: ' . $e->getMessage()]);
}
?>