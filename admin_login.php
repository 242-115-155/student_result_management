<?php
session_start();
include 'db_connect.php';

$error = "";

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($query)==1)
    {
        $_SESSION['admin']=$username;
        header("Location: admin_dashboard.php");
        exit();
    }
    else
    {
        $error="Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">Admin Login</h2>

    <div class="card p-4 mx-auto" style="max-width:400px">

        <form method="POST">

            <input type="text"
                   name="username"
                   class="form-control mb-3"
                   placeholder="Enter Username"
                   required>

            <input type="password"
                   name="password"
                   class="form-control mb-3"
                   placeholder="Enter Password"
                   required>

            <button type="submit"
                    name="login"
                    class="btn btn-success w-100">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>