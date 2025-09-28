<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Student Records</h2>
    <a href="insert.php" class="btn btn-success mb-3">Add Student</a>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Number</th><th>Full name</th><th>Email Address</th><th>Course</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['studentID'] ?></td>
                <td><?= $row['studentName'] ?></td>
                <td><?= $row['studentEmail'] ?></td>
                <td><?= $row['studentCourse'] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['studentID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['studentID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>