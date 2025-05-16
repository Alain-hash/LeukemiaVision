<?php

include("../../../database/db.php");

$stmt = $connection->prepare("
    SELECT 
        user.User_ID, 
        user.Name, 
        user.Email,  
        user.Status,
        assistant.Account_Creation_Date
    FROM user
    JOIN assistant ON user.User_ID = assistant.User_ID
    WHERE user.Role = 'Assistant'
");

$stmt->execute();
$result = $stmt->get_result();

$assistants = array();
while ($row = $result->fetch_assoc()) {
    $assistants[] = $row;
}

echo json_encode($assistants);

$stmt->close();
$connection->close();
?>