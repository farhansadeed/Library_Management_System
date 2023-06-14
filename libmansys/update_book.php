<?php
echo "<pre>";
var_dump($_POST);
echo "</pre>";


require 'db_config.php';

if (isset($_POST['id']) && isset($_POST['isbn']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE Books SET ISBN = :isbn, Book_Name = :title, Author = :author, Quantity = :quantity WHERE Book_No = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':quantity', $quantity);

    $stmt->execute();

    echo "Book updated successfully!";
} else {
    echo "Missing required field(s)";
}
?>
