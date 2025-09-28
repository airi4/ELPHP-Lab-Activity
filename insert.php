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