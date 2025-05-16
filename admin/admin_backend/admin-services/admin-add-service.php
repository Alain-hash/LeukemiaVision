<?php
// Start session and include database connection
session_start();
include("../../../database/db.php");

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Admin') {
    header("location: ../../login.php");
    exit();
}

$serviceName = $_POST['serviceName'];
$serviceFee = $_POST['serviceFee'];
$serviceDescription = $_POST['serviceDescription'];
$serviceDuration = $_POST['serviceDuration'];
$statusDropdown = $_POST['statusDropdown'];
$categoryDropdown = $_POST['categoryDropdown'];

// Validate data
$errors = [];

if (empty($serviceName)) {
    $errors['serviceName'] = 'Service name is required';
}

if ($categoryDropdown == 'selectCategory' || empty($categoryDropdown)) {
    $errors['categoryDropdown'] = 'Service category is required';
}

if (empty($serviceFee) || !is_numeric($serviceFee) || $serviceFee < 0) {
    $errors['serviceFee'] = 'Service fee must be a positive number';
}

if (empty($serviceDuration) || !is_numeric($serviceDuration) || $serviceDuration <= 0) {
    $errors['serviceDuration'] = 'Service duration must be a positive number';
}

if ($statusDropdown == 'selectAvailability' || empty($statusDropdown)) {
    $errors['statusDropdown'] = 'Service status is required';
}

if (empty($serviceDescription)) {
    $errors['serviceDescription'] = 'Service description is required';
}

// Return errors if any
if (!empty($errors)) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'errors' => $errors]);
    exit();
}

// Get institution ID
$sql4 = "SELECT Institution_ID FROM clinical_institution LIMIT 1";
$result4 = $connection->query($sql4);

if ($result4 && $row = $result4->fetch_assoc()) {
    $inst_id = $row['Institution_ID'];
} else {
    $inst_id = null;
}

// Insert new service into the database
$sql = "INSERT INTO services (Name, Type, Availability, Fee, Description, Service_Duration, Clinical_Inst_ID) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $connection->prepare($sql);
$stmt->bind_param(
    "sssdsii",
    $serviceName,
    $categoryDropdown,
    $statusDropdown,
    $serviceFee,
    $serviceDescription,
    $serviceDuration,
    $inst_id
);

if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Service added successfully']);
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'errors' => ['general' => 'Failed to add service: ' . $stmt->error]]);
}

$stmt->close();
$connection->close();
?>