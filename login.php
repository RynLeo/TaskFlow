<?php
session_start();

// Database connection
$servername = "localhost"; // Change if necessary
$username = "root";        // Change if necessary
$password = "";            // Change if necessary
$dbname = "taskflow";      // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Please fill out both fields.";
        header("Location: login.html");
        exit();
    }

    // Prepare and execute the query
    $sql = "SELECT * FROM clientdetails WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $_SESSION['login_error'] = "User does not exist.";
    } else {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful, redirect to task.html
            $_SESSION['user_id'] = $user['id'];
            header("Location: task.html");
            exit();
        } else {
            // Invalid password
            $_SESSION['login_error'] = "Username/password is invalid.";
        }
    }

    // Redirect back to login page with error message
    header("Location: login.html");
    exit();
}
