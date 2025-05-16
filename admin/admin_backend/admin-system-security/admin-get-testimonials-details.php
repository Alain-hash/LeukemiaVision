<?php
include("../../../database/db.php");

// Validate input
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_GET['feedbackId']) || !is_numeric($_GET['feedbackId'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid feedback ID']);
    exit;
}

$feedbackId = intval($_GET['feedbackId']);

// Prepare query to get testimonial details
$sql = "SELECT 
    f.Report_ID, 
    f.Doctor_Rating, 
    f.Doctor_Feedback, 
    f.Date, 
    f.Status,
    f.Patient_ID, 
    f.Doctor_ID,
    u.Name AS patient_name,
    du.Name AS doctor_name
FROM 
    feedback f
    JOIN patient p ON f.Patient_ID = p.Patient_ID
    JOIN user u ON p.User_ID = u.User_ID
    LEFT JOIN doctor d ON f.Doctor_ID = d.Doctor_ID
    LEFT JOIN user du ON d.User_ID = du.User_ID
WHERE 
    f.Report_ID = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $feedbackId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Format date
    $formattedDate = date('d M Y', strtotime($row['Date']));
    
    // Format testimonial data
    $testimonial = [
        'report_id' => $row['Report_ID'],
        'patient_name' => htmlspecialchars($row['patient_name']),
        'doctor_name' => htmlspecialchars($row['doctor_name']),
        'doctor_rating' => $row['Doctor_Rating'],
        'doctor_feedback' => nl2br(htmlspecialchars($row['Doctor_Feedback'])),
        'date' => $formattedDate,
        'status' => $row['Status']
    ];
    
    echo json_encode([
        'success' => true,
        'testimonial' => $testimonial
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Testimonial not found'
    ]);
}
?>