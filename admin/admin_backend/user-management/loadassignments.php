<?php
include("../../../database/db.php");


//--------------get doctor----------------//
$stmt = $connection->prepare("
SELECT 
    user.User_ID, 
    user.Name, 
    doctor.Doctor_ID,
    doctor.Specialization
FROM user
JOIN doctor ON user.User_ID = doctor.User_ID
WHERE user.Role = 'Doctor'
");

$stmt->execute();
$result = $stmt->get_result();

$Doctors = array();
while ($Doctor = $result->fetch_assoc()) {
    $Doctors[] = $Doctor;
}


//--------------get Assistant----------------//
$stmt2 = $connection->prepare("
    SELECT 
        user.Name AS Assistant_Name, 
        assistant.Doctor_ID
    FROM user
    JOIN assistant ON user.User_ID = assistant.User_ID
    WHERE user.Role = 'Assistant'
");

$stmt2->execute();
$result2 = $stmt2->get_result();

$assistants = array();
while ($row = $result2->fetch_assoc()) {
    // Group assistants by Doctor_ID
    if (!isset($assistants[$row['Doctor_ID']])) {
        $assistants[$row['Doctor_ID']] = array();
    }
    $assistants[$row['Doctor_ID']][] = $row['Assistant_Name'];
}

 foreach($Doctors as $Doctor): ?>
    <tr>
      <td><?php echo $Doctor['Name']." - ".$Doctor['Specialization']; ?></td>
      <td>
        <?php 
        if (isset($assistants[$Doctor['Doctor_ID']])){
            echo implode(", ", $assistants[$Doctor['Doctor_ID']]);
        } else {
            echo "No assistants assigned";
        }
        ?>
      </td>
      <td>
        <?php if (isset($assistants[$Doctor['Doctor_ID']])){
        ?>
        <button class="btn btn-sm btn-success unassign-btn" data-id="<?php echo $Doctor['Doctor_ID']; ?>">Unassign</button>
        <?php }else{ ?>
            <button class="btn btn-sm btn-danger unassign-btn disabled"  >No Assignment</button>
         <?php } ?>
      </td>
    </tr>
    <?php endforeach; ?>


