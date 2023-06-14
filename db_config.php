<?php
$host = 'localhost';  // The hostname of your database server
$db   = 'librarydb'; // The name of your database
$user = 'root';       // The username to connect to the database
$pass = '';           // The password to connect to the database
$charset = 'utf8mb4'; // The character set to use for the connection

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $conn = new PDO($dsn, $user, $pass, $opt);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
