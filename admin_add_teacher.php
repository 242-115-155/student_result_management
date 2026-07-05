<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

include("db_connect.php");

$msg="";

if(isset($_POST['save']))
{
    $teacher_name=mysqli_real_escape_string($conn,$_POST['teacher_name']);
    $designation=mysqli_real_escape_string($conn,$_POST['designation']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $check=mysqli_query($conn,"SELECT * FROM teacher WHERE email='$email'");

    if(mysqli_num_rows($check)>0)
    {
        $msg="<div class='alert alert-danger'>Email already exists!</div>";
    }
    else
    {
        $insert=mysqli_query($conn,"INSERT INTO teacher(teacher_name,designation,email,password)
        VALUES('$teacher_name','$designation','$email','$password')");

        if($insert)
        {
            $msg="<div class='alert alert-success'>
            Teacher Added Successfully.
            </div>";
        }
        else
        {
            $msg="<div class='alert alert-danger'>
            Failed to Add Teacher.
            </div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Teacher</title>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.card{
margin-top:50px;
border:none;
border-radius:12px;
box-shadow:0 0 12px rgba(0,0,0,.15);
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card">

<div class="card-header bg-success text-white">

<h4>Add New Teacher</h4>

</div>

<div class="card-body">

<?php echo $msg; ?>

<form method="POST">

<div class="mb-3">

<label>Teacher Name</label>

<input type="text"
name="teacher_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Designation</label>

<input type="text"
name="designation"
class="form-control"
placeholder="Assistant Professor"
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

<label>Password</label>

<input type="text"
name="password"
class="form-control"
required>

</div>

<button type="submit"
name="save"
class="btn btn-success">

Save Teacher

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