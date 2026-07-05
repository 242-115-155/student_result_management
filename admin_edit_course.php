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

$course_id = $_GET['course_id'];

$result = mysqli_query($conn, "SELECT * FROM course WHERE course_id='$course_id'");
$course = mysqli_fetch_assoc($result);

if (!$course) {
    die("Course Not Found");
}

if (isset($_POST['update_course'])) {

    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $credit      = mysqli_real_escape_string($conn, $_POST['credit']);
    $batch_id    = mysqli_real_escape_string($conn, $_POST['batch_id']);

    mysqli_query($conn, "UPDATE course SET
        course_code='$course_code',
        course_name='$course_name',
        credit='$credit',
        batch_id='$batch_id'
        WHERE course_id='$course_id'");

    header("Location: admin_manage_courses.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Course</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fa;
}

.box{
    width:650px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="box">

<h2 class="text-center mb-4">
Edit Course
</h2>

<form method="POST">

<div class="mb-3">

<label>Course Code</label>

<input
type="text"
name="course_code"
class="form-control"
value="<?php echo $course['course_code']; ?>"
required>

</div>

<div class="mb-3">

<label>Course Name</label>

<input
type="text"
name="course_name"
class="form-control"
value="<?php echo $course['course_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Credit</label>

<input
type="number"
step="0.5"
name="credit"
class="form-control"
value="<?php echo $course['credit']; ?>"
required>

</div>

<div class="mb-3">

<label>Batch</label>

<select
name="batch_id"
class="form-select"
required>

<?php

$batch = mysqli_query($conn,"SELECT * FROM batch ORDER BY batch_name");

while($b=mysqli_fetch_assoc($batch))
{

?>

<option
value="<?php echo $b['batch_id']; ?>"

<?php
if($course['batch_id']==$b['batch_id'])
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
name="update_course"
class="btn btn-success w-100">

Update Course

</button>

<br><br>

<a
href="admin_manage_courses.php"
class="btn btn-secondary w-100">

Back

</a>

</form>

</div>

</body>

</html>