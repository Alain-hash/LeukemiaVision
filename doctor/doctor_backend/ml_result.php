<?php
include("../../database/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ml_prediction = isset($_POST['ml_prediction']) ? $_POST['ml_prediction'] : '';
    $ml_confidence = isset($_POST['ml_confidence']) ? $_POST['ml_confidence'] : '';
    $blood_smear_image = isset($_POST['image_url']) ? $_POST['image_url'] : '';
    
    if ($ml_prediction && $ml_confidence && $blood_smear_image) {
        
       
    
        $stmt = $conn->prepare("INSERT INTO leukemia_test (patient_id, test_type, , confidence) VALUES (?, 'leukemia', ?, ?)");
        $stmt->bind_param("isd", $patient_id, $ml_prediction, $ml_confidence);
        $stmt->execute();
    }
}
?>