<?php

// fetch_course.php

require_once("config.php");

if (isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];

    // Perform a database query to fetch course data based on $courseId
    // ...

    // Example: Fetch data from your database
    $query = "SELECT * FROM courses WHERE course_id = $courseId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $courseData = mysqli_fetch_assoc($result);
        echo json_encode($courseData);
    } else {
        echo json_encode(['error' => 'Failed to fetch course data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
