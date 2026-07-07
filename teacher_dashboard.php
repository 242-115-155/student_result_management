<?php
session_start();


$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "student_result_management"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$total_students = $conn->query("SELECT COUNT(*) as count FROM student")->fetch_assoc()['count'];
$total_batches  = $conn->query("SELECT COUNT(*) as count FROM batch")->fetch_assoc()['count'];
$total_courses  = $conn->query("SELECT COUNT(DISTINCT course_code) as count FROM result")->fetch_assoc()['count'];
$total_results  = $conn->query("SELECT COUNT(*) as count FROM result")->fetch_assoc()['count'];


$recent_query = "SELECT r.*, s.student_name FROM result r 
                 JOIN student s ON r.student_id = s.student_id 
                 ORDER BY r.result_id DESC LIMIT 5";
$recent_results = $conn->query($recent_query);


$batch_chart_query = "SELECT b.batch_name, COUNT(s.student_id) as student_count 
                      FROM batch b 
                      LEFT JOIN student s ON b.batch_id = s.batch_id 
                      GROUP BY b.batch_id";
$batch_chart_res = $conn->query($batch_chart_query);

$batch_labels = [];
$batch_counts = [];
while($row = $batch_chart_res->fetch_assoc()) {
    $batch_labels[] = "CSE-" . $row['batch_name'];
    $batch_counts[] = $row['student_count'];
}

