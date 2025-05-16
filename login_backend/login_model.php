<?php

require_once("../database/db.php");

function authenticateUser($email, $password, $connection) {
    
    $stmt = $connection->prepare("SELECT User_ID, Name, Email, Password,Role,Status FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['Password'])) {
            return $user;
        }
    }
   
    return false;
}

?>