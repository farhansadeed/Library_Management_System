<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database configuration file
    require 'db_config.php';

    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a prepared statement
    $stmt = $conn->prepare("SELECT * FROM Users WHERE Username = :username AND Password = :password");

    // Bind the parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // Execute the statement
    $stmt->execute();

    // Check if a row is returned
    if ($stmt->rowCount() > 0) {
        // Store the username in the session
        $_SESSION['username'] = $username;

        // Redirect to the dashboard page
        header('Location: dashboard.php');
        exit;
    } else {
        // Display an error message
        $error_message = "Invalid username or password";
    }

    // Close the statement
    $stmt = null;

    // Close the database connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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

        .form-label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .error-message {
            color: #dc3545;
            margin-top: 10px;
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
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <?php if (isset($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
