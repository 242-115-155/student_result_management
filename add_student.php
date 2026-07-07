<?php
session_start();

include 'db_connect.php';

if (isset($_POST['save_student'])) {
    $student_id   = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $batch_id     = $_POST['batch_id'];

    $sql = "INSERT INTO student (student_id, student_name, email, phone, batch_id) 
            VALUES ('$student_id', '$student_name', '$email', '$phone', '$batch_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student Added Successfully');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Metropolitan University</title>
    
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
        
        /* sidebar design */
        .sidebar { width: 260px; height: 100vh; background-color: var(--sidebar-bg); position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar-brand { padding: 10px 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 15px; padding: 12px 16px; color: #a2b4c7; text-decoration: none; border-radius: 8px; font-weight: 500; transition: 0.3s; margin-bottom: 5px; }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        .menu-label { padding: 10px 24px; color: #506784; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        /* main layout */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: #0b5ed7; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; }
        .wrapper { padding: 30px; flex: 1; }
        
        /* form card design */
        .form-card { background: white; border-radius: 12px; padding: 30px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.01); max-width: 700px; margin: 0 auto; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border: 1px solid #ced4da; font-size: 14px; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15); }
        .form-label { font-weight: 600; color: #495057; font-size: 14px; margin-bottom: 8px; }

        /* system info table style */
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
            <li class="active"><a href="add_student.php"><i class="fa-solid fa-user-plus"></i> Add Student</a></li>
            <li><a href="add_result.php"><i class="fa-solid fa-file-circle-plus"></i> Add Result</a></li>
            <li><a href="edit_result.php"><i class="fa-solid fa-pen-to-square"></i> Edit Result</a></li>
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
                <h3 class="fw-bold m-0 text-dark">Add New Student</h3>
                <p class="text-muted small">Fill up the information below to register a student</p>
            </div>

            
            <div class="form-card">
                <form method="POST" action="add_student.php">
                    <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" class="form-control" placeholder="e.g. 245-0050" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Student Name</label>
                        <input type="text" name="student_name" class="form-control" placeholder="e.g. Shakil Karim" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. shakil@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="e.g. 017XXXXXXXX" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Select Batch</label>
                        <select name="batch_id" class="form-select" required>
                            <option value="">-- Select Batch --</option>
                            <option value="61">CSE-61</option>
                            <option value="62">CSE-62</option>
                            <option value="63">CSE-63</option>
                            <option value="64">CSE-64</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" name="save_student" class="btn btn-primary px-4 py-2 fw-semibold w-100" style="border-radius: 8px;">
                            <i class="fa-solid fa-user-plus me-2"></i> Save Student
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>


</body>
</html>
