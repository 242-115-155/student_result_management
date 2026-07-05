<?php
session_start();
// ডাটাবেজ কানেকশন (প্রয়োজন হলে অন রাখুন)
// include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results - Metropolitan University</title>
    
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #112240;
            --primary-blue: #0d6efd;
            --body-bg: #f3f6f9;
        }
        body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: var(--body-bg); margin: 0; }
        
        /* সাইডবার ডিজাইন */
        .sidebar { width: 260px; height: 100vh; background-color: var(--sidebar-bg); position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar-brand { padding: 10px 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 15px; padding: 12px 16px; color: #a2b4c7; text-decoration: none; border-radius: 8px; font-weight: 500; transition: 0.3s; margin-bottom: 5px; }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        .menu-label { padding: 10px 24px; color: #506784; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        /* মেইন লেআউট */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: #0b5ed7; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; }
        .wrapper { padding: 30px; flex: 1; }
        
        /* ব্যাচ কার্ড গ্রিড ডিজাইন */
        .batch-card { 
            background: white; 
            border-radius: 14px; 
            padding: 30px 20px; 
            border: 1px solid #eef2f5; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.02); 
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none !important;
            display: block;
        }
        .batch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.1);
            border-color: rgba(13, 110, 253, 0.2);
        }
        .batch-icon-box {
            width: 65px;
            height: 65px;
            background-color: #e6f0ff;
            color: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px auto;
            font-size: 24px;
            transition: 0.3s;
        }
        .batch-card:hover .batch-icon-box {
            background-color: var(--primary-blue);
            color: white;
        }
        .batch-title { font-size: 18px; font-weight: 700; color: #212529; margin-bottom: 8px; }
        .batch-link-text { font-size: 13px; font-weight: 600; color: var(--primary-blue); display: flex; align-items: center; justify-content: center; gap: 6px; }

        /* ইনফো অ্যালার্ট বার */
        .info-alert-bar {
            background-color: #fff;
            border-left: 4px solid var(--primary-blue);
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 14px;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.01);
        }
    </style>
</head>
<body>

    <!-- বাম পাশের মডার্ন সাইডবার (View Results মেনু এখন এক্টিভ) -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-graduation-cap text-white fs-3 bg-primary p-2 rounded-circle"></i>
            <div>
                <h6 class="m-0 fw-bold text-white">Metropolitan</h6>
                <small style="font-size: 11px; color: #788ba8;">University</small>
            </div>
        </div>
        <div class="menu-label mt-4">Main Menu</div>
        <ul class="sidebar-menu">
            <li><a href="teacher_dashboard.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="add_student.php"><i class="fa-solid fa-user-plus"></i> Add Student</a></li>
            <li><a href="add_result.php"><i class="fa-solid fa-file-circle-plus"></i> Add Result</a></li>
            <li><a href="edit_result.php"><i class="fa-solid fa-pen-to-square"></i> Edit Result</a></li>
            <li><a href="delete_results.php"><i class="fa-solid fa-trash-can"></i> Delete Result</a></li>
            <li class="active"><a href="teacher_view_result.php"><i class="fa-solid fa-eye"></i> View Results</a></li>
            <li class="mt-4"><a href="index.php" style="color: #ff6b6b;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    <!-- ডান পাশের মেইন কন্টেন্ট এরিয়া -->
    <div class="main-content">
        <!-- টপবার -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-bars fs-5" style="cursor:pointer;"></i>
                <h5 class="m-0 fw-semibold" style="font-size: 16px;">Student Result Management System</h5>
            </div>
            <div class="d-flex align-items-center gap-2">
                <img src="https://ui-avatars.com/api/?name=Teacher&background=fff&color=0d6efd" class="rounded-circle" width="35" alt="Profile">
                <span class="fw-medium text-white">Teacher <i class="fa-solid fa-angle-down small ms-1"></i></span>
            </div>
        </div>

        <!-- মেইন কন্টেন্ট এরিয়া wrapper -->
        <div class="wrapper">
            <!-- হেডার টাইটেল -->
            <div class="mb-4">
                <h3 class="fw-bold m-0 text-dark">View Results</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-0 mt-1">
                        <li class="breadcrumb-item"><a href="teacher_dashboard.php" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Results</li>
                    </ol>
                </nav>
            </div>

            <!-- ইনফো বার নোটিফিকেশন -->
            <div class="info-alert-bar mb-4">
                <i class="fa-solid fa-circle-info text-primary fs-5"></i>
                <span>Please select your desired batch from below to view detailed academic results.</span>
            </div>

            <!-- মডার্ন ব্যাচ কার্ড গ্রিড (৪টি কলাম রেসপনসিভ) -->
            <div class="row g-4">
                
                <!-- 61 Batch -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="teacher_batch_result.php?batch=61" class="batch-card">
                        <div class="batch-icon-box">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="batch-title">61 Batch</div>
                        <div class="batch-link-text">
                            View Results <i class="fa-solid fa-arrow-right small"></i>
                        </div>
                    </a>
                </div>

                <!-- 62 Batch -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="teacher_batch_result.php?batch=62" class="batch-card">
                        <div class="batch-icon-box">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="batch-title">62 Batch</div>
                        <div class="batch-link-text">
                            View Results <i class="fa-solid fa-arrow-right small"></i>
                        </div>
                    </a>
                </div>

                <!-- 63 Batch -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="teacher_batch_result.php?batch=63" class="batch-card">
                        <div class="batch-icon-box">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="batch-title">63 Batch</div>
                        <div class="batch-link-text">
                            View Results <i class="fa-solid fa-arrow-right small"></i>
                        </div>
                    </a>
                </div>

                <!-- 64 Batch -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="teacher_batch_result.php?batch=64" class="batch-card">
                        <div class="batch-icon-box">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="batch-title">64 Batch</div>
                        <div class="batch-link-text">
                            View Results <i class="fa-solid fa-arrow-right small"></i>
                        </div>
                    </a>
                </div>

            </div> <!-- row end -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>