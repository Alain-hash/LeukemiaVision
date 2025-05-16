$stmt = $connection->prepare("
        SELECT Date,
        Reason 
        FROM absence 
        WHERE Absence_ID = ?
    ");
    $stmt->bind_param("i", $absenceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    return $row;