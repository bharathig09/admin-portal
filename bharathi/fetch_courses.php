<?php
require_once("config.php");

$sql = "SELECT * FROM courses WHERE status='1' ORDER BY modify_date_time DESC";
// $sql = "SELECT ist.*, i.instructor_name FROM courses ist JOIN instructors i ON ist.course_id = i.instructor_id WHERE ist.status='1' ORDER BY ist.course_id DESC";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>



