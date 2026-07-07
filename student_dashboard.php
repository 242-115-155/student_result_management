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


$total_students = $conn->query("SELECT COUNT(*) AS total FROM student")->fetch_assoc()['total'] ?? 0;
$total_batches  = $conn->query("SELECT COUNT(*) AS total FROM batch")->fetch_assoc()['total'] ?? 0;
$total_courses  = $conn->query("SELECT COUNT(*) AS total FROM course")->fetch_assoc()['total'] ?? 0;
$total_results  = $conn->query("SELECT COUNT(*) AS total FROM result")->fetch_assoc()['total'] ?? 0;


$recent_results_query = "SELECT r.student_id, s.student_name, r.course_name, r.marks, r.grade 
                         FROM result r
                         LEFT JOIN student s ON r.student_id = s.student_id
                         ORDER BY r.result_id DESC LIMIT 5";
$recent_results_list = $conn->query($recent_results_query);

// 1. Students by Batch (Pie Chart Data)
$batch_counts = ['CSE-61' => 0, 'CSE-62' => 0, 'CSE-63' => 0, 'CSE-64' => 0];
$batch_chart_query = "SELECT b.batch_name, COUNT(s.student_id) AS total_stu 
                      FROM student s 
                      JOIN batch b ON s.batch_id = b.batch_id 
                      WHERE b.batch_name IN ('CSE-61', 'CSE-62', 'CSE-63', 'CSE-64') 
                      GROUP BY b.batch_name";
$batch_chart_res = $conn->query($batch_chart_query);
if ($batch_chart_res) {
    while($b_row = $batch_chart_res->fetch_assoc()) {
        $b_name = trim($b_row['batch_name']);
        if (array_key_exists($b_name, $batch_counts)) {
            $batch_counts[$b_name] = (int)$b_row['total_stu'];
        }
    }
}

