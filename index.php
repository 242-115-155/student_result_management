<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System - Metropolitan University</title>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Background image with overlay color */
            background: linear-gradient(rgba(19, 51, 93, 0.82), rgba(19, 51, 93, 0.82)), 
                        url('mu_campus.jpeg') no-repeat center center/cover;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            text-align: center;
            color: #ffffff;
        }

        /* Logo Area */
        .logo-area {
            margin-bottom: 25px;
        }
        
        .logo-area img {
            max-width: 500px;
            height: auto;
             mix-blend-mode:multiply;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #e0e6ed;
            margin-bottom: 45px;
            font-weight: 300;
        }

        /* Responsive Card Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            justify-content: center;
            max-width: 1000px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        }

        /* Icon Styles */
        .icon-wrapper {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
            font-size: 2.2rem;
        }

        /* Color themes per role */
        .student-icon { background-color: #e6f0fa; color: #1a56db; }
        .admin-icon { background-color: #fde8e8; color: #e02424; }
        .teacher-icon { background-color: #edfaf2; color: #057a55; }

        .card h2 {
            color: #1f2937;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .card p {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 35px;
            flex-grow: 1;
        }

        /* Button Configurations */
        .btn {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            transition: background-color 0.2s ease;
        }

        .btn-student { background-color: #1a56db; }
        .btn-student:hover { background-color: #1849b7; }

        .btn-admin { background-color: #ef1c1c; }
        .btn-admin:hover { background-color: #c81010; }

        .btn-teacher { background-color: #047857; }
        .btn-teacher:hover { background-color: #065f46; }
    </style>
</head>
<body>

    <div class="container">
        <!-- University Logo -->
        <div class="logo-area">
            <img src="mu_logo.jpeg" alt="Metropolitan University Logo">
        </div>

        <h1>Student Result Management System</h1>
        <p class="subtitle">Please select your role to continue</p>

        <!-- Role Cards -->
        <div class="cards-grid">
            
            <!-- Student Card -->
            <div class="card">
                <div class="icon-wrapper student-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h2>Student Login</h2>
                <p>Access your profile, view result and academic information</p>
                <a href="student_dashboard.php" class="btn btn-student">
                    Login as Student <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Admin Card -->
            <div class="card">
                <div class="icon-wrapper admin-icon">
                    <i class="bi bi-person-fill-gear"></i>
                </div>
                <h2>Admin Login</h2>
                <p>Access all administrative controls, manage users, and configure the system.</p>
                <a href="admin_login.php" class="btn btn-admin">
                    Login as Admin <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Teacher Card -->
            <div class="card">
                <div class="icon-wrapper teacher-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <h2>Teacher Login</h2>
                <p>Manage students, enter and manage results</p>
                <a href="teacher_login.php" class="btn btn-teacher">
                    Login as Teacher <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>

</body>
</html>