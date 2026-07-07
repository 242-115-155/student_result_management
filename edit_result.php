<?php
session_start();


include 'db_connect.php';

$result = null;


if (isset($_POST['search'])) {
    $student_id = $_POST['student_id'];
    $sql = "SELECT * FROM result WHERE student_id='$student_id'";
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Result - Metropolitan University</title>
    
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
        
        
        .sidebar { width: 260px; height: 100vh; background-color: var(--sidebar-bg); position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar-brand { padding: 10px 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 15px; padding: 12px 16px; color: #a2b4c7; text-decoration: none; border-radius: 8px; font-weight: 500; transition: 0.3s; margin-bottom: 5px; }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        .menu-label { padding: 10px 24px; color: #506784; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: #0b5ed7; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; }
        .wrapper { padding: 30px; flex: 1; }
        
        
        .form-card { background: white; border-radius: 12px; padding: 30px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.02); max-width: 700px; margin: 0 auto 20px auto; }
        .form-control { border-radius: 8px; padding: 10px 15px; border: 1px solid #ced4da; font-size: 14px; }
        .form-control:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15); }
        .form-label { font-weight: 600; color: #495057; font-size: 14px; margin-bottom: 8px; }

        
        .sys-card { background: white; border-radius: 12px; padding: 20px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.01); max-width: 700px; margin: 20px auto 0 auto; }
        .sys-info-table td { padding: 10px 8px; border-bottom: 1px solid #f1f4f8; font-size: 14px; }
        .sys-info-table tr:last-child td { border-bottom: none; }
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
            <li class="active"><a href="edit_result.php"><i class="fa-solid fa-pen-to-square"></i> Edit Result</a></li>
            <li><a href="delete_result.php"><i class="fa-solid fa-trash-can"></i> Delete Result</a></li>
            <li><a href="teacher_view_result.php"><i class="fa-solid fa-eye"></i> View Results</a></li>
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
            <div class="max-width: 700px; margin: 0 auto; mb-4 text-center">
                <h3 class="fw-bold m-0 text-dark">Edit Student Result</h3>
                <p class="text-muted small">Search by Student ID and modify the registered marks</p>
            </div>

            
            <div class="form-card">
                <form method="POST" action="edit_result.php">
                    <div class="mb-3">
                        <label class="form-label">Enter Student ID</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" name="student_id" class="form-control" placeholder="Enter Student ID" required>
                        </div>
                    </div>
                    <button type="submit" name="search" class="btn btn-primary px-4 fw-semibold w-100" style="border-radius: 8px;">
                        <i class="fa-solid fa-search me-2"></i> Search
                    </button>
                </form>
            </div>

            
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="form-card border-start border-success border-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fa-solid fa-graduation-cap text-success fs-4"></i>
                            <h5 class="m-0 fw-bold text-dark">Course: <span class="text-success"><?php echo $row['course_code']; ?></span></h5>
                        </div>
                        
                        <form action="update_result.php" method="POST">
                            <input type="hidden" name="result_id" value="<?php echo $row['result_id']; ?>">
                            
                            <div class="mb-4">
                                <label class="form-label text-secondary">Modify Marks</label>
                                <input type="number" name="marks" class="form-control" value="<?php echo $row['marks']; ?>" required>
                            </div>
                            
                            <button type="submit" class="btn btn-success fw-semibold w-100" style="border-radius: 8px;">
                                <i class="fa-solid fa-rotate me-2"></i> Update Result
                            </button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php elseif (isset($_POST['search'])): ?>
                
                <div class="alert alert-danger max-width: 700px; margin: 0 auto; border-radius: 10px; text-center" style="max-width: 700px;">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> No result record found for this Student ID.
                </div>
            <?php endif; ?>
</body>
</html>
