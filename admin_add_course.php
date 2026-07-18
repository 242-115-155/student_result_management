<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if (isset($_POST['add_course'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $credit      = mysqli_real_escape_string($conn, $_POST['credit']);
    $batch_id    = mysqli_real_escape_string($conn, $_POST['batch_id']);

    $check = mysqli_query($conn, "SELECT * FROM course WHERE course_code='$course_code'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Course Code Already Exists.</div>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO course(course_code, course_name, credit, batch_id) 
                  VALUES('$course_code', '$course_name', '$credit', '$batch_id')");

        if ($insert) {
            $message = "<div class='alert alert-success'>Course Added Successfully.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Failed to Add Course.</div>";
        }
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-success text-white py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-book-medical me-2"></i> Add New Course
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="add-course-form">
            <div class="mb-3">
                <label>Course Code</label>
                <input type="text" name="course_code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Course Name</label>
                <input type="text" name="course_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Credit</label>
                <input type="number" step="0.5" name="credit" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Batch</label>
                <select name="batch_id" class="form-select" required>
                    <option value="">Select Batch</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM batch ORDER BY batch_name");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['batch_id']}'>{$row['batch_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" name="add_course" class="btn btn-success px-4">Add Course</button>
            <button type="button" id="btn-back-courses" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-courses').click(function(){
        loadPageContent('admin_manage_courses.php');
    });

    $('#add-course-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&add_course=1";
        
        $.ajax({
            url: 'admin_add_course.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
