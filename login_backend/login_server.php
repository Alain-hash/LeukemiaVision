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
    $rememberMe = isset($_POST['rememberMe']) ? true : false;

    // Data validation
    $errors = validateLoginData($email, $password);

    // If there are errors, store them in session and redirect to the login page
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../login.php");
        exit();
    }

    // Attempt to authenticate the user
    $user = authenticateUser($email, $password, $connection);

    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_name'] = $user['Name'];
        $_SESSION['user_email'] = $user['Email'];
        $_SESSION['user_role'] = $user['Role'];
        
        // Set remember me cookie if checked
        if ($rememberMe) {
            // Generate a unique token
            $token = bin2hex(random_bytes(32));
            
            // Store token in database (you'd want to implement this in login_model.php)
            storeRememberMeToken($user['User_ID'], $token, $connection);
            
            // Set the cookie - expires in 30 days
            setcookie('remember_token', $token, time() + (86400 * 30), "/", "", true, true);
        }

        // Redirect based on role
        if ($user['Role'] == 'Patient') {
            header("Location: ../patient/editprofile.php");
        } else if ($user['Role'] == 'Doctor') {
            header("Location: ../doctor/doctor_dashboard.php");
        } else if ($user['Role'] == 'Admin') {
            header("Location: ../admin/admin_dashboard.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    } else {
        // Authentication failed
        $_SESSION['errors'] = ["Invalid email or password. Please try again."];
        header("Location: ../login.php");
        exit();
    }
}

// Check for remember me cookie on page load (you could place this in a separate file that runs on every page)
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];
    $user = getUserByRememberToken($token, $connection);
    
    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['user_name'] = $user['Name'];
        $_SESSION['user_email'] = $user['Email'];
        $_SESSION['user_role'] = $user['Role'];
        
        // Refresh the token
        $newToken = bin2hex(random_bytes(32));
        storeRememberMeToken($user['User_ID'], $newToken, $connection);
        setcookie('remember_token', $newToken, time() + (86400 * 30), "/", "", true, true);
    }
}

$connection->close();
?>