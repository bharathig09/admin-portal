<?php
require_once("config.php");

$courseId = $_GET['course_id'];

// $delete_qry = mysqli_query($conn,"DELETE FROM courses WHERE course_id = '$courseId'") or die(mysqli_error($conn));
$qry = mysqli_query($conn, "UPDATE courses SET status='0' WHERE course_id = $courseId") or die(mysqli_error($conn));


?>