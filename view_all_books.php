<?php
// Start the PHP session
session_start();
require 'db_config.php';

// Create a prepared statement
$stmt = $conn->prepare("SELECT * FROM Books");

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>View All Books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('background_2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            padding: 20px;
        }

        h1 {
            color: #fff;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="my-4">All Books</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Book ID</th>
                <th scope="col">ISBN</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Quantity</th>
                <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?>
                    <th scope="col">Update/Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row): ?>
        <tr>
            <td><?php echo $row['Book_No']; ?></td>
            <td><?php echo $row['ISBN']; ?></td>
            <td><?php echo $row['Book_Name']; ?></td>
            <td><?php echo $row['Author']; ?></td>
            <td><?php echo $row['Quantity']; ?></td>
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?>
            <td>
                <!-- Update Button -->
                <form action="update_book.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Book_No']; ?>">
                    <input type="text" name="isbn" value="<?php echo $row['ISBN']; ?>">
                    <input type="text" name="title" value="<?php echo $row['Book_Name']; ?>">
                    <input type="text" name="author" value="<?php echo $row['Author']; ?>">
                    <input type="number" name="quantity" value="<?php echo $row['Quantity']; ?>">
                    <input type="submit" value="Update">
                </form>

                <!-- Delete Button -->
                <form action="delete_book.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Book_No']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>

</tbody>

    </table>
<!-- Insert Button -->
<?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?>
<form action="insert_book.php" method="get">
    <input type="submit" value="Insert New Book">
</form>
<?php endif; ?>

</div>
</body>
</html>
