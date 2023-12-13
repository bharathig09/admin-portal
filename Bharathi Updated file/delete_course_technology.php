<?php
require_once("config.php");

$courseTechnologyId = $_GET['course_technology_id'];

$course_technology_update_qry = mysqli_query($conn, "UPDATE courses_technologies SET status = '0' WHERE courses_technologies_id = '$courseTechnologyId'") or die(mysqli_error($conn));

?>