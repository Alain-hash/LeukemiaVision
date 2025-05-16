<?php
require($_SERVER['DOCUMENT_ROOT'] . "/LeukemiaVision/database/db.php");
// Get total number of services
$sql_total = "SELECT COUNT(*) as total FROM services";
$result_total = $connection->query($sql_total);
$total_services = $result_total->fetch_assoc()['total'];

// Get number of active services
$sql_active = "SELECT COUNT(*) as active FROM services WHERE Availability = 1";

$result_active = $connection->query($sql_active);
$active_services = $result_active->fetch_assoc()['active'];

// Calculate inactive services
$inactive_services = $total_services - $active_services;


// Prepare response as JSON
$response = [
    'total' => $total_services,
    'active' => $active_services,
    'inactive' => $inactive_services
];
// Set header to JSON
header('Content-Type: application/json');

// Send JSON response
echo json_encode($response);

$connection->close();
?>