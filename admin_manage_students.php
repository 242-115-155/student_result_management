<?php

include("db_connect.php");

$search = "";

$sql = "
SELECT
student.student_id,
student.student_name,
student.email,
student.phone,
batch.batch_name
FROM student
LEFT JOIN batch
ON student.batch_id=batch.batch_id
";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql .= " WHERE
    student.student_id LIKE '%$search%'
    OR student.student_name LIKE '%$search%'
    OR student.email LIKE '%$search%'
    ";
}

$sql .= " ORDER BY student.batch_id ASC, student.student_id ASC";

$result = mysqli_query($conn, $sql);
?>


<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-primary text-white py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-users me-2"></i> Manage Students
    </div>

    <div class="card-body p-4">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6 d-flex gap-2 mb-3 mb-md-0">
                <a href="admin_add_student.php" class="btn btn-success px-3 rounded-2">
                    <i class="fa-solid fa-plus me-1"></i> Add Student
                </a>
                
                <a href="admin_dashboard.php" class="btn btn-secondary px-3 rounded-2">
                    <i class="fa-solid fa-house me-1"></i> Dashboard
                </a>
            </div>

            <div class="col-md-6">
                
                <form id="student-search-form" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by ID / Name / Email" value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn btn-primary px-4">
                            <i class="fa-solid fa-magnifying-glass"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle small m-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="py-3 text-center">Student ID</th>
                        <th class="py-3 text-center">Student Name</th>
                        <th class="py-3 text-center">Email</th>
                        <th class="py-3 text-center">Phone</th>
                        <th class="py-3 text-center">Batch</th>
                        <th class="py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td class="text-center fw-semibold"><?php echo htmlspecialchars($row['student_id']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td class="text-center"><span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1"><?php echo htmlspecialchars($row['batch_name']); ?></span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="admin_edit_student.php?student_id=<?php echo urlencode($row['student_id']); ?>" class="btn btn-warning btn-sm text-dark px-2">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>
                                        <a href="admin_delete_student.php?student_id=<?php echo urlencode($row['student_id']); ?>" class="btn btn-danger btn-sm px-2" onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center text-danger py-4 fw-medium">
                                <i class="fa-solid fa-circle-exclamation me-1"></i> No Student Found
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
    $('#student-search-form').on('submit', function(e) {
        e.preventDefault();
        let searchVal = $(this).find('input[name="search"]').val();
        
        $('#dynamic-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        
        $.ajax({
            url: 'admin_manage_students.php',
            type: 'GET',
            data: { search: searchVal },
            success: function(data) {
                $('#dynamic-content').html(data);
            },
            error: function() {
                $('#dynamic-content').html('<div class="alert alert-danger">Error fetching search results.</div>');
            }
        });
    });
</script>
