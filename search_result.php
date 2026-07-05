<?php
session_start();
// ডাটাবেজ কানেকশন (যদি প্রয়োজন হয়)
include 'db_connect.php';

// সাইডবার লুপের জন্য ব্যাচ লিস্ট
$batches_list = [
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
    <title>Search Result</title>
    
    <!-- বুটস্ট্র্যাপ ও ফন্ট-অসাম আইকন সিডিএন -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #001f3f;
            --primary-blue: #0d6efd;
            --body-bg: #f8f9fa;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--body-bg); margin: 0; padding: 0; }
        
        /* সাইডবার লেআউট */
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
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; text-decoration: none; }
        
        /* সাবমেনু স্টাইল */
        .submenu { list-style: none; padding-left: 35px; margin-bottom: 10px; display: block; }
        .submenu li a { padding: 8px 16px; font-size: 14px; color: #a2b4c7; display: block; text-decoration: none; }
        .submenu li a:hover, .submenu li.active-sub a { color: #fff; font-weight: bold; }
        .menu-label { padding: 10px 24px; color: #647b9c; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        /* কন্টেন্ট এরিয়া */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; background-color: var(--body-bg); }
        .topbar { background-color: var(--primary-blue); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; box-sizing: border-box; }
        .wrapper { padding: 40px; flex: 1; }
        
        /* সার্চ কার্ড ডিজাইন */
        .search-card { background: #fff; border-radius: 12px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.02); padding: 35px; margin-top: 20px; max-width: 600px; }
        .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15); border-color: var(--primary-blue); }
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
            <li>
                <a href="javascript:void(0);" class="d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-file-invoice me-1"></i> View Results</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px;"></i>
                </a>
                <ul class="submenu" id="viewResultsMenu">
                    <?php foreach($batches_list as $b) { ?>
                        <li><a href="batch_result.php?batch=<?php echo $b['id']; ?>"><i class="fa-solid fa-angle-right me-1"></i> <?php echo $b['id']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li class="active"><a href="search_result.php"><i class="fa-solid fa-magnifying-glass"></i> Search Result</a></li>
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
            <div class="search-card mx-auto">
                <h2 class="text-center fw-bold text-dark mb-4" style="font-size: 24px;">Search Student Result</h2>
                
                <!-- সার্চ ফর্ম -->
                <form action="student_result.php" method="GET">
                    <div class="mb-4">
                        <label for="student_id" class="form-label fw-semibold text-secondary">Student ID</label>
                        <input type="text" name="id" id="student_id" class="form-control form-control-lg" placeholder="Enter Student ID" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-medium">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> Search
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>