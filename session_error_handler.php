<?php
session_start();
$response = [];

if (isset($_SESSION['login_error'])) {
    $response['error'] = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Clear the error after showing it
}

echo json_encode($response);
?>