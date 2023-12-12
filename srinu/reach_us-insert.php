<?php
session_start();
require_once("config.php");

    $id = $_SESSION['id'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $header = $_POST["email_header"];
    $hid = $_POST["hid"];


    if(!empty($hid)) {
        $stmt=$conn->prepare("update reach_us set contact_name='$name', contact_email='$email', contact_subject='$subject', contact_message='$message', email_headers='$header', modified_by='$id' where contact_id='$hid'");
        $stmt->execute();
        $stmt->close();
        echo "Data updated successfully";
    }
    else {

    $sql = mysqli_query($conn, "INSERT INTO reach_us (contact_name, contact_email, contact_subject, contact_message, email_headers, created_date_time, created_by)
                        VALUES ('$name','$email','$subject', '$message', '$header',now(), '$id')") or die (mysqli_error($conn));
        echo "Data inserted successfully";

    }             
?>
