<?php
session_start();
include("../../database/db.php");
// Check user authentication
if (!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'Patient') {
    header("Location: ../../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get parameters from the request
if (isset($_GET['doctor_id']) && isset($_GET['date']) && isset($_GET['test_id'])) {
    $doctor_id = $_GET['doctor_id'];
    $date = $_GET['date'];
    $test_id = $_GET['test_id'];
        
} else {
    echo json_encode(["error" => "Missing required parameters"]);
    exit();
}
// Debugging: Log received parameters
error_log("Received parameters: doctor_id=$doctor_id, date=$date, test_id=$test_id");

$availableSlots = [];
$dayOfWeek = date('l', strtotime($date));
// Fetch doctor's schedule
$scheduleSql = "SELECT * FROM `schedule` WHERE Day = '$dayOfWeek' And Schedule_ID IN (SELECT Schedule_ID FROM doctor_schedule WHERE Doctor_ID = $doctor_id)
";
$scheduleResult = $connection->query($scheduleSql);
if ($scheduleResult->num_rows == 0) {
    exit();
}

$schedule = $scheduleResult->fetch_assoc();



// Process schedule data
$startTime = new DateTime($schedule['Start_Time']);
$endTime = new DateTime($schedule['End_Time']);
$buffer = $schedule['Buffer_Time'];
$newBuffer = new DateTime($buffer);
$newBuffer = $newBuffer->format("i");
$newBuffer= intval($newBuffer);

$breakStart = isset($schedule['Break_Period_Start']) ? new DateTime($schedule['Break_Period_Start']) : null;
$breakEnd = isset($schedule['Break_Period_End']) ? new DateTime($schedule['Break_Period_End']) : null;

// Fetch service duration
$serviceSql = "SELECT Service_Duration FROM services WHERE Service_ID = ?";
$serviceStmt = $connection->prepare($serviceSql);
$serviceStmt->bind_param("i", $test_id);
$serviceStmt->execute();
$serviceResult = $serviceStmt->get_result();
$service = $serviceResult->fetch_assoc();
$serviceDuration = (int)$service['Service_Duration'];

// Fetch booked appointments
$bookedSlots = [];
$apptSql = "SELECT App_time FROM appointment WHERE Doctor_ID = ? AND App_date >= ? AND Status = 'Scheduled'";
$apptStmt = $connection->prepare($apptSql);
$apptStmt->bind_param("is", $doctor_id, $date);
$apptStmt->execute();
$apptResult = $apptStmt->get_result();

while ($row = $apptResult->fetch_assoc()) {
    $bookedSlots[] = new DateTime($row['App_time']);
}

// Generate available slots
$currentTime = clone $startTime; // Start from the beginning of the schedule

while ($currentTime < $endTime) {
    $slotStart = clone $currentTime;
    $slotEnd = (clone $currentTime)->modify("+$serviceDuration minutes");

    // Check if slot overlaps with break time
    if ($breakStart && $breakEnd && ($slotStart >= $breakStart && $slotStart < $breakEnd)) {
        $currentTime = clone $breakEnd; // Jump to end of break
        continue;
    }

    // Check if the slot is already booked
    $isBooked = false;
    foreach ($bookedSlots as $bookedTime) {
        if ($slotStart <= $bookedTime && $slotEnd > $bookedTime) {
            $isBooked = true;
            break;
        }
    }

    if (!$isBooked) {
        $availableSlots[] = $slotStart->format("h:i A");
        echo "<option value='".$slotStart->format("h:i A")."'>".$slotStart->format("h:i A")."</option>";
    }
    

    // Move to the next slot
    $currentTime->modify("+$serviceDuration minutes")->modify("+$newBuffer minutes");
}