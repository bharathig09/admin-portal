<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$technologyId = $_POST['technology_id'];

    $technologyName = $_POST["technology_name"];

    $technology_update_qry = mysqli_query($conn, "UPDATE technologies SET technology_name ='$technologyName', modified_by='$name' WHERE technology_id = '$technologyId'") or die(mysqli_error($conn));
?>