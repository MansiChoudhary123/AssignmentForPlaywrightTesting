<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "webkul";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data with proper validation
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : null;
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $dob = isset($_POST['dob']) ? trim($_POST['dob']) : null;
    $city = isset($_POST['city']) ? trim($_POST['city']) : null;
    $state = isset($_POST['state']) ? trim($_POST['state']) : null;

    // Check if required fields are empty
    if (!$firstName || !$email || !$password) {
        die(json_encode(["status" => "error", "message" => "Required fields missing."]));
    }

    // Hash password before storing
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, phoneNumber, Password, DOB, city, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Database error: " . $conn->error]));
    }

    $stmt->bind_param("ssssssss", $firstName, $lastName, $email, $phone, $hashedPassword, $dob, $city, $state);

    // Execute query
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "User registered successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

$conn->close();
?>
