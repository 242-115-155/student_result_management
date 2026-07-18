<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$course_id = $_GET['course_id'];
$result = mysqli_query($conn, "SELECT * FROM course WHERE course_id='$course_id'");
$course = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update_course'])) {
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $credit      = mysqli_real_escape_string($conn, $_POST['credit']);
    $batch_id    = mysqli_real_escape_string($conn, $_POST['batch_id']);

    $update = mysqli_query($conn, "UPDATE course SET 
              course_code='$course_code', 
              course_name='$course_name', 
              credit='$credit', 
              batch_id='$batch_id' 
              WHERE course_id='$course_id'");

    if($update) {
        $message = "<div class='alert alert-success'>Course Updated Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Update Failed!</div>";
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-warning text-dark py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Course
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="edit-course-form">
            <div class="mb-3">
                <label>Course Code</label>
                <input type="text" name="course_code" class="form-control" value="<?php echo $course['course_code']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Course Name</label>
                <input type="text" name="course_name" class="form-control" value="<?php echo $course['course_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Credit</label>
                <input type="number" step="0.5" name="credit" class="form-control" value="<?php echo $course['credit']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Batch</label>
                <select name="batch_id" class="form-select" required>
                    <?php
                    $batch = mysqli_query($conn, "SELECT * FROM batch ORDER BY batch_name");
                    while($b = mysqli_fetch_assoc($batch)) {
                        $selected = ($course['batch_id'] == $b['batch_id']) ? "selected" : "";
                        echo "<option value='{$b['batch_id']}' $selected>{$b['batch_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="update_course" class="btn btn-success px-4">Update Course</button>
            <button type="button" id="btn-back-courses" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-courses').click(function(){
        loadPageContent('admin_manage_courses.php');
    });

    $('#edit-course-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&update_course=1";
        
        $.ajax({
            url: 'admin_edit_course.php?course_id=<?php echo $course_id; ?>',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
