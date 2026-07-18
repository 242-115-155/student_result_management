<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if (isset($_POST['save'])) {
    $student_id   = mysqli_real_escape_string($conn, $_POST['student_id']);
    $course_code  = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course_name  = mysqli_real_escape_string($conn, $_POST['course_name']);
    $semester_id  = mysqli_real_escape_string($conn, $_POST['semester_id']);
    $marks        = mysqli_real_escape_string($conn, $_POST['marks']);

    // Grade Calculation
    if($marks >= 80) { $grade = "A+"; $point = 4.00; }
    elseif($marks >= 75) { $grade = "A"; $point = 3.75; }
    elseif($marks >= 70) { $grade = "A-"; $point = 3.50; }
    elseif($marks >= 65) { $grade = "B+"; $point = 3.25; }
    elseif($marks >= 60) { $grade = "B"; $point = 3.00; }
    elseif($marks >= 55) { $grade = "B-"; $point = 2.75; }
    elseif($marks >= 50) { $grade = "C+"; $point = 2.50; }
    elseif($marks >= 45) { $grade = "C"; $point = 2.25; }
    elseif($marks >= 40) { $grade = "D"; $point = 2.00; }
    else { $grade = "F"; $point = 0.00; }

    $insert = mysqli_query($conn, "INSERT INTO result (student_id, course_code, course_name, semester_id, marks, grade, grade_point) 
              VALUES ('$student_id', '$course_code', '$course_name', '$semester_id', '$marks', '$grade', '$point')");

    if($insert) {
        $message = "<div class='alert alert-success'>Result Added Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Failed to Add Result.</div>";
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-primary text-white py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-plus me-2"></i> Add Student Result
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="add-result-form">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Batch</label>
                    <select id="batch" class="form-select" required>
                        <option value="">Select Batch</option>
                        <?php
                        $batches = mysqli_query($conn, "SELECT * FROM batch ORDER BY batch_id ASC");
                        while($batch = mysqli_fetch_assoc($batches)) {
                            echo "<option value='{$batch['batch_id']}'>{$batch['batch_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Student</label>
                    <select name="student_id" id="student" class="form-select" required>
                        <option value="">Select Batch First</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course Code</label>
                    <select name="course_code" id="course" class="form-select" required>
                        <option value="">Select Batch First</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course Name</label>
                    <input type="text" name="course_name" id="course_name" class="form-control" readonly required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Semester ID</label>
                    <input type="number" name="semester_id" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Marks</label>
                    <input type="number" name="marks" class="form-control" min="0" max="100" required>
                </div>
            </div>
            <button type="submit" name="save" class="btn btn-success px-4">Save Result</button>
            <button type="button" id="btn-back-results" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    // Load dynamic data (Students & Courses)
    $('#batch').change(function(){
        let batch = $(this).val();
        $('#student').load('load_students.php?batch_id=' + batch);
        
        $.getJSON('load_courses.php?batch_id=' + batch, function(data) {
            let courseSelect = $('#course');
            courseSelect.html("<option value=''>Select Course</option>");
            $.each(data, function(i, item) {
                courseSelect.append("<option value='" + item.course_code + "' data-name='" + item.course_name + "'>" + item.course_code + "</option>");
            });
        });
    });

    $('#course').change(function(){
        $('#course_name').val($(this).find(':selected').data('name'));
    });

    $('#btn-back-results').click(function(){
        loadPageContent('admin_manage_results.php');
    });

    $('#add-result-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&save=1";
        $.ajax({
            url: 'admin_add_result.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
