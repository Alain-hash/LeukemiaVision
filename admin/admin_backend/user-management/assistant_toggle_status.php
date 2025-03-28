<?php
include("../../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['status'])) {
    $assistantId = $_POST['id'];
    $newStatus = $_POST['status'];


    $stmt = $connection->prepare("UPDATE user SET Status = ? WHERE User_ID = ?");
    $stmt->bind_param("si", $newStatus, $assistantId);

    if ($stmt->execute()) {
        echo "Assistant status updated to $newStatus successfully.";
    } else {
        echo "Error updating Assistant status.";
    }

    $stmt->close();
    $connection->close();
} else {
    echo "Invalid request.";
}
?>
