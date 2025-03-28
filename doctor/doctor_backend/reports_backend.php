<?php 
session_start();

include("../../database/db.php");


if($_SERVER['REQUEST_METHOD']=="POST"){


}

//----------------patient Search----------------//
if (isset($_GET['name'])) {
    $searchTerm = $connection->real_escape_string($_GET['name']);
    $sql = "SELECT Name User_ID FROM user WHERE Name LIKE '%$searchTerm%' AND Role = 'Patient'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Name"] . "'>" . $row["Name"] . "</option>";
        }
    } else {
        echo "<option value=''>No results found</option>";
    }
    $conn->close();
}



//----------------data insertion----------------// 


// Handle patient data retrieval
if (isset($_GET['patient_id'])) {
    $patientId = $_GET['patient_id'];
    $patientId = $conn->real_escape_string($patientId);
    
    // Get the latest leukemia test results for this patient
    $sql = "SELECT * FROM leukemia_tests 
            WHERE Appointment_ID IN (
                SELECT appointment_id FROM appointments WHERE patient_id = '$patientId'
            ) 
            ORDER BY Result_Date DESC 
            LIMIT 1";
    
    $result = $conn->query($sql);
    
    $response = array();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['test_results'] = $row;
        
        // Get the associated treatment data
        $appointmentId = $row['Appointment_ID'];
        $treatmentSql = "SELECT * FROM treatments 
                         WHERE Appointment_ID = '$appointmentId'
                         ORDER BY Result_Date DESC 
                         LIMIT 1";
        
        $treatmentResult = $conn->query($treatmentSql);
        
        if ($treatmentResult->num_rows > 0) {
            $treatmentRow = $treatmentResult->fetch_assoc();
            $response['treatment'] = $treatmentRow;
        }
        
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "No test results found for this patient"]);
    }
}

// Handle saving new test results
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'save_test') {
    // Get form data
    $appointmentId = $conn->real_escape_string($_POST['appointment_id']);
    $testResult = $conn->real_escape_string($_POST['test_result']);
    $resultDate = $conn->real_escape_string($_POST['result_date']);
    $blastCellsPercentage = $conn->real_escape_string($_POST['blast_cells_percentage']);
    $hemoglobin = $conn->real_escape_string($_POST['hemoglobin']);
    $platelets = $conn->real_escape_string($_POST['platelets']);
    $wbcCount = $conn->real_escape_string($_POST['wbc_count']);
    $cancerStage = $conn->real_escape_string($_POST['cancer_stage']);
    
    // Handle image upload
    $smearBloodImage = NULL;
    if(isset($_FILES['smear_blood_image']) && $_FILES['smear_blood_image']['error'] == 0) {
        $targetDir = "uploads/smear_images/";
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $fileName = basename($_FILES["smear_blood_image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if(in_array($fileType, $allowTypes)) {
            // Upload file to server
            if(move_uploaded_file($_FILES["smear_blood_image"]["tmp_name"], $targetFilePath)) {
                $smearBloodImage = $targetFilePath;
            }
        }
    }
    
    // Insert data into leukemia_tests table
    $sql = "INSERT INTO leukemia_tests (Appointment_ID, Test_Result, Result_Date, Blast_Cells_Percentage, 
            Hemoglobin, Platelets, WBC_Count, Cancer_Stage, Smear_Blood_Image) 
            VALUES ('$appointmentId', '$testResult', '$resultDate', '$blastCellsPercentage', 
            '$hemoglobin', '$platelets', '$wbcCount', '$cancerStage', '$smearBloodImage')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => "Test results saved successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

// Handle saving new treatment data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'save_treatment') {
    // Get form data
    $appointmentId = $conn->real_escape_string($_POST['appointment_id']);
    $treatmentName = $conn->real_escape_string($_POST['treatment_name']);
    $treatmentCycle = $conn->real_escape_string($_POST['treatment_cycle']);
    $treatmentProgression = $conn->real_escape_string($_POST['treatment_progression']);
    $nextCycleDate = $conn->real_escape_string($_POST['next_cycle_date']);
    $resultDate = $conn->real_escape_string($_POST['result_date']);
    
    // Insert data into treatments table
    $sql = "INSERT INTO treatments (Appointment_ID, Treatment_Name, Treatment_Cycle, Treatment_Progression, 
            Next_Cycle_Date, Result_Date) 
            VALUES ('$appointmentId', '$treatmentName', '$treatmentCycle', '$treatmentProgression', 
            '$nextCycleDate', '$resultDate')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => "Treatment data saved successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

// Handle AI image analysis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'analyze_image') {
    // In a real application, this would send the image to an AI service
    // For this example, we'll return mock data
    
    // Mock analysis results
    $analysisResults = [
        "test_result" => "Abnormal cells detected, consistent with leukemia.",
        "cancer_stage" => "Stage 2",
        "wbc_count" => rand(12, 20), // Random value between 12 and 20
        "blast_cells_percentage" => rand(25, 40), // Random value between 25 and 40
        "hemoglobin" => round(rand(90, 110) / 10, 1), // Random value between 9.0 and 11.0
        "platelets" => rand(120, 180) // Random value between 120 and 180
    ];
    
    echo json_encode($analysisResults);
}

$conn->close();
?>


