<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];

    if ($action === "delete") {
        $hid = $_POST["hid"];

        $stmt = $conn->prepare("DELETE FROM reach_us WHERE contact_id = ?");
        // $stmt = $conn->prepare("UPDATE reach_us SET status='1' WHERE contact_id = ?");
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
