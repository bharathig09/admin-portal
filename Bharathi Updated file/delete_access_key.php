<?php
require_once("config.php");

$accessKeyId = $_GET['access_key_id'];

$ak_update_qry = mysqli_query($conn, "UPDATE number_verify_access_key SET status = '0' WHERE access_key_id = '$accessKeyId'") or die(mysqli_error($conn));

?>