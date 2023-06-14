<?php
// Start a PHP session
session_start();

// Destroy the session
header('Location: login.php');
exit;

session_destroy();
?>
