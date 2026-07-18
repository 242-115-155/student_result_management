<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$student_id = $_GET['student_id'];
$result = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$student_id'");
$student = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update_student'])) {
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $phone        = mysqli_real_escape_string($conn, $_POST['phone']);
    $batch_id     = mysqli_real_escape_string($conn, $_POST['batch_id']);

    $sql = "UPDATE student SET student_name='$student_name', email='$email', phone='$phone', batch_id='$batch_id' WHERE student_id='$student_id'";

    if(mysqli_query($conn, $sql)){
        $message = "<div class='alert alert-success'>Student updated successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Update Failed!</div>";
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-warning text-dark py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Student
    </div>
    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="edit-student-form">
            <div class="mb-3">
                <label>Student ID</label>
                <input type="text" class="form-control" value="<?php echo $student['student_id']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Student Name</label>
                <input type="text" name="student_name" class="form-control" value="<?php echo $student['student_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $student['phone']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Batch</label>
                <select name="batch_id" class="form-select" required>
                    <?php
                    $batch = mysqli_query($conn, "SELECT * FROM batch ORDER BY batch_name");
                    while($b = mysqli_fetch_assoc($batch)) {
                        $selected = ($student['batch_id'] == $b['batch_id']) ? "selected" : "";
                        echo "<option value='{$b['batch_id']}' $selected>{$b['batch_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="update_student" class="btn btn-success px-4">Update Student</button>
            <button type="button" id="btn-back-students" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-students').click(function(){
        loadPageContent('admin_manage_students.php');
    });

    $('#edit-student-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&update_student=1";
        
        $.ajax({
            url: 'admin_edit_student.php?student_id=<?php echo $student_id; ?>',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
