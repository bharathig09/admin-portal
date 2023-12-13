<?php
session_start();
$username = $_SESSION['username'];
// Include your database connection script
include 'partials/_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract data from POST
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name_input'];
    $no_of_openings = $_POST['no_of_openings'];
    $hiring = $_POST['hiring'];
    $status = $_POST['status'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

    // Prepare the update statement
    $sql = "UPDATE current_opening SET course_name=?, no_of_openings=?, hiring=?, status=?, created_by=?, modified_by=? WHERE course_id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters and execute
        $stmt->bind_param("sisissi", $course_name, $no_of_openings, $hiring, $status, $created_by, $modified_by, $course_id);
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