// 2. Results Overview by Grade (Bar Chart Data)
$grade_counts = ['A+' => 0, 'A' => 0, 'A-' => 0, 'B+' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'F' => 0];
$grade_chart_query = "SELECT grade, COUNT(*) AS total_grade FROM result GROUP BY grade";
$grade_chart_res = $conn->query($grade_chart_query);
if ($grade_chart_res) {
    while($g_row = $grade_chart_res->fetch_assoc()) {
        $g_name = strtoupper(trim($g_row['grade']));
        if (array_key_exists($g_name, $grade_counts)) {
            $grade_counts[$g_name] = (int)$g_row['total_grade'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Metropolitan University</title>
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
        
        
        .sidebar {
            width: 260px; height: 100vh; background-color: var(--sidebar-bg);
            position: fixed; top: 0; left: 0; padding-top: 20px; z-index: 1000;
        }
        .sidebar-brand { padding: 10px 24px; color: #fff; font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; }
        .sidebar-brand img { width: 35px; height: 35px; border-radius: 50%; background: white; padding: 2px;}
        .sidebar-menu { list-style: none; padding: 20px 12px; margin: 0; }
        .sidebar-menu li a {
            display: flex; align-items: center; gap: 15px; padding: 12px 16px;
            color: #b3c0ce; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.3s; margin-bottom: 5px;
        }
        .sidebar-menu li a:hover, .sidebar-menu li.active > a { background-color: var(--primary-blue); color: #fff; }
        
        
        .submenu { list-style: none; padding-left: 35px; margin-bottom: 10px; }
        .submenu li a { padding: 8px 16px; font-size: 14px; color: #a2b4c7; }
        .submenu li a:hover { background-color: var(--sidebar-hover); color: #fff; }
        .menu-label { padding: 10px 24px; color: #647b9c; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        
        
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background: linear-gradient(135deg, #0d4295 0%, #0061f2 100%); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .wrapper { padding: 30px; flex: 1; }
        
        .stat-card { border: none; border-radius: 12px; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: transform 0.2s; }
        .stat-card:hover { transform: translateY(-3px); }
        .icon-box { width: 52px; height: 52px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        
        .bg-light-blue { background-color: #e6f0ff; color: #0061f2; }
        .bg-light-success { background-color: #d1f7ec; color: #0f7654; }
        .bg-light-warning { background-color: #fef0d6; color: #a96900; }
        .bg-light-danger { background-color: #ffe7e6; color: #d9383a; }
        
        .action-box { text-align: center; padding: 20px; border-radius: 12px; background: #fff; text-decoration: none; display: block; color: #333; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.02); border: 1px solid #eee; }
        .action-box:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }
        .action-icon { font-size: 28px; margin-bottom: 10px; }
        
        
        .chart-wrapper { position: relative; width: 100%; height: 260px; display: flex; justify-content: center; align-items: center; }
    </style>
</head>
<body>

    
    <div class="sidebar">
        <div class="university-logo d-flex align-items-center gap-3 pb-3 mb-2">
            <div class="bg-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                <i class="fa-solid fa-graduation-cap text-primary fs-4"></i>
            </div>
            <div>
                <h6 class="text-white m-0 fw-bold">Metropolitan</h6>
                <small style="font-size: 11px; color: #788ba8;">University</small>
            </div>
        </div>
        <div class="menu-label mt-4">Main Menu</div>
        <ul class="sidebar-menu">
            <li class="active"><a href="#"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            
            <li>
                <a href="view_results.php" class="d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-file-invoice me-1"></i> View Results</span>
                    <i class="fa-solid fa-chevron-down fs-12"></i>
                </a>
                <ul class="submenu collapse" id="viewResultsMenu">
                    <li><a href="batch_result.php?batch=CSE-61">CSE-61</a></li>
                    <li><a href="batch_result.php?batch=CSE-62">CSE-62</a></li>
                    <li><a href="batch_result.php?batch=CSE-63">CSE-63</a></li>
                    <li><a href="batch_result.php?batch=CSE-64">CSE-64</a></li>
                </ul>
            </li>
            
            <li><a href="search_result.php"><i class="fa-solid fa-magnifying-glass"></i> Search Result</a></li>
            <li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
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
           
            <div class="mb-4">
                <h2 class="fw-bold m-0 text-dark">Student Dashboard</h2>
                <p class="text-muted m-0">Welcome back, dear student!</p>
            </div>

            
            <div class="row mb-4 g-3">
                <div class="col-md-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small fw-bold mb-1">TOTAL STUDENTS</p>
                                <h3 class="fw-bold m-0 text-primary"><?php echo number_format($total_students); ?></h3>
                            </div>
                            <div class="icon-box bg-light-blue"><i class="fa-solid fa-users"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small fw-bold mb-1">TOTAL BATCHES</p>
                                <h3 class="fw-bold m-0 text-success"><?php echo number_format($total_batches); ?></h3>
                            </div>
                            <div class="icon-box bg-light-success"><i class="fa-solid fa-layer-group"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small fw-bold mb-1">TOTAL COURSES</p>
                                <h3 class="fw-bold m-0 text-warning"><?php echo number_format($total_courses); ?></h3>
                            </div>
                            <div class="icon-box bg-light-warning"><i class="fa-solid fa-book-open"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted small fw-bold mb-1">TOTAL RESULTS</p>
                                <h3 class="fw-bold m-0 text-danger"><?php echo number_format($total_results); ?></h3>
                            </div>
                            <div class="icon-box bg-light-danger"><i class="fa-solid fa-square-poll-vertical"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card stat-card p-4 h-100">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-bolt text-warning me-2"></i>Quick Actions</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="view_results.php" class="action-box bg-light-blue">
                                    <div class="action-icon text-primary"><i class="fa-regular fa-eye"></i></div>
                                    <span class="small fw-semibold d-block">View Results</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="search_result.php" class="action-box bg-light-warning">
                                    <div class="action-icon text-warning"><i class="fa-solid fa-magnifying-glass"></i></div>
                                    <span class="small fw-semibold d-block">Search Result</span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="index.php" class="action-box bg-light-danger">
                                    <div class="action-icon text-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                                    <span class="small fw-semibold d-block">Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mb-3">
                    <div class="card stat-card p-4 h-100">
                        <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Recent Results</h5>
                        <?php if ($recent_results_list && $recent_results_list->num_rows > 0) { ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle m-0">
                                    <thead class="table-light">
                                        <tr class="text-muted small uppercase">
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Course</th>
                                            <th>Marks</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sl = 1;
                                        while($row = $recent_results_list->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $sl++; ?></td>
                                                <td class="fw-semibold text-secondary"><?php echo htmlspecialchars($row['student_id'] ?? 'N/A'); ?></td>
                                                <td><?php echo htmlspecialchars($row['student_name'] ?? 'N/A'); ?></td>
                                                <td><?php echo htmlspecialchars($row['course_name'] ?? 'N/A'); ?></td>
                                                <td><?php echo htmlspecialchars($row['marks'] ?? '0'); ?></td>
                                                <td>
                                                    <span class="badge bg-success px-2.5 py-1.5"><?php echo htmlspecialchars($row['grade'] ?? 'N/A'); ?></span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-warning text-center my-auto">No recent results found!</div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            
            <div class="row">
                
                <div class="col-md-5 mb-4">
                    <div class="card stat-card p-4 h-100">
                        <h5 class="fw-bold mb-3 text-dark">Students by Batch</h5>
                        <div class="chart-wrapper">
                            <canvas id="batchPieChart"></canvas>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-4 mb-4">
                    <div class="card stat-card p-4 h-100">
                        <h5 class="fw-bold mb-3 text-dark">Results Overview</h5>
                        <div class="chart-wrapper">
                            <canvas id="resultsOverviewChart"></canvas>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-3 mb-4">
                    <div class="card stat-card p-4 h-100">
                        <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-circle-info me-2 text-info"></i>System Info</h5>
                        <div class="d-flex gap-3 mb-3">
                            <i class="fa-regular fa-calendar text-muted mt-1"></i>
                            <div>
                                <span class="text-muted d-block small">Today's Date</span>
                                <span class="fw-semibold"><?php echo date("d F Y"); ?></span>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <i class="fa-regular fa-clock text-muted mt-1"></i>
                            <div>
                                <span class="text-muted d-block small">Current Time</span>
                                <span class="fw-semibold text-primary" id="liveClock">00:00:00 AM</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <i class="fa-regular fa-user text-muted mt-1"></i>
                            <div>
                                <span class="text-muted d-block small">Logged in as</span>
                                <span class="fw-semibold text-dark">Student</span>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <i class="fa-solid fa-shield-halved text-muted mt-1"></i>
                            <div>
                                <span class="text-muted d-block small">User Role</span>
                                <span class="badge bg-light-blue fw-semibold">Student</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <footer class="text-center text-muted mt-5 small py-3 border-top bg-white rounded">
                <p class="m-0">© 2026 <strong>Metropolitan University</strong>. All rights reserved.</p>
                <small class="text-muted">Developed by <strong>Maliha Tabassum Hridila</strong></small>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS + Chart.js Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // 1. Live JavaScript Clock
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
            
            document.getElementById('liveClock').innerHTML = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // 2. Students by Batch 
        const ctxPie = document.getElementById('batchPieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['CSE-61', 'CSE-62', 'CSE-63', 'CSE-64'],
            datasets: [{
                data: [
                    <?php echo $batch_counts['CSE-61']; ?>,
                    <?php echo $batch_counts['CSE-62']; ?>,
                    <?php echo $batch_counts['CSE-63']; ?>,
                    <?php echo $batch_counts['CSE-64']; ?>
                ],
                backgroundColor: ['#e74c3c', '#3498db', '#2ecc71', '#f1c40f'],
                borderWidth: 2
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: { 
                legend: { 
                    position: 'right',
                    labels: { boxWidth: 12, padding: 15 }
                } 
            }
        }
    });
        // 3. Results Overview (Bar Chart)
        const ctxBar = document.getElementById('resultsOverviewChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['A+', 'A', 'A-', 'B+', 'B', 'C', 'D', 'F'],
                datasets: [{
                    label: 'Total Grades',
                    data: [
                        <?php echo $grade_counts['A+']; ?>,
                        <?php echo $grade_counts['A']; ?>,
                        <?php echo $grade_counts['A-']; ?>,
                        <?php echo $grade_counts['B+']; ?>,
                        <?php echo $grade_counts['B']; ?>,
                        <?php echo $grade_counts['C']; ?>,
                        <?php echo $grade_counts['D']; ?>,
                        <?php echo $grade_counts['F']; ?>
                    ],
                    backgroundColor: '#3498db',
                    borderRadius: 4
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>
