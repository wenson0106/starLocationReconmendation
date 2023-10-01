<?php
$host = 'localhost';  // 你的資料庫伺服器地址
$db   = 'star';  // 你的資料庫名稱
$user = 'root';  // 資料庫使用者名稱
$pass = '';  // 資料庫密碼
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$buttonId = $_POST['buttonId'];
$userIp = $_SERVER['REMOTE_ADDR']; // 獲取使用者的IP地址

$stmt = $pdo->prepare("INSERT INTO button_clicks (button_id, user_ip) VALUES (?, ?)");
$stmt->execute([$buttonId, $userIp]);

echo "Inserted successfully";
?>