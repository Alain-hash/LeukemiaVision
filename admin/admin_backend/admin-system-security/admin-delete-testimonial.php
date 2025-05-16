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

// No longer need reviewType since we're only handling doctor testimonials
$feedbackId = intval($_POST['feedbackId']);

// Update feedback status to 'Inactive' instead of deleting
$updateSql = "UPDATE feedback SET Status='Inactive' WHERE Report_ID = ?";
$updateStmt = $connection->prepare($updateSql);
$updateStmt->bind_param("i", $feedbackId);
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
$totalCount = $countRow['total_count'];

echo json_encode([
    'success' => true, 
    'message' => 'Testimonial status updated successfully',
    'count' => $totalCount,
    'last_updated' => date("d M Y")
]);
?>