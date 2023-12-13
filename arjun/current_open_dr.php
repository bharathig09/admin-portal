<?php
// Database connection code goes here
include 'config.php';
// Check if menu_id is set
if(isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM current_opening WHERE course_id = ?");
    $stmt->bind_param("i", $menu_id);

    // Execute the statement
    if($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "course_id not set";
}
?>
