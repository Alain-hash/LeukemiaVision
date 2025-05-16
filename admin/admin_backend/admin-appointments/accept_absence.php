<?php
session_start();
// Include database connection
include("../../../database/db.php");

require '../../../phpmailer/phpmailer/src/Exception.php';
require '../../../phpmailer/phpmailer/src/PHPMailer.php';
require '../../../phpmailer/phpmailer/src/SMTP.php';
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Get data from POST
$Absence_ID = isset($_POST['Absence_ID']) ? $_POST['Absence_ID'] : null;
$Doctor_ID = isset($_POST['Doctor_ID']) ? $_POST['Doctor_ID'] : null;
$Email = isset($_POST['Email']) ? $_POST['Email'] : null;
if (!$Absence_ID) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameter: Absence_ID']);
    exit;
  }
// Debug log
error_log("Processing absence: ID=$Absence_ID, Doctor=$Doctor_ID, Email=$Email");
  
// Function to send email using PHPMailer
function sendEmail($to, $subject, $message) {
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
        $mail->setFrom('noreply@LeukemkaVision.com', 'LeukemiaVision');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        error_log("Email successfully sent to: $to");
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

// Function to get patients' emails for a doctor
function getPatientEmails($connection, $doctorId) {
    $stmt = $connection->prepare("
        SELECT DISTINCT user.Email 
        FROM user 
        JOIN patient ON patient.user_ID=user.User_ID
        JOIN appointment ON appointment.Patient_ID = patient.Patient_ID
        WHERE appointment.Doctor_ID = ? AND appointment.Status = 'Canceled'
    ");
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $emails = [];
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['Email'];
    }
    
    $stmt->close();
    return $emails;
}

// Function to get absence details
function getAbsenceDetails($connection, $absenceId) {
    $stmt = $connection->prepare("
        SELECT Date,
        Reason 
        FROM absence 
        WHERE Absence_ID = ?
    ");
    $stmt->bind_param("i", $absenceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    return $row;
}



// Get the filename to determine which action to take
$currentFile = basename($_SERVER['PHP_SELF']);

// Handle rejection
if ($currentFile == "reject_absence.php" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from AJAX request
    $reason = $_POST['DeclineReason'] ?? 'Your absence request has been declined.';
    
    // Update absence status
    $stmt = $connection->prepare("UPDATE absence SET Status = 'Rejected' WHERE Absence_ID = ?");
    $stmt->bind_param("i", $Absence_ID);
    
    if ($stmt->execute()) {
        // Get absence details
        $absenceDetails = getAbsenceDetails($connection, $Absence_ID);
        
        // Send email to doctor
        if ($Email && filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $subject = "Absence Request Rejected";
            $message = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        .header { background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; }
                        .content { padding: 20px; border: 1px solid #ddd; }
                        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>Absence Request Rejected</h2>
                        </div>
                        <div class='content'>
                            <p>Dear Doctor,</p>
                            <p>Your absence request for the date <strong>{$absenceDetails['Date']}</strong> has been rejected.</p>
                            <p><strong>Reason for rejection:</strong> {$reason}</p>
                            <p>If you have any questions or need further clarification, please contact the administration.</p>
                            <p>Thank you for your understanding.</p>
                        </div>
                        <div class='footer'>
                            <p>This is an automated message. Please do not reply to this email.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            
            if (sendEmail($Email, $subject, $message)) {
                echo "Success. Absence rejected and email sent.";
            } else {
                echo "Absence rejected but email could not be sent.";
            }
        } else {
            echo "Success. Absence rejected but no email was sent due to missing or invalid email address.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

// Handle acceptance
if ($currentFile == "accept_absence.php" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update absence status
    $stmt1 = $connection->prepare("UPDATE absence SET Status = 'Accepted' WHERE Absence_ID = ?");
    $stmt1->bind_param("i", $Absence_ID);
    
    if ($stmt1->execute()) {
        // Update appointments
        $stmt2 = $connection->prepare("UPDATE appointment SET Status = 'Canceled due to absence' WHERE Doctor_ID = ? AND App_Date = (SELECT Date FROM absence WHERE Absence_ID = ?)");
        $stmt2->bind_param("ii", $Doctor_ID, $Absence_ID);
        $stmt2->execute();
        
        // Get absence details
        $absenceDetails = getAbsenceDetails($connection, $Absence_ID);
        error_log("Absence details: " . print_r($absenceDetails, true));
        
        // Send email to doctor
        if ($Email && filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $subject = "Absence Request Approved";
            $message = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        .header { background-color: #d4edda; color: #155724; padding: 10px; text-align: center; }
                        .content { padding: 20px; border: 1px solid #ddd; }
                        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>Absence Request Approved</h2>
                        </div>
                        <div class='content'>
                            <p>Dear Doctor,</p>
                            <p>Your absence request for the date <strong>{$absenceDetails['Date']}</strong> has been approved.</p>
                            <p>All appointments during this date have been canceled, and patients have been notified.</p>
                            <p>Thank you for your notification.</p>
                        </div>
                        <div class='footer'>
                            <p>This is an automated message. Please do not reply to this email.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            
            $emailSent = sendEmail($Email, $subject, $message);
            error_log("Doctor email sent result: " . ($emailSent ? "Success" : "Failed"));
        } else {
            error_log("Invalid doctor email: $Email");
        }
        
        // Send emails to affected patients
        $patientEmails = getPatientEmails($connection, $Doctor_ID);
        error_log("Found " . count($patientEmails) . " patient emails to notify");
        
        foreach ($patientEmails as $email) {
            $subject = "Appointment Cancellation Notice";
            $message = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        .header { background-color: #cce5ff; color: #004085; padding: 10px; text-align: center; }
                        .content { padding: 20px; border: 1px solid #ddd; }
                        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #666; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>Appointment Cancellation</h2>
                        </div>
                        <div class='content'>
                            <p>Dear Patient,</p>
                            <p>We regret to inform you that your appointment with your doctor has been canceled due to the doctor's absence on <strong>{$absenceDetails['Date']}</strong>.</p>
                            <p>Please contact our clinic to reschedule your appointment at your earliest convenience.</p>
                            <p>We apologize for any inconvenience this may cause.</p>
                        </div>
                        <div class='footer'>
                            <p>This is an automated message. Please do not reply to this email.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            
            sendEmail($email, $subject, $message);
        }
        
        echo "Success. Absence accepted and emails sent.";
    } else {
        echo "Error: " . $stmt1->error;
    }
    
    $stmt1->close();
    if (isset($stmt2)) $stmt2->close();
}

$connection->close();
?>