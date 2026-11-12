<?php

require_once 'config.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid student ID.");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);

$student = $stmt->fetch();

if (!$student) {
    die("Student not found.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $status = $_POST['status'] ?? 'Active';

    if ($name === '' || $email === '' || $course === '') {
        $message = "Please fill all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Enter a valid email address.";
    } elseif (!in_array($status, ['Active', 'Inactive'], true)) {
        $message = "Invalid status.";
    } else {

        try {

            $update = $pdo->prepare(
                "UPDATE students
                 SET name = ?, email = ?, course = ?, status = ?
                 WHERE id = ?"
            );

            $update->execute([
                $name,
                $email,
                $course,
                $status,
                $id
            ]);

            header("Location: index.php");
            exit();

        } catch (PDOException $e) {
            $message = "Unable to update student. Email may already exist.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-content">

    <section class="form-section">
        <h2>Edit Student Details</h2>

        <?php if ($message): ?>
            <p><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST">

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($student['name']) ?>"
                placeholder="Student Name"
                required
            >

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($student['email']) ?>"
                placeholder="Email Address"
                required
            >

            <input
                type="text"
                name="course"
                value="<?= htmlspecialchars($student['course']) ?>"
                placeholder="Course"
                required
            >

            <select name="status">
                <option value="Active" <?= $student['status'] === 'Active' ? 'selected' : '' ?>>
                    Active
                </option>

                <option value="Inactive" <?= $student['status'] === 'Inactive' ? 'selected' : '' ?>>
                    Inactive
                </option>
            </select>

            <button type="submit">Update Student</button>

        </form>

        <p><a href="index.php">Back to Dashboard</a></p>
    </section>

</div>

</body>
</html>
