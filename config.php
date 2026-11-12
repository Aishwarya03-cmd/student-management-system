
<?php

// Database Configuration

$host = "localhost";
$dbname = "student_management";
$username = "root";
$password = "";

// Start Session

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {

    // Create Database Connection

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Enable Error Handling

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    // Fetch Database Results as Associative Arrays

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {

    // Hide Technical Database Details

    die("Database connection failed. Please check your configuration.");

}

?>
