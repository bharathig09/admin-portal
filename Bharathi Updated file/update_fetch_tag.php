<?php

require_once("config.php");

if (isset($_GET['tag_id'])) {
    $tagId = $_GET['tag_id'];

    $query = "SELECT * FROM tags WHERE tag_id = $tagId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $tagData = mysqli_fetch_assoc($result);
        echo json_encode($tagData);
    } else {
        echo json_encode(['error' => 'Failed to fetch course data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>