<?php

include 'db_connect.php';

if(isset($_POST['result_id']))
{
    $result_id = $_POST['result_id'];
    $marks = $_POST['marks'];

    if($marks >= 80)
    {
        $grade="A+";
        $grade_point=4.00;
    }
    elseif($marks >= 75)
    {
        $grade="A";
        $grade_point=3.75;
    }
    elseif($marks >= 70)
    {
        $grade="A-";
        $grade_point=3.50;
    }
    elseif($marks >= 65)
    {
        $grade="B+";
        $grade_point=3.25;
    }
    elseif($marks >= 60)
    {
        $grade="B";
        $grade_point=3.00;
    }
    elseif($marks >= 55)
    {
        $grade="B-";
        $grade_point=2.75;
    }
    elseif($marks >= 50)
    {
        $grade="C+";
        $grade_point=2.50;
    }
    elseif($marks >= 45)
    {
        $grade="C";
        $grade_point=2.25;
    }
    elseif($marks >= 40)
    {
        $grade="D";
        $grade_point=2.00;
    }
    else
    {
        $grade="F";
        $grade_point=0.00;
    }

    $sql = "UPDATE result
            SET marks='$marks',
                grade='$grade',
                grade_point='$grade_point'
            WHERE result_id='$result_id'";

    if(mysqli_query($conn,$sql))
    {
        echo "
        <script>
        alert('Result Updated Successfully');
        window.location='edit_result.php';
        </script>
        ";
    }
    else
    {
        echo "Update Failed";
    }
}
?>