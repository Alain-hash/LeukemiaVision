<?php
include("../../../database/db.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $serviceId = intval($_POST['id']);

    $stmt = $connection->prepare("DELETE FROM services WHERE Service_ID = ?");
    $stmt->bind_param("i", $serviceId);
    if ($stmt->execute()) {

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No row deleted. Possibly invalid ID.']);
        }

        $connection->close();
}

?>
