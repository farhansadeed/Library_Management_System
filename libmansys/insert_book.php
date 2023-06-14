<?php
require 'db_config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];
    // Get other book attributes from $_POST here

    $stmt = $conn->prepare("INSERT INTO Books (ISBN, Book_Name, Author, Quantity) VALUES (:isbn, :book_name, :author, :quantity)");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':book_name', $title);  // 'Book_Name' is used in the SQL statement, 'title' is used in the form
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':quantity', $quantity);
    

    $stmt->execute();

    echo "Book added successfully!";
} else {
    // Display the form if the form is not submitted
?>
    <form action="insert_book.php" method="post">
        <label for="isbn">ISBN:</label><br>
        <input type="text" id="isbn" name="isbn"><br>
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author"><br>
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" min="0"><br>
        <input type="submit" value="Add Book">
    </form>
<?php
}
?>
