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

$id = intval($_GET['id']);

$result = mysqli_query($conn,
"SELECT * FROM result WHERE result_id='$id'");

if(mysqli_num_rows($result)==0){
    die("Result not found.");
}

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $marks = $_POST['marks'];
    $semester_id = $_POST['semester_id'];

    // Grade Calculation

    if($marks>=80){
        $grade="A+";
        $grade_point=4.00;
    }
    elseif($marks>=75){
        $grade="A";
        $grade_point=3.75;
    }
    elseif($marks>=70){
        $grade="A-";
        $grade_point=3.50;
    }
    elseif($marks>=65){
        $grade="B+";
        $grade_point=3.25;
    }
    elseif($marks>=60){
        $grade="B";
        $grade_point=3.00;
    }
    elseif($marks>=55){
        $grade="B-";
        $grade_point=2.75;
    }
    elseif($marks>=50){
        $grade="C+";
        $grade_point=2.50;
    }
    elseif($marks>=45){
        $grade="C";
        $grade_point=2.25;
    }
    elseif($marks>=40){
        $grade="D";
        $grade_point=2.00;
    }
    else{
        $grade="F";
        $grade_point=0.00;
    }

    mysqli_query($conn,"
    UPDATE result
    SET
    semester_id='$semester_id',
    marks='$marks',
    grade='$grade',
    grade_point='$grade_point'
    WHERE result_id='$id'
    ");

    echo "<script>
    alert('Result Updated Successfully');
    window.location='admin_manage_results.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Result</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
margin-top:40px;
}

</style>

</head>

<body>

<div class="container">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Result</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Student ID</label>

<input
type="text"
class="form-control"
value="<?php echo $row['student_id'];?>"
readonly>

</div>

<div class="mb-3">

<label>Course Code</label>

<input
type="text"
class="form-control"
value="<?php echo $row['course_code'];?>"
readonly>

</div>

<div class="mb-3">

<label>Course Name</label>

<input
type="text"
class="form-control"
value="<?php echo $row['course_name'];?>"
readonly>

</div>

<div class="mb-3">

<label>Semester ID</label>

<input
type="number"
name="semester_id"
class="form-control"
value="<?php echo $row['semester_id'];?>"
required>

</div>

<div class="mb-3">

<label>Marks</label>

<input
type="number"
name="marks"
class="form-control"
min="0"
max="100"
value="<?php echo $row['marks'];?>"
required>

</div>

<div class="mb-3">

<label>Current Grade</label>

<input
type="text"
class="form-control"
value="<?php echo $row['grade'];?>"
readonly>

</div>

<div class="mb-3">

<label>Current Grade Point</label>

<input
type="text"
class="form-control"
value="<?php echo $row['grade_point'];?>"
readonly>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

Update Result

</button>

<a
href="admin_manage_results.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>