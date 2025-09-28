<?php 
include 'db_connect.php';

if (isset($_GET['Student_ID'])) {
    $studentID = $_GET['Student_ID']; 
    $result = $conn->query("SELECT * FROM students WHERE Student_ID=$studentID");
    $row = $result->fetch_assoc();
} else {
    die("No student ID provided.");
}

if(isset($_POST['update'])) {
    $studentID     = $_POST['Student_ID'];
    $studentName   = $_POST['Student_Name'];
    $studentEmail  = $_POST['Student_Email'];
    $studentCourse = $_POST['Student_Course'];

    $sql = "UPDATE students 
            SET Student_Name='$studentName', 
                Student_Email='$studentEmail', 
                Student_Course='$studentCourse' 
            WHERE Student_ID=$studentID";

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
            <input type="number" name="Student_ID" value="<?= $row['Student_ID'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Full name</label>
            <input type="text" name="Student_Name" value="<?= $row['Student_Name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="Student_Email" value="<?= $row['Student_Email'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course</label>
            <input type="text" name="Student_Course" value="<?= $row['Student_Course'] ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="select.php" class="btn btn-secondary">Back</a>
    </form>
</body>
</html>