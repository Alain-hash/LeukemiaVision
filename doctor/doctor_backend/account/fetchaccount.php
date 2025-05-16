<?php

include("../database/db.php");

// Fetch doctor information
$sql = "SELECT u.Name as doctorname, u.Email, d.Doctor_ID, d.Specialization, 
        d.Account_Creation_Date, d.Profile_Picture as profile_image, d.Clinical_Inst_ID, 
        d.License_Number, d.Rating
        FROM doctor d 
        JOIN user u ON d.User_ID = u.User_ID
        WHERE u.User_ID = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Store data in array
$accountData = array();
if ($result->num_rows > 0) {
    $accountData = $result->fetch_assoc();
}
$stmt->close();

// Get the count of assistants assigned to this doctor
$sql_assistants = "SELECT COUNT(*) as assistant_count 
                  FROM assistant 
                  WHERE Doctor_ID = ?";

if (isset($accountData['Doctor_ID'])) {
    $stmt_assistants = $connection->prepare($sql_assistants);
    $stmt_assistants->bind_param("i", $accountData['Doctor_ID']);
    $stmt_assistants->execute();
    $result_assistants = $stmt_assistants->get_result();
    $assistant_data = $result_assistants->fetch_assoc();
    $accountData['assistant_count'] = $assistant_data['assistant_count'];
    $stmt_assistants->close();
} else {
    $accountData['assistant_count'] = 0;
}

// Get clinic name if Clinical_Inst_ID is set
if (isset($accountData['Clinical_Inst_ID']) && $accountData['Clinical_Inst_ID'] != NULL) {
    $sql_clinic = "SELECT Name FROM clinical_institution WHERE Institution_ID = ?";
    $stmt_clinic = $connection->prepare($sql_clinic);
    $stmt_clinic->bind_param("i", $accountData['Clinical_Inst_ID']);
    $stmt_clinic->execute();
    $result_clinic = $stmt_clinic->get_result();
    $clinic_data = $result_clinic->fetch_assoc();
    $accountData['clinic_name'] = $clinic_data['Name'] ?? 'Not Affiliated';
    $stmt_clinic->close();
} else {
    $accountData['clinic_name'] = 'Not Affiliated';
}
?>