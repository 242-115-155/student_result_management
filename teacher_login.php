<?php
include 'db_connect.php';

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM teacher
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        header("Location: teacher_dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">Teacher Login</h2>

    <div class="card p-4 mx-auto" style="max-width:400px">

        <form method="POST">

            <input type="email"
                   name="email"
                   class="form-control mb-3"
                   placeholder="Enter Email"
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