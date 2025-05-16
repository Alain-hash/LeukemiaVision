<?php
include ("../../database/db.php");

// Check if the user is logged in and has the role 'Patient'
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient') { 
    header("Location: ../../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the corresponding Patient_ID from the patient table
$sql_patient = "SELECT Patient_ID FROM patient WHERE User_ID = ?";
$stmt_patient = $connection->prepare($sql_patient);
$stmt_patient->bind_param("i", $user_id);
$stmt_patient->execute();
$result_patient = $stmt_patient->get_result();
$row_patient = $result_patient->fetch_assoc();
$patient_id = $row_patient['Patient_ID'];
$stmt_patient->close(); // Added to close the statement

// Fetch Institution_ID for the clinical institution
$sql3 = "SELECT Institution_ID FROM clinical_institution LIMIT 1;"; // Added LIMIT 1 for safety
$stmt3 = $connection->prepare($sql3);
$stmt3->execute();
$result3 = $stmt3->get_result();
$row = $result3->fetch_assoc();
$Institution_ID = $row['Institution_ID'];
$stmt3->close(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate_voucher'])) {

        $doctor_name = $_POST['doctor_name'];
        $doctor_specialization = $_POST['doctor_specialization'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $service_name = $_POST['service_name'];
        $fee = $_POST['fee'];
        
        // Generate a random voucher number and store it in session
        $rand2 = rand(10000, 99999);
        $_SESSION['rand2'] = $rand2;

        // Insert payment record
        $sql_payment = "INSERT INTO payment (Payment_Type, Status, receipt, Refund_Status, Date) 
                        VALUES ('Cash', 'Pending', ?, 'No Refund', CURDATE())";
        
        $stmt_payment = $connection->prepare($sql_payment);
        $stmt_payment->bind_param("i", $_SESSION['rand2']);
        $stmt_payment->execute();
        $payment_id = $connection->insert_id; // Get the payment ID
        $stmt_payment->close();
        
        // Set session variables for doctor and specialization
        $_SESSION['doctor_name'] = $doctor_name;
        $_SESSION['doctor_specialization'] = $doctor_specialization;
        
        // Check if an appointment already exists with the same date and time
        $sql_check_appointment = "SELECT * FROM appointment WHERE Doctor_ID = ? AND App_Date = ? AND App_Time = ?";
        $stmt_check_appointment = $connection->prepare($sql_check_appointment);
        $stmt_check_appointment->bind_param("iss", $_SESSION['doctor_id'], $_SESSION['date'], $_SESSION['time']);
        $stmt_check_appointment->execute();
        $result_check_appointment = $stmt_check_appointment->get_result();
        
        if ($result_check_appointment->num_rows > 0) {
            
            header("Location: ../patient_frontend/leukemia-appointment.php");
            exit();
        } else {
            // Insert new appointment
            $status = 'Scheduled';
            $sql_appointment = "INSERT INTO appointment (
                App_Date, App_Time, Status, App_Invoice, Booking_Date, Booking_Time, Doctor_ID, Patient_ID, Clinical_Inst_ID, Service_ID
            ) 
            VALUES (?, ?, ?, ?, CURDATE(), CURTIME(), ?, ?, ?, ?)";
            
            $stmt_appointment = $connection->prepare($sql_appointment);
            $stmt_appointment->bind_param(
                "sssiiiii",
                $_SESSION['date'],
                $_SESSION['time'],
                $status,
                $_SESSION['rand2'],
                $_SESSION['doctor_id'],
                $patient_id,
                $Institution_ID,
                $_SESSION['test_id']
            );
            
            // Execute the appointment insertion
            $stmt_appointment->execute();
            $appointment_id = $connection->insert_id;
            $stmt_appointment->close();
            
            // Update payment with appointment ID
            $sql_update_payment = "UPDATE payment SET Appointment_ID = ? WHERE receipt = ?";
            $stmt_update_payment = $connection->prepare($sql_update_payment);
            $stmt_update_payment->bind_param("ii", $appointment_id, $_SESSION['rand2']);
            $stmt_update_payment->execute();
            $stmt_update_payment->close();
            
            // Redirect to receipt page
            header("Location: ../patient_frontend/payment-onsite-receipt.php");
            exit();
        }
    
}
?>