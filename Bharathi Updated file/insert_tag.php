<?php
    session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$tag_name = $_POST["tag_name"];

$insert_tag_qry = mysqli_query($conn, "INSERT INTO tags (tag_name, created_date_time, created_by) VALUES('$tag_name', now(), '$name')") or die(mysqli_error($conn));

?>