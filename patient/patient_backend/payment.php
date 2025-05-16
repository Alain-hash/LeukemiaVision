<?php 
file_put_contents("debug.log", print_r($_POST, true));
session_start();
include("../../database/db.php");

// Check user authentication
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient' && $_SESSION['Status'] != 'Active') {
    header("Location: ../../login.php");
    exit();
  }

$user_id = $_SESSION['user_id'];


if (isset($_POST['doctor_id']) && isset($_POST['date']) && isset($_POST['test_id']) && isset($_POST['time'])) {
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $test_id = $_POST['test_id'];
    $time = $_POST['time'];
    
    // Store the values in session for use on the payment page
    $_SESSION['doctor_id'] = $doctor_id;
    $_SESSION['date'] = $date;
    $_SESSION['test_id'] = $test_id;
    $_SESSION['time'] = $time;
    
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Missing required parameters"]);
    exit();
}




$connection->close();
?>
