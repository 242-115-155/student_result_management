<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if (isset($_POST['save'])) {
    $batch_id   = mysqli_real_escape_string($conn, $_POST['batch_id']);
    $batch_name = mysqli_real_escape_string($conn, $_POST['batch_name']);

    $check = mysqli_query($conn, "SELECT * FROM batch WHERE batch_id='$batch_id' OR batch_name='$batch_name'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Batch already exists!</div>";
    } else {
        mysqli_query($conn, "INSERT INTO batch(batch_id, batch_name) VALUES('$batch_id', '$batch_name')");
        $message = "<div class='alert alert-success'>Batch Added Successfully!</div>";
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-success text-white py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-plus me-2"></i> Add New Batch
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="add-batch-form">
            <div class="mb-3">
                <label class="form-label">Batch ID</label>
                <input type="number" name="batch_id" class="form-control" placeholder="Example: 65" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Batch Name</label>
                <input type="text" name="batch_name" class="form-control" placeholder="Example: CSE-65" required>
            </div>
            <button type="submit" name="save" class="btn btn-success px-4">Save Batch</button>
            <button type="button" id="btn-back-batches" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-batches').click(function(){
        loadPageContent('admin_manage_batches.php');
    });

    $('#add-batch-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&save=1";
        
        $.ajax({
            url: 'admin_add_batch.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
