<?php
session_start();
include("../../database/db.php");


unset($_SESSION['searchResults']);
unset($_SESSION['errorMessage']);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['questionsearch'])) {
    $searchTerm = trim($_POST['questionsearch']);
    
    if (empty($searchTerm)) {
        $_SESSION['errorMessage'] = "Please enter a search term.";
    } else {
        try {
          
            $sql = "SELECT Doctor_ID,QA_ID, Question, Answer, Status, Category, LastUpdated FROM q_a WHERE Category LIKE ?";
            $stmt = $connection->prepare($sql);
            
            if ($stmt) {
             
                $searchParam = "%" . $searchTerm . "%";
                $stmt->bind_param("s", $searchParam);
                $stmt->execute();
                $result = $stmt->get_result();
                
                
                $searchResults = [];
                while ($row = $result->fetch_assoc()) {
                    $searchResults[] = $row;
                }
                
                if (count($searchResults) > 0) {
                    $_SESSION['searchResults'] = $searchResults;
                } else {
                    $_SESSION['errorMessage'] = "No questions found matching '{$searchTerm}'.";
                }
                
                $stmt->close();
            } else {
                $_SESSION['errorMessage'] = "Database query failed.";
            }
        } catch (Exception $e) {
            $_SESSION['errorMessage'] = "An error occurred: " . $e->getMessage();
        }
    }
}


header("Location: ../qa.php");
exit();
?>