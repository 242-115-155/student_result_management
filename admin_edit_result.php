<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM result WHERE result_id='$id'");
$row = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['update'])) {
    $marks = mysqli_real_escape_string($conn, $_POST['marks']);
    $semester_id = mysqli_real_escape_string($conn, $_POST['semester_id']);

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

    $update = mysqli_query($conn, "UPDATE result SET semester_id='$semester_id', marks='$marks', grade='$grade', grade_point='$point' WHERE result_id='$id'");

    if($update) {
        $message = "<div class='alert alert-success'>Result Updated Successfully!</div>";
        // আপডেট হওয়ার পর লেটেস্ট ডাটা রিলোড করা
        $row['semester_id'] = $semester_id;
        $row['marks'] = $marks;
        $row['grade'] = $grade;
        $row['grade_point'] = $point;
    } else {
        $message = "<div class='alert alert-danger'>Failed to update.</div>";
    }
}
?>

<div class="card border-0 shadow-sm bg-white rounded-3">
    <div class="card-header bg-warning text-dark py-3 fs-5 fw-bold d-flex align-items-center">
        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Result
    </div>

    <div class="card-body p-4">
        <?php echo $message; ?>
        <form id="edit-result-form">
            <div class="mb-3">
                <label>Student ID</label>
                <input type="text" class="form-control" value="<?php echo $row['student_id'];?>" readonly>
            </div>
            <div class="mb-3">
                <label>Course Code</label>
                <input type="text" class="form-control" value="<?php echo $row['course_code'];?>" readonly>
            </div>
            <div class="mb-3">
                <label>Semester ID</label>
                <input type="number" name="semester_id" class="form-control" value="<?php echo $row['semester_id'];?>" required>
            </div>
            <div class="mb-3">
                <label>Marks</label>
                <input type="number" name="marks" class="form-control" min="0" max="100" value="<?php echo $row['marks'];?>" required>
            </div>
            <div class="mb-3">
                <label>Grade</label>
                <input type="text" class="form-control" value="<?php echo $row['grade'];?>" readonly>
            </div>
            <div class="mb-3">
                <label>Grade Point</label>
                <input type="text" class="form-control" value="<?php echo $row['grade_point'];?>" readonly>
            </div>
            
            <button type="submit" name="update" class="btn btn-success px-4">Update Result</button>
            <button type="button" id="btn-back-results" class="btn btn-secondary px-4">Back</button>
        </form>
    </div>
</div>

<script>
    $('#btn-back-results').click(function(){
        loadPageContent('admin_manage_results.php');
    });

    $('#edit-result-form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize() + "&update=1";
        
        $.ajax({
            url: 'admin_edit_result.php?id=<?php echo $id; ?>',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#dynamic-content').html(data);
            }
        });
    });
</script>
