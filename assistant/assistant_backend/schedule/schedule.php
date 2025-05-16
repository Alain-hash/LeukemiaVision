<?php 

include("../database/db.php");


// Get selected day from URL parameter, default to the first active day
$selected_day = isset($_GET['day']) ? $_GET['day'] : null;

// Fetch all schedule data first
$sql1 = "SELECT * FROM schedule";
$stmt1 = $connection->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
$scheduleData = array();
$allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$workingDays = [];
$dayStatus = [];

if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $scheduleData[] = $row;
        $workingDays[] = $row['Day'];
        $dayStatus[$row['Day']] = $row['Status'];
        
        // Set default selected day if none is provided in URL
        if ($selected_day === null && $row['Status'] == 'Active') {
            $selected_day = $row['Day'];
        }
    }
}
$stmt1->close();

// If still no selected day (all days might be inactive), just use the first one
if ($selected_day === null && count($scheduleData) > 0) {
    $selected_day = $scheduleData[0]['Day'];
}

// Fetch specific data for the selected day
$selectedDayData = null;
foreach ($scheduleData as $day) {
    if ($day['Day'] == $selected_day) {
        $selectedDayData = $day;
        break;
    }
}

// Convert times to user-friendly format for display
if ($selectedDayData) {
    if ($selectedDayData['Status'] == 'Active') {
        $selectedDayData['Start_Time_Formatted'] = date("g:i A", strtotime($selectedDayData['Start_Time']));
        $selectedDayData['End_Time_Formatted'] = date("g:i A", strtotime($selectedDayData['End_Time']));
        $selectedDayData['Break_Period_Start_Formatted'] = date("g:i A", strtotime($selectedDayData['Break_Period_Start']));
        $selectedDayData['Break_Period_End_Formatted'] = date("g:i A", strtotime($selectedDayData['Break_Period_End']));
    }
}

// Fetch Service Duration
$sql2 = "SELECT Service_Duration FROM services LIMIT 1"; 
$stmt2 = $connection->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->get_result();
$serviceData = $result2->fetch_assoc();
$stmt2->close();

// Fetch Test Services
$sql3 = "SELECT Name FROM services WHERE Type='Test'";
$stmt3 = $connection->prepare($sql3);
$testData = array();
if ($stmt3) {
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    while ($row = $result3->fetch_assoc()) {
        $testData[] = $row['Name'];
    }
    $stmt3->close();
} else {
    echo "Error preparing Test services query: " . $connection->error;
}

// Fetch Treatment Services
$sql4 = "SELECT Name FROM services WHERE Type='Treatment'";
$stmt4 = $connection->prepare($sql4);
$treatmentData = array();
if ($stmt4) {
    $stmt4->execute();
    $result4 = $stmt4->get_result();
    while ($row = $result4->fetch_assoc()) {
        $treatmentData[] = $row['Name'];
    }
    $stmt4->close();
} else {
    echo "Error preparing Treatment services query: " . $connection->error;
}

// Fetch assistant name
$sql5 = "SELECT u.Name as assistantname
        FROM assistant a 
        JOIN user u ON a.User_ID = u.User_ID
        WHERE u.User_ID = ?";

$stmt5 = $connection->prepare($sql5);
$stmt5->bind_param("i", $user_id);
$stmt5->execute();
$result5 = $stmt5->get_result();

// Generate time slots based on start and end times
function generateTimeSlots($startTime, $endTime, $breakStart, $breakEnd, $interval = 60) {
    $timeSlots = [];
    $current = strtotime($startTime);
    $end = strtotime($endTime);
    $breakStartTime = strtotime($breakStart);
    $breakEndTime = strtotime($breakEnd);
    
    while ($current <= $end) {
        $timeSlots[] = [
            'time' => date('g:i A', $current),
            'isBreak' => ($current >= $breakStartTime && $current < $breakEndTime)
        ];
        $current = strtotime('+' . $interval . ' minutes', $current);
    }
    
    return $timeSlots;
}

// Generate time slots for selected day if active
$timeSlots = [];
if ($selectedDayData && $selectedDayData['Status'] == 'Active') {
    $timeSlots = generateTimeSlots(
        $selectedDayData['Start_Time'],
        $selectedDayData['End_Time'],
        $selectedDayData['Break_Period_Start'],
        $selectedDayData['Break_Period_End']
    );
}



//Fetch patients count who are reserved appointment with the dr assigned for the assistant 
$sql6 = "
    SELECT COUNT(*) AS patient_count
    FROM appointment a
    WHERE a.Doctor_ID = (
        SELECT Doctor_ID
        FROM assistant
        WHERE User_ID = ?
    )
    AND a.App_Date = CURDATE() AND a.Status = 'Scheduled' 
";
$stmt6=$connection->prepare($sql6);
$stmt6->bind_param("i",$user_id);
$stmt6->execute();
$result6=$stmt6->get_result();
$row=$result6->fetch_assoc();
$PatientCount=$row['patient_count'];
$stmt6->close();
?>