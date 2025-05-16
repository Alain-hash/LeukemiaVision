<?php
session_start();
include("../../database/db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_POST['qa_id']) || empty($_POST['qa_id'])) {
        $_SESSION['error_message'] = "Missing Q&A ID";
        header("location:../qa.php");
        exit();
    }
    
    
    $qa_id = intval($_POST['qa_id']);
    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);
    $status = isset($_POST['status']) ? 'Published' : 'Drafted'; 
    $doctor_id = $_SESSION['doctor_id']; 
    $current_date = date('Y-m-d H:i:s');
    
    
    $stmt = $connection->prepare("UPDATE q_a SET Question = ?, Answer = ?, Status = ?, LastUpdated = ? WHERE QA_ID = ? ");
    
    if ($stmt) {
        $stmt->bind_param('ssssi', $question, $answer, $status, $current_date, $qa_id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Q&A updated successfully.";
        } else {
            $_SESSION['errorMessage'] = "Failed to update Q&A: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['errorMessage'] = "Database error: " . $connection->error;
    }
    
   
    header("location:../qa.php");
    exit();
}