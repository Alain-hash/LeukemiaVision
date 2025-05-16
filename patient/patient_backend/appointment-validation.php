<?php
session_start();
include("../../database/db.php");

// Check user authentication
if (!isset($_SESSION['user_id']) || $_SESSION['Role'] != 'Patient' || $_SESSION['Status'] != 'Active') {
    header("Location: ../../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$errors = []; // Array to store validation errors

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Preserve form inputs in session for repopulating the form
    $_SESSION['doctor_id'] = $_POST['doctor'] ?? '';
    $_SESSION['test_id'] = $_POST['test'] ?? '';
    $_SESSION['date'] = $_POST['date'] ?? '';
    $_SESSION['time'] = $_POST['time'] ?? '';
    
    // Validate doctor selection
    if (empty($_POST['doctor'])) {
        $errors['doctor'] = "Please select a doctor.";
    } else {
        $doctor_id = $_POST['doctor'];
        
        // Verify doctor exists in database
        $sql_check_doctor = "SELECT Doctor_ID FROM doctor WHERE Doctor_ID = ?";
        $stmt_check_doctor = $connection->prepare($sql_check_doctor);
        $stmt_check_doctor->bind_param("i", $doctor_id);
        $stmt_check_doctor->execute();
        $result_check_doctor = $stmt_check_doctor->get_result();
        
        if ($result_check_doctor->num_rows == 0) {
            $errors['doctor'] = "Selected doctor does not exist.";
        }
        $stmt_check_doctor->close();
    }
    
    // Validate test/service selection
    if (empty($_POST['test'])) {
        $errors['test'] = "Please select a test or service.";
    } else {
        $test_id = $_POST['test'];
        
        // Verify test exists in database
        $sql_check_test = "SELECT Service_ID FROM services WHERE Service_ID = ?";
        $stmt_check_test = $connection->prepare($sql_check_test);
        $stmt_check_test->bind_param("i", $test_id);
        $stmt_check_test->execute();
        $result_check_test = $stmt_check_test->get_result();
        
        if ($result_check_test->num_rows == 0) {
            $errors['test'] = "Selected test/service does not exist.";
        }
        $stmt_check_test->close();
    }
    
    // Validate date
    if (empty($_POST['date'])) {
        $errors['date'] = "Please select a date.";
    } else {
        $selected_date = $_POST['date'];
        $current_date = date('Y-m-d');
        
        // Check if date is in the future
        if ($selected_date < $current_date) {
            $errors['date'] = "Selected date must be today or in the future.";
        }
        
        // Verify that the doctor works on the selected day
        if (isset($doctor_id) && empty($errors['doctor'])) {
            $day_of_week = date('l', strtotime($selected_date));
            
            $sql_check_schedule = "SELECT s.Schedule_ID FROM schedule s 
                                   JOIN doctor_schedule ds ON s.Schedule_ID = ds.Schedule_ID 
                                   WHERE ds.Doctor_ID = ? AND s.Day = ?";
            $stmt_check_schedule = $connection->prepare($sql_check_schedule);
            $stmt_check_schedule->bind_param("is", $doctor_id, $day_of_week);
            $stmt_check_schedule->execute();
            $result_check_schedule = $stmt_check_schedule->get_result();
            
            if ($result_check_schedule->num_rows == 0) {
                $errors['date'] = "The selected doctor is not available on this day.";
            }
            $stmt_check_schedule->close();
        }
    }
    
    // Validate time slot
    if (empty($_POST['time'])) {
        $errors['time'] = "Please select a time slot.";
    } else {
        $selected_time = $_POST['time'];
        
        // Verify the time slot is available for the doctor on the selected date
        if (isset($doctor_id) && isset($selected_date) && isset($test_id) && 
            empty($errors['doctor']) && empty($errors['date']) && empty($errors['test'])) {
            
            // Check if the slot is already booked
            $sql_check_slot = "SELECT App_ID FROM appointment 
                              WHERE Doctor_ID = ? AND App_Date = ? AND App_Time = ? AND Status = 'Scheduled'";
            $stmt_check_slot = $connection->prepare($sql_check_slot);
            $stmt_check_slot->bind_param("iss", $doctor_id, $selected_date, $selected_time);
            $stmt_check_slot->execute();
            $result_check_slot = $stmt_check_slot->get_result();
            
            if ($result_check_slot->num_rows > 0) {
                $errors['time'] = "This time slot is already booked. Please select another one.";
            }
            $stmt_check_slot->close();
            
            // Validate if the selected time falls within the doctor's schedule
            if (empty($errors['time'])) {
                $day_of_week = date('l', strtotime($selected_date));
                
                $sql_check_time = "SELECT s.Start_Time, s.End_Time, s.Break_Period_Start, s.Break_Period_End 
                                  FROM schedule s 
                                  JOIN doctor_schedule ds ON s.Schedule_ID = ds.Schedule_ID 
                                  WHERE ds.Doctor_ID = ? AND s.Day = ?";
                $stmt_check_time = $connection->prepare($sql_check_time);
                $stmt_check_time->bind_param("is", $doctor_id, $day_of_week);
                $stmt_check_time->execute();
                $result_check_time = $stmt_check_time->get_result();
                
                if ($result_check_time->num_rows > 0) {
                    $schedule = $result_check_time->fetch_assoc();
                    
                    // Convert the time formats for comparison
                    $selected_time_24h = date("H:i:s", strtotime($selected_time));
                    $start_time = $schedule['Start_Time'];
                    $end_time = $schedule['End_Time'];
                    $break_start = $schedule['Break_Period_Start'];
                    $break_end = $schedule['Break_Period_End'];
                    
                    // Check if the selected time is within the doctor's working hours
                    if ($selected_time_24h < $start_time || $selected_time_24h > $end_time) {
                        $errors['time'] = "Selected time is outside the doctor's working hours.";
                    }
                    
                    // Check if the selected time is during break period
                    if ($break_start && $break_end && $selected_time_24h >= $break_start && $selected_time_24h <= $break_end) {
                        $errors['time'] = "Selected time is during the doctor's break period.";
                    }
                }
                $stmt_check_time->close();
            }
        }
    }
    
    // If there are no errors, proceed with appointment booking
    if (empty($errors)) {
        // Keep validated information in session for the payment page 
        // These are already set above
        
        // Redirect to payment page
        header("Location: ../patient_frontend/payment.php");
        exit();
    } else {
        // Store error messages in session to display them
        $_SESSION['form_errors'] = $errors;
        
        // Redirect back to the appointment form
        header("Location: ../patient_frontend/leukemia-appointment.php");
        exit();
    }
}
?>