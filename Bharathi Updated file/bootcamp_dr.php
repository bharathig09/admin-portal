<?php
// Database connection code goes here
include 'config.php';
// Check if menu_id is set
if(isset($_POST['bootcamp_id'])) {
    $bootcamp_id = $_POST['bootcamp_id'];

    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM bootcamp WHERE bootcamp_id = ?");
    $stmt->bind_param("i", $bootcamp_id);

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
    echo "bootcamp_id not set";
}
?>
