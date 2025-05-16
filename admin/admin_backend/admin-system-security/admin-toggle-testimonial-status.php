<?php
include("../../../database/db.php");

// Validate input
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['feedbackId']) || !is_numeric($_POST['feedbackId'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid feedback ID']);
    exit;
}

if (!isset($_POST['status']) || ($_POST['status'] !== 'Active' && $_POST['status'] !== 'Inactive')) {
    echo json_encode(['success' => false, 'message' => 'Invalid status value']);
    exit;
}

$feedbackId = intval($_POST['feedbackId']);
$newStatus = $_POST['status'] === 'Active' ? 'Inactive' : 'Active'; // Toggle the status

// Update feedback status
$updateSql = "UPDATE feedback SET Status = ? WHERE Report_ID = ?";
$updateStmt = $connection->prepare($updateSql);
$updateStmt->bind_param("si", $newStatus, $feedbackId);
$result = $updateStmt->execute();

if (!$result) {
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to update testimonial status: ' . $connection->error
    ]);
    exit;
}

// Get updated active testimonial count
$countSql = "SELECT COUNT(*) as total_count FROM feedback WHERE Status = 'Active'";
$countResult = $connection->query($countSql);
$countRow = $countResult->fetch_assoc();
$totalActiveCount = $countRow['total_count'];

echo json_encode([
    'success' => true, 
    'message' => 'Testimonial status updated successfully',
    'new_status' => $newStatus,
    'count' => $totalActiveCount,
    'last_updated' => date("d M Y")
]);
?>