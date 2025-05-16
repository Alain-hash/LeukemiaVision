<?php
include("../../../database/db.php");

// Initialize response array
$response = ['status' => 'error', 'message' => ''];

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $response['message'] = 'Service ID is required';
    echo json_encode($response);
    exit;
}

// Get and sanitize input
$serviceId = $connection->real_escape_string($_GET['id']);

// Get service data
$sql = "SELECT * FROM services WHERE Service_ID = '$serviceId'";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $service = $result->fetch_assoc();
    $response['status'] = 'success';
    $response['data'] = $service;
} else {
    $response['message'] = 'Service not found';
}

echo json_encode($response);
$connection->close();
?>