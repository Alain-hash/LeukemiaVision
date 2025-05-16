<?php
session_start();
include("../../database/db.php");


$doctor_id = $_POST['doctor_id'] ?? 0;
$appointment_date = $_POST['date'] ?? '';
$test_id= $_POST['test_id'] ?? '';

$_SESSION['doctor_id'] = $doctor_id;
$_SESSION['date'] = $appointment_date;
$_SESSION['test_id'] = $test_id;

$absencesql = "
    SELECT Date
    FROM absence 
    WHERE Doctor_ID = ? AND Date = ? AND Status = 'Accepted'
";
$stmt = $connection->prepare($absencesql);
$stmt->bind_param("is", $doctor_id, $appointment_date);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
   
    $_SESSION['Absence_message'] = 'Doctor is not available on ' . $appointment_date . '. Kindly choose another day.';
    
    $redirect_url = '';
    if (isset($test_id)) {
        $_SESSION['type'] = 'test';  
        $redirect_url = "../patient_frontend/leukemia-appointment.php";
    } else {
        $_SESSION['type'] = 'treatment';
        $redirect_url = "../patient_frontend/Treatment-appointment.php";
    }
    
    echo json_encode(['success' => false, 'redirect' => $redirect_url]);
} else {

    echo json_encode(['success' => true, 'redirect' => 'payment.php']);
}

$stmt->close();
$connection->close();
exit();
?>