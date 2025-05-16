<?php
include("../../../database/db.php");

// Initialize response array
$response = ['status' => 'error', 'errors' => []];

// Validate input
if (!isset($_POST['serviceId']) || empty($_POST['serviceId'])) {
    $response['errors']['general'] = 'Service ID is required';
    echo json_encode($response);
    exit;
}

// Get and sanitize input
$serviceId = $connection->real_escape_string($_POST['serviceId']);
$serviceName = isset($_POST['serviceName']) ? $connection->real_escape_string($_POST['serviceName']) : '';
$serviceCategory = isset($_POST['categoryDropdown']) ? $connection->real_escape_string($_POST['categoryDropdown']) : '';
$serviceFee = isset($_POST['serviceFee']) ? $connection->real_escape_string($_POST['serviceFee']) : '';
$serviceDuration = isset($_POST['serviceDuration']) ? $connection->real_escape_string($_POST['serviceDuration']) : '';
$serviceStatus = isset($_POST['statusDropdown']) ? $connection->real_escape_string($_POST['statusDropdown']) : '';
$serviceDescription = isset($_POST['serviceDescription']) ? $connection->real_escape_string($_POST['serviceDescription']) : '';

// Validate form data
$errors = [];

if (empty($serviceName)) {
    $errors['serviceName'] = 'Service name is required';
}

if (empty($serviceCategory) || $serviceCategory === 'selectCategory') {
    $errors['categoryDropdown'] = 'Please select a category';
}

if (empty($serviceFee) || !is_numeric($serviceFee)) {
    $errors['serviceFee'] = 'Please enter a valid fee';
}

if (empty($serviceDuration) || !is_numeric($serviceDuration)) {
    $errors['serviceDuration'] = 'Please enter a valid duration';
}

if (empty($serviceStatus) || $serviceStatus === 'selectAvailability') {
    $errors['statusDropdown'] = 'Please select a status';
}

if (empty($serviceDescription)) {
    $errors['serviceDescription'] = 'Description is required';
}

// If there are errors, return them
if (!empty($errors)) {
    $response['errors'] = $errors;
    echo json_encode($response);
    exit;
}

// Update service in database
$sql = "UPDATE services SET 
        Name = '$serviceName', 
        Type = '$serviceCategory', 
        Fee = '$serviceFee', 
        Service_Duration = '$serviceDuration', 
        Availability = '$serviceStatus', 
        Description = '$serviceDescription' 
        WHERE Service_ID = '$serviceId'";

if ($connection->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = 'Service updated successfully';
} else {
    $response['errors']['general'] = 'Error updating service: ' . $connection->error;
}

echo json_encode($response);
$connection->close();
?>