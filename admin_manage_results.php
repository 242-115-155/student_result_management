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

$sql = "
SELECT
r.result_id,
r.student_id,
s.student_name,
b.batch_name,
r.course_code,
r.course_name,
r.semester_id,
r.marks,
r.grade,
r.grade_point
FROM result r
LEFT JOIN student s
ON r.student_id = s.student_id
LEFT JOIN batch b
ON s.batch_id = b.batch_id
WHERE 1
";

if(isset($_GET['search']) && $_GET['search']!="")
{
    $search = mysqli_real_escape_string($conn,$_GET['search']);

    $sql .= "
    AND
    (
        r.student_id LIKE '%$search%'
        OR
        s.student_name LIKE '%$search%'
        OR
        r.course_code LIKE '%$search%'
        OR
        r.course_name LIKE '%$search%'
    )
    ";
}

$sql .= "
ORDER BY
b.batch_id,
s.student_id,
r.course_code
";

$query = mysqli_query($conn,$sql);


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])): 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; padding: 20px; }
    </style>
</head>
<body>
<?php endif; ?>


<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-primary text-white py-3 fs-5 fw-bold">
        Manage Results
    </div>

    <div class="card-body p-4">
        <div class="row mb-3 align-items-center">
            
            <div class="col-md-4 d-flex gap-2 mb-3 mb-md-0">
                <a href="#" onclick="loadPageContent('admin_add_result.php'); return false;" class="btn btn-success">
                    <i class="fa-solid fa-plus me-1"></i> Add Result
                </a>
                <a href="admin_dashboard.php" class="btn btn-secondary px-3">
                    Dashboard
                </a>
            </div>

            <div class="col-md-4"></div>

            
            <div class="col-md-4">
                <form id="result-search-form" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search Student ID / Name..." value="<?php echo htmlspecialchars($search); ?>">
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
                        <th style="background:#0d6efd; color:white;" class="py-3">Student ID</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Name</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Batch</th>
                        <th style="background:#0d6efd; color:white;" class="py-3 text-start">Course</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Semester</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Marks</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Grade</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Point</th>
                        <th style="background:#0d6efd; color:white;" class="py-3" width="140">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                <td class="text-start fw-semibold"><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['batch_name']); ?></td>
                                <td class="text-start">
                                    <span class="badge bg-secondary mb-1"><?php echo htmlspecialchars($row['course_code']); ?></span><br>
                                    <small class="text-muted"><?php echo htmlspecialchars($row['course_name']); ?></small>
                                </td>
                                <td><?php echo htmlspecialchars($row['semester_id']); ?></td>
                                <td class="fw-bold"><?php echo htmlspecialchars($row['marks']); ?></td>
                                <td><span class="badge bg-success fs-6"><?php echo htmlspecialchars($row['grade']); ?></span></td>
                                <td class="fw-semibold text-primary"><?php echo htmlspecialchars($row['grade_point']); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="#" onclick="loadPageContent('admin_edit_result.php?id=<?php echo $row['result_id']; ?>'); return false;" class="btn btn-warning btn-sm px-2">
                                            Edit
                                        </a>
                                        <a href="#" onclick="loadPageContent('admin_delete_result.php?id=<?php echo $row['result_id']; ?>'); return false;" class="btn btn-danger btn-sm px-2">
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
                            <td colspan="9" class="text-center text-danger py-4 fw-bold">
                                No Result Found
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
    $('#result-search-form').on('submit', function(e) {
        e.preventDefault();
        let searchVal = $(this).find('input[name="search"]').val();
        
        $('#dynamic-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');
        
        $.ajax({
            url: 'admin_manage_results.php',
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
