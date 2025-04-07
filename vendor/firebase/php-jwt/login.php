<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=test", "root", "");

// Count active users
$stmt = $conn->query("SELECT COUNT(*) FROM active_users");
$activeUsers = $stmt->fetchColumn();

if ($activeUsers >= 100) {
    die("Sorry, the website is full. Try again later.");
}

// Verify user login
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
$stmt->execute([$username, $password]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION["user_id"] = $user["id"];
    
    // Store active session
    $stmt = $conn->prepare("INSERT INTO active_users (session_id, user_id) VALUES (?, ?)");
    $stmt->execute([session_id(), $user["id"]]);

    echo "Login successful!";
} else {
    echo "Invalid login.";
}
?>
