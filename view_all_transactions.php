<?php
// Start the PHP session
session_start();
require 'db_config.php';

// Create a prepared statement
$stmt = $conn->prepare("SELECT * FROM Transactions");

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the statement
$stmt = null;

// Close the database connection
$conn = null;
?>
<html>
<head>
    <title>View All Transactions</title>
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
    <h1 class="my-4">All Transactions</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Transaction ID</th>
                <th scope="col">Student ID</th>
                <th scope="col">Book ID</th>
                <th scope="col">Checkout Date</th>
                <th scope="col">Return Date</th>
                <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row['Transaction_ID']; ?></td>
                    <td><?php echo $row['Student_ID']; ?></td>
                    <td><?php echo $row['Book_No']; ?></td>
                    <td><?php echo $row['Checkout_Date']; ?></td>
                    <td><?php echo $row['Return_Date']; ?></td>
                    <?php if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?>
                        <td><a href="update_transaction.php?id=<?php echo $row['Transaction_ID']; ?>" class="btn btn-primary">Update</a></td>
                        <td><a href="delete_transaction.php?id=<?php echo $row['Transaction_ID']; ?>" class="btn btn-danger">Delete</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
