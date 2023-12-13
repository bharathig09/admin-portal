<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];
$accessKeyId = $_POST['access_key_id'];

$accessKey = $_POST["access_key"];

$ak_update_qry = mysqli_query($conn, "UPDATE number_verify_access_key SET access_key ='$accessKey', modified_by='$name' WHERE access_key_id = '$accessKeyId'") or die(mysqli_error($conn));
?>