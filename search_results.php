<?php

require 'db_config.php';

// Get the form data
$student_id = $_POST['student_id'];

// Create a prepared statement
$stmt = $conn->prepare("SELECT * FROM Transactions WHERE Student_ID = :student_id");

// Bind the parameters
$stmt->bindParam(':student_id', $student_id);

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
    <title>View Search Results</title>
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
    <h1 class="my-4">Search Results</h1>
    <?php if ($result && count($result) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Book No.</th>
                    <th scope="col">Checkout Date</th>
                    <th scope="col">Return Date</th>
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
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No search results found.</p>
    <?php endif; ?>
</div>
</body>
</html>
