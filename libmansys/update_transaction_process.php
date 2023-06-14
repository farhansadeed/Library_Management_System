<?php
session_start();
require 'db_config.php';

// Get the form data
$id = $_POST['id'];
$return_date = $_POST['return_date'];

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("You do not have permission to access this page!");
}

// Turn on output buffering
ob_start();

// Create a prepared statement
$stmt = $conn->prepare("UPDATE Transactions SET return_date = ? WHERE id = ?");
$stmt->bind_param("si", $return_date, $id);

// Execute the statement
if ($stmt->execute()) {
    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect the admin user to the dashboard
    header('Location: dashboard.php');
    exit;
} else {
    $message = "Error: " . $stmt->error;
    $stmt->close();
    $conn->close();
}

// Flush the output buffer and send the output to the browser
ob_end_flush();
?>