// Results Overview By Grade
$grades = ['A+', 'A', 'A-', 'B+', 'B', 'C', 'D', 'F'];
$grade_counts = [];
foreach($grades as $g) {
    $grade_query = "SELECT COUNT(*) as count FROM result WHERE grade = '$g'";
    $grade_counts[] = $conn->query($grade_query)->fetch_assoc()['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Metropolitan University</title>
    
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        .wrapper { padding: 30px; }
        
        
        .stat-card { background: white; border-radius: 12px; border: 1px solid #eef2f5; padding: 20px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(0,0,0,0.01); }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
        
        
        .action-box { background: white; border-radius: 12px; padding: 25px; height: 100%; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.01); }
        .action-btn { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 15px; border-radius: 12px; border: none; text-decoration: none; font-weight: 600; font-size: 12px; transition: transform 0.2s; height: 100px; text-align: center; }
        .action-btn:hover { transform: translateY(-3px); color: initial; }
        
        
        .dashboard-card { background: white; border-radius: 12px; padding: 25px; border: 1px solid #eef2f5; box-shadow: 0 4px 12px rgba(0,0,0,0.01); height: 100%; }
        .table th { background-color: #f8f9fa; color: #6c757d; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px; }
        .table td { padding: 12px; vertical-align: middle; font-size: 14px; }
        .badge-grade { padding: 5px 10px; border-radius: 6px; font-weight: 600; font-size: 12px; }

        
        .sys-info-table td { padding: 12px 8px; border-bottom: 1px solid #f1f4f8; font-size: 14px; }
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
            <li class="active"><a href="teacher_dashboard.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
            <li><a href="add_student.php"><i class="fa-solid fa-user-plus"></i> Add Student</a></li>
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
            <div class="mb-4">
                <h3 class="fw-bold m-0 text-dark">Teacher Dashboard</h3>
                <p class="text-muted small m-0">Welcome back, Teacher</p>
            </div>

            
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <p class="text-muted small mb-1 fw-bold">TOTAL STUDENTS</p>
                            <h3 class="fw-bold m-0 text-primary"><?php echo $total_students; ?></h3>
                        </div>
                        <div class="stat-icon bg-primary-subtle text-primary"><i class="fa-solid fa-users"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <p class="text-muted small mb-1 fw-bold">TOTAL BATCHES</p>
                            <h3 class="fw-bold m-0 text-info"><?php echo $total_batches; ?></h3>
                        </div>
                        <div class="stat-icon bg-info-subtle text-info"><i class="fa-solid fa-folder"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <p class="text-muted small mb-1 fw-bold">TOTAL COURSES</p>
                            <h3 class="fw-bold m-0 text-warning"><?php echo $total_courses; ?></h3>
                        </div>
                        <div class="stat-icon bg-warning-subtle text-warning"><i class="fa-solid fa-book"></i></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <p class="text-muted small mb-1 fw-bold">TOTAL RESULTS</p>
                            <h3 class="fw-bold m-0 text-success"><?php echo $total_results; ?></h3>
                        </div>
                        <div class="stat-icon bg-success-subtle text-success"><i class="fa-solid fa-file-invoice"></i></div>
                    </div>
                </div>
            </div>

            
            <div class="row g-4 mb-4">
               
                <div class="col-lg-5">
                    <div class="action-box">
                        <h6 class="fw-bold text-dark mb-3">Quick Actions</h6>
                        <div class="row g-2">
                            <div class="col-4"><a href="add_student.php" class="action-btn bg-primary-subtle text-primary"><i class="fa-solid fa-user-plus mb-2 fs-4"></i>Add Student</a></div>
                            <div class="col-4"><a href="add_result.php" class="action-btn bg-success-subtle text-success"><i class="fa-solid fa-file-circle-plus mb-2 fs-4"></i>Add Result</a></div>
                            <div class="col-4"><a href="edit_result.php" class="action-btn bg-warning-subtle text-warning"><i class="fa-solid fa-pen-to-square mb-2 fs-4"></i>Edit Result</a></div>
                            <div class="col-4"><a href="delete_result.php" class="action-btn bg-danger-subtle text-danger"><i class="fa-solid fa-trash-can mb-2 fs-4"></i>Delete Result</a></div>
                            <div class="col-4"><a href="teacher_view_result.php" class="action-btn bg-info-subtle text-info"><i class="fa-solid fa-eye mb-2 fs-4"></i>View Results</a></div>
                            <div class="col-4"><a href="index.php" class="action-btn bg-secondary-subtle text-secondary"><i class="fa-solid fa-right-from-bracket mb-2 fs-4"></i>Logout</a></div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-7">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-dark m-0">Recent Results Added</h6>
                            <a href="view_results.php" class="btn btn-sm btn-primary px-3">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student Name</th>
                                        <th>Course</th>
                                        <th>Marks</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($recent_results && $recent_results->num_rows > 0) {
                                        while($row = $recent_results->fetch_assoc()) {
                                            $bg = ($row['grade'] == 'F') ? 'bg-danger text-white' : 'bg-success-subtle text-success';
                                    ?>
                                        <tr>
                                            <td class="fw-semibold text-secondary"><?php echo htmlspecialchars($row['student_id']); ?></td>
                                            <td class="fw-medium"><?php echo htmlspecialchars($row['student_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['marks']); ?></td>
                                            <td><span class="badge-grade <?php echo $bg; ?>"><?php echo htmlspecialchars($row['grade']); ?></span></td>
                                        </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center text-muted'>No results found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row g-4">
                
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h6 class="fw-bold text-dark mb-3">Students by Batch</h6>
                        <div style="height: 240px; display: flex; justify-content: center;">
                            <canvas id="batchPieChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Results Overview (By Grade) -->
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h6 class="fw-bold text-dark mb-3">Results Overview (By Grade)</h6>
                        <div style="height: 240px;">
                            <canvas id="gradeBarChart"></canvas>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h6 class="fw-bold text-dark mb-3">System Info</h6>
                        <table class="w-100 sys-info-table">
                            <tr>
                                <td class="text-secondary fw-medium"><i class="fa-regular fa-calendar me-2 text-primary"></i> Today's Date</td>
                                <td class="text-end fw-semibold text-dark"><?php echo date('d M Y'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-secondary fw-medium"><i class="fa-regular fa-clock me-2 text-success"></i> Current Time</td>
                                <td class="text-end fw-semibold text-dark" id="live-clock"><?php echo date('h:i:s A'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-secondary fw-medium"><i class="fa-regular fa-user me-2 text-info"></i> Logged In As</td>
                                <td class="text-end fw-semibold text-dark">Teacher</td>
                            </tr>
                            <tr>
                                <td class="text-secondary fw-medium"><i class="fa-solid fa-shield-halved me-2 text-danger"></i> User Role</td>
                                <td class="text-end fw-semibold text-dark"><span class="badge bg-danger-subtle text-danger px-2 py-1 rounded">Teacher</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
    <script>
        
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; 
            minutes = minutes < 10 ? '0'+minutes : minutes;
            seconds = seconds < 10 ? '0'+seconds : seconds;
            document.getElementById('live-clock').innerHTML = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        }
        setInterval(updateClock, 1000);

        // pie chart (Students by Batch)
        const ctxPie = document.getElementById('batchPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($batch_labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($batch_counts); ?>,
                    backgroundColor: ['#36a2eb', '#4bc0c0', '#ff9f40', '#ff6384', '#9966ff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
            }
        });

        // bar chart (Results Overview)
        const ctxBar = document.getElementById('gradeBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($grades); ?>,
                datasets: [{
                    data: <?php echo json_encode($grade_counts); ?>,
                    backgroundColor: '#5bc0de',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f8f9fa' } },
                    x: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
