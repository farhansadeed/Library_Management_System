<?php
require 'db_config.php';

// Get the form data
$id = $_POST['id'];

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    die("You do not have permission to access this page!");
}

// Create a prepared statement
$stmt = $conn->prepare("DELETE FROM Transactions WHERE id = ?");
$stmt->bind_param("i", $id);

// Execute the statement
if ($stmt->execute()) {
    echo "Transaction deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
