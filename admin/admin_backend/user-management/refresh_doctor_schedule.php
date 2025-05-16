<?php

// Fetch all active Schedule_IDs
$schedule_ids = [];
$stmt = $connection->prepare("SELECT Schedule_ID FROM Schedule WHERE Status = 'Active'");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $schedule_ids[] = $row['Schedule_ID'];
}
$stmt->close();

// Fetch the newest active Doctor_ID
$doctor_id = null;
$stmt = $connection->prepare("
    SELECT Doctor.Doctor_ID 
    FROM Doctor 
    JOIN User ON Doctor.User_ID = User.User_ID 
    WHERE User.Status = 'Active'
    ORDER BY Doctor.Doctor_ID DESC
    LIMIT 1
");
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $doctor_id = $row['Doctor_ID'];
}
$stmt->close();

// Assign each Schedule_ID to the newest Doctor_ID
if ($doctor_id !== null) {
    // Prepare SELECT and INSERT statements
    $checkStmt = $connection->prepare("
        SELECT 1 FROM doctor_schedule 
        WHERE Doctor_ID = ? AND Schedule_ID = ?
    ");
    $insertStmt = $connection->prepare("
        INSERT INTO doctor_schedule (Doctor_ID, Schedule_ID) 
        VALUES (?, ?)
    ");

    foreach ($schedule_ids as $schedule_id) {
        // Avoid duplicate entry
        $checkStmt->bind_param("ii", $doctor_id, $schedule_id);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows === 0) {
            $insertStmt->bind_param("ii", $doctor_id, $schedule_id);
            $insertStmt->execute();
        }
    }

    $checkStmt->close();
    $insertStmt->close();
}
?>
