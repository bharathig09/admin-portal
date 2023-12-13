<?php
// Database connection code goes here
include 'partials/_dbconnect.php';
// Check if student_id is set
if(isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM registration WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);

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
    echo "student_id not set";
}
?>
