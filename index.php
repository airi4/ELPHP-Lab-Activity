<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "student_lab";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
include 'db_connect.php';

if (isset($_POST['submit'])) {
    $studentID = $_POST['Student_ID'];
    $studentName   = $_POST['Student_Name'];
    $studentEmail  = $_POST['Student_Email'];
    $studentCourse = $_POST['Student_Course'];

    $sql = "INSERT INTO students (Student_ID, Student_Name, Student_Email, Student_Course) VALUES ('$studentID', '$studentName', '$studentEmail', '$studentCourse')";
    if ($conn->query($sql) === TRUE) {
        $msg = "New student added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body.container {
            background-color: #113F67;
            color: #FFFFF0;
        }
    </style>
</head>

<body class="container mt-5">
    <h2 class="mb-4 fw-bold">Add Student</h2>

    <?php if(isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST">
    <div class="card p-4" style="background-color: #FFF0CE; border-radius: 10px;">
        <div class="mb-3">
            <label class="form-label">ID Number</label>
            <input type="number" name="Student_ID" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="Student_Name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="Student_Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course</label>
            <input type="text" name="Student_Course" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary" style="background-color: #113F67; color: white;">Add Student</button>
    </div>
</form>
</body>
</html>

<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .table-header-custom th{
            background-color: #8ABB6C; 
            color: #000000;    
            text-align: center;
            vertical-align: middle;          
        }
        .table td:last-child, 
        .table th:last-child {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body class="container mt-5">
    <div class="d-flex align-items-center justify-content-center">
        <hr class="w-100 border border-light">
    </div>
    <h2 class="mb-4 fw-bold">Student Records</h2>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-header-custom">
            <tr>
                <th>ID Number</th><th>Full name</th><th>Email Address</th><th>Course</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['Student_ID'] ?></td>
                <td><?= $row['Student_Name'] ?></td>
                <td><?= $row['Student_Email'] ?></td>
                <td><?= $row['Student_Course'] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['Student_ID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['Student_ID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
include 'db_connect.php';
$studentID = $_GET['Student_ID'];
$result = $conn->query("SELECT * FROM students WHERE id=$studentID");
$row = $result->fetch_assoc();

if(isset($_POST['update'])) {
    $studentID = $_POST['Student_ID'];
    $studentName = $_POST['Student_Name'];
    $studentEmail = $_POST['Student_Email'];
    $studentCourse = $_POST['Student_Course'];

    $sql = "UPDATE students SET Student_Name='$studentName', Student_Email='$studentEmail', Student_Course='$studentCourse' WHERE id=$studentID";
    if($conn->query($sql) === TRUE){
        $msg = "Record updated successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Edit Student</h2>

    <?php if(isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">ID Number</label>
            <input type="number" name="Student_ID" value="<?= $row['studentID'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="Student_Name" value="<?= $row['studentName'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="Student_Email" value="<?= $row['studentEmail'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course</label>
            <input type="text" name="Student_Course" value="<?= $row['studentCourse'] ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="select.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>

<?php
include 'db_connect.php';
$studentID = $_GET['Student_ID'];

$sql = "DELETE FROM students WHERE id=$studentID";
$conn->query($sql);
header("Location: select.php");
exit();
?>