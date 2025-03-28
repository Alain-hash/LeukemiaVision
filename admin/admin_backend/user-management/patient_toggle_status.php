<?php
include("../../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['status'])) {
    $patientId = $_POST['id'];
    $newStatus = $_POST['status'];

    $stmt = $connection->prepare("UPDATE user SET Status = ? WHERE User_ID = ?");
    $stmt->bind_param("si", $newStatus, $patientId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Patient status updated to $newStatus successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating Patient status."]);
    }

    $stmt->close();
    $connection->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>