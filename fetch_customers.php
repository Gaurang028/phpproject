<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";  // Change this if needed
$password = "";      // Change this if needed
$database = "testing";  // Make sure this matches your actual database name

// Create Connection
$conn = new mysqli($servername, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// SQL Query to Fetch All Customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $customers = [];

    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }

    echo json_encode(["status" => "success", "data" => $customers], JSON_PRETTY_PRINT);
} else {
    echo json_encode(["status" => "error", "message" => "No customers found"]);
}

$conn->close();
?>
