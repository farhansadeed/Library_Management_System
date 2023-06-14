<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-image: url('background_image.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .card {
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

        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }

        .list-group-item {
            border: none;
            background-color: transparent;
            padding: 8px 16px;
            color: #007bff;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Library Management System</h3>
            </div>
            <div class="card-body">
                <p class="welcome-message">Welcome, <?php echo $_SESSION['username']; ?>!</p>
                <ul class="list-group">
                    <li class="list-group-item"><a href="view_all_books.php">View All Books</a></li>
                    <li class="list-group-item"><a href="view_all_users.php">View All Users</a></li>
                    <li class="list-group-item"><a href="view_all_transactions.php">View All Transactions</a></li>
                    <li class="list-group-item"><a href="search.php">Search for Book Checkouts</a></li>
                    <li class="list-group-item"><a href="logout.php">Logout</a></li> <!-- Your new Logout link -->
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
