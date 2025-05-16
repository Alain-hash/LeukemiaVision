<?php
session_start(); 
include("../../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
    $breakStartTime = $_POST['break-start-time'];
    $breakEndTime = $_POST['break-end-time'];
    $bufferTime = (int)$_POST['buffer-time']; // Cast to integer
    // Flag to check if all operations were successful
    $allSuccess = true; 

    // Process each day's schedule
    foreach ($days as $day) {
        // Check if day is active
        $isActive = isset($_POST[strtolower($day) . "-active"]) ? 1 : 0;
        $status = $isActive ? 'Active' : 'Not Active';
        
        $startTime = $_POST[strtolower($day) . "-start-time"];
        $endTime = $_POST[strtolower($day) . "-end-time"];
        
        // Check if record already exists
        $checkSql = "SELECT Schedule_ID FROM Schedule WHERE Day = ?";
        $checkStmt = $connection->prepare($checkSql);
        $checkStmt->bind_param("s", $day);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if ($result->num_rows > 0) {
            // Update existing record
            $row = $result->fetch_assoc();
            $scheduleId = $row['Schedule_ID'];
            
            $updateSql = "UPDATE Schedule 
                         SET Start_Time = ?, 
                             End_Time = ?, 
                             Break_Period_Start = ?, 
                             Break_Period_End = ?, 
                             Buffer_Time = ?,
                             Status = ? 
                         WHERE Schedule_ID = ?";
            
            $updateStmt = $connection->prepare($updateSql);
            $updateStmt->bind_param("ssssisi", 
                                   $startTime, 
                                   $endTime, 
                                   $breakStartTime, 
                                   $breakEndTime,
                                   $bufferTime, // Integer parameter
                                   $status, 
                                   $scheduleId);
            
            if (!$updateStmt->execute()) {
                $allSuccess = false;
                $_SESSION['message'] = "Error updating schedule for $day: " . $connection->error;
                break;
            }
            $updateStmt->close();
        } else {
            // Insert new record
            $insertSql = "INSERT INTO Schedule (Day, Start_Time, End_Time, Break_Period_Start, Break_Period_End, Buffer_Time, Status) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $insertStmt = $connection->prepare($insertSql);
            $insertStmt->bind_param("ssssiss", 
                                  $day, 
                                  $startTime, 
                                  $endTime, 
                                  $breakStartTime, 
                                  $breakEndTime,
                                  $bufferTime, // Integer parameter
                                  $status);
            
            if (!$insertStmt->execute()) {
                $allSuccess = false;
                $_SESSION['message'] = "Error inserting schedule for $day: " . $connection->error;
                break;
            }
            $insertStmt->close();
        }
        
        $checkStmt->close();
    }
    
    if ($allSuccess) {
        $_SESSION['message'] = "Schedule updated successfully!";
    }
    
    header("Location: ../../admin_frontend/admin-schedule_setup.php");
    exit();
}

// Close the database connection
$connection->close();
?>