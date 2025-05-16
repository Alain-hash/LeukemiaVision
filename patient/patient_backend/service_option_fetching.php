<?php 
session_start();


include("../../database/db.php");

if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient'){
  header("Location: ../../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
//$profile_image=$_SESSION['profile_image'];

$sql = "SELECT * FROM services WHERE Type = 'Test'";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();


$sql2 = "SELECT * FROM services WHERE Type = 'Treatment'";
$stmt2 = $connection->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->get_result();
$stmt2->close();

?>
