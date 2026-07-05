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

$student_id = $_GET['student_id'];

$result = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$student_id'");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found.");
}

$message = "";

if (isset($_POST['update_student'])) {

    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $phone        = mysqli_real_escape_string($conn, $_POST['phone']);
    $batch_id     = mysqli_real_escape_string($conn, $_POST['batch_id']);

    $sql = "UPDATE student
            SET
            student_name='$student_name',
            email='$email',
            phone='$phone',
            batch_id='$batch_id'
            WHERE student_id='$student_id'";

    if(mysqli_query($conn,$sql)){

        header("Location: admin_manage_students.php");
        exit();

    }else{

        $message="<div class='alert alert-danger'>
        Update Failed.
        </div>";

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

.box{
width:650px;
margin:40px auto;
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
Edit Student
</h2>

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Student ID</label>

<input
type="text"
class="form-control"
value="<?php echo $student['student_id']; ?>"
readonly>

</div>

<div class="mb-3">

<label>Student Name</label>

<input
type="text"
name="student_name"
class="form-control"
value="<?php echo $student['student_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $student['email']; ?>"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo $student['phone']; ?>"
required>

</div>

<div class="mb-3">

<label>Batch</label>

<select
name="batch_id"
class="form-select"
required>

<?php

$batch=mysqli_query($conn,"SELECT * FROM batch ORDER BY batch_name");

while($b=mysqli_fetch_assoc($batch))
{

?>

<option
value="<?php echo $b['batch_id']; ?>"

<?php
if($student['batch_id']==$b['batch_id'])
echo "selected";
?>

>

<?php echo $b['batch_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<button
type="submit"
name="update_student"
class="btn btn-success w-100">

Update Student

</button>

<br><br>

<a
href="admin_manage_students.php"
class="btn btn-secondary w-100">

Back

</a>

</form>

</div>

</body>
</html>