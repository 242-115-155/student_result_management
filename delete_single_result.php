<?php

include 'db_connect.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM result
            WHERE result_id='$id'";

    if(mysqli_query($conn, $sql))
    {
        echo "
        <script>
            alert('Result Deleted Successfully');
            window.location='delete_result.php';
        </script>
        ";
    }
    else
    {
        echo "
        <script>
            alert('Delete Failed');
            window.location='delete_result.php';
        </script>
        ";
    }
}
else
{
    header("Location: delete_result.php");
}

?>