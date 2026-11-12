
<?php

require_once 'config.php';
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

verifyCSRFToken();

$id = $_POST['id'] ?? '';

if (!ctype_digit((string)$id)) {
    die("Invalid student ID.");
}

$stmt = $pdo->prepare(
    "DELETE FROM students WHERE id = ?"
);

$stmt->execute([(int)$id]);

header("Location: index.php");
exit();

?>
