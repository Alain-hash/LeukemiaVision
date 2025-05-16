<?php
include("../../../database/db.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $connection->query("UPDATE  assistant SET Doctor_ID='NULL' WHERE Doctor_ID = $id");
    echo 'Unassignment Successful!';
}
?>