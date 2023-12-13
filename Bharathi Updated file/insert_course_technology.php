<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$course = $_POST["course"];
$technology = $_POST["technology"];


$insert_qry = mysqli_query($conn, "INSERT INTO courses_technologies (course_id, technology_id, created_date_time, created_by) VALUES('$course', '$technology', now(), '$name')") or die(mysqli_error($conn));

?>