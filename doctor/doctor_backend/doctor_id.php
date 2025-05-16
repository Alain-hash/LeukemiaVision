<?php
session_start();
include("../../database/db.php");

$user_id=$_SESSION['user_id'];
$stmt1 = $connection->prepare("
    SELECT Doctor_ID
    FROM doctor
    WHERE User_ID = ?
");

$stmt1->bind_param("i", $user_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($row = $result1->fetch_assoc()) {
    $_SESSION['doctor_id'] = $row['Doctor_ID'];
}
?>
