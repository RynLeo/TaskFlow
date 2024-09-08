<?php
// get_username.php

header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TaskFlow";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch email from GET request
$email = isset($_GET['email']) ? $conn->real_escape_string($_GET['email']) : '';

// Prepare and execute query to fetch user details
$sql = "SELECT first_name FROM clientdetails WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a row is returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    echo json_encode(['username' => $first_name]);
} else {
    echo json_encode(['username' => 'Guest']);
}

// Close the connection
$stmt->close();
$conn->close();
?>
