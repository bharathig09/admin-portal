<?php
// Include your database connection script
include 'partials/_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract data from POST
    $bootcamp_id = $_POST['bootcamp_id'];
    $bootcamp_email = $_POST['bootcamp_email'];
    $bootcamp_contact = $_POST['bootcamp_contact'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

    // Prepare the update statement
    $sql = "UPDATE bootcamp SET bootcamp_email=?, bootcamp_contact=?, created_by=?, modified_by=? WHERE bootcamp_id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters and execute
        $stmt->bind_param("sissi", $bootcamp_email, $bootcamp_contact, $created_by, $modified_by, $bootcamp_id);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully";
        } else {
            echo "No records were updated";
        }
    } else {
        // Handle error if statement couldn't be prepared
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
