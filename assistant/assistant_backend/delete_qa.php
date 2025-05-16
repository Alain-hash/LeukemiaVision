<?php
session_start();
include("../../database/db.php");




if (isset($_POST['qa_id']) && !empty($_POST['qa_id'])) {
    $qa_id = intval($_POST['qa_id']);
    $Status='Deleted';
   
    $sql = "UPDATE q_a Set Status=? WHERE QA_ID = ?";
    $stmt = $connection->prepare($sql);
    
    if ($stmt) {
       
        $stmt->bind_param("si", $Status,$qa_id);
        $result = $stmt->execute();
        
        if ($result) {
            
            $_SESSION['success_message'] = "Q&A deleted successfully!";
        } else {
            
            $_SESSION['errorMessage'] = "Failed to delete Q&A. Please try again.";
        }
        
        $stmt->close();
    } else {
        
        $_SESSION['errorMessage'] = "Database error occurred. Please try again.";
    }
} else {
   
    $_SESSION['errorMessage'] = "Invalid request: No Q&A specified for deletion.";
}


header("Location: ../qa.php");
exit();
?>