<?php
session_start();
include("../../../database/db.php");

header('Content-Type: application/json');

// Input validation
if (!isset($_POST['doctor_id']) || !isset($_POST['assistant_id'])){
    echo json_encode([
        'success' => false, 
        'message' => 'Doctor and Assistant IDs are required.'
    ]);
    exit;
}

$doctorId = $_POST['doctor_id'];
$assistantId = $_POST['assistant_id'];

// Validate IDs are not empty
if (empty($doctorId) || empty($assistantId)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Please select both a doctor and an assistant.'
    ]);
    exit;
}

try {
    // Validate doctor exists
    $doctorStmt = $connection->prepare("SELECT * FROM doctor WHERE Doctor_ID = ?");
    $doctorStmt->bind_param("i", $doctorId);
    $doctorStmt->execute();
    $doctorResult = $doctorStmt->get_result();

    if ($doctorResult->num_rows == 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'Invalid Doctor ID.'
        ]);
        exit;
    }

    // Validate assistant exists
    $assistantStmt = $connection->prepare("SELECT * FROM assistant WHERE Assistant_ID = ?");
    $assistantStmt->bind_param("i", $assistantId);
    $assistantStmt->execute();
    $assistantResult = $assistantStmt->get_result();

    if ($assistantResult->num_rows == 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'Invalid Assistant ID.'
        ]);
        exit;
    }

    // Check if the assistant is already assigned to a doctor
    $checkAssignmentStmt = $connection->prepare("
        SELECT * FROM assistant 
        WHERE Assistant_ID = ? AND Doctor_ID IS NOT NULL
    ");
    $checkAssignmentStmt->bind_param("i", $assistantId);
    $checkAssignmentStmt->execute();
    $checkAssignmentResult = $checkAssignmentStmt->get_result();

    if ($checkAssignmentResult->num_rows > 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'Assistant is already assigned to a doctor.'
        ]);
        exit;
    }

    // Update the assistant with the doctor ID
    $updateStmt = $connection->prepare("
        UPDATE assistant 
        SET Doctor_ID = ? 
        WHERE Assistant_ID = ?
    ");
    $updateStmt->bind_param("ii", $doctorId, $assistantId);
    
    if ($updateStmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Doctor and Assistant successfully assigned!'
        ]);
    } else {
        throw new Exception("Database update failed");
    }

    // Close statements
    $doctorStmt->close();
    $assistantStmt->close();
    $checkAssignmentStmt->close();
    $updateStmt->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => 'An error occurred: ' . $e->getMessage()
    ]);
}

$connection->close();
?>