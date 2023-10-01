<?php
session_start(); // 開始會話

// 連線MySQL資料庫
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "star";

// 建立資料庫連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗：" . $conn->connect_error);
}

$conn->query("SET NAMES UTF8");

// 獲取用戶提交的表單數據
$account = $_POST['account'];
$password = $_POST['password'];

// 在這裡可以進一步驗證用戶名稱和密碼等

// 使用 Prepared Statements 來防止 SQL 注入攻擊
$stmt = $conn->prepare("SELECT * FROM users WHERE account=? AND password=?");
$stmt->bind_param("ss", $account, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($re = $result->fetch_array()) {
    // 登入成功
    $_SESSION['username'] = $re["user_Name"];
    $_SESSION['account'] = $re["account"];
    $_SESSION['userId'] = $re["user_Id"];
    $_SESSION['message'] = "登入成功！";
    header("Location: ./community.php");
    exit();
} else {
    // 登入失敗
    $_SESSION['message'] = "登入失敗：帳號或密碼錯誤。";
    header("Location: ./community.php");
    exit();
}
?>