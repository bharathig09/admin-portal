<?php
// Include your database connection script
include 'partials/_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract data from POST
    $meta_id = $_POST['meta_id'];
    $name = $_POST['name'];
    $property = $_POST['property'];
    $content = $_POST['content'];
    $menu_id = $_POST['menu_id'];
    $tag_id = $_POST['tag_id'];
    $course_id = $_POST['course_id'];
    $status = $_POST['status'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

    // Prepare the update statement
    $sql = "UPDATE meta SET name=?, property=?, content=?, menu_id=?, tag_id=?, course_id=?, status=?, created_by=?, modified_by=? WHERE meta_id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters and execute
        $stmt->bind_param("sssiiiissi", $name, $property, $content, $menu_id, $tag_id, $course_id, $status, $created_by, $modified_by, $meta_id);
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
