<?php
$CURRDate = date('Y-m-d');

$stmt2 = $connection->prepare("SELECT App_Date FROM appointment");
$stmt2->execute();
$result2 = $stmt2->get_result();
while ($row = $result2->fetch_assoc()) {
    $Date = $row['App_Date'];

    if ($Date < $CURRDate) {
        $stmt = $connection->prepare("UPDATE appointment SET Status = 'Missed' WHERE App_Date = ? AND Status = 'Scheduled'");
        $stmt->bind_param("s", $Date);
        $stmt->execute();
        $stmt->close();
    }
}
$stmt2->close();
?>
