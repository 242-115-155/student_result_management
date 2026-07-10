<?php
// Start session and handle authentication
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// 1. Include Database Connection
include "db_connect.php";

// 2. Fetch Dashboard Metrics using MySQLi syntax
$total_students_res = $conn->query("SELECT COUNT(*) FROM student");
$total_students = $total_students_res->fetch_row()[0];

$total_courses_res = $conn->query("SELECT COUNT(*) FROM course");
$total_courses = $total_courses_res->fetch_row()[0];

$total_results_res = $conn->query("SELECT COUNT(*) FROM result");
$total_results = $total_results_res->fetch_row()[0];

$total_teachers_res = $conn->query("SELECT COUNT(*) FROM teacher");
$total_teachers = $total_teachers_res->fetch_row()[0];


$grades_to_check = ['A+', 'A', 'A-', 'B+', 'B', 'C', 'D', 'F'];
$grade_counts = [];

foreach ($grades_to_check as $g) {
    $g_res = $conn->query("SELECT COUNT(*) FROM result WHERE grade = '$g'");
    $grade_counts[$g] = $g_res ? $g_res->fetch_row()[0] : 0;
}


$js_grade_labels = json_encode(array_keys($grade_counts));
$js_grade_data = json_encode(array_values($grade_counts));


$query_recent = "
    SELECT r.student_id, s.student_name, r.course_name, r.marks, r.grade 
    FROM result r
    JOIN student s ON r.student_id = s.student_id
    ORDER BY r.semester_id DESC, r.student_id DESC 
    LIMIT 5
";
$recent_results_res = $conn->query($query_recent);
$recent_results = $recent_results_res->fetch_all(MYSQLI_ASSOC);

// 4. Fetch Students Distribution by Batch
$query_batch = "
    SELECT b.batch_name, COUNT(s.student_id) as total 
    FROM batch b
    LEFT JOIN student s ON b.batch_id = s.batch_id
    GROUP BY b.batch_id
";
$batch_res = $conn->query($query_batch);
$batch_data = $batch_res->fetch_all(MYSQLI_ASSOC);

