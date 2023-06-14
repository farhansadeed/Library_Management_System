<?php
session_start();

require 'db_config.php';

// Get the form data
$id = $_GET['id'];

// Create a prepared statement
$stmt = $conn->prepare("DELETE FROM Transactions WHERE Transaction_ID = :id");
$stmt->bindParam(':id', $id);

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    die("You do not have permission to access this page!");
}

// Execute the statement
if ($stmt->execute()) {
    echo "Transaction deleted successfully!";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

// Close the statement
$stmt = null;

// Close the database connection
$conn = null;
?>
