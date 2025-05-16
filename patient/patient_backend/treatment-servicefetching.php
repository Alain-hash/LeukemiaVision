<?php 
session_start();

include("../../database/db.php");
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Patient') {
  header("Location: ../../login.php");
  exit();
}


$user_id = $_SESSION['user_id'];

//Get Patient_ID
$get_patient_id = $connection->prepare("SELECT Patient_ID FROM patient WHERE User_ID = ?");
$get_patient_id->bind_param("i", $user_id);
$get_patient_id->execute();
$result = $get_patient_id->get_result();

$Patient_ID = null;
if ($row = $result->fetch_assoc()) {
    $Patient_ID = $row['Patient_ID'];
}

//Get latest recommended treatment
$Treatment_Name = null;
if ($Patient_ID !== null) {
    $stmt = $connection->prepare("SELECT Treatment_Name FROM Treatment WHERE Patient_ID = ? ORDER BY Treatment_ID DESC LIMIT 1");
    $stmt->bind_param("i", $Patient_ID);
    $stmt->execute();
    $recommendation_result = $stmt->get_result();

    if ($row = $recommendation_result->fetch_assoc()) {
        $Treatment_Name = $row['Treatment_Name'];
    }
    $stmt->close();
}

//Get Service_ID and Service_Duration of treatment
$test = [];
if ($Treatment_Name !== null) {
    $sql = "SELECT s.Service_ID, s.Service_Duration,s.Name
            FROM services s 
            WHERE s.Type = 'Treatment' AND s.Name = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $Treatment_Name);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $test[] = $row;
    }
}

echo json_encode($test);




$sql1 = "SELECT Service_Duration FROM services WHERE Name = 'Treatment';";
$stmt1 = $connection->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($row = $result1->fetch_assoc()) {
    $treatment_service_duration = $row['Service_Duration'];
    $_SESSION['treatment_service_duration'] = $treatment_service_duration;
    $_SESSION['type=treatment']=$row['Type'];
}

$stmt1->close();

?>