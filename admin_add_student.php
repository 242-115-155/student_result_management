<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if (isset($_POST['add_student'])) {

    $student_id   = mysqli_real_escape_string($conn, $_POST['student_id']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $phone        = mysqli_real_escape_string($conn, $_POST['phone']);
    $batch_id     = mysqli_real_escape_string($conn, $_POST['batch_id']);

    // Check duplicate Student ID
    $check = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$student_id'");

    if(mysqli_num_rows($check) > 0){

        $message = "<div class='alert alert-danger'>
        Student ID already exists!
        </div>";

    }else{

        $sql = "INSERT INTO student
        (student_id, student_name, email, phone, batch_id)
        VALUES
        ('$student_id','$student_name','$email','$phone','$batch_id')";

        if(mysqli_query($conn,$sql)){

            $message = "<div class='alert alert-success'>
            Student Added Successfully.
            </div>";

        }else{

            $message = "<div class='alert alert-danger'>
            Failed to Add Student.
            </div>";
        }
    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Student</title>

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
Add New Student
</h2>

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">
<label>Student ID</label>

<input type="text"
name="student_id"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Student Name</label>

<input type="text"
name="student_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input type="text"
name="phone"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Batch</label>

<select
name="batch_id"
class="form-select"
required>

<option value="">Select Batch</option>

<?php

$result=mysqli_query($conn,"SELECT * FROM batch ORDER BY batch_name");

while($row=mysqli_fetch_assoc($result))
{

?>

<option value="<?php echo $row['batch_id']; ?>">

<?php echo $row['batch_name']; ?>

</option>

<?php

}

?>

</select>

</div>

<button
type="submit"
name="add_student"
class="btn btn-success w-100">

Add Student

</button>

<br><br>

<a
href="admin_manage_students.php"
class="btn btn-secondary w-100">

Back to Manage Students

</a>

</form>

</div>

</body>
</html>