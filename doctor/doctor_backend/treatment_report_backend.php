<?php
session_start();
include("../../database/db.php");

require '../../phpmailer/phpmailer/src/Exception.php';
require '../../phpmailer/phpmailer/src/PHPMailer.php';
require '../../phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resultDate = $_POST['resultDate'] ?? null;
    $treatmentStartDate = $_POST['treatmentStartDate'] ?? null;
    $treatmentEndDate = $_POST['treatmentEndDate'] ?? null;
    $treatmentOutcome = $_POST['treatmentOutcome'] ?? null;
    $treatmentProgression = $_POST['treatmentProgression'] ?? null;

    $currentCycle = $_POST['currentCycle'] ?? null;
    $totalCycles = $_POST['totalCycles'] ?? null;
    $nextCycleDate = $_POST['nextCycleDate'] ?? null;

    $Appointment_ID = $_SESSION['Appointment_ID'] ?? null;
    $patient_user_id = $_SESSION['patient_id'] ?? null;

    // Basic validation
    if (empty($resultDate) || empty($treatmentStartDate) || empty($treatmentEndDate) || empty($treatmentProgression)) {
        $_SESSION['empty_field'] = "All required fields must be filled!";
        header("location:../treatment_report.php");
        exit();
    }

    // Get the patient_id from user_id
    $patient_id = null;
    $stmt_pid = $connection->prepare("SELECT Patient_ID FROM patient WHERE User_ID = ?");
    $stmt_pid->bind_param("i", $patient_user_id);
    $stmt_pid->execute();
    $result_pid = $stmt_pid->get_result();
    if ($row = $result_pid->fetch_assoc()) {
        $patient_id = $row['Patient_ID'];
    }
    $stmt_pid->close();

    // Update treatment table
    $sql1 = "UPDATE treatment
             SET Treatment_Result_Date = ?, Treatment_Start_Date = ?, Treatment_End_Date = ?, 
                 Treatment_Outcome = ?, Treatment_Progression = ?
             WHERE Appointment_ID = ?";
    $stmt1 = mysqli_prepare($connection, $sql1);
    mysqli_stmt_bind_param(
        $stmt1,
        "ssssss",
        $resultDate,
        $treatmentStartDate,
        $treatmentEndDate,
        $treatmentOutcome,
        $treatmentProgression,
        $Appointment_ID,
    );

    $updateAnalysisSuccess = mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    // Update treatment cycle info
    $sql2 = "UPDATE patient_diagnosis 
             SET current_cycle = ?, total_cycles = ?, next_cycle_date = ?
             WHERE Patient_ID = ?";
    $stmt2 = mysqli_prepare($connection, $sql2);
    mysqli_stmt_bind_param(
        $stmt2,
        "iisi",
        $currentCycle,
        $totalCycles,
        $nextCycleDate,
        $patient_id
    );
    $updateCycleSuccess = mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    // Send notification if everything succeeded
    if ($updateAnalysisSuccess && $updateCycleSuccess) {
        $stmt_user = $connection->prepare("SELECT Email, Name FROM user WHERE User_ID = ?");
        $stmt_user->bind_param("i", $patient_user_id);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($user_data = $result_user->fetch_assoc()) {
            $patient_email = $user_data['Email'];
            $patient_name = $user_data['Name'];

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'alainmoussa123@gmail.com';
                $mail->Password = 'enqq mrri flqf zsvh';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('noreply@leukemiavision.com', 'LeukemiaVision');
                $mail->addAddress($patient_email, $patient_name);

                $mail->isHTML(true);
                $mail->Subject = 'LeukemiaVision - Treatment Report Submitted';
                $mail->Body = '
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
                    <div style="text-align: center; background-color: #0d6efd; color: white; padding: 10px;">
                        <h2>LeukemiaVision</h2>
                    </div>
                    <div style="padding: 20px; border: 1px solid #ddd; border-top: none;">
                        <p>Dear ' . htmlspecialchars($patient_name) . ',</p>
                        <p>Your treatment analysis and cycle report has been successfully submitted.</p>
                        <p>You can review it via your patient portal:</p>
                        <div style="text-align: center; margin: 25px 0;">
                            <a href="https://leukemiavision.com/login" style="background-color: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                                View Your Report
                            </a>
                        </div>
                        <p>If you have any questions, please contact your healthcare provider.</p>
                        <p>Best regards,<br>The LeukemiaVision Medical Team</p>
                    </div>
                </div>';
                $mail->AltBody = 'Dear ' . $patient_name . ',

Your treatment report has been submitted. You can log in at https://leukemiavision.com/login to view it.

Regards,
LeukemiaVision Team';

                $mail->send();
            } catch (Exception $e) {
                error_log("Email error: {$mail->ErrorInfo}");
            }
        }

        $_SESSION['success'] = "Treatment data submitted and patient notified!";
        header("location:../appointment.php");
    } else {
        $_SESSION['error'] = "There was an error submitting the treatment data.";
        header("location:../treatment_report.php");
    }

    mysqli_close($connection);
    exit();
}
