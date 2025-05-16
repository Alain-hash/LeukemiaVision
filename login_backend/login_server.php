<?php
session_start();

//------------------------------//
include("../database/db.php");
include("login_controller.php");
include("login_model.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize data
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Store the submitted data in session for repopulating the form
    $_SESSION['old_input'] = [
        'email' => $email,
        // Don't store password for security reasons
    ];

    // Data validation
    $errors = validateLoginData($email, $password);

    // If there are errors, store them in session and redirect to the login page
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../login.php");
        exit();
    }

    $user = authenticateUser($email, $password, $connection);

    if ($user) {
        // Clear old input if login is successful
        if (isset($_SESSION['old_input'])) {
            unset($_SESSION['old_input']);
        }

        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_name'] = $user['Name'];
        $_SESSION['user_email'] = $user['Email'];
        $_SESSION['user_role'] = $user['Role'];
        $_SESSION['user_Status'] = $user['Status'];

        if ($user['Role'] == 'Patient') {
            header("Location: ../index.php");
        } else if ($user['Role'] == 'Doctor') {
            $user_id = $_SESSION['user_id'];
            $stmt2 = $connection->prepare("
                SELECT Doctor_ID
                FROM doctor
                WHERE User_ID = ?
            ");
            $stmt2->bind_param("i", $user_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($row = $result2->fetch_assoc()) {
                $_SESSION['doctor_id'] = $row['Doctor_ID'];
            }
            header("Location: ../doctor/homepage.php");
        } else if ($user['Role'] == 'Assistant') {
            header("Location: ../assistant/homepage.php");
        } else if ($user['Role'] == 'Admin') {
            header("Location: ../admin/admin_frontend/admin-dashboard.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    } else {
        $_SESSION['errors'] = ["Invalid email or password. Please try again."];
        header("Location: ../login.php");
        exit();
    }
}

$connection->close();