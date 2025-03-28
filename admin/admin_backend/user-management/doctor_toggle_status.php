<?php
include("../../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['status'])) {
    $doctorId = $_POST['id'];
    $newStatus = $_POST['status'];


    $stmt = $connection->prepare("UPDATE user SET Status = ? WHERE User_ID = ?");
    $stmt->bind_param("si", $newStatus, $doctorId);

    if ($stmt->execute()) {
        echo "Doctor status updated to $newStatus successfully.";
    } else {
        echo "Error updating doctor status.";
    }

    $stmt->close();
    $connection->close();
} else {
    echo "Invalid request.";
}
?>
