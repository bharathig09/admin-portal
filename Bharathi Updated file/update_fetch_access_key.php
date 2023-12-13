<?php

require_once("config.php");

if (isset($_GET['access_key_id'])) {
    $accessKeyId = $_GET['access_key_id'];

    $query = "SELECT * FROM number_verify_access_key WHERE access_key_id = $accessKeyId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $accessKeyData = mysqli_fetch_assoc($result);
        echo json_encode($accessKeyData);
    } else {
        echo json_encode(['error' => 'Failed to fetch access key data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>