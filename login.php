<?php
session_start();
header("Content-Type: application/json");

$conn = new PDO("mysql:host=localhost;dbname=testing", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

$stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user["password"])) {
    echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
    exit;
}

$_SESSION["user_id"] = $user["id"];
echo json_encode(["status" => "success", "message" => "Login successful"]);
?>
