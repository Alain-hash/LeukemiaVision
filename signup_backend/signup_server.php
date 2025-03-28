<?php

session_start();

require '../phpmailer/phpmailer/src/Exception.php';
require '../phpmailer/phpmailer/src/PHPMailer.php';
require '../phpmailer/phpmailer/src/SMTP.php';
//------------------------------//
include("../database/db.php");
include("signup_controller.php");
include("signup_model.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to send verification email
function sendVerificationEmail($email, $fullName) {
    // Generate a random 6-digit verification code
    $verificationCode = rand(100000, 999999);
    
    // Store the verification code in the session
    $_SESSION['verification_code'] = $verificationCode;
    $_SESSION['user_email'] = $email;
    $_SESSION['form_data'] = $_POST; // Store all form data to use after verification
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alainmoussa123@gmail.com'; 
        $mail->Password = 'enqq mrri flqf zsvh'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('noreply@leukemiavision.com', 'LeukemiaVision');
        $mail->addAddress($email, $fullName);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification - LeukemiaVision';
        $mail->Body = '
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 5px;">
                <h2 style="color: #3fbbc0;">LeukemiaVision Email Verification</h2>
                <p>Dear ' . htmlspecialchars($fullName) . ',</p>
                <p>Thank you for registering with LeukemiaVision. To complete your registration, please use the verification code below:</p>
                <div style="background-color: #f9f9f9; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 5px; margin: 20px 0;">
                    ' . $verificationCode . '
                </div>
                <p>This code will expire in 30 minutes.</p>
                <p>If you did not request this verification, please ignore this email.</p>
                <p>Best regards,<br>The LeukemiaVision Team</p>
            </div>
        ';
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        $_SESSION['errors'][] = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize data
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $cpassword = isset($_POST['cpassword']) ? trim($_POST['cpassword']) : null;
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
    $address = isset($_POST['address']) ? trim($_POST['address']) : null;
    $emergency_contact = isset($_POST['emergency_contact']) ? trim($_POST['emergency_contact']) : null;
    $birth_date = isset($_POST['birth_date']) ? trim($_POST['birth_date']) : null;
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : null;
    $blood_type = isset($_POST['blood_type']) ? trim($_POST['blood_type']) : null;
    $weight = isset($_POST['weight']) ? trim($_POST['weight']) : null;
    $allergies = isset($_POST['allergies']) ? trim($_POST['allergies']) : null;
    $existing_conditions = isset($_POST['existing_conditions']) ? trim($_POST['existing_conditions']) : null;

    // Data validation
    $errors = validateSignupData(
        $name,
        $email,
        $password,
        $cpassword,
        $phone_number,
        $address,
        $emergency_contact,
        $birth_date,
        $gender,
        $blood_type,
        $weight,
        $allergies,
        $existing_conditions
    );

    // Check if the user already exists
    if (checkUserExists($name, $email, $connection)) {
        $errors['existance'] = "Username or Email already exists.";
    }

    // If there are errors, store them in session and redirect to the signup page
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../signup.php");
        exit();
    }

    // If validation is successful, send verification email
    if (sendVerificationEmail($email, $name)) {
        // Redirect to verification page
        header("Location: verify_email.php");
        exit();
    } else {
        // Redirect back to signup with error
        $_SESSION['errors'] = ["Failed to send verification email. Please try again."];
        header("Location: ../signup.php");
        exit();
    }
}

$connection->close();
?>