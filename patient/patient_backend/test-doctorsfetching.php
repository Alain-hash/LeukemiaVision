<?php 
session_start();

include("../../database/db.php");

if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient') {
  header("Location: ../../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

//fetching all doctors (Name + Specialization)
$sql = "SELECT u.Name, d.Doctor_ID, d.Specialization 
FROM doctor d
JOIN user u ON u.User_ID=d.User_ID";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$doctors = [];

while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

echo json_encode($doctors);

$connection->close();

?>