<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json"); // Ensure response is JSON

$conn = new mysqli("localhost", "root", "", "testing");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

// Read JSON input properly
$inputJSON = file_get_contents("php://input");
$data = json_decode($inputJSON, true); // Convert to associative array

// Debugging: Log received data
error_log("Received data: " . $inputJSON);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
    exit();
}

// Ensure all required fields are present
if (isset($data["id"], $data["name"], $data["email"], $data["phone"])) {
    $stmt = $conn->prepare("UPDATE customers SET name=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("sssi", $data["name"], $data["email"], $data["phone"], $data["id"]);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "User updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update user"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
}

$conn->close();
?>
