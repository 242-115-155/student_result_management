<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

include("db_connect.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM teacher WHERE teacher_id='$id'");

header("Location: admin_manage_teachers.php");

?>