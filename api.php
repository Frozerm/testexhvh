<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Разрешаем запросы с любого домена (для теста)

$servername = "95.213.255.80";
$username = "u1126_BrDnq9Ff94";
$password = "GGOGDcFSi2H@BcVVK0G.Lief";
$dbname = "s1126_1v1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->query("SELECT name, value FROM lvl_base ORDER BY value DESC LIMIT 3");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
