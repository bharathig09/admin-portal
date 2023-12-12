<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$curriculumId = $_POST['curriculum_id'];

$day_no = $_POST["day_no"];
$technology_details = $_POST["technology_details"];
$technology = $_POST["technology"];
$training_time = $_POST["training_time"];
$practice_time = $_POST["practice_time"];

$technology_update_qry = mysqli_query($conn, "UPDATE course_curriculum SET day_no ='$day_no', technology_details='$technology_details', technology_id='$technology', training_time='$training_time', practice_time='$practice_time', modified_by='$name' WHERE curriculum_id = '$curriculumId'") or die(mysqli_error($conn));
?>