<?php
include("db_connect.php");

header("Content-Type: application/json");

$data = array();

if(isset($_GET['batch_id']))
{
    $batch_id = $_GET['batch_id'];

    $sql = mysqli_query($conn,"
        SELECT course_code, course_name
        FROM course
        WHERE batch_id='$batch_id'
        ORDER BY course_code ASC
    ");

    while($row = mysqli_fetch_assoc($sql))
    {
        $data[] = array(
            "course_code" => $row['course_code'],
            "course_name" => $row['course_name']
        );
    }
}

echo json_encode($data);
?>