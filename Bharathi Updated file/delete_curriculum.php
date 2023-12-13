<?php
require_once("config.php");

$curriculumId = $_GET['curriculum_id'];

// $delete_qry = mysqli_query($conn,"DELETE FROM technologies WHERE curriculum_id = '$curriculumId'") or die(mysqli_error($conn));
$curriculum_update_qry = mysqli_query($conn, "UPDATE course_curriculum SET status = '0' WHERE curriculum_id = '$curriculumId'") or die(mysqli_error($conn));

?>