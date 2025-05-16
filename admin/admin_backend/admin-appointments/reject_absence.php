<?php
// Include database connection
include("../../../database/db.php");

require '../../../phpmailer/phpmailer/src/Exception.php';
require '../../../phpmailer/phpmailer/src/PHPMailer.php';
require '../../../phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to send email using PHPMailer
function sendEmail($to, $subject, $message)
{
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

// Function to get absence details
function getAbsenceDetails($connection, $absenceId)
{
    $stmt = $connection->prepare("
        SELECT Date, Reason 
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

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from AJAX request
    $Absence_ID = isset($_POST['Absence_ID']) ? $_POST['Absence_ID'] : '';
    $Doctor_ID = isset($_POST['Doctor_ID']) ? $_POST['Doctor_ID'] : '';
    $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
   

    // Validate required parameters
    if (!$Absence_ID) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required parameter: Absence_ID']);
        exit;
    }

    // Get the filename to determine which action to take
    $currentFile = basename($_SERVER['PHP_SELF']);

    // Handle rejection
    if ($currentFile == "reject_absence.php") {
        // Update absence status
        $stmt = $connection->prepare("UPDATE absence SET Status = 'Rejected' WHERE Absence_ID = ?");
        $stmt->bind_param("i", $Absence_ID);

        if ($stmt->execute()) {
            $rows_affected = $stmt->affected_rows;
            
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
    } else {
        // Default case if not the reject_absence.php file
        echo "Error: Invalid operation for this file.";
    }
    
    // Close the database connection
    $connection->close();
}
?>