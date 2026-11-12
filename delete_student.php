<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST['id'] ?? '';

    if (!ctype_digit((string)$id)) {
        die("Invalid student ID.");
    }

    try {

        $stmt = $pdo->prepare(
            "DELETE FROM students WHERE id = ?"
        );

        $stmt->execute([(int)$id]);

        header("Location: index.php");
        exit();

    } catch (PDOException $e) {

        die("Unable to delete student. Please try again.");

    }

} else {

    header("Location: index.php");
    exit();

}

?>