// Format data for JavaScript Chart
$batch_labels = [];
$batch_counts = [];
foreach ($batch_data as $row) {
    $batch_labels[] = $row['batch_name'] . " (" . $row['total'] . ")";
    $batch_counts[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System - Admin Dashboard</title>
    <!-- Bootstrap 5 & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery adding for AJAX loading smoothly -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        body { background-color: #f3f4f9; font-family: 'Segoe UI', Arial, sans-serif; }
        .navbar-custom { background-color: #0b5ed7; color: white; padding: 12px 25px; }
        .sidebar { height: calc(100vh - 55px); background: #1a233a; color: #a1b0cb; width: 260px; position: fixed; padding-top: 15px; }
        .sidebar .university-logo { padding: 10px 20px; border-bottom: 1px solid #283554; }
        .sidebar .menu-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #596b8c; padding: 20px 20px 10px; font-weight: bold; }
        .sidebar a { color: #a1b0cb; text-decoration: none; padding: 12px 20px; display: block; font-size: 14px; transition: all 0.2s; cursor: pointer; }
        .sidebar a:hover, .sidebar a.active { background: #0d6efd; color: white; border-radius: 4px; margin: 0 10px; }
        .main-content { margin-left: 260px; padding: 30px; min-height: calc(100vh - 110px); }
        .card-stat { border: none; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.04); transition: transform 0.2s; background: white;}
        .card-stat:hover { transform: translateY(-3px); }
        .stat-icon { width: 55px; height: 55px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .card-action { text-align: center; padding: 25px 15px; border: none; border-radius: 8px; background: white; cursor: pointer; transition: all 0.2s; text-decoration: none; display: block; }
        .card-action:hover { background: #f8f9fa; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        .card-action i { font-size: 28px; margin-bottom: 12px; }
        .badge-grade { padding: 5px 10px; font-weight: bold; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <div class="navbar-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-bars fs-5" style="cursor: pointer;"></i>
            <span class="fw-bold fs-5">Student Result Management System</span>
        </div>
        <div class="d-flex align-items-center gap-4">
            <div class="d-flex align-items-center gap-2">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0d6efd&color=fff&size=35" class="rounded-circle" alt="Admin">
                <span class="small fw-semibold">Admin <i class="fa-solid fa-chevron-down ms-1" style="font-size: 10px;"></i></span>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu Section -->
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
        
        <div class="menu-label">Main Menu</div>
        <a href="admin_dashboard.php" class="active" id="nav-dashboard"><i class="fa-solid fa-house me-3"></i> Dashboard</a>
        <!-- AJAX Trigger for Manage Students -->
        <a id="nav-students"><i class="fa-solid fa-users me-3"></i> Manage Students</a>
        <a id="nav-teachers"><i class="fa-solid fa-user-tie me-3"></i> Manage Teachers</a>
        <a id="nav-courses"><i class="fa-solid fa-book me-3"></i> Manage Courses</a>
        <a id="nav-batches" href="admin_manage_batches.php"><i class="fa-solid fa-folder me-3"></i> Manage Batches</a>
        <a id="nav-results" href="admin_manage_results.php"><i class="fa-solid fa-file-invoice me-3"></i> Manage Results</a>
        <a href="admin_logout.php" class="text-danger mt-4"><i class="fa-solid fa-right-from-bracket me-3"></i> Logout</a>
    </div>

    <!-- Main Content Panel (Dynamically Loaded Container) -->
    <div class="main-content" id="dynamic-content">
        
        <!-- Default Dashboard View Content Start -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold m-0">Admin Dashboard</h4>
                <small class="text-muted">Welcome back, Admin</small>
            </div>
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                <ol class="breadcrumb m-0 small">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- 4 Metrics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card card-stat p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <span class="text-muted small uppercase fw-semibold">TOTAL STUDENTS</span>
                            <h3 class="fw-bold m-0 text-dark mt-1"><?php echo number_format($total_students); ?></h3>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <hr class="m-0 text-muted opacity-25">
                    <a id="link-view-students" href="#" class="small text-decoration-none mt-2 d-flex justify-content-between text-muted">View all students</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <span class="text-muted small uppercase fw-semibold">TOTAL TEACHERS</span>
                            <h3 class="fw-bold m-0 text-dark mt-1"><?php echo $total_teachers; ?></h3>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    </div>
                    <hr class="m-0 text-muted opacity-25">
                    <a id="link-view-teachers" href="#" class="small text-decoration-none mt-2 d-flex justify-content-between text-muted">View all teachers</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <span class="text-muted small uppercase fw-semibold">TOTAL COURSES</span>
                            <h3 class="fw-bold m-0 text-dark mt-1"><?php echo $total_courses; ?></h3>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fa-solid fa-book"></i>
                        </div>
                    </div>
                    <hr class="m-0 text-muted opacity-25">
                    <a id="link-view-courses" href="#" class="small text-decoration-none mt-2 d-flex justify-content-between text-muted">View all courses</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <span class="text-muted small uppercase fw-semibold">TOTAL RESULTS</span>
                            <h3 class="fw-bold m-0 text-dark mt-1"><?php echo number_format($total_results); ?></h3>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                    </div>
                    <hr class="m-0 text-muted opacity-25">
                    <a id="link-view-results" href="#" class="small text-decoration-none mt-2 d-flex justify-content-between text-muted">View all results</a>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Tables -->
        <div class="row g-4 mb-4">
            <div class="col-md-5">
                <div class="card p-4 border-0 shadow-sm bg-white h-100">
                    <h6 class="fw-bold mb-3">Quick Actions</h6>
                    <div class="row g-3">
                        <div class="col-4"><a id="action-manage-students" class="card-action text-primary bg-primary bg-opacity-10"><i class="fa-solid fa-users"></i><div class="small fw-semibold">Manage<br>Students</div></a></div>
                        <div class="col-4"><a id="action-manage-teachers" class="card-action text-success bg-success bg-opacity-10"><i class="fa-solid fa-user-tie"></i><div class="small fw-semibold">Manage<br>Teachers</div></a></div>
                        <div class="col-4"><a id="action-manage-courses" class="card-action text-warning bg-warning bg-opacity-10"><i class="fa-solid fa-book"></i><div class="small fw-semibold">Manage<br>Courses</div></a></div>
                        <div class="col-4"><a id="action-manage-batches" class="card-action text-info bg-info bg-opacity-10"><i class="fa-solid fa-folder"></i><div class="small fw-semibold">Manage<br>Batches</div></a></div>
                        <div class="col-4"><a id="action-manage-results" class="card-action text-secondary bg-secondary bg-opacity-10"><i class="fa-solid fa-file-invoice"></i><div class="small fw-semibold">Manage<br>Results</div></a></div>
                        <div class="col-4"><a href="admin_logout.php" class="card-action text-primary bg-primary bg-opacity-10"><i class="fa-solid fa-right-from-bracket"></i><div class="small fw-semibold">Logout</div></a></div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card p-4 border-0 shadow-sm bg-white h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold m-0">Recent Results</h6>
                        <button class="btn btn-sm btn-primary px-3 rounded-2">View All Results</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless table-striped m-0 small">
                            <thead>
                                <tr class="text-muted table-light">
                                    <th>#</th>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Course</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($recent_results) > 0): ?>
                                    <?php $count = 1; foreach($recent_results as $res): 
                                        $badge_class = match($res['grade']) {
                                            'A+' => 'bg-success text-white',
                                            'A'  => 'bg-success text-white bg-opacity-75',
                                            'B+' => 'bg-primary text-white bg-opacity-75',
                                            'B'  => 'bg-primary text-white',
                                            default => 'bg-warning text-dark'
                                        };
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($res['student_id']); ?></td>
                                            <td><?php echo htmlspecialchars($res['student_name']); ?></td>
                                            <td><?php echo htmlspecialchars($res['course_name']); ?></td>
                                            <td><?php echo htmlspecialchars($res['marks']); ?></td>
                                            <td><span class="badge badge-grade <?php echo $badge_class; ?>"><?php echo htmlspecialchars($res['grade']); ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center text-muted">No recent result metrics available.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4 border-0 shadow-sm bg-white h-100">
                    <h6 class="fw-bold mb-3">Students by Batch</h6>
                    <div style="max-height: 220px; display: flex; justify-content: center;">
                        <canvas id="batchPieChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 border-0 shadow-sm bg-white h-100">
                    <h6 class="fw-bold mb-3">Results Overview</h6>
                    <canvas id="resultsLineChart"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 border-0 shadow-sm bg-white h-100">
                    <h6 class="fw-bold mb-3">System Info</h6>
                    <div class="d-flex justify-content-between py-2 border-bottom small"><span class="text-muted"><i class="fa-regular fa-calendar me-2"></i> Today's Date</span><span class="fw-semibold"><?php echo date('d M Y'); ?></span></div>
                    <div class="d-flex justify-content-between py-2 border-bottom small"><span class="text-muted"><i class="fa-regular fa-clock me-2"></i> Current Time</span><span class="fw-semibold"><?php echo date('h:i:A'); ?></span></div>
                    <div class="d-flex justify-content-between py-2 border-bottom small"><span class="text-muted"><i class="fa-regular fa-user me-2"></i> Logged In As</span><span class="fw-semibold">Admin</span></div>
                    <div class="d-flex justify-content-between py-2 small"><span class="text-muted"><i class="fa-solid fa-shield-halved me-2"></i> User Role</span><span class="fw-semibold text-primary">Administrator</span></div>
                </div>
            </div>
        </div>
        <!-- Default Dashboard View Content End -->

    </div>

    <!-- Footer Area -->
    <footer class="bg-white py-3 border-top mt-5 small text-muted">
        <div class="container-fluid px-5 d-flex justify-content-between">
            <span>© <?php echo date('Y'); ?> <a href="#" class="text-decoration-none">Metropolitan University</a>. All rights reserved.</span>
            <span>Developed by Maliha Tabassum Hridila <i class="fa-solid fa-heart text-primary"></i></span>
        </div>
    </footer>

    <!-- JavaScript & AJAX Logics -->
    <script>
        // Function to load external PHP files inside the dynamic container via AJAX
        function loadPageContent(pageUrl) {
            // Loading Animation or effect
            $('#dynamic-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            
            // Execute AJAX call
            $.ajax({
                url: pageUrl,
                type: 'GET',
                success: function(data) {
                    $('#dynamic-content').html(data);
                },
                error: function() {
                    $('#dynamic-content').html('<div class="alert alert-danger">Error: Could not load the component layout.</div>');
                }
            });
        }

        // Active State toggle helper
        function updateActiveTab(elementId) {
            $('.sidebar a').removeClass('active');
            $(elementId).addClass('active');
        }

        // Event triggers for Dashboard Card Links (View All)
    $(document).on('click', '#link-view-students', function(e) { e.preventDefault(); $('#nav-students').click(); });
    $(document).on('click', '#link-view-teachers', function(e) { e.preventDefault(); $('#nav-teachers').click(); });
    $(document).on('click', '#link-view-courses', function(e) { e.preventDefault(); $('#nav-courses').click(); });
    $(document).on('click', '#link-view-results', function(e) { e.preventDefault(); $('#nav-results').click(); });

        // Event triggers for 'Manage Students'
        $(document).on('click', '#nav-students, #action-manage-students, #link-view-students', function(e) {
            e.preventDefault();
            updateActiveTab('#nav-students');
            loadPageContent('admin_manage_students.php');
        });

        // Event triggers for 'Manage Teachers'
        $(document).on('click', '#nav-teachers, #action-manage-teachers', function(e) {
        e.preventDefault();
        updateActiveTab('#nav-teachers');
        loadPageContent('admin_manage_teachers.php'); 
        });

        // Event triggers for 'Manage Courses'
        $(document).on('click', '#nav-courses, #action-manage-courses', function(e) {
        e.preventDefault();
        updateActiveTab('#nav-courses'); 
        loadPageContent('admin_manage_courses.php');
        });

        // Event triggers for 'Manage Batches'
        $(document).on('click', '#nav-batches', function(e) {
        e.preventDefault();
        updateActiveTab('#nav-batches'); 
        loadPageContent('admin_manage_batches.php'); 
        });

        // Event triggers for 'Manage Results'
$       (document).on('click', '#nav-results', function(e) {
        e.preventDefault();
        updateActiveTab('#nav-results'); 
        loadPageContent('admin_manage_results.php'); 
        });

        // Charts configuration
        const ctxPie = document.getElementById('batchPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($batch_labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($batch_counts); ?>,
                    backgroundColor: ['#0d6efd', '#2ec4b6', '#ff9f1c', '#e71d36', '#8338ec']
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'right' } } }
        });

        const ctxLine = document.getElementById('resultsLineChart').getContext('2d');
new Chart(ctxLine, {
    type: 'bar', 
    data: {
        labels: <?php echo $js_grade_labels; ?>, 
        datasets: [{
            label: 'Total Students',
            data: <?php echo $js_grade_data; ?>, 
            backgroundColor: 'rgba(13, 110, 253, 0.4)', 
            borderColor: 'rgba(13, 110, 253, 1)',
            borderWidth: 2,
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1 
                }
            }
        }
    }
});
    </script>
</body>
</html>
