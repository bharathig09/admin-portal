<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];
$technology_name = $_POST["technology_name"];

$insert_technology_qry = mysqli_query($conn, "INSERT INTO technologies (technology_name, created_date_time, created_by) VALUES('$technology_name', now(), '$name')") or die(mysqli_error($conn));

?>