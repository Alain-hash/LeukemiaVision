<?php
include("database/db.php");

    $stmt2 = $connection->prepare("
        SELECT Question, Answer 
        FROM q_a 
        WHERE Status = 'Published' 
        AND Date >= CURDATE() - INTERVAL 10 DAY 
        LIMIT 7
    ");
 
$stmt2->execute();
$Q_A_result = $stmt2->get_result(); 


?>