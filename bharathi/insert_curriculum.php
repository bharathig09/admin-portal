<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$day_no = $_POST["day_no"];
$technology_details = $_POST["technology_details"];
$technology = $_POST["technology"];
$training_time = $_POST["training_time"];
$practice_time = $_POST["practice_time"];

$insert_curriculum_qry = mysqli_query($conn, "INSERT INTO course_curriculum (day_no, technology_details, technology_id, training_time, practice_time, created_by) VALUES('$day_no', '$technology_details', '$technology', '$training_time', '$practice_time','$name')") or die(mysqli_error($conn));

?>