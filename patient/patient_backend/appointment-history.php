<?php
session_start();
include("../../database/db.php");

if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient') { 
    header("Location: ../../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$profile_image=$_SESSION['profile_image'];
// Fetch the corresponding Patient_ID from the patient table
$sql_patient = "SELECT Patient_ID FROM patient WHERE User_ID = ?";
$stmt_patient = $connection->prepare($sql_patient);
$stmt_patient->bind_param("i", $user_id);
$stmt_patient->execute();
$result_patient = $stmt_patient->get_result();
$row_patient = $result_patient->fetch_assoc();
$patient_id = $row_patient['Patient_ID'];
$stmt_patient->close();

// Fetch upcoming appointments specific to the current patient
$sql1 = "SELECT a.Appointment_ID, a.App_Date, a.App_Time, a.Booking_Date, a.Booking_Time, 
                s.Name as service_name,s.Fee as Service_Fee, u.Name as doctor_name, 
                d.Specialization as doctor_specialization, a.Status as appointment_status, 
                p.Status as payment_status 
         FROM appointment a 
         LEFT JOIN services s ON s.Service_ID = a.Service_ID 
         LEFT JOIN doctor d ON d.Doctor_ID = a.Doctor_ID 
         LEFT JOIN user u ON u.User_ID = d.User_ID 
         LEFT JOIN payment p ON p.receipt = a.App_Invoice 
         WHERE a.Patient_ID = ? AND a.App_Date >= CURDATE() AND 
         ((a.App_Date > CURDATE()) OR (a.App_Date = CURDATE() AND a.App_Time >= CURTIME())) 
         AND a.Status = 'Scheduled'
         ORDER BY a.App_Date ASC, a.App_Time ASC;";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("i", $patient_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

// Store appointment data in session for the first result
if ($row = $result1->fetch_assoc()) {
    $_SESSION['appointments'] = [];
    $_SESSION['appointments'][] = [
        'Booking_Date' => $row['Booking_Date'],
        'Booking_Time' => $row['Booking_Time'],
        'Appointment_Date' => $row['App_Date'],
        'Appointment_Time' => $row['App_Time'],
        'Appointment_ID' => $row['Appointment_ID']
    ];
    // Reset result pointer to beginning
    $stmt1->execute();
    $result1 = $stmt1->get_result();
}
$stmt1->close();

// Handle the cancellation logic
if (isset($_POST['Appointment_ID'])) {
    $Appointment_ID = (int)$_POST['Appointment_ID'];

    // Get appointment details first
    $sql_app = "SELECT a.App_Date, a.App_Time, a.Booking_Date, a.Booking_Time 
                    FROM appointment a 
                    WHERE a.Appointment_ID = ?";
    $stmt_app = $connection->prepare($sql_app);
    $stmt_app->bind_param("i", $Appointment_ID);
    $stmt_app->execute();
    $result_app = $stmt_app->get_result();

    if ($row_app = $result_app->fetch_assoc()) {
        // Get current date and time
        $current_date = date("Y-m-d");
        $current_time = date("H:i:s");

        // Get the appointment's dates and times
        $Appointment_Date = $row_app['App_Date'];
        $Appointment_Time = $row_app['App_Time'];

        $appointment_timestamp = strtotime($Appointment_Date . ' ' . $Appointment_Time);
        $current_timestamp = time();
        $hours_difference = ($appointment_timestamp - $current_timestamp) / 3600;
        
        // Determine refund policy based on the time difference
        if ($hours_difference > 6) {
            $sql2 = "UPDATE appointment a 
            JOIN payment p ON a.App_Invoice = p.receipt 
            SET a.Status = 'Canceled', p.Refund_Status = 'Full' 
            WHERE a.Appointment_ID = ?";
        } else {
            $sql2 = "UPDATE appointment a 
            JOIN payment p ON a.App_Invoice = p.receipt 
            SET a.Status = 'Canceled', p.Refund_Status = 'No Refund' 
            WHERE a.Appointment_ID = ?";
        }
        
        $stmt2 = $connection->prepare($sql2);
        $stmt2->bind_param("i", $Appointment_ID);
        $stmt2->execute();
        $stmt2->close();
        // Redirect to appointment history page with cancellation status
        header('Location: ../patient_frontend/appointment-history.php');
        exit();
    }
}

// Fetching past appointments for the current patient
$sql3 = "SELECT a.Appointment_ID, a.App_Date, a.App_Time, s.Name as service_name, u.Name as doctor_name, 
         d.Specialization as doctor_specialization, a.Status as appointment_status, p.Status as payment_status 
         FROM appointment a 
         LEFT JOIN services s ON s.Service_ID = a.Service_ID 
         LEFT JOIN doctor d ON d.Doctor_ID = a.Doctor_ID 
         LEFT JOIN user u ON u.User_ID = d.User_ID 
         LEFT JOIN payment p ON p.receipt = a.App_Invoice 
         WHERE a.Patient_ID = ? AND 
         ((a.App_Date < CURDATE()) OR (a.App_Date = CURDATE() AND a.App_Time < CURTIME()))
         AND a.Status = 'Completed'
         ORDER BY a.App_Date DESC, a.App_Time DESC;";
$stmt3 = $connection->prepare($sql3);
$stmt3->bind_param("i", $patient_id);
$stmt3->execute();
$result3 = $stmt3->get_result();
$stmt3->close();

// Fetching canceled appointments for the current patient
$sql4 = "SELECT a.Appointment_ID, a.App_Date, a.App_Time, s.Name as service_name, u.Name as doctor_name, 
         d.Specialization as doctor_specialization, p.Refund_Status as Refund_status, p.Status as payment_status 
         FROM appointment a 
         LEFT JOIN services s ON s.Service_ID = a.Service_ID 
         LEFT JOIN doctor d ON d.Doctor_ID = a.Doctor_ID 
         LEFT JOIN user u ON u.User_ID = d.User_ID 
         LEFT JOIN payment p ON p.receipt = a.App_Invoice 
         WHERE a.Patient_ID = ? AND a.Status = 'Canceled'
         ORDER BY a.App_Date DESC, a.App_Time DESC;";
$stmt4 = $connection->prepare($sql4);
$stmt4->bind_param("i", $patient_id);
$stmt4->execute();
$result4 = $stmt4->get_result();
$stmt4->close();
