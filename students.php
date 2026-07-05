<?php
include 'db_connect.php';

$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>

<h1>All Students</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Batch</th>
    </tr>

    <?php
    while($row = mysqli_fetch_assoc($result))
    {
    ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['batch_id']; ?></td>
        </tr>
    <?php
    }
    ?>

</table>

</body>
</html>