<?php 
session_start();
include("../../database/db.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $Appointment_ID=$_POST['Appointment_ID'];
    

    $stmt="UPDATE appointment SET Status='Completed' WHERE Appointment_ID=?";
    $stmt=$connection->prepare($stmt);
    $stmt->bind_param("i",$Appointment_ID);

    if($stmt->execute()){
        $_SESSION["success"]="Status has been updated successfully";
        header("location:../appointment.php");
        exit();
    }

}else{
    echo "There is an error accessing the data in backend";
}