<?php

// fetch_course.php

require_once("config.php");

if (isset($_GET['curriculum_id'])) {
    $curriculumId = $_GET['curriculum_id'];

    // Perform a database query to fetch course data based on $curriculumId
    // ...

    // Example: Fetch data from your database
    $query = "SELECT * FROM course_curriculum WHERE curriculum_id = $curriculumId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $curriculumData = mysqli_fetch_assoc($result);
        echo json_encode($curriculumData);
    } else {
        echo json_encode(['error' => 'Failed to fetch course data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>