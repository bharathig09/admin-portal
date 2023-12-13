<?php
require_once("config.php");

$tagId = $_GET['tag_id'];

$tag_update_qry = mysqli_query($conn, "UPDATE tags SET status = '0' WHERE tag_id = '$tagId'") or die(mysqli_error($conn));

?>