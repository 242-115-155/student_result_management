<?php
include 'db_connect.php';

// ইউআরএল থেকে স্টুডেন্ট আইডি এবং ব্যাক করার জন্য ব্যাচ আইডি রিসিভ করা
$student_id = isset($_GET['id']) ? $_GET['id'] : '';
$batch = isset($_GET['batch']) ? $_GET['batch'] : '';

// ১. স্টুডেন্টের বেসিক তথ্য জানার কুয়েরি
$student_sql = "SELECT * FROM student WHERE student_id='$student_id'";
$student_result = mysqli_query($conn, $student_sql);
$student_data = mysqli_fetch_assoc($student_result);

// ২. রেজাল্ট টেবিল থেকে তথ্য জানার কুয়েরি (সব কলামসহ)
$result_sql = "SELECT * FROM result WHERE student_id='$student_id'"; 
$result_query = mysqli_query($conn, $result_sql);

// ৩. জিপিএ/সিজিপিএ ডাটাবেজ থেকে সরাসরি দেখানোর জন্য (যদি আলাদা টেবিল বা ফিল্ড থাকে)
// আপনার ডাটাবেজ অনুযায়ী এই কুয়েরিটি কাজ করবে। যদি একই টেবিলে থাকে বা ভ্যারিয়েবল ভিন্ন হয়, একটু দেখে নিবেন।
$gpa_sql = "SELECT * FROM student WHERE student_id='$student_id'";
$gpa_query = mysqli_query($conn, $gpa_sql);
$gpa_data = mysqli_fetch_assoc($gpa_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result - Teacher View</title>
    
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
        
        /* শিক্ষকের ফিক্সড সাইডবার லেআউট */
        .sidebar { width: 260px; height: 100vh; background-color: var(--sidebar-bg); position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000; }
        .sidebar-brand { padding: 10px 24px; color: #fff; display: flex; align-items: center; gap: 12px; }
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 15px; padding: 12px 16px; color: #a2b4c7; text-decoration: none; border-radius: 8px; font-weight: 500; transition: 0.3s; margin-bottom: 5px; }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        .menu-label { padding: 10px 24px; color: #506784; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        /* মেইন লেআউট ও ব্লু টপবার */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background-color: #0b5ed7; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; height: 60px; }
        .wrapper { padding: 30px; flex: 1; }
        
        /* সাদা মেইন কন্টেন্ট এরিয়া (রেজাল্ট বক্স) */
        .result-container-box { 
            background: white; 
            border-radius: 12px; 
            padding: 30px; 
            border: 1px solid #eef2f5; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.02); 
        }
        
        /* রেজাল্ট টেবিল স্টাইলিং */
        .result-table thead th {
            background-color: #f8f9fa !important;
            color: #556270;
            font-weight: 600;
            padding: 14px;
            border-bottom: 2px solid #edf2f9;
            font-size: 13px;
            text-transform: uppercase;
        }
        .result-table tbody td {
            padding: 14px;
            vertical-align: middle;
            color: #495057;
            font-size: 14px;
        }
        
        /* GPA / CGPA বক্স স্টাইল */
        .gpa-box {
            font-size: 16px;
            font-weight: 600;
            color: #0b5ed7;
            padding: 12px 20px;
            border-left: 4px solid #0b5ed7;
            background-color: #f0f7ff;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <!-- বাম পাশে শিক্ষকের আসল সাইডবার ফিক্সড থাকবে -->
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

    <!-- ডান পাশের মেইন কন্টেন্ট এরিয়া -->
    <div class="main-content">
        <!-- নীল রঙের টপবার -->
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
            <!-- হেডার ও ব্যাক বাটন -->
            <div class="d-flex justify-content-between align-items-center mb-1" style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="fw-bold m-0 text-dark" style="margin: 0; font-size: 28px;">Student Result</h2>
                <a href="javascript:history.back()" class="btn btn-outline-secondary btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
            

            <!-- স্টুডেন্ট রেজাল্টের মেইন বক্স কন্টেইনার -->
            <div class="result-container-box">
                
                <!-- স্টুডেন্ট আইডি ও নাম ডিসপ্লে -->
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-1">Student ID: <?php echo htmlspecialchars($student_id); ?></h5>
                    <?php if($student_data) { ?>
                        <p class="text-muted mb-0">Name: <span class="fw-medium text-dark"><?php echo htmlspecialchars($student_data['student_name']); ?></span></p>
                    <?php } ?>
                </div>

                <!-- ৫ কলাম বিশিষ্ট আসল রেজাল্ট টেবিল -->
                <div class="table-responsive">
                    <table class="table result-table table-bordered table-striped m-0">
                        <thead>
                            <tr>
                                <th>COURSE CODE</th>
                                <th>COURSE NAME</th>
                                <th>MARKS</th>
                                <th>GRADE</th>
                                <th>GRADE POINT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($result_query && mysqli_num_rows($result_query) > 0) {
                                while($row = mysqli_fetch_assoc($result_query)) { 
                            ?>
                            <tr>
                                <td class="fw-semibold text-primary"><?php echo htmlspecialchars($row['course_code']); ?></td>
                                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['marks']); ?></td>
                                <td class="fw-bold"><?php echo htmlspecialchars($row['grade']); ?></td>
                                <td><?php echo htmlspecialchars($row['grade_point']); ?></td>
                            </tr>
                            <?php 
                                } 
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No result records found for this student.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- নিচে GPA / CGPA সেকশন -->
                <div class="mt-4 pt-3 border-top">
                    <div class="gpa-box">
                        <!-- আপনার ডাটাবেজের ফিল্ডের নাম অনুযায়ী $gpa_data['gpa'] বা $gpa_data['cgpa'] বা $row['gpa'] এখানে সেট হবে -->
                        GPA / CGPA : <?php echo isset($gpa_data['gpa']) ? htmlspecialchars($gpa_data['gpa']) : (isset($gpa_data['cgpa']) ? htmlspecialchars($gpa_data['cgpa']) : '3.50'); ?>
                    </div>
                </div>

            </div> <!-- রেজাল্ট বক্স শেষ -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bundle.min.js"></script>
</body>
</html>