<?php
session_start();

// ডাটাবেজ কানেকশন
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_result_management"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ব্যাচ লিস্ট (যেগুলো স্ক্রিনে কার্ড আকারে দেখাবে)
$batches = [
    ['id' => 'CSE-61', 'name' => '61 Batch'],
    ['id' => 'CSE-62', 'name' => '62 Batch'],
    ['id' => 'CSE-63', 'name' => '63 Batch'],
    ['id' => 'CSE-64', 'name' => '64 Batch']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results - Metropolitan University</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #071e43;
            --sidebar-hover: #0d2c5e;
            --primary-blue: #0061f2;
            --body-bg: #f4f6f9;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--body-bg); overflow-x: hidden; }
        
        /* বাম পাশের সাইডবার */
        .sidebar {
            width: 260px; height: 100vh; background-color: var(--sidebar-bg);
            position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000;
        }
        .sidebar-brand { padding: 10px 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
        .sidebar-brand .icon-container { width: 40px; height: 40px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a {
            display: flex; align-items: center; gap: 15px; padding: 12px 16px;
            color: #b3c0ce; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.3s; margin-bottom: 5px;
        }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        
        /* সাবমেনু স্টাইল */
        .submenu { list-style: none; padding-left: 35px; margin-bottom: 10px; }
        .submenu li a { padding: 8px 16px; font-size: 14px; color: #a2b4c7; display: block; text-decoration: none;}
        .submenu li a:hover { color: #fff; }
        .menu-label { padding: 10px 24px; color: #647b9c; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        /* কন্টেন্ট এরিয়া */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: var(--primary-blue); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .wrapper { padding: 40px; flex: 1; }
        
        /* ব্রেডক্রাম্ব ও নোটিশ */
        .breadcrumb-item a { text-decoration: none; color: var(--primary-blue); }
        .info-alert { background-color: #eec; border: none; color: #084298; border-radius: 6px; font-size: 14px; padding: 15px; }
        
        /* ব্যাচ কার্ড ডিজাইন (৩ নং ছবির মতো) */
        .batch-card {
            background: #fff; border: 1px solid #eef2f5; border-radius: 8px;
            padding: 35px 20px; text-align: center; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.01);
        }
        .batch-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .batch-icon-box {
            width: 70px; height: 70px; background-color: #e6f0ff; color: var(--primary-blue);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 28px; margin: 0 auto 20px auto;
        }
        .batch-title { font-size: 22px; font-weight: 700; color: #002347; margin-bottom: 8px; }
        .view-link { color: #6c757d; font-size: 14px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; }
        .batch-card:hover .view-link { color: var(--primary-blue); }
    </style>
</head>
<body>

    <!-- বাম পাশের সাইডবার -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="icon-container">
                <i class="fa-solid fa-graduation-cap text-primary fs-4"></i>
            </div>
            <div>
                <h6 class="m-0 fw-bold text-white">Metropolitan</h6>
                <small style="font-size: 11px; color: #788ba8;">University</small>
            </div>
        </div>
        <div class="menu-label mt-4">Main Menu</div>
        <ul class="sidebar-menu">
            <li><a href="student_dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li class="active">
                <a href="#viewResultsMenu" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-file-invoice me-1"></i> View Results</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px;"></i>
                </a>
                <ul class="collapse show submenu" id="viewResultsMenu">
                    <?php foreach($batches as $b) { ?>
                        <li><a href="batch_result.php?batch=<?php echo $b['id']; ?>"><i class="fa-solid fa-angle-right me-1"></i> <?php echo $b['id']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="search_result.php"><i class="fa-solid fa-magnifying-glass"></i> Search Result</a></li>
            <li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
        </ul>
    </div>

    <!-- ডান পাশের কন্টেন্ট এরিয়া -->
    <div class="main-content">
        <!-- টপ নেভিগেশন বার (Notification রিমুভড এবং ইউজার নেম সরাসরি 'Student') -->
        <div class="topbar">
            <h5 class="m-0 fw-semibold"><i class="fa-solid fa-bars me-2"></i> Student Portal</h5>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <div class="d-flex align-items-center gap-2 dropdown-toggle pointer" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <img src="https://ui-avatars.com/api/?name=Student&background=0061f2&color=fff" class="rounded-circle" width="35" alt="Profile">
                        <span class="fw-medium text-white">Student</span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-menu-item p-2 px-3 d-block text-secondary text-decoration-none small" href="#"><i class="fa-regular fa-user me-2"></i> My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-menu-item p-2 px-3 d-block text-danger text-decoration-none small" href="index.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="wrapper">
            <!-- টাইটেল এবং ব্রেডক্রাম্ব -->
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h2 class="fw-bold m-0 text-dark">View Results</h2>
            </div>
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="student_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Results</li>
                </ol>
            </nav>

            <!-- নোটিফিকেশন অ্যালার্ট বক্স -->
            <div class="alert info-alert d-flex align-items-center gap-2 mb-5" role="alert">
                <i class="fa-solid fa-circle-info fs-5 text-primary"></i>
                <div>Please select your batch to view results.</div>
            </div>

            <!-- ব্যাচ কার্ড গ্রিড (৩ নং ছবির অবিকল ডিজাইন) -->
            <div class="row g-4">
                <?php foreach($batches as $b) { ?>
                    <div class="col-md-3">
                        <div class="card batch-card">
                            <div class="batch-icon-box">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div class="batch-title"><?php echo $b['name']; ?></div>
                            <a href="batch_result.php?batch=<?php echo $b['id']; ?>" class="view-link">
                                View Results <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
