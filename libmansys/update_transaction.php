<?php
session_start(); 
require 'db_config.php';

// Get the form data
$id = $_GET['id'];
$return_date = isset($_POST['return_date']) ? $_POST['return_date'] : null;

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    die("You do not have permission to access this page!");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create a prepared statement
    $stmt = $conn->prepare("UPDATE Transactions SET Return_Date = :return_date WHERE Transaction_ID = :id");
    $stmt->bindParam(':return_date', $return_date);
    $stmt->bindParam(':id', $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Transaction updated successfully!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    // Close the statement
    $stmt = null;
    
    // Close the database connection
    $conn = null;

    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-image: url('background_2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            margin-top: 200px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Update Transaction</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <label for="return_date">Return Date:</label><br>
                    <input type="date" id="return_date" name="return_date"><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
