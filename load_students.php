<?php
include("db_connect.php");

if(isset($_GET['batch_id']))
{
    $batch_id = $_GET['batch_id'];

    $sql = mysqli_query($conn,"
        SELECT student_id, student_name
        FROM student
        WHERE batch_id='$batch_id'
        ORDER BY student_id ASC
    ");

    echo "<option value=''>Select Student</option>";

    while($row = mysqli_fetch_assoc($sql))
    {
        echo "<option value='".$row['student_id']."'>";
        echo $row['student_id']." - ".$row['student_name'];
        echo "</option>";
    }
}
?>