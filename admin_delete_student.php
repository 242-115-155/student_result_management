<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['student_id'])) {
    header("Location: admin_manage_students.php");
    exit();
}

$student_id = mysqli_real_escape_string($conn, $_GET['student_id']);

$delete = mysqli_query($conn, "DELETE FROM student WHERE student_id='$student_id'");

if($delete)
{
    header("Location: admin_manage_students.php?msg=deleted");
    exit();
}
else
{
    echo "<script>
            alert('Failed to delete student!');
            window.location='admin_manage_students.php';
          </script>";
}
?>