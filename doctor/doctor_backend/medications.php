<?php
include("../../database/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start the session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $user_id = $_POST['patientid'];
    $med_name = $_POST['med_name']; 
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $form = $_POST['form'];
    $additional_notes = $_POST['additional_notes'];
    $prescription_date = date("Y-m-d");

    $sql = "SELECT Patient_ID FROM patient WHERE User_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $patient_id = $row['Patient_ID'];
   
        $sql_insert = "INSERT INTO medications (
            Med_Name, Dosage, Frequency, Start_Date, End_Date, Form, Additional_Notes, Status,Prescription_Date, Patient_ID
        ) VALUES (?, ?, ?, ?, ?, ?, ?, 'Active',?, ?)";
    
        $stmt_insert = $connection->prepare($sql_insert);
        $stmt_insert->bind_param("ssssssssi", $med_name, $dosage, $frequency, $start_date, $end_date, $form, $additional_notes,$prescription_date, $patient_id);

        if ($stmt_insert->execute()) {
            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_message'] = "Prescription for $med_name was successfully added to the patient's record.";
        } else {
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_message'] = "Unable to add prescription. Error: " . $stmt_insert->error;
        }
    } else {
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_message'] = "Patient with ID $user_id was not found in our records. Please verify the patient ID.";
    }

    $connection->close();
    
    
    header("Location: ../medications.php");
    exit();
}
?>