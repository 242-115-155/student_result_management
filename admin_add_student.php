<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if (isset($_POST['add_student'])) {
    $student_id   = mysqli_real_escape_string($conn, $_POST['student_id']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $phone        = mysqli_real_escape_string($conn, $_POST['phone']);
    $batch_id     = mysqli_real_escape_string($conn, $_POST['batch_id']);

    $check = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$student_id'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Student ID already exists!</div>";
    } else {
        $sql = "INSERT INTO student (student_id, student_name, email, phone, batch_id) 
                VALUES ('$student_id', '$student_name', '$email', '$phone', '$batch_id')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success'>Student Added Successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}

$batch_res = mysqli_query($conn, "SELECT * FROM batch");
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-success text-white py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-user-plus me-2"></i> Add New Student
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        
        <form id="add-student-form">
            <div class="mb-3">
                <label>Student ID</label>
                <input type="text" name="student_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Student Name</label>
                <input type="text" name="student_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Batch</label>
                <select name="batch_id" class="form-control" required>
                    <option value="">Select Batch</option>
                    <?php while($row = mysqli_fetch_assoc($batch_res)) { ?>
                        <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <button type="submit" name="add_student" class="btn btn-success px-4">Add Student</button>
            <button type="button" id="btn-back-students" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-students').click(function(){
        loadPageContent('admin_manage_students.php');
    });

    $('#add-student-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&add_student=1";
        
        $.ajax({
            url: 'admin_add_student.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
