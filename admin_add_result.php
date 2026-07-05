<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Load all batches
$batches = mysqli_query($conn, "
SELECT *
FROM batch
ORDER BY batch_id ASC
");

// Save Result
if(isset($_POST['save']))
{
    $student_id   = mysqli_real_escape_string($conn,$_POST['student_id']);
    $course_code  = mysqli_real_escape_string($conn,$_POST['course_code']);
    $course_name  = mysqli_real_escape_string($conn,$_POST['course_name']);
    $semester_id  = mysqli_real_escape_string($conn,$_POST['semester_id']);
    $marks        = mysqli_real_escape_string($conn,$_POST['marks']);

    // Grade Calculation

    if($marks>=80){
        $grade="A+";
        $point=4.00;
    }
    elseif($marks>=75){
        $grade="A";
        $point=3.75;
    }
    elseif($marks>=70){
        $grade="A-";
        $point=3.50;
    }
    elseif($marks>=65){
        $grade="B+";
        $point=3.25;
    }
    elseif($marks>=60){
        $grade="B";
        $point=3.00;
    }
    elseif($marks>=55){
        $grade="B-";
        $point=2.75;
    }
    elseif($marks>=50){
        $grade="C+";
        $point=2.50;
    }
    elseif($marks>=45){
        $grade="C";
        $point=2.25;
    }
    elseif($marks>=40){
        $grade="D";
        $point=2.00;
    }
    else{
        $grade="F";
        $point=0.00;
    }

    $insert=mysqli_query($conn,"
    INSERT INTO result
    (
        student_id,
        course_code,
        course_name,
        semester_id,
        marks,
        grade,
        grade_point
    )
    VALUES
    (
        '$student_id',
        '$course_code',
        '$course_name',
        '$semester_id',
        '$marks',
        '$grade',
        '$point'
    )
    ");

    if($insert){
        echo "<script>
        alert('Result Added Successfully');
        window.location='admin_manage_results.php';
        </script>";
        exit();
    }
    else{
        echo "<script>alert('Failed to Add Result');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Add Result</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.container-box{
    width:900px;
    margin:40px auto;
}

.card{
    border-radius:10px;
}

</style>

</head>

<body>

<div class="container-box">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Add Student Result</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Batch</label>

<select id="batch" class="form-select" required>

<option value="">Select Batch</option>

<?php
while($batch=mysqli_fetch_assoc($batches))
{
?>

<option value="<?php echo $batch['batch_id']; ?>">

<?php echo $batch['batch_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Student</label>

<select
name="student_id"
id="student"
class="form-select"
required>

<option value="">Select Batch First</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Course Code</label>

<select
name="course_code"
id="course"
class="form-select"
required>

<option value="">Select Batch First</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Course Name</label>

<input
type="text"
name="course_name"
id="course_name"
class="form-control"
readonly>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Semester ID</label>

<input
type="number"
name="semester_id"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Marks</label>

<input
type="number"
name="marks"
class="form-control"
min="0"
max="100"
required>

</div>

<div class="col-12">

<button
type="submit"
name="save"
class="btn btn-success">

Save Result

</button>

<a
href="admin_manage_results.php"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</form>

</div>

</div>

</div>

<script>

document.getElementById("batch").addEventListener("change", function(){

    let batch = this.value;

    // Load Students

    fetch("load_students.php?batch_id=" + batch)
    .then(response => response.text())
    .then(data => {
        document.getElementById("student").innerHTML = data;
    });

    // Load Courses

    fetch("load_courses.php?batch_id=" + batch)
    .then(response => response.json())
    .then(data => {

        let course = document.getElementById("course");

        course.innerHTML =
        "<option value=''>Select Course</option>";

        data.forEach(function(item){

            course.innerHTML +=
            "<option value='" + item.course_code +
            "' data-name='" + item.course_name + "'>" +
            item.course_code +
            "</option>";

        });

    });

});

// Show Course Name Automatically

document.getElementById("course").addEventListener("change", function(){

    let courseName =
    this.options[this.selectedIndex].getAttribute("data-name");

    document.getElementById("course_name").value = courseName;

});

</script>

</body>

</html>