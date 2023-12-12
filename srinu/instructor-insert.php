<?php
session_start();
require_once("config.php");

    $id = $_SESSION['id'];
    $instructor_name = $_POST["instructor_name"];
    $about_instructor = $_POST["about_instructor"];
    $instructor_designation = $_POST["instructor_designation"];
    $Iid = $_POST["Iid"];


    $image_name = $_FILES['instructor_profile_image']['name'];
    $image_tmp = $_FILES['instructor_profile_image']['tmp_name'];
    $image_size = $_FILES['instructor_profile_image']['size'];
    $image_type = $_FILES['instructor_profile_image']['type'];

    if ($instructor_name != "") {
        $upload_directory = 'C:\xampp\htdocs\Admin\images';

        $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $extensions_arr)) {

            if (move_uploaded_file($image_tmp, $upload_directory . '/' . $image_name)) {

                if(!empty($Iid)) {
                    $stmt=$conn->prepare("update instructors set instructor_name='$instructor_name', about_instructor='$about_instructor', instructor_designation='$instructor_designation', instructor_profile_image='$image_name', modified_by='$id' where instructor_id='$Iid'");
                    $stmt->execute();
                    $stmt->close();
                    echo "Data update successfully";

                }
                else {

                $sql = "INSERT INTO instructors (instructor_name, about_instructor, instructor_designation, instructor_profile_image, created_date_time, created_by)
                        VALUES ('$instructor_name','$about_instructor','$instructor_designation', '$image_name', now(), '$id')";

                    $stmt = $conn->prepare($sql);

                    if ($stmt->execute()) {
                        echo 'Data inserted successfully';
                    } else {
                        echo 'insert error';
                    }
                }
                
            } else {
            echo 'Error in uploading file - ' . $image_name . '<br/>';
            }
            } else {
            echo 'Invalid file extension. Please upload a file with jpg, jpeg, png, or gif extension.';
            }
            }
            
            ?>
