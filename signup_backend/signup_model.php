<?php

include("../database/db.php");



function checkUserExists($name, $email, $connection)
{
    $stmt = $connection->prepare("SELECT User_ID FROM user WHERE Name = ? OR Email = ?");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if any results were found
    if ($stmt->num_rows > 0) {
        $stmt->close();
        return true; // User already exists
    } else {
        $stmt->close();
        return false; // User does not exist
    }
}
function createUser(
    $Name,
    $Email,
    $Password,
    $Phone_Number,
    $Address,
    $Emergency_Contact,
    $Birth_Date,
    $Gender,
    $Blood_Type,
    $Weight,
    $Allergies,
    $Existing_Conditions,
    $Role,
    $connection
) {

    // Secure password
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

    // Insert into `user` table
    $Role="Patient";
    $stmt2 = $connection->prepare("INSERT INTO user (Name, Email, Password, Role) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("ssss", $Name, $Email, $hashed_password, $Role);

    if (!$stmt2->execute()) {
        return false; 
    }

    // Get the last inserted user_id
    $user_id = $connection->insert_id;

    // Insert into `patient` table
    $stmt1 = $connection->prepare("INSERT INTO patient 
        (Phone_Number, Address, Emergency_Contact, Birth_Date, Gender, Blood_Type, Weight, Allergies, Existing_Conditions, User_ID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt1->bind_param(
        "sssssssssi",
        $Phone_Number,
        $Address,
        $Emergency_Contact,
        $Birth_Date,
        $Gender,
        $Blood_Type,
        $Weight,
        $Allergies,
        $Existing_Conditions,
        $user_id
    );

    if ($stmt1->execute()) {
        return true;
    } else {
        return false;
    }
}


?>