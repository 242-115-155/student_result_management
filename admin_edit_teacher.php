<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM teacher WHERE teacher_id='$id'");
$row = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update'])) {
    $teacher_name = mysqli_real_escape_string($conn, $_POST['teacher_name']);
    $designation  = mysqli_real_escape_string($conn, $_POST['designation']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $password     = mysqli_real_escape_string($conn, $_POST['password']);

    $update = mysqli_query($conn, "UPDATE teacher SET 
              teacher_name='$teacher_name', 
              designation='$designation', 
              email='$email', 
              password='$password' 
              WHERE teacher_id='$id'");

    if ($update) {
        $message = "<div class='alert alert-success'>Teacher Updated Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Update Failed!</div>";
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-warning text-dark py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Teacher
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="edit-teacher-form">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="mb-3">
                <label>Teacher Name</label>
                <input type="text" name="teacher_name" class="form-control" value="<?php echo htmlspecialchars($row['teacher_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" value="<?php echo htmlspecialchars($row['designation']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($row['password']); ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-warning px-4">Update Teacher</button>
            <button type="button" id="btn-back" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back').click(function(){
        loadPageContent('admin_manage_teachers.php');
    });

    $('#edit-teacher-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&update=1";
        
        $.ajax({
            url: 'admin_edit_teacher.php?id=<?php echo $id; ?>',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
