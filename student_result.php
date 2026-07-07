<?php
session_start();


include 'db_connect.php';


$student_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';


$batch_param = "CSE-61"; 
if (!empty($student_id)) {
    $student_info_query = "SELECT b.batch_name FROM student s JOIN batch b ON s.batch_id = b.batch_id WHERE s.student_id = '$student_id' LIMIT 1";
    $student_info_res = mysqli_query($conn, $student_info_query);
    if ($student_info_res && mysqli_num_rows($student_info_res) > 0) {
        $student_info_row = mysqli_fetch_assoc($student_info_res);
        $batch_param = "CSE-" . $student_info_row['batch_name'];
    }
}


$sql = "SELECT * FROM result WHERE student_id='$student_id'";
$result = mysqli_query($conn, $sql);

/* GPA / CGPA Calculation */
$gpa_sql = "SELECT AVG(grade_point) AS cgpa FROM result WHERE student_id='$student_id'";
$gpa_result = mysqli_query($conn, $gpa_sql);
$gpa_row = mysqli_fetch_assoc($gpa_result);
$cgpa = round($gpa_row['cgpa'], 2);


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
    <title>Student Result</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #001f3f;
            --primary-blue: #0d6efd;
            --body-bg: #f8f9fa;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--body-bg); margin: 0; padding: 0; }
        
        
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
        
       
        .submenu { list-style: none; padding-left: 35px; margin-bottom: 10px; display: block; }
        .submenu li a { padding: 8px 16px; font-size: 14px; color: #a2b4c7; display: block; text-decoration: none; }
        .submenu li a:hover, .submenu li.active-sub a { color: #fff; font-weight: bold; }
        .menu-label { padding: 10px 24px; color: #647b9c; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; background-color: var(--body-bg); }
        .topbar { background-color: var(--primary-blue); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; box-sizing: border-box; }
        .wrapper { padding: 40px; flex: 1; }
        
        
        .table-card { background: #fff; border-radius: 12px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.02); padding: 25px; margin-top: 20px; }
        .table { width: 100%; margin-bottom: 0; border-collapse: collapse; }
        .table th { background-color: #f8f9fa; color: #495057; font-weight: 600; text-transform: uppercase; font-size: 12px; padding: 15px; border-bottom: 2px solid #dee2e6; text-align: left; }
        .table td { padding: 15px; vertical-align: middle; font-size: 14px; color: #333; border-bottom: 1px solid #dee2e6; text-align: left; }
        .table-bordered th, .table-bordered td { border: 1px solid #dee2e6; }
        
        
        .btn-back { display: inline-flex; align-items: center; gap: 8px; font-size: 14px; padding: 8px 20px; border-radius: 6px; text-decoration: none; }
        .breadcrumb { display: flex; flex-wrap: wrap; padding: 0; margin-bottom: 1rem; list-style: none; gap: 5px; font-size: 14px; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; color: #6c757d; padding-right: 5px; }
        .breadcrumb-item a { text-decoration: none; color: var(--primary-blue); }
        
        .cgpa-box { background-color: #e8f4fd; border-left: 4px solid var(--primary-blue); padding: 15px; border-radius: 4px; margin-top: 20px; font-size: 16px; font-weight: 600; color: #0b5ed7; }
    </style>
</head>
<body>

    
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
                        
                        $activeClass = (strpos($batch_param, $b['id']) !== false) ? 'active-sub' : '';
                    ?>
                        <li class="<?php echo $activeClass; ?>"><a href="batch_result.php?batch=<?php echo $b['id']; ?>"><i class="fa-solid fa-angle-right me-1"></i> <?php echo $b['id']; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li><a href="search_result.php"><i class="fa-solid fa-magnifying-glass"></i> Search Result</a></li>
            <li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
        </ul>
    </div>

    
    <div class="main-content">
        
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
            
            <div class="d-flex justify-content-between align-items-center mb-1" style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="fw-bold m-0 text-dark" style="margin: 0; font-size: 28px;">Student Result</h2>
                <a href="javascript:history.back()" class="btn btn-outline-secondary btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
            
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="student_dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:history.back()">View Results</a></li>
                    <li class="breadcrumb-item active" style="color: #6c757d;">Result Details</li>
                </ol>
            </nav>

            
            <div class="table-card">
                <h4 class="text-secondary mb-4" style="font-size: 18px; font-weight: 600;">
                    Student ID: <span class="text-dark"><?php echo htmlspecialchars($student_id); ?></span>
                </h4>

                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Marks</th>
                            <th>Grade</th>
                            <th>Grade Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { 
                        ?>
                            <tr>
                                <td class="fw-semibold" style="color: #495057;"><?php echo htmlspecialchars($row['course_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['marks']); ?></td>
                                <td><?php echo htmlspecialchars($row['grade']); ?></td>
                                <td><?php echo htmlspecialchars($row['grade_point']); ?></td>
                            </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align: center; color: #6c757d; padding: 30px;'>No result data found for this student.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                
                <div class="cgpa-box">
                    GPA / CGPA : <?php echo htmlspecialchars($cgpa); ?>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>
