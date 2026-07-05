<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

include("db_connect.php");

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM teacher WHERE teacher_id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $teacher_name=$_POST['teacher_name'];
    $designation=$_POST['designation'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    mysqli_query($conn,"UPDATE teacher SET
    teacher_name='$teacher_name',
    designation='$designation',
    email='$email',
    password='$password'
    WHERE teacher_id='$id'");

    header("Location: admin_manage_teachers.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Teacher</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card">

<div class="card-header bg-warning">

<h4>Edit Teacher</h4>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Teacher Name</label>

<input type="text"
name="teacher_name"
class="form-control"
value="<?php echo $row['teacher_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Designation</label>

<input type="text"
name="designation"
class="form-control"
value="<?php echo $row['designation']; ?>"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
value="<?php echo $row['email']; ?>"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="text"
name="password"
class="form-control"
value="<?php echo $row['password']; ?>"
required>

</div>

<button class="btn btn-warning"
name="update">

Update Teacher

</button>

<a href="manage_teachers.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>