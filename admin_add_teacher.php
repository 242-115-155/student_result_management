<?php
session_start();
include("db_connect.php");

$message = "";

if (isset($_POST['add_teacher'])) {
    $teacher_name = mysqli_real_escape_string($conn, $_POST['teacher_name']);
    $designation  = mysqli_real_escape_string($conn, $_POST['designation']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $password     = mysqli_real_escape_string($conn, $_POST['password']);

    $check = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Email already exists!</div>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO teacher(teacher_name, designation, email, password) 
                                       VALUES('$teacher_name', '$designation', '$email', '$password')");

        if ($insert) {
            $message = "<div class='alert alert-success'>Teacher Added Successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to Add Teacher: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-success text-white py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-user-plus me-2"></i> Add New Teacher
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>

        <form id="add-teacher-form">
            <div class="mb-3">
                <label>Teacher Name</label>
                <input type="text" name="teacher_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required>
            </div>
            
            <button type="submit" name="add_teacher" class="btn btn-success px-4">Save Teacher</button>
            <button type="button" id="btn-back-teachers" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-teachers').click(function(){
        loadPageContent('admin_manage_teachers.php');
    });

    $('#add-teacher-form').on('submit', function(e){
        e.preventDefault(); 
        
        var formData = $(this).serialize() + "&add_teacher=1"; 

        $.ajax({
            url: 'admin_add_teacher.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data); 
            },
            error: function() {
                alert("Error occurred!");
            }
        });
    });
</script>
