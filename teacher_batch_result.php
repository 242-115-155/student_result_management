<?php
include 'db_connect.php';

$batch = $_GET['batch'];

$sql = "SELECT * FROM student WHERE batch_id='$batch'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Result - Metropolitan University</title>
    
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #112240;
            --primary-blue: #0d6efd;
            --body-bg: #f3f6f9;
        }
        body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: var(--body-bg); margin: 0; }
        
        
        .sidebar { width: 260px; height: 100vh; background-color: var(--sidebar-bg); position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar-brand { padding: 10px 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 15px; padding: 12px 16px; color: #a2b4c7; text-decoration: none; border-radius: 8px; font-weight: 500; transition: 0.3s; margin-bottom: 5px; }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        .menu-label { padding: 10px 24px; color: #506784; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: #0b5ed7; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; }
        .wrapper { padding: 30px; flex: 1; }
        
        
        .table-card { 
            background: white; 
            border-radius: 12px; 
            padding: 24px; 
            border: 1px solid #eef2f5; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.02); 
        }
        
        
        .custom-table thead th {
            background-color: #f8f9fa !important;
            color: #556270;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 14px;
            border-bottom: 2px solid #edf2f9;
        }
        .custom-table tbody td {
            padding: 14px;
            vertical-align: middle;
            color: #495057;
            font-size: 14px;
        }
    </style>
</head>
<body>

    
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
            <li><a href="delete_result.php"><i class="fa-solid fa-trash-can"></i> Delete Result</a></li>
            <li class="active"><a href="teacher_view_result.php"><i class="fa-solid fa-eye"></i> View Results</a></li>
            <li class="mt-4"><a href="index.php" style="color: #ff6b6b;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </div>

    
    <div class="main-content">
        
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

        
        <div class="wrapper">
            
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-dark">CSE-<?php echo $batch; ?> Students</h3>
                    <p class="text-muted small mb-0">List of registered students under this batch</p>
                </div>
                
                <button onclick="history.back()" class="btn btn-outline-secondary btn-sm px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back
                </button>
            </div>

            
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table custom-table table-striped table-hover m-0">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td class="fw-semibold text-primary"><?php echo $row['student_id']; ?></td>
                                <td><?php echo $row['student_name']; ?></td>
                                <td class="text-center">
                                    <a href="teacher_student_result.php?id=<?php echo $row['student_id']; ?>" class="btn btn-primary btn-sm px-3 rounded-2">
                                        <i class="fa-solid fa-eye me-1"></i> View Result
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div> 

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bundle.min.js"></script>
</body>
</html>
