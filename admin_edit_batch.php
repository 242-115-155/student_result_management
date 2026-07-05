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

$result = mysqli_query($conn, "SELECT * FROM batch WHERE batch_id='$id'");
$row = mysqli_fetch_assoc($result);

if(!$row){
    header("Location: admin_manage_batches.php");
    exit();
}

$message = "";

if(isset($_POST['update']))
{
    $new_batch_id = mysqli_real_escape_string($conn,$_POST['batch_id']);
    $batch_name   = mysqli_real_escape_string($conn,$_POST['batch_name']);

    $check = mysqli_query($conn,"
        SELECT *
        FROM batch
        WHERE batch_id='$new_batch_id'
        AND batch_id<>'$id'
    ");

    if(mysqli_num_rows($check)>0)
    {
        $message="<div class='alert alert-danger'>
        Batch ID already exists!
        </div>";
    }
    else
    {
        mysqli_query($conn,"
            UPDATE batch
            SET
            batch_id='$new_batch_id',
            batch_name='$batch_name'
            WHERE batch_id='$id'
        ");

        header("Location: admin_manage_batches.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Edit Batch</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.box{

width:500px;

margin:50px auto;

background:white;

padding:30px;

border-radius:10px;

box-shadow:0 0 15px rgba(0,0,0,.15);

}

</style>

</head>

<body>

<div class="box">

<h2 class="text-center mb-4">
Edit Batch
</h2>

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Batch ID</label>

<input
type="number"
name="batch_id"
class="form-control"
value="<?php echo $row['batch_id']; ?>"
required>

</div>

<div class="mb-3">

<label>Batch Name</label>

<input
type="text"
name="batch_name"
class="form-control"
value="<?php echo $row['batch_name']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-success w-100">

Update Batch

</button>

<br><br>

<a
href="admin_manage_batches.php"
class="btn btn-secondary w-100">

Back

</a>

</form>

</div>

</body>

</html>