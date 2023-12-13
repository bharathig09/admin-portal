<?php
session_start(); 
require_once("config.php");
$name = $_SESSION["admin_name"];

    $targetDir = "http://localhost/admin_template/images/"; 
    $targetFile = $targetDir . basename($_FILES["course_image"]["name"]);
    move_uploaded_file($_FILES["course_image"]["tmp_name"], $targetFile);
    $course_share_image = $targetDir . basename($_FILES["course_share_image"]["name"]);
    move_uploaded_file($_FILES["course_share_image"]["tmp_name"], $course_share_image);
    $course_banner_image = $targetDir . basename($_FILES["course_banner_image"]["name"]);
    move_uploaded_file($_FILES["course_banner_image"]["tmp_name"], $course_banner_image);

    $courseId = $_POST['course_id'];

    $courseName = $_POST["course_name"];
    $courseDescription = $_POST["course_des"];
    $imageURL = $targetFile; 
    $shareImage = $course_share_image;
    $bannerImage = $course_banner_image;
    // $courseShareDescription = $_POST["course_share_description"];
    $relatedCourses = isset($_POST["related_course"]) ? implode(",", $_POST["related_course"]) : "";
    $instructor = $_POST["instructor"];
    $iframe_url = $_POST["iframe_url"];
    $lessons = $_POST["lessons"];
    $students = $_POST["students"];


    // $qry = mysqli_query($conn, "INSERT INTO courses (course_name, course_description, course_image, course_share_image, course_banner_image, course_share_desc, related_courses) VALUES ('$courseName', '$courseDescription', '$imageURL','$shareImage', '$bannerImage', '$courseShareDescription', '$relatedCourses')") or die(mysqli_error($conn));
    $qry = mysqli_query($conn, "UPDATE courses SET course_name = '$courseName', course_description = '$courseDescription', course_image='$imageURL', course_share_image='$shareImage',course_banner_image='$bannerImage', course_share_desc = '$courseDescription', related_courses='$relatedCourses', instructor_id='$instructor', iframe_url='$iframe_url', lessons='$lessons', students='$students', modified_by='$name' WHERE course_id = $courseId") or die(mysqli_error($conn));
?>