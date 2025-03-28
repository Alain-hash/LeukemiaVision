<?php
session_start();
include("../../../database/db.php");

$stmt = $connection->prepare("
    SELECT 
        User_ID, 
        Name, 
        Email,  
        Status
    FROM user
    WHERE Role = 'Patient'
");

$stmt->execute();
$result = $stmt->get_result();

$patients = array();
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

echo json_encode($patients);

$stmt->close();
$connection->close();
?>