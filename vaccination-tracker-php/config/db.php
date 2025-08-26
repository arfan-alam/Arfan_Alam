<?php
$host = "localhost";   // MySQL host
$db   = "vaccination_tracker"; // Database name
$user = "root";        // MySQL username
$pass = "";            // MySQL password (set if you have one)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>
