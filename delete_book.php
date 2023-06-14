<?php
require 'db_config.php';

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM Books WHERE Book_No = :id");
$stmt->bindParam(':id', $id);

$stmt->execute();

echo "Book deleted successfully!";
?>
