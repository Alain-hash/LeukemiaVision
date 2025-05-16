<?php
session_start();
include("../../database/db.php");
// Send email using PHPMailer
require '../../phpmailer/phpmailer/src/Exception.php';
require '../../phpmailer/phpmailer/src/PHPMailer.php';
require '../../phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_SESSION['Appointment_ID'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $test_date = $_POST['date'] ?? null;
        $wbc_count = $_POST['wbc_count'] ?? null;
        $blast_percentage = $_POST['blast_percentage'] ?? null;
        $hemoglobin = $_POST['hemoglobin'] ?? null;
        $platelets = $_POST['platelets'] ?? null;
        $doctor_notes = $_POST['doctorNotes'] ?? null;
        $Appointment_ID = $_SESSION['Appointment_ID'];
        $diagnosis_status = $_POST['diagnosis_status'] ?? null;
        $treatment_name = $_POST['treatment_name'] ?? null;
        $ml_prediction = isset($_POST['ml_prediction']) ? $_POST['ml_prediction'] : '';
        $blood_smear_image = isset($_POST['image_url']) ? $_POST['image_url'] : '';
    
        if (empty($wbc_count) || empty($blast_percentage) || empty($hemoglobin) || empty($platelets) || empty($doctor_notes)) {
            $_SESSION['empty_field'] = "Fields are required!";
            header("location:../test_report.php");
            exit();
        }
    
        // Prepare and execute leukemia_test insert
        $sql1 = "INSERT INTO leukemia_test (
        Smear_Blood_Image,Test_Result,
                Test_Result_Date, WBC_Count, Blast_Cells_Percentage, Hemoglobin, Platelets, Appointment_ID, notes
            ) VALUES (?,?,?, ?, ?, ?, ?, ?, ?)";
    
        $stmt1 = mysqli_prepare($connection, $sql1);
        mysqli_stmt_bind_param(
            $stmt1,
            "sssdddiss",
            $blood_smear_image,
            $ml_prediction,
            $test_date,
            $wbc_count,
            $blast_percentage,
            $hemoglobin,
            $platelets,
            $Appointment_ID,
            $doctor_notes
        );
    
        $insertDiagnosisSuccess = true;
    
        if ($diagnosis_status === 'yes') {
            $current_stage = $_POST['current_stage'] ?? null;
            $diagnosis_date = $_POST['diagnosis_date'] ?? null;
            $leukemia_type = $_POST['leukemia_type'] ?? null;
            $current_status = $_POST['current_status'] ?? null;
            $previous_stage = $_POST['previous_stage'] ?? null;
            $wbc_status = $_POST['wbc_status'] ?? null;
            $patient_user_id = $_SESSION['patient_id'];
    
            if (empty($current_stage) || empty($leukemia_type) || empty($current_status) || empty($previous_stage) || empty($wbc_status) || empty($treatment_name)) {
                $_SESSION['empty_field'] = "Fields are required!";
                header("location:../test_report.php");
                exit();
            }
    
            $stmt = $connection->prepare("SELECT Patient_ID FROM patient WHERE User_ID = ?");
            $stmt->bind_param("i", $patient_user_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $patient_id = null;
            if ($row = $result->fetch_assoc()) {
                $patient_id = $row['Patient_ID'];
            }
            $stmt->close();
    
            if ($patient_id !== null) {
                $sql2 = "INSERT INTO patient_diagnosis (
                    diagnosis_date, leukemia_type, current_stage, current_status, previous_stage, wbc_status, patient_id
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
                $stmt2 = mysqli_prepare($connection, $sql2);
                mysqli_stmt_bind_param(
                    $stmt2,
                    "ssssssi",
                    $diagnosis_date,
                    $leukemia_type,
                    $current_stage,
                    $current_status,
                    $previous_stage,
                    $wbc_status,
                    $patient_id
                );
                $insertDiagnosisSuccess = mysqli_stmt_execute($stmt2);
                mysqli_stmt_close($stmt2);
            } else {
                $insertDiagnosisSuccess = false;
            }
        }
    
        $insertTestSuccess = mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);
    
        // Insert into treatment
        $sql5 = "INSERT INTO treatment (
            Treatment_Name,
            Appointment_ID,
            Patient_ID
        ) VALUES (?, ?,?)";
    
        $stmt5 = mysqli_prepare($connection, $sql5);
        mysqli_stmt_bind_param(
            $stmt5,
            "sii",
            $treatment_name,
            $Appointment_ID,
            $patient_id
        );
        $insertTreatmentSuccess = mysqli_stmt_execute($stmt5);
        mysqli_stmt_close($stmt5);
    
        if ($insertTestSuccess && $insertDiagnosisSuccess && $insertTreatmentSuccess) {
            // Get patient email and name for notification
            $patient_user_id = $_SESSION['patient_id'];
            $stmt_user = $connection->prepare("SELECT Email, Name FROM user WHERE User_ID = ?");
            $stmt_user->bind_param("i", $patient_user_id);
            $stmt_user->execute();
            $result_user = $stmt_user->get_result();
    
            if ($user_data = $result_user->fetch_assoc()) {
                $patient_email = $user_data['Email'];
                $patient_name = $user_data['Name'];
    
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
                    $mail->addAddress($patient_email, $patient_name);
    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'LeukemiaVision - Your Test Report is Ready';
    
                    $mail->Body = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
                        <div style="text-align: center; background-color: #0d6efd; color: white; padding: 10px;">
                            <h2>LeukemiaVision</h2>
                        </div>
                        <div style="padding: 20px; border: 1px solid #ddd; border-top: none;">
                            <p>Dear ' . htmlspecialchars($patient_name) . ',</p>
                            <p>We are writing to inform you that your test report from your recent appointment has been completed.</p>
                            <p>You can now access this report by logging into your LeukemiaVision patient portal.</p>
                            <div style="text-align: center; margin: 25px 0;">
                                <a href="https://leukemiavision.com/login" style="background-color: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                                    View Your Report
                                </a>
                            </div>
                            <p>If you have any questions about your report, please contact your healthcare provider.</p>
                            <p>Thank you for choosing LeukemiaVision.</p>
                            <p>Best regards,<br>The LeukemiaVision Medical Team</p>
                        </div>
                    </div>';
    
                    $mail->AltBody = 'Dear ' . $patient_name . ',
    
    We are writing to inform you that your test report from your recent appointment has been completed.
    
    You can now access this report by logging into your LeukemiaVision patient portal at https://leukemiavision.com/login
    
    If you have any questions about your report, please contact your healthcare provider.
    
    Thank you for choosing LeukemiaVision.
    
    Best regards,
    The LeukemiaVision Medical Team';
    
                    $mail->send();
                    error_log("Email notification sent to patient ID: $patient_user_id");
                } catch (Exception $e) {
                    error_log("Failed to send email notification to patient ID: $patient_user_id. Error: {$mail->ErrorInfo}");
                }
            }
            unset($_SESSION['Appointment_ID']);
            $_SESSION['success'] = "Report submitted successfully and patient has been notified!";
            header("location:../appointment.php");
        } else {
            $_SESSION['error'] = "There has been an error while submitting the report!";
            header("location:../test_report.php");
        }
        
        mysqli_close($connection);
        exit();
}

}else{
    $_SESSION['appointment_selection_restriction']='Cannot make report, No selected patient yet';
    header("location:../test_report.php");
    exit();
}
?>
