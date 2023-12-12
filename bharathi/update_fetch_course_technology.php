<?php

// fetch_course.php

require_once("config.php");

if (isset($_GET['course_technology_id'])) {
    $courseTechnologyId = $_GET['course_technology_id'];

    // Perform a database query to fetch course data based on $courseTechnologyId
    // ...

    // Example: Fetch data from your database
    $query = "SELECT * FROM courses_technologies WHERE courses_technologies_id = $courseTechnologyId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $courseTechnologyData = mysqli_fetch_assoc($result);
        echo json_encode($courseTechnologyData);
    } else {
        echo json_encode(['error' => 'Failed to fetch course data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>