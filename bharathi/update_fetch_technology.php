<?php

// fetch_course.php

require_once("config.php");

if (isset($_GET['technology_id'])) {
    $technologyId = $_GET['technology_id'];

    // Perform a database query to fetch course data based on $technologyId
    // ...

    // Example: Fetch data from your database
    $query = "SELECT * FROM technologies WHERE technology_id = $technologyId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $technologyData = mysqli_fetch_assoc($result);
        echo json_encode($technologyData);
    } else {
        echo json_encode(['error' => 'Failed to fetch course data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>