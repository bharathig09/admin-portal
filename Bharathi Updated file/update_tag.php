<?php

session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

$tagId = $_POST['tag_id'];

$tagName = $_POST["tag_name"];

$tag_update_qry = mysqli_query($conn, "UPDATE tags SET tag_name ='$tagName', modified_by='$name' WHERE tag_id = '$tagId'") or die(mysqli_error($conn));
?>