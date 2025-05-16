<?php
// process_testimonial.php
session_start();
include("database/db.php");

// Function to redirect with error message
function redirectWithError($message, $type = "danger") {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    header("Location: index.php#testimonials");
    exit();
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize error array
    $errors = [];
    
    // Get form data without sanitizing initially (for validation checks)
    $patient_id = isset($_SESSION['patient_id']) ? $_SESSION['patient_id'] : null;
    $doctor_id = isset($_POST['doctor_id']) ? $_POST['doctor_id'] : null;
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    $feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : null;
    
    // Validate patient ID
    if (empty($patient_id) || !is_numeric($patient_id)) {
        $errors[] = "Invalid patient information. Please try logging in again.";
    }
    
    // Validate doctor selection
    if (empty($doctor_id) || !is_numeric($doctor_id)) {
        $errors[] = "Please select a doctor.";
    } else {
        // Verify doctor exists in database
        $doctor_check = $connection->prepare("SELECT Doctor_ID FROM doctor WHERE Doctor_ID = ?");
        $doctor_check->bind_param("i", $doctor_id);
        $doctor_check->execute();
        $doctor_result = $doctor_check->get_result();
        
        if ($doctor_result->num_rows === 0) {
            $errors[] = "Selected doctor does not exist.";
        }
        $doctor_check->close();
    }
    
    // Validate rating
    if (empty($rating) || !is_numeric($rating) || $rating < 1 || $rating > 5) {
        $errors[] = "Please provide a valid rating between 1 and 5.";
    }
    
    // Validate feedback text
    if (empty($feedback)) {
        $errors[] = "Feedback cannot be empty.";
    } elseif (strlen($feedback) < 20) {
        $errors[] = "Feedback must be at least 20 characters long.";
    } elseif (strlen($feedback) > 500) {
        $errors[] = "Feedback cannot exceed 500 characters.";
    }
    
    // Check for existing feedback from this patient for this doctor
    $existing_check = $connection->prepare("SELECT Report_ID FROM feedback WHERE Patient_ID = ? AND Doctor_ID = ? AND Date > DATE_SUB(NOW(), INTERVAL 30 DAY)");
    $existing_check->bind_param("ii", $patient_id, $doctor_id);
    $existing_check->execute();
    $existing_result = $existing_check->get_result();
    
    if ($existing_result->num_rows > 0) {
        $errors[] = "You have already submitted feedback for this doctor in the last 30 days.";
    }
    $existing_check->close();
    
    // If there are validation errors, redirect back with error message
    if (!empty($errors)) {
        redirectWithError(implode("<br>", $errors));
    }
    
    // Now sanitize the validated data
    $doctor_id = filter_var($doctor_id, FILTER_SANITIZE_NUMBER_INT);
    $rating = filter_var($rating, FILTER_SANITIZE_NUMBER_INT);
    $feedback = filter_var($feedback, FILTER_SANITIZE_SPECIAL_CHARS);
    $date = date("Y-m-d"); // Current date
    $status = "Inactive";
    
    // Prepare SQL statement to insert feedback
    $sql = "INSERT INTO feedback (Patient_ID, Doctor_ID, Doctor_Rating, Doctor_Feedback, Date, Status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("iiisss", $patient_id, $doctor_id, $rating, $feedback, $date, $status);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Log the successful submission
            error_log("Testimonial submitted successfully by Patient ID: $patient_id for Doctor ID: $doctor_id");
            
            redirectWithError("Thank you for your feedback! It will be reviewed before being published.", "success");
        } else {
            // Log the error
            error_log("Database error when submitting testimonial: " . $stmt->error);
            redirectWithError("Error submitting your testimonial. Please try again later.");
        }
        
        $stmt->close();
    } else {
        // Log the error
        error_log("Prepare statement failed: " . $connection->error);
        redirectWithError("System error. Please try again later or contact support.");
    }
} else {
    // If accessed directly without form submission
    header("Location: index.php");
    exit();
}
?>