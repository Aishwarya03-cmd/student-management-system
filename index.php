
<?php

require_once 'config.php';
require_once 'functions.php';

// Fetch all students
$stmt = $pdo->query(
    "SELECT * FROM students ORDER BY id DESC"
);

$students = $stmt->fetchAll();

// Dashboard statistics
$totalStudents = count($students);

$activeStudents = count(
    array_filter($students, function ($student) {
        return $student['status'] === 'Active';
    })
);

$inactiveStudents = $totalStudents - $activeStudents;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>EduTrack - Student Management System</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<!-- Sidebar -->

<aside class="sidebar">

    <h2>Edu<span>Track</span></h2>

    <p class="menu-title">MAIN MENU</p>

    <a href="index.php" class="active">Dashboard</a>

    <a href="#students">Students</a>

    <a href="#add-student">Add Student</a>

</aside>


<!-- Main Content -->

<main class="main-content">

    <!-- Header -->

    <header class="topbar">

        <div>

            <h1>Student Dashboard</h1>

            <p>Welcome to EduTrack Management Portal</p>

        </div>

        <div class="admin">

            Admin

        </div>

    </header>


    <!-- Statistics -->

    <section class="stats">

        <div class="stat-card">

            <p>Total Students</p>

            <h2><?= $totalStudents ?></h2>

        </div>

        <div class="stat-card">

            <p>Active Students</p>

            <h2><?= $activeStudents ?></h2>

        </div>

        <div class="stat-card">

            <p>Inactive Students</p>

            <h2><?= $inactiveStudents ?></h2>

        </div>

    </section>


    <!-- Add Student Form -->

    <section class="form-section" id="add-student">

        <h2>Add New Student</h2>

        <form action="add_student.php" method="POST">

            <?= csrfField() ?>

            <input
                type="text"
                name="name"
                placeholder="Enter Student Name"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Enter Email Address"
                required
            >

            <input
                type="text"
                name="course"
                placeholder="Enter Course"
                required
            >

            <button type="submit">

                Add Student

            </button>

        </form>

    </section>


    <!-- Student Records -->

    <section class="table-section" id="students">

        <h2>Student Records</h2>

        <input
            type="text"
            id="searchInput"
            placeholder="Search students..."
        >

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Course</th>

                    <th>Status</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>

                <?php if (count($students) > 0): ?>

                    <?php foreach ($students as $student): ?>

                        <tr>

                            <td>
                                <?= (int)$student['id'] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['email']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['course']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($student['status']) ?>
                            </td>

                            <td>

                                <a href="edit_student.php?id=<?= (int)$student['id'] ?>">
                                    Edit
                                </a>

                                <form
                                    action="delete_student.php"
                                    method="POST"
                                    class="delete-form"
                                >

                                    <?= csrfField() ?>

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int)$student['id'] ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">
                            No students found. Add your first student!
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </section>


    <!-- Footer -->

    <footer>

        © 2026 EduTrack | Student Management System

    </footer>

</main>


<script src="script.js"></script>

</body>

</html>
