<?php
$host = "localhost"; // Change this if your database is on another server
$user = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "webkul"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}
?>
