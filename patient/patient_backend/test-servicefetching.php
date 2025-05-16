<?php 
session_start();

include("../../database/db.php");

if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient') {
  header("Location: ../../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT s.Name, s.Service_ID, s.Service_Duration FROM services s WHERE s.Type = 'Test';";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$test = [];

while ($row = $result->fetch_assoc()) {
    $test[] = $row;
}

echo json_encode($test);

$sql1 = "SELECT Service_Duration, Type FROM services  WHERE Type = 'Test';";
$stmt1 = $connection->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($row = $result1->fetch_assoc()) {
  $test_service_duration=$row['Service_Duration'];
    $_SESSION['test_service_duration'] = $test_service_duration;
    $_SESSION['type=test']=$row['Type'];
}

$stmt1->close();



?>