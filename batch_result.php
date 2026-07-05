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

// ইউআরএল থেকে ব্যাচ প্যারামিটার নেওয়া
$batch_param = isset($_GET['batch']) ? mysqli_real_escape_string($conn, $_GET['batch']) : '';

// ইউআরএল থেকে যদি 'CSE-61' আসে, তবে '61' আলাদা করা
$batch_name = str_replace('CSE-', '', $batch_param);

// batch টেবিল থেকে সঠিক batch_id খুঁজে বের করা
$batch_query = "SELECT batch_id FROM batch WHERE batch_name = '$batch_name' OR batch_name = '$batch_param' LIMIT 1";
$batch_res = mysqli_query($conn, $batch_query);

$batch_id = 0;
if ($batch_res && mysqli_num_rows($batch_res) > 0) {
    $batch_row = mysqli_fetch_assoc($batch_res);
    $batch_id = $batch_row['batch_id'];
}

// সঠিক batch_id দিয়ে স্টুডেন্টদের তালিকা নিয়ে আসা
if ($batch_id > 0) {
    $sql = "SELECT * FROM student WHERE batch_id = '$batch_id'";
} else {
    $sql = "SELECT * FROM student WHERE batch_id = '$batch_param' OR batch_id = '$batch_name'";
}
$result = mysqli_query($conn, $sql);

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
    <title><?php echo htmlspecialchars($batch_param); ?> Students</title>
    
    <!-- বুটস্ট্র্যাপ ও আইকন সিডিএন (ইন্টারনেট থাকলে কাজ করবে) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #071e43;
            --sidebar-hover: #0d2c5e;
            --primary-blue: #0061f2;
            --body-bg: #f4f6f9;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--body-bg); margin: 0; padding: 0; }
        
        /* সাইডবার লেআউট ফিক্স */
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
        .submenu { list-style: none; padding-left: 35px; margin-bottom: 10px; display: block !important; }
        .submenu li a { padding: 8px 16px; font-size: 14px; color: #a2b4c7; display: block; text-decoration: none; }
        .submenu li a:hover, .submenu li.active-sub a { color: #fff; font-weight: bold; }
        .menu-label { padding: 10px 24px; color: #647b9c; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        /* কন্টেন্ট এরিয়া ফিক্স */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; background-color: var(--body-bg); }
        .topbar { background-color: var(--primary-blue); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; box-sizing: border-box; }
        .wrapper { padding: 40px; flex: 1; }
        
        /* টেবিল কন্টেইনার ও ডিজাইন */
        .table-card { background: #fff; border-radius: 12px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.02); padding: 25px; margin-top: 20px; }
        .table { width: 100%; margin-bottom: 0; border-collapse: collapse; }
        .table th { background-color: #f8f9fa; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 12px; padding: 15px; border-bottom: 2px solid #dee2e6; text-align: left; }
        .table td { padding: 15px; vertical-align: middle; font-size: 14px; color: #333; border-bottom: 1px solid #dee2e6; text-align: left; }
        .table-striped tbody tr:nth-of-type(odd) { background-color: rgba(0,0,0,.02); }
        
        /* বাটন ও অন্যান্য */
        .btn-view { background-color: var(--primary-blue); color: white; font-size: 13px; font-weight: 500; padding: 8px 18px; border-radius: 6px; border: none; text-decoration: none; display: inline-block; transition: 0.2s; }
        .btn-view:hover { background-color: #0b5ed7; color: white; text-decoration: none; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; font-size: 14px; padding: 8px 20px; border-radius: 6px; text-decoration: none; }
        .breadcrumb { display: flex; flex-wrap: wrap; padding: 0; margin-bottom: 1rem; list-style: none; gap: 5px; font-size: 14px; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #6c757d; padding-right: 5px; }
        .breadcrumb-item a { text-decoration: none; color: var(--primary-blue); }
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
                <a href="#viewResultsMenu" class="d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-file-invoice me-1"></i> View Results</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px;"></i>
                </a>
                <ul class="submenu" id="viewResultsMenu">
                    <?php foreach($batches_list as $b) { 
                        $activeClass = ($b['id'] == $batch_param) ? 'active-sub' : '';
                    ?>
                        <li class="<?php echo $activeClass; ?>"><a href="batch_result.php?batch=<?php echo $b['id']; ?>"><i class="fa-solid fa-angle-right me-1"></i> <?php echo $b['id']; ?></a></li>
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
            <!-- হেডার ও ব্যাক বাটন -->
            <div class="d-flex justify-content-between align-items-center mb-1" style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="fw-bold m-0 text-dark" style="margin: 0; font-size: 28px;"><?php echo htmlspecialchars($batch_param); ?> Students</h2>
                <a href="view_results.php" class="btn btn-outline-secondary btn-back"><i class="fa-solid fa-arrow-left"></i> Back to Batches</a>
            </div>
            
            <!-- ব্রেডক্রাম্ব নেভিগেশন -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="student_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="view_results.php">View Results</a></li>
                    <li class="breadcrumb-item active" style="color: #6c757d;"><?php echo htmlspecialchars($batch_param); ?></li>
                </ol>
            </nav>

            <!-- সাদা বক্স টেবিল এরিয়া -->
            <div class="table-card">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Student ID</th>
                            <th style="width: 50%;">Name</th>
                            <th style="width: 25%; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { 
                        ?>
                            <tr>
                                <td class="fw-semibold" style="font-weight: 600; color: #495057;"><?php echo htmlspecialchars($row['student_id']); ?></td>
                                <td style="font-weight: 500; color: #212529;"><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td style="text-align: center;">
                                    <a href="student_result.php?id=<?php echo $row['student_id']; ?>" class="btn-view">
                                        View Result
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='3' style='text-align: center; color: #6c757d; padding: 30px;'>No students found in this batch.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

</body>
</html>
