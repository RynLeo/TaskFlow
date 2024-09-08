<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Adjust the username if needed
$password = ""; // Adjust the password if needed
$dbname = "TaskFlow";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<script>hello</script>";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $first_name = trim($_POST['first-name']);
    $last_name = trim($_POST['last-name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone-number']);
    $password = trim($_POST['password']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO clientdetails (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $hashed_password);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
