<?php
include("../../database/db.php");

$stmt = $connection->prepare("
    SELECT 
        user.User_ID, 
        user.Name, 
        user.Email,
        doctor.Doctor_ID,
        doctor.Profile_Picture,
        doctor.Specialization,
        absence.Absence_ID,
        absence.Subject,
        absence.Date,
        absence.Reason,
        absence.Status
    FROM user
    JOIN doctor ON user.User_ID = doctor.User_ID
    JOIN absence ON doctor.Doctor_ID = absence.Doctor_ID
    WHERE user.Role = 'Doctor'
");

$stmt->execute();
$result = $stmt->get_result(); // Now $result is defined

if ($result->num_rows === 0) {
    echo "No records found.";
} else {
    $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all records as an associative array
}

// Close statement and connection
$stmt->close();

?>
