<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM batch WHERE batch_id='$id'");
$row = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update'])) {
    $new_batch_id = mysqli_real_escape_string($conn, $_POST['batch_id']);
    $batch_name   = mysqli_real_escape_string($conn, $_POST['batch_name']);

    $check = mysqli_query($conn, "SELECT * FROM batch WHERE batch_id='$new_batch_id' AND batch_id<>'$id'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Batch ID already exists!</div>";
    } else {
        mysqli_query($conn, "UPDATE batch SET batch_id='$new_batch_id', batch_name='$batch_name' WHERE batch_id='$id'");
        $message = "<div class='alert alert-success'>Batch Updated Successfully!</div>";
        // আপডেট হওয়ার পর নতুন আইডি দিয়ে ডাটা রিফ্রেশ করা
        $id = $new_batch_id;
        $row['batch_id'] = $new_batch_id;
        $row['batch_name'] = $batch_name;
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-warning text-dark py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Batch
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="edit-batch-form">
            <div class="mb-3">
                <label class="form-label">Batch ID</label>
                <input type="number" name="batch_id" class="form-control" value="<?php echo $row['batch_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Batch Name</label>
                <input type="text" name="batch_name" class="form-control" value="<?php echo $row['batch_name']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-success px-4">Update Batch</button>
            <button type="button" id="btn-back-batches" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-batches').click(function(){
        loadPageContent('admin_manage_batches.php');
    });

    $('#edit-batch-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&update=1";
        
        $.ajax({
            url: 'admin_edit_batch.php?id=<?php echo $id; ?>',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
