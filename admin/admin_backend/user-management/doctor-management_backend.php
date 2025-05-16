<?php
session_start();


include("../../../database/db.php");
include_once("user-management-validation_backend.php");



//-------Doctor insertion-------//
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['form_data'] = $_POST;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'Doctor';
   
    $speciality = $_POST['speciality'];
    $date = $_POST['date'];
    $license_number = $_POST['lisence_number'];
    $Inst_ID=1;

    $errors = validateDoctorData(
        $username,
        $email,
        $password,
        $license_number,
        $date,
        $speciality
    );


    if (checkUserExists($username, $email, $connection)) {
        $errors['existence'] = "Username or Email already exists.";
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../admin_frontend/admin-user-management.php");
        exit();
    }


    $stmt1 = $connection->prepare("INSERT INTO user (Name, Email, Password, Role) VALUES (?, ?, ?,?)");
    if (!$stmt1) {
        $_SESSION['error'] = "Error preparing user insert statement: " . $connection->error;
        header("Location: ../../admin_frontend/admin-user-management.php");
        exit();
    }

    $stmt1->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt1->execute()) {

        $user_id = $connection->insert_id;


        $stmt2 = $connection->prepare("INSERT INTO doctor (Specialization, Account_Creation_Date, License_Number, User_ID,Clinical_Inst_ID) VALUES (?, ?, ?, ?,?)");
        if (!$stmt2) {
            $_SESSION['error'] = "Error preparing doctor insert statement: " . $connection->error;
            header("Location: ../../admin_frontend/admin-user-management.php");
            exit();
        }

        $stmt2->bind_param("sssis", $speciality, $date, $license_number, $user_id,$Inst_ID);

        if ($stmt2->execute()) {
            $_SESSION['message'] = "Doctor registration successful";
            include_once("refresh_doctor_schedule.php");
            unset($_SESSION['form_data']);
            
        } else {
            $_SESSION['error'] = "Error registering doctor: " . $stmt2->error;
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

