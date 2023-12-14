<?php
session_start();

require_once("config.php");

    $id = $_SESSION['id'];
    $name = $_POST["name"];
    $property = $_POST["property"];
    $content = $_POST["content"];
    $menu = $_POST["menu_id"];
    $tag = $_POST["tag_id"];
    $course = $_POST["course_id"];
    $hid = $_POST["hid"];


    if(!empty($hid)) {
        $stmt=$conn->prepare("update meta set name='$name', property='$property', content='$content', menu_id='$menu', tag_id='$tag', course_id='$course', modified_by='$id'  where meta_id='$hid'");
        $stmt->execute();
        $stmt->close();
        echo "Data updated successfully";
    }
    else {

    $sql = mysqli_query($conn, "INSERT INTO meta (name, property, content, menu_id, tag_id, course_id, created_date_time, created_by)
                        VALUES ('$name','$property','$content', '$menu', '$tag', '$course', now(), '$id')") or die (mysqli_error($conn));

            echo "Data inserted successfully";

    }             
?>
