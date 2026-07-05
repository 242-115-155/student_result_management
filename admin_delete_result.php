<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_manage_results.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Check Result Exists
$check = mysqli_query($conn, "SELECT * FROM result WHERE result_id='$id'");

if(mysqli_num_rows($check)==0)
{
    header("Location: admin_manage_results.php");
    exit();
}

// Delete Result
$delete = mysqli_query($conn, "DELETE FROM result WHERE result_id='$id'");

if($delete)
{
    header("Location: admin_manage_results.php?msg=deleted");
    exit();
}
else
{
    echo "<script>
    alert('Failed to delete result!');
    window.location='admin_manage_results.php';
    </script>";
}
?>