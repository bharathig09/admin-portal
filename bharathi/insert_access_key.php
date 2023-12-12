<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];
$access_key = $_POST["access_key"];

$insert_access_key_qry = mysqli_query($conn, "INSERT INTO number_verify_access_key (access_key, created_by) VALUES('$access_key', '$name')") or die(mysqli_error($conn));

?>