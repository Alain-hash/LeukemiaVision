<?php
session_start();
include("../../../database/db.php");


$stmt = $connection->prepare("
    SELECT 
        user.User_ID, 
        user.Name, 
        user.Email,  
        user.Status, 
        doctor.Specialization, 
        doctor.Account_Creation_Date
    FROM user
    JOIN doctor ON user.User_ID = doctor.User_ID
    WHERE user.Role = 'Doctor'
");

$stmt->execute();
$result = $stmt->get_result();

$Doctors = array();
while ($Doctor = $result->fetch_assoc()) {
    $Doctors[] = $Doctor;
    
}

echo json_encode($Doctors);
?>

