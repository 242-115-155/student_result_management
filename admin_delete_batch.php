<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_manage_batches.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Check Batch Exists
$check = mysqli_query($conn, "SELECT * FROM batch WHERE batch_id='$id'");

if(mysqli_num_rows($check)==0)
{
    header("Location: admin_manage_batches.php");
    exit();
}

// Delete Batch
$delete = mysqli_query($conn, "DELETE FROM batch WHERE batch_id='$id'");

if($delete)
{
    header("Location: admin_manage_batches.php?msg=deleted");
    exit();
}
else
{
    echo "<script>
    alert('Batch cannot be deleted. It may be used by Students or Courses.');
    window.location='admin_manage_batches.php';
    </script>";
}
?>