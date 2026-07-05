<?php
include("db_connect.php");

$search = "";
$sql = "SELECT * FROM teacher";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql .= " WHERE teacher_id LIKE '%$search%' 
              OR teacher_name LIKE '%$search%' 
              OR designation LIKE '%$search%' 
              OR email LIKE '%$search%'";
}

$sql .= " ORDER BY teacher_id ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white py-3 fs-5 fw-bold">
        Manage Teachers
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="add_teacher.php" class="btn btn-success">
                    + Add Teacher
                </a>
                <a href="admin_dashboard.php" class="btn btn-secondary">
                    Dashboard
                </a>
            </div>

            <div class="col-md-6">
                <form id="teacher-search-form" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by ID / Name / Designation" value="<?php echo $search; ?>">
                        <button class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-hover text-center align-middle">
            <thead>
                <tr class="table-primary text-white">
                    <th style="background:#0d6efd; color:white;">ID</th>
                    <th style="background:#0d6efd; color:white;">Name</th>
                    <th style="background:#0d6efd; color:white;">Designation</th>
                    <th style="background:#0d6efd; color:white;">Email</th>
                    <th style="background:#0d6efd; color:white;">Password</th>
                    <th style="background:#0d6efd; color:white;" width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['teacher_id']; ?></td>
                            <td><?php echo $row['teacher_name']; ?></td>
                            <td><?php echo $row['designation']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td>
                                <a href="edit_teacher.php?id=<?php echo $row['teacher_id']; ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <a href="delete_teacher.php?id=<?php echo $row['teacher_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this teacher?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center text-danger fw-bold">
                            No Teacher Found
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#teacher-search-form').on('submit', function(e) {
        e.preventDefault();
        let searchVal = $(this).find('input[name="search"]').val();
        
        $('#dynamic-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');
        
        $.ajax({
            url: 'admin_manage_teachers.php',
            type: 'GET',
            data: { search: searchVal },
            success: function(data) {
                $('#dynamic-content').html(data);
            },
            error: function() {
                $('#dynamic-content').html('<div class="alert alert-danger">Error fetching data.</div>');
            }
        });
    });
</script>