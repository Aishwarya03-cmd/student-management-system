
<?php

require_once 'config.php';
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// Verify security token
verifyCSRFToken();

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$course = trim($_POST['course'] ?? '');

if ($name === '' || $email === '' || $course === '') {
    die("Please fill all fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

try {

    $stmt = $pdo->prepare(
        "INSERT INTO students (name, email, course)
         VALUES (?, ?, ?)"
    );

    $stmt->execute([$name, $email, $course]);

    header("Location: index.php");
    exit();

} catch (PDOException $e) {

    if ($e->getCode() == '23000') {
        die("Email already exists.");
    }

    die("Unable to add student.");

}
