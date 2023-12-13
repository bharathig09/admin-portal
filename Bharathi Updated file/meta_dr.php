<?php
// Database connection code goes here
include 'config.php';
// Check if meta_id is set
if(isset($_POST['meta_id'])) {
    $meta_id = $_POST['meta_id'];

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM meta WHERE meta_id = ?");
    $stmt->bind_param("i", $meta_id);

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
    echo "meta_id not set";
}
?>
