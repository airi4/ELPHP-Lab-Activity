<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $studentID = intval($_GET['id']); 

    $sql = "DELETE FROM students WHERE Student_ID = $studentID";

    if ($conn->query($sql) === TRUE) {
        header("Location: select.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID received!";
}
?>