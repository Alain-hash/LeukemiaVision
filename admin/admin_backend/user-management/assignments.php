<?php
session_start();
require("../../../database/db.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (empty($_POST['doctor_id']) || empty($_POST['assistant_id'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Both doctor and assistant IDs are required. Received: ' . 
                     'doctor=' . (isset($_POST['doctor_id']) ? $_POST['doctor_id'] : 'none') . ', ' .
                     'assistant=' . (isset($_POST['assistant_id']) ? $_POST['assistant_id'] : 'none')
    ]);
    exit;
}
$doctorId = (int)$_POST['doctor_id'];
$assistantId = (int)$_POST['assistant_id'];

// Verify the IDs exist in their respective tables
$doctorCheck = $connection->prepare("SELECT COUNT(*) FROM doctor WHERE User_ID = ?");
$doctorCheck->bind_param("i", $doctorId);
$doctorCheck->execute();
$doctorCheck->bind_result($doctorExists);
$doctorCheck->fetch();
$doctorCheck->close();

$assistantCheck = $connection->prepare("SELECT COUNT(*) FROM assistant WHERE User_ID = ?");
$assistantCheck->bind_param("i", $assistantId);
$assistantCheck->execute();
$assistantCheck->bind_result($assistantExists);
$assistantCheck->fetch();
$assistantCheck->close();

if (!$assistantExists) {
    echo json_encode(['success' => false, 'message' => "Assistant with ID $assistantId does not exist"]);
    exit;
}

if (!$doctorExists) {
    echo json_encode(['success' => false, 'message' => "Doctor with ID $doctorId does not exist"]);
    exit;
}

$stmt1 = $connection->prepare("SELECT Doctor_ID from doctor where User_ID = ?");
$stmt1->bind_param("i",$doctorId);
$stmt1->execute();
$result = $stmt1->get_result();
$stmt1->close();
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $docID = $row['Doctor_ID'];
}
$stmt = $connection->prepare("UPDATE assistant SET Doctor_ID = ? WHERE User_ID = ?");

if (!$stmt) {
    echo json_encode([
        'success' => false, 
        'message' => 'Prepare statement failed: ' . $connection->error
    ]);
    exit;
}

$stmt->bind_param("ii", $docID, $assistantId); // Use integers for both parameters

if ($stmt->execute()) {
    // Check if any rows were actually affected
    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'success' => true
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => "No records updated. Assistant #$assistantId may already be assigned to this doctor."
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Assignment failed: ' . $stmt->error
    ]);
}

$stmt->close();
$connection->close();

}else{
    echo json_encode(['success' => false, 'message' => 'Please use POST method']);
    exit;
}


?>