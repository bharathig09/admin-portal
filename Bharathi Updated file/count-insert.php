<?php
session_start();

require_once("config.php");

    $admin_name = $_SESSION['admin_name'];
    $finished = $_POST["finished"];
    $online = $_POST["online"];
    $subjects = $_POST["subjects"];
    $satisfaction = $_POST["satisfaction"];
    $hid = $_POST["hid"];


    if(!empty($hid)) {
        $stmt=$conn->prepare("update counts set finished_sessions='$finished', subjects_taught='$subjects', satisfaction_rate='$satisfaction', online_enrollment='$online', modified_by='$admin_name' where count_id='$hid'");
        $stmt->execute();
        $stmt->close();
        echo "Data updated successfully";
    }
    else {

    $sql = mysqli_query($conn, "INSERT INTO counts (finished_sessions, online_enrollment, subjects_taught, satisfaction_rate, created_date_time, created_by)
                        VALUES ('$finished','$online','$subjects', '$satisfaction', now(), '$admin_name')") or die (mysqli_error($conn));

            echo "Data inserted successfully";

    }             
?>
