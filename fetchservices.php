<?php

include("database/db.php");

$stmt1 = $connection->prepare("
    SELECT 
           Name,
           Type,
           Availability,
           Description,
           Service_Duration,
           Fee
           
    FROM services
    LIMIT 3
");

$stmt1->execute();
$result1 = $stmt1->get_result();



