<?php
include("../../../database/db.php");

// Get count of active testimonials
$sql = "SELECT COUNT(*) as count FROM feedback WHERE Status = 'Active'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

echo json_encode([
    'count' => $row['count'],
    'last_updated' => date('d M Y')
]);
?>