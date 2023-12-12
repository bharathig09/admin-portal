<?php
require_once("config.php");

$technologyId = $_GET['technology_id'];

// $delete_qry = mysqli_query($conn,"DELETE FROM technologies WHERE technology_id = '$technologyId'") or die(mysqli_error($conn));
$technology_update_qry = mysqli_query($conn, "UPDATE technologies SET status = '0' WHERE technology_id = '$technologyId'") or die(mysqli_error($conn));

?>