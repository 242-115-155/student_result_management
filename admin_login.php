<?php
session_start();
include 'db_connect.php';

$error_message = "";

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    ি
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($query) == 1)
    {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    }
    else
    {
        $error_message = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Student Result Management System</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    
    .brand-bg { background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%); }
    .brand-text { color: #b91c1c; }
    .brand-btn { background-color: #b91c1c; }
    .brand-btn:hover { background-color: #991b1b; }
</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

<div class="bg-white rounded-3xl shadow-xl flex flex-col md:flex-row max-w-5xl w-full overflow-hidden min-h-[600px]">
    
    
    <div class="brand-bg w-full md:w-1/2 p-8 md:p-12 text-white flex flex-col justify-between relative hidden md:flex">
            
            <div class="flex items-center gap-3 z-10">
                <div class="bg-white/10 p-2.5 rounded-xl border border-white/20">
                    <i class="fa-solid fa-graduation-cap text-2xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-sm font-semibold tracking-wide uppercase leading-tight">Metropolitan University</h2>
                    <p class="text-xs opacity-80">Student ResultManagement System</p>
                </div>
            </div>

        <div class="my-auto z-10">
            <h1 class="text-3xl font-bold mb-4">Welcome Back!</h1>
            <p class="text-white/80 font-light max-w-sm">Login to access the admin dashboard and manage the system.</p>
</div>
    
        <div class="w-full flex justify-center items-center overflow-hidden">
            
            <img src="admin.png" alt="Admin Illustration" class="w-full max-w-[550px] h-auto object-contain flex-shrink-0 max-h-[550px]">
        </div>
        </div>
    
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
        <div class="text-center md:text-left mb-8">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto md:mx-0 mb-4">
                <i class="fa-regular fa-user text-4xl brand-text"></i>
            </div>
            <h2 class="text-2xl font-bold brand-text">Admin Login</h2>
            <p class="text-gray-400 text-sm">Enter your credentials to access admin panel</p>
        </div>

        <?php if($error_message): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-xl mb-4 text-center border border-red-100 text-sm">
                <i class="fa-solid fa-circle-exclamation mr-2"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="relative flex items-center mb-4">
                <span class="absolute left-4 text-gray-400"><i class="fa-regular fa-user"></i></span>
                <input type="text" name="username" class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-600" placeholder="Username" required>
            </div>

            <div class="relative flex items-center mb-6">
                <span class="absolute left-4 text-gray-400"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-600" placeholder="Password" required>
            

            <button type="button" onclick="togglePassword()" class="absolute right-4 text-gray-400 hover:text-red-600">
                <i id="eye-icon" class="fa-solid fa-eye"></i>
            </button>

            </div>

            <button type="submit" name="login" class="w-full brand-btn text-white font-medium py-3.5 rounded-xl transition duration-300">
                Login <i class="fa-solid fa-arrow-right ml-2"></i>
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>
