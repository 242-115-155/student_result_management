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

    $query = mysqli_query($conn,"
        SELECT *
        FROM batch
        WHERE batch_name LIKE '%$search%'
        ORDER BY batch_id ASC
    ");
} else {
    $query = mysqli_query($conn,"
        SELECT *
        FROM batch
        ORDER BY batch_id ASC
    ");
}


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])): 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Batches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; padding: 20px; }
    </style>
</head>
<body>
<?php endif; ?>


<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-primary text-white py-3 fs-5 fw-bold">
        Manage Batches
    </div>

    <div class="card-body p-4">
        <div class="row mb-3 align-items-center">
            
            <div class="col-md-6 d-flex gap-2 mb-3 mb-md-0">
                <a href="#" onclick="loadPageContent('admin_add_batch.php'); return false;" class="btn btn-success">
                    <i class="fa-solid fa-plus me-1"></i> Add Batch
                </a>
                <a href="admin_dashboard.php" class="btn btn-dark px-3">
                    Dashboard
                </a>
            </div>

            
            <div class="col-md-6">
                <form id="batch-search-form" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search Batch..." value="<?php echo htmlspecialchars($search); ?>">
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
                        <th style="background:#0d6efd; color:white;" class="py-3">Batch ID</th>
                        <th style="background:#0d6efd; color:white;" class="py-3">Batch Name</th>
                        <th style="background:#0d6efd; color:white;" class="py-3" width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['batch_id']); ?></td>
                                <td class="fw-bold"><?php echo htmlspecialchars($row['batch_name']); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="#" onclick="loadPageContent('admin_edit_batch.php?id=<?php echo $row['batch_id']; ?>'); return false;" class="btn btn-warning btn-sm px-2">
                                            Edit
                                        </a>
                                        <a href="#" onclick="loadPageContent('admin_delete_batch.php?id=<?php echo $row['batch_id']; ?>'); return false;" class="btn btn-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this batch?');">
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
                            <td colspan="3" class="text-center text-danger py-4 fw-bold">
                                No Batch Found
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
    $('#batch-search-form').on('submit', function(e) {
        e.preventDefault();
        let searchVal = $(this).find('input[name="search"]').val();
        
        $('#dynamic-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');
        
        $.ajax({
            url: 'admin_manage_batches.php',
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
