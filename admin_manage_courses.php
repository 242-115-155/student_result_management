<?php

if (session_status() === PHP_SESSION_NONE && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("Location: admin_login.php");
        exit();
    }
}

include("db_connect.php");

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql = "SELECT course.*, batch.batch_name
            FROM course
            LEFT JOIN batch ON course.batch_id=batch.batch_id
            WHERE course.course_code LIKE '%$search%'
               OR course.course_name LIKE '%$search%'
               OR batch.batch_name LIKE '%$search%'
            ORDER BY batch.batch_name ASC, course.course_code ASC";
} else {
    $sql = "SELECT c.*, b.batch_name
            FROM course c
            LEFT JOIN batch b
            ON c.batch_id = b.batch_id
            ORDER BY c.batch_id, c.course_code";
}

$result = mysqli_query($conn, $sql);

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])): 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fa; padding: 20px; }
    </style>
</head>
<body>
<?php endif; ?>


<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-primary text-white py-3 fs-5 fw-bold">
        Manage Courses
    </div>

    <div class="card-body p-4">
        <div class="row mb-3 align-items-center">
           
            <div class="col-md-6 d-flex gap-2 mb-3 mb-md-0">
                <a href="#" onclick="loadPageContent('admin_add_course.php'); return false;" class="btn btn-success">
                    <i class="fa-solid fa-plus me-1"></i> Add Course
                </a>
                <a href="admin_dashboard.php" class="btn btn-secondary px-3">
                    Dashboard
                </a>
            </div>

            
            <div class="col-md-6">
                <form id="course-search-form" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search Course..." value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn btn-primary px-4" type="submit">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle m-0 text-center">
                <thead>
                    <tr class="table-primary">
                        <th style="background:#0d6efd; color:white;" class="py-3">Course Code</th>
                        <th style="background:#0d6efd; color:white;" class="py-3 text-start">Course Name</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Credit</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Batch</th>
                        <th style="background:#0d6efd; color:white;" class="py-3" width="160">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td class="fw-bold"><?php echo htmlspecialchars($row['course_code']); ?></td>
                                <td class="text-start"><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['credit']); ?></td>
                                <td><?php echo htmlspecialchars($row['batch_name']); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="#" onclick="loadPageContent('admin_edit_course.php?course_id=<?php echo $row['course_id']; ?>'); return false;" class="btn btn-warning btn-sm px-2">
                                            Edit
                                        </a>
                                        <a href="#" onclick="loadPageContent('admin_delete_courses.php?course_id=<?php echo $row['course_id']; ?>'); return false;" class="btn btn-danger btn-sm px-2" onclick="return confirm('Are you sure you want to delete this course?');">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center text-danger py-4 fw-bold">
                                No Course Found
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $('#course-search-form').on('submit', function(e) {
        e.preventDefault();
        let searchVal = $(this).find('input[name="search"]').val();
        
        $('#dynamic-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');
        
        $.ajax({
            url: 'admin_manage_courses.php',
            type: 'GET',
            data: { search: searchVal },
            success: function(data) {
                
                $('#dynamic-content').html($(data).closest('.card').length ? $(data).closest('.card') : data);
            },
            error: function() {
                $('#dynamic-content').html('<div class="alert alert-danger">Error fetching data.</div>');
            }
        });
    });
</script>

<?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
</body>
</html>
<?php endif; ?>
