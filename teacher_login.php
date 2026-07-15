<?php
session_start();
require_once 'db_connect.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        
        $query = "SELECT teacher_id, teacher_name, password FROM teacher WHERE email = ? LIMIT 1";
        
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $teacher_id, $teacher_name, $db_password);
                mysqli_stmt_fetch($stmt);
                
                
                if ($password === $db_password) {
                    session_regenerate_id(true);
                    $_SESSION['teacher_id'] = $teacher_id;
                    $_SESSION['teacher_name'] = $teacher_name;
                    
                    header("Location: teacher_dashboard.php");
                    exit();
                } else {
                    $error_message = "Invalid Email or Password.";
                }
            } else {
                $error_message = "Invalid Email or Password.";
            }
            mysqli_stmt_close($stmt);
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Student Result Management System</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .brand-bg { background-color: #03623b; }
        .brand-text { color: #03623b; }
        .brand-btn { background-color: #025934; }
        .brand-btn:hover { background-color: #014024; }
        .brand-bg {
         background: linear-gradient(135deg, #03623b 0%, #014024 100%); /* গ্রেডিয়েন্ট ব্লেন্ড */
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 sm:p-6 md:p-10">

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

            
            <div class="my-auto z-10 text-center md:text-left mt-10 flex flex-col justify-between h-full">
                <div>
                    <h1 class="text-3xl font-bold mb-4">Welcome Back!</h1>
                    <p class="text-white/80 font-light max-w-sm leading-relaxed mb-6">
                        Login to manage students and academic results
                    </p>
                </div>
                
                
                <div class="w-full h-auto flex justify-center items-end flex-1">
                <img src="teacher.png" alt="Teacher Illustration" class="w-full h-auto object-contain max-h-[400px] mix-blend-multiply">
                </div>
            </div>
        </div>

        
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-gray-50/50">
            <div class="max-w-md w-full mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                
                
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-user text-4xl brand-text"></i>
                    </div>
                    <h2 class="text-2xl font-bold brand-text mb-1">Teacher Login</h2>
                    <p class="text-gray-400 text-sm">Enter your credentials to login</p>
                </div>

                
                <?php if (!empty($error_message)): ?>
                    <div class="bg-red-50 text-red-600 text-sm p-3 rounded-xl mb-4 text-center border border-red-100">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i> <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-5">
                    
                    
                    <div>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-gray-400">
                                <i class="fa-regular fa-envelope text-lg"></i>
                            </span>
                            <input type="email" name="email" required placeholder="Email" 
                                value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                                class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition-all text-gray-700 placeholder-gray-400">
                        </div>
                    </div>

                    
                    <div>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-gray-400">
                                <i class="fa-solid fa-lock text-lg"></i>
                            </span>
                            <input type="password" id="password" name="password" required placeholder="Password" 
                                class="w-full pl-12 pr-12 py-3.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 transition-all text-gray-700 placeholder-gray-400">
                            <button type="button" onclick="togglePassword()" class="absolute right-4 text-gray-400 hover:text-gray-600 transition-colors">
                                <i id="toggleIcon" class="fa-regular fa-eye text-lg"></i>
                            </button>
                        </div>
                    </div>

                    
                    <button type="submit" class="w-full brand-btn text-white font-medium py-3.5 px-4 rounded-xl transition-colors flex items-center justify-center gap-2 shadow-md cursor-pointer mt-4">
                        <span>Login</span>
                        <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>

                </form>
            </div>
        </div>

    </div>

    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
