<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];

    if ($action === "delete") {
        $Iid = $_POST["Iid"];

        $stmt = $conn->prepare("UPDATE instructors SET status = 0 WHERE instructor_id = ?");
        $stmt->bind_param("i", $Iid);

        if ($stmt->execute()) {
            echo 'Data deleted successfully';
        } else {
            echo 'Error: ' . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
