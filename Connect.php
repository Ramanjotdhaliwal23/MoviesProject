<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Database connection details
$host = '127.0.0.1'; // Use '127.0.0.1' instead of 'localhost' if needed
$dbname = 'blockbustermovies';
$user = 'root'; // Your database username
$password = ''; // Your database password (leave blank if no password)

// Create a new PDO instance
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
