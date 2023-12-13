<?php
session_start();
require_once("config.php");

    $name = $_SESSION['admin_name'];
    $social_url = $_POST["social_tags_url"];
    $social_type = $_POST["social_tags_type"];
    $Iid = $_POST["instructor_id"];
    $hid = $_POST["hid"];


    if(!empty($hid)) {
        $stmt=$conn->prepare("update instructor_social_tags set instructor_id='$Iid', instructor_social_tags_url='$social_url', instructor_social_tags_type='$social_type', modified_by='$name' where instructor_social_tags_id='$hid'");
        $stmt->execute();
        $stmt->close();
        echo "Data updated successfully";
    }
    else {

    $sql = mysqli_query($conn, "INSERT INTO instructor_social_tags (instructor_social_tags_url, instructor_social_tags_type, instructor_id, created_date_time, created_by) VALUES ('$social_url','$social_type','$Iid', now(), '$name')") or die (mysqli_error($conn));
    echo "Data inserted successfully";

    }             
?>
