<?php
// config.php - update credentials accordingly

$host = 'localhost';
$dbname = 'crustonlinesystem';         // ✅ Your actual database name
$username = 'root';              // ✅ Common default for local development
$password = '';                  // ✅ Empty password for XAMPP/MAMP/WAMP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
