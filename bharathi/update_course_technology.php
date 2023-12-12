<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$courseTechnologyId = $_POST['course_technology_id'];

$course = $_POST["course"];
$technology = $_POST["technology"];

$course_technology_update_qry = mysqli_query($conn, "UPDATE courses_technologies SET course_id='$course', technology_id='$technology', modified_by='$name' WHERE courses_technologies_id = '$courseTechnologyId'") or die(mysqli_error($conn));
?>