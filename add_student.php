<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($name === '' || $email === '' || $course === '') {
        die("Please fill all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }

    try {

        $sql = "INSERT INTO students (name, email, course)
                VALUES (:name, :email, :course)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':course' => $course
        ]);

        header("Location: index.php");
        exit();

    } catch (PDOException $e) {

        if ($e->getCode() == 23000) {
            die("This email address is already registered.");
        }

        die("Unable to add student. Please try again.");

    }

} else {

    header("Location: index.html");
    exit();

}

?>
