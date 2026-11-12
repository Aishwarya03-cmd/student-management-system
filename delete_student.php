
<?php

require_once 'config.php';
require_once 'functions.php';

// Allow only POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// Verify CSRF security token
verifyCSRFToken();

// Get student ID
$id = $_POST['id'] ?? '';

if (!ctype_digit((string)$id)) {
    die("Invalid student ID.");
}

try {

    // Delete student from database
    $stmt = $pdo->prepare(
        "DELETE FROM students WHERE id = ?"
    );

    $stmt->execute([(int)$id]);

    header("Location: index.php");
    exit();

} catch (PDOException $e) {

    die("Unable to delete student. Please try again.");

}

?>
