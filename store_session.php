<?php
session_save_path("C:/wamp64/www/sessions"); // Set custom session save path
session_start(); // Start the session

// Store session variables
$_SESSION["username"] = "JohnDoe";
$_SESSION["email"] = "johndoe@example.com";
$_SESSION["role"] = "admin";

echo "Session data stored successfully.";
?>
