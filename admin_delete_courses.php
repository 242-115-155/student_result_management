<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['course_id'])) {
    header("Location: admin_manage_courses.php");
    exit();
}

$course_id = mysqli_real_escape_string($conn, $_GET['course_id']);

// Check if course exists
$check = mysqli_query($conn, "SELECT * FROM course WHERE course_id='$course_id'");

if(mysqli_num_rows($check)==0){
    header("Location: admin_manage_courses.php");
    exit();
}

// Delete course
$delete = mysqli_query($conn, "DELETE FROM course WHERE course_id='$course_id'");

if($delete){

    header("Location: admin_manage_courses.php?msg=deleted");
    exit();

}else{

    echo "<script>
            alert('Failed to delete course!');
            window.location='admin_manage_courses.php';
          </script>";

}
?>