<?php
require 'db_config.php';

// Create a prepared statement
$stmt = $conn->prepare("SELECT * FROM Users");

// Execute the statement
$stmt->execute();

// Fetch all the results
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Close the statement
$stmt = null;

// Close the database connection
$conn = null;
?>

<html>
<head>
    <title>View All Users</title>
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
    <h1 class="my-4">All Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
            <tr>
                <td><?php echo $row['Student_ID']; ?></td>
                <td><?php echo $row['Student_Name']; ?></td>
                <td><?php echo $row['Username']; ?></td>
                <td><?php echo $row['role']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
