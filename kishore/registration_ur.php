<?php
// Include your database connection script
include 'partials/_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract data from POST
    $student_id = $_POST['student_id'];
    $student_fname = $_POST['student_fname'];
    $student_lname = $_POST['student_lname'];
    $student_email = $_POST['student_email'];
    $student_number = $_POST['student_number'];
    $student_alt_number = $_POST['student_alt_number'];
    $student_gender = $_POST['student_gender'];
    $student_address = $_POST['student_address'];
    $student_courses = $_POST['student_courses'];
    $student_program1 = $_POST['student_program1'];
    $student_program2 = $_POST['student_program2'];
    $student_program3 = $_POST['student_program3'];
    $student_hear_aboutus = $_POST['student_hear_aboutus'];
    $student_recommend = $_POST['student_recommend'];
    $ref1 = $_POST['ref1'];
    $ref1_number = $_POST['ref1_number'];
    $ref2 = $_POST['ref2'];
    $ref2_number = $_POST['ref2_number'];
    $created_by = $_POST['created_by'];
    $modified_by = $_POST['modified_by'];

    // Prepare the update statement
    $sql = "UPDATE registration SET student_fname=?, student_lname=?, student_email=?, student_number=?, student_alt_number=?, student_gender=?, student_address=?, student_courses=?, student_program1=?, student_program2=?, student_program3=?, student_hear_aboutus=?, student_recommend=?, ref1=?, ref1_number=?, ref2=?, ref2_number=?, created_by=?, modified_by=? WHERE student_id=?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters and execute
        $stmt->bind_param("sssssssssssssssssssi", $student_fname, $student_lname, $student_email, $student_number, $student_alt_number, $student_gender, $student_address, $student_courses, $student_program1, $student_program2, $student_program3, $student_hear_aboutus, $student_recommend, $ref1, $ref1_number, $ref2, $ref2_number, $created_by, $modified_by, $student_id);
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
