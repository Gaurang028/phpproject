<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "testing");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

// Read JSON input properly
$inputJSON = file_get_contents("php://input");
$data = json_decode($inputJSON, true);

if (!$data || !isset($data["id"])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

$id = intval($data["id"]);

// Prepare and execute the delete query
$stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    echo json_encode(["status" => "success", "message" => "User deleted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "User not found or could not be deleted"]);
}

$stmt->close();
$conn->close();
?>
