<?php
include("database/db.php");

$stmt = $connection->prepare(
    "SELECT doctor.Doctor_ID, 
            doctor.Specialization,
            user.Name,
            doctor.Profile_Picture,
            doctor.Rating
     FROM doctor
     JOIN user ON user.User_ID = doctor.User_ID
     WHERE user.Status = 'Active'
     LIMIT 4"
);

$stmt->execute();
$doctors_result = $stmt->get_result(); 
?>