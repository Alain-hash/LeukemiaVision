<?php
session_start();
include("../../database/db.php");

// Check if the user is logged in and has the role 'Patient'
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient' && $_SESSION['Status'] != 'Active') {
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
$stmt_patient->close();

// Fetch doctor information
$sql1 = "SELECT u.Name, d.Specialization 
FROM doctor d
JOIN user u ON u.User_ID = d.User_ID
WHERE d.Doctor_ID = ?";

if (!isset($_SESSION['doctor_id'])) {
    $_SESSION['error_message'] = "Doctor ID not set. Please select a doctor first.";
    header("Location: appointment-booking.php");
    exit();
}

$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("i", $_SESSION['doctor_id']);
$stmt1->execute();
$result1 = $stmt1->get_result();
$doctors = [];

while ($row = $result1->fetch_assoc()) {
    $doctors[] = $row;
}
$stmt1->close();

// Fetch service information
$sql2 = "SELECT Name, Fee 
FROM services
WHERE Service_ID = ?";

if (!isset($_SESSION['test_id'])) {
    $_SESSION['error_message'] = "Service ID not set. Please select a service first.";
    header("Location: appointment-booking.php");
    exit();
}

$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("i", $_SESSION['test_id']);
$stmt2->execute();
$result2 = $stmt2->get_result();
$tests = [];

while ($row = $result2->fetch_assoc()) {
    $tests[] = $row;
}
$stmt2->close();

// Fetch institution information
$sql3 = "SELECT Institution_ID FROM clinical_institution LIMIT 1;";
$stmt3 = $connection->prepare($sql3);
$stmt3->execute();
$result3 = $stmt3->get_result();
$row = $result3->fetch_assoc();
$Institution_ID = $row['Institution_ID'];
$stmt3->close();

$payment_success = false;
$payment_message = "";

// Check if form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if payment form was submitted
    if (
        isset($_POST['card-name']) && isset($_POST['card-number']) &&
        isset($_POST['expiry-date']) && isset($_POST['cvv'])
    ) {


        // Sanitize input data to prevent SQL Injection
        $card_name = $connection->real_escape_string($_POST['card-name']);
        $card_number = $connection->real_escape_string(substr($_POST['card-number'], -4));
        $expiry_date = $connection->real_escape_string($_POST['expiry-date']);
        $cvv = $connection->real_escape_string($_POST['cvv']);
        $rand1 = rand(10000, 99999);;
        $_SESSION['rand1'] = $rand1;

        // SQL Query to insert the payment information into the database
        $sql = "INSERT INTO payment (Payment_Type, Status, receipt, Refund_Status, Date) 
                    VALUES ('Credit Card', 'Paid', ?, 'No Refund', CURDATE())";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $_SESSION['rand1']);

        // Execute the query
        $stmt->execute();
        $payment_id = $connection->insert_id;
        $stmt->close();

        // Insert appointment record
        $status = 'Scheduled';

       

        

        // Fix the SQL insertion query by matching columns and values
        $sql_appointment = "INSERT INTO appointment (
    App_Date, App_Time, Status, App_Invoice, Booking_Date, Booking_Time, 
    Doctor_ID, Patient_ID, Clinical_Inst_ID, Service_ID
) 
VALUES (?, ?, ?, ?, CURDATE(), CURTIME(), ?, ?, ?, ?)";

        $stmt_appointment = $connection->prepare($sql_appointment);
        $stmt_appointment->bind_param(
            "ssssiiii",
            $_SESSION['date'],
            $_SESSION['time'],
            $status,
            $_SESSION['rand1'],
            $_SESSION['doctor_id'],
            $patient_id,
            $Institution_ID,
            $_SESSION['test_id']
        );

        $stmt_appointment->execute();
        $appointment_id = $connection->insert_id;
        $stmt_appointment->close();

        // Update payment with appointment ID
        $sql_update_payment = "UPDATE payment SET Appointment_ID = ? WHERE receipt = ?";
        $stmt_update_payment = $connection->prepare($sql_update_payment);
        $stmt_update_payment->bind_param("ii", $appointment_id, $_SESSION['rand1']);
        $stmt_update_payment->execute();
        $stmt_update_payment->close();

        // Redirect to receipt page
        header("Location: ../patient_frontend/payment-online-receipt.php");
        exit();
    }
}
