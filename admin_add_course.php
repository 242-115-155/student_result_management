<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message="";

if(isset($_POST['add_course']))
{
    $course_code=mysqli_real_escape_string($conn,$_POST['course_code']);
    $course_name=mysqli_real_escape_string($conn,$_POST['course_name']);
    $credit=mysqli_real_escape_string($conn,$_POST['credit']);
    $batch_id=mysqli_real_escape_string($conn,$_POST['batch_id']);

    $check=mysqli_query($conn,"SELECT * FROM course WHERE course_code='$course_code'");

    if(mysqli_num_rows($check)>0)
    {
        $message="<div class='alert alert-danger'>
        Course Code Already Exists.
        </div>";
    }
    else
    {

        $insert=mysqli_query($conn,"INSERT INTO course(course_code,course_name,credit,batch_id)
        VALUES('$course_code','$course_name','$credit','$batch_id')");

        if($insert)
        {
            $message="<div class='alert alert-success'>
            Course Added Successfully.
            </div>";
        }
        else
        {
            $message="<div class='alert alert-danger'>
            Failed to Add Course.
            </div>";
        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Add Course</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
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

Add New Course

</h2>

<?php echo $message; ?>

<form method="POST">

<div class="mb-3">

<label>Course Code</label>

<input
type="text"
name="course_code"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Course Name</label>

<input
type="text"
name="course_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Credit</label>

<input
type="number"
step="0.5"
name="credit"
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
name="add_course"
class="btn btn-success w-100">

Add Course

</button>

<br><br>

<a
href="admin_manage_courses.php"
class="btn btn-secondary w-100">

Back to Manage Courses

</a>

</form>

</div>

</body>

</html>