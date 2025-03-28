<?php
session_start();


include("../../../database/db.php");
include_once("user-management-validation_backend.php");


//-------assistant insertion-------//

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['form_data'] = $_POST;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $date = $_POST['date'];
    


    $errors = validateAssistantData(
        $username,
        $email,
        $password,
        $date,
    );
    if (checkUserExists($name, $email, $connection)) {
        $errors['existence'] = "Username or Email already exists.";
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../admin_frontend/admin-user-management.php");
        exit();
    }

    $role = 'Assistant';
    $stmt1 = $connection->prepare("INSERT INTO user (Name, Email, Password, Role) VALUES (?, ?, ?, ?)");
    if (!$stmt1) {
        $_SESSION['error'] = "Error preparing user insert statement: " . $connection->error;
        header("Location: ../../admin_frontend/admin-user-management.php");
        exit();
    }

    $stmt1->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt1->execute()) {

        $user_id = $connection->insert_id;
        $stmt2 = $connection->prepare("INSERT INTO assistant (Account_Creation_Date, User_ID) VALUES (?, ?)");
        if (!$stmt2) {
            $_SESSION['error'] = "Error preparing doctor insert statement: " . $connection->error;
            header("Location: ../../admin_frontend/admin-user-management.php");
            exit();
        }

        $stmt2->bind_param("si",$date,$user_id);

        if ($stmt2->execute()) {
            $_SESSION['message'] = "Assistant registration successful";

            unset($_SESSION['form_data']);
        } else {
            $_SESSION['error'] = "Error registering Assistant: " . $stmt2->error;
        }
    } else {
        $_SESSION['error'] = "Error creating user: " . $stmt1->error;
    }

    if (isset($stmt1)) $stmt1->close();
    if (isset($stmt2)) $stmt2->close();
} else {
    $_SESSION['error'] = "Invalid request method";
}

header("Location: ../../admin_frontend/admin-user-management.php");
exit();
