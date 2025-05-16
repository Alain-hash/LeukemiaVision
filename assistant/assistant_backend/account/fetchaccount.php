<?php

include("../database/db.php");
// Prepare and execute query
$sql = "SELECT u1.Name as assistantname, u1.Email, a.Assistant_ID, a.Account_Creation_Date, 
        a.profile_image, u2.Name as doctorname
        FROM assistant a 
        JOIN user u1 ON a.User_ID = u1.User_ID
        JOIN doctor d ON d.Doctor_ID = a.Doctor_ID
        JOIN user u2 ON d.User_ID = u2.User_ID
        WHERE u1.User_ID = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Store data in array instead of directly using result
$accountData = array();
if ($result->num_rows > 0) {
    $accountData = $result->fetch_assoc();
}

?>