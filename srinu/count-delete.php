<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];

    if ($action === "delete") {
        $hid = $_POST["hid"];

        $stmt = $conn->prepare("DELETE FROM counts WHERE count_id = ?");
        $stmt->bind_param("i", $hid);

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
