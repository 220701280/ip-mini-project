<?php
$host = 'localhost';
$dbname = 'forex';
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

