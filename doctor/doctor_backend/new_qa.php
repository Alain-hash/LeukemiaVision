<?php
session_start();
include("../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);
    $action = $_POST['action'] ?? 'draft';
    $category=trim($_POST['category']);
   
    if ($action === 'publish') {
        $status = 'Published';
    } else {
        $status = 'Drafted';
    }

    $doctor_id = $_SESSION['doctor_id'];
    $current_date = date('Y-m-d H:i:s');

    if (empty($question) || empty($answer) || empty($category) ) {
        $_SESSION['requied_fields'] = " fields are required.";
    }

   

    if (!empty($_SESSION['requied_fields'])) {
        header("location:../qa.php");
        exit();
    }

    $stmt = $connection->prepare("INSERT INTO q_a (Doctor_ID, Question, Answer, Status,Category,LastUpdated) VALUES (?,?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("isssss", $doctor_id, $question, $answer, $status,$category, $current_date);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Q&A " . strtolower($status) . " successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to add Q&A: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['errorMessage'] = "Database error: " . $connection->error;
    }

    header("location:../qa.php");
    exit();
}
?>
