<?php
session_start();
include("../../database/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$errors = [];
$field_errors = array_fill_keys([
    'fullName', 'phoneNumber', 'address', 'emergencyContact', 'dateofbirth', 
    'gender', 'bloodType', 'weight', 'allergies', 'existingConditions', 'profileImage'
], '');

$default_image_path = "assets/img/default_profile_image.png";
$profile_image = $default_image_path;

// Check for flash messages from session
$success_message = "";
$error_message = "";

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the message after displaying once
}

if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Clear the message after displaying once
}

// Fetch user info
$query = $connection->prepare("SELECT name, email FROM user WHERE User_ID = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->bind_result($full_name, $email);
$query->fetch();
$query->close();

// Fetch patient info
$query = $connection->prepare("SELECT * FROM patient WHERE User_ID = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    $patient_id = $row['Patient_ID'];
    $phone_number = $row['Phone_Number'];
    $address = $row['Address'];
    $emergency_contact = $row['Emergency_Contact'];
    $birth_date = $row['Birth_Date'];
    $gender = $row['Gender'];
    $blood_type = $row['Blood_Type'];
    $weight = $row['Weight'];
    $allergies = $row['Allergies'];
    $existing_conditions = $row['Existing_Conditions'];
    $profile_image = !empty($row['profile_image']) ? "../../" . $row['profile_image'] : "../../" . $default_image_path;
}
$query->close();

// Handle Remove Photo action
if (isset($_POST['remove_photo'])) {
    $db_file_path = str_replace("../../", "", $profile_image);
    
    // If current image is not the default, delete it
    if ($db_file_path !== $default_image_path && file_exists("../../" . $db_file_path)) {
        @unlink("../../" . $db_file_path);
    }
    
    // Update database with default image path
    $stmt = $connection->prepare("UPDATE patient SET profile_image = ? WHERE User_ID = ?");
    $stmt->bind_param("si", $default_image_path, $user_id);
    
    if ($stmt->execute()) {
        // Update the display image path for the current page
        $profile_image = "../../" . $default_image_path;
        $_SESSION['success_message'] = "Profile photo removed successfully!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['error_message'] = "Error removing profile photo: " . $stmt->error;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    $stmt->close();
}

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST['remove_photo'])) {
    // Input sanitization
    $full_name = trim($_POST['fullName']);
    $phone_number = trim($_POST['phoneNumber']);
    $address = trim($_POST['address']);
    $emergency_contact = trim($_POST['emergencyContact']);
    $birth_date = trim($_POST['dateofbirth']);
    $gender = $_POST['gender'] ?? '';
    $blood_type = $_POST['bloodType'];
    $weight = trim($_POST['weight']);
    $allergies = trim($_POST['allergies']);
    $existing_conditions = trim($_POST['existingConditions']);
    $db_file_path = str_replace("../../", "", $profile_image);

    // Validation
    if (empty($full_name) || strlen($full_name) < 3 || strlen($full_name) > 50) {
        $field_errors['fullName'] = "Full name must be between 3 and 50 characters";
    }
    if (!preg_match("/^[0-9+\-\s]{8,15}$/", $phone_number)) {
        $field_errors['phoneNumber'] = "Enter a valid phone number";
    }
    if (empty($address)) {
        $field_errors['address'] = "Address is required";
    }
    if (!preg_match("/^[0-9+\-\s]{8,15}$/", $emergency_contact)) {
        $field_errors['emergencyContact'] = "Enter a valid emergency contact number";
    }
    if (empty($birth_date) || (new DateTime($birth_date)) > new DateTime()) {
        $field_errors['dateofbirth'] = "Enter a valid birth date";
    }
    if (empty($gender)) {
        $field_errors['gender'] = "Select gender";
    }
    if (!in_array($blood_type, ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
        $field_errors['bloodType'] = "Select valid blood type";
    }
    if (!is_numeric($weight) || $weight <= 0 || $weight > 500) {
        $field_errors['weight'] = "Enter valid weight";
    }

    // Handle new upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $field_errors['profileImage'] = "Invalid image format";
        } elseif ($_FILES['profileImage']['size'] > 5 * 1024 * 1024) {
            $field_errors['profileImage'] = "Image exceeds 5MB";
        } else {
            $upload_dir = "../../uploads/profile_images/";
            if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);
            $new_filename = uniqid() . "." . $ext;
            $target_path = $upload_dir . $new_filename;
            if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $target_path)) {
                // If there was a previous image that wasn't the default, delete it
                if ($db_file_path !== $default_image_path && file_exists("../../" . $db_file_path)) {
                    @unlink("../../" . $db_file_path);
                }
                $db_file_path = "uploads/profile_images/" . $new_filename;
            } else {
                $field_errors['profileImage'] = "Upload failed";
            }
        }
    }

    // Check errors
    if (!array_filter($field_errors)) {
        $stmt = $connection->prepare("UPDATE user SET name = ? WHERE User_ID = ?");
        $stmt->bind_param("si", $full_name, $user_id);
        $stmt->execute();

        $stmt = $connection->prepare("UPDATE patient SET Phone_Number=?, Address=?, Emergency_Contact=?, Birth_Date=?, Gender=?, Blood_Type=?, Weight=?, Allergies=?, Existing_Conditions=?, profile_image=? WHERE User_ID=?");
        $stmt->bind_param("ssssssdsssi", $phone_number, $address, $emergency_contact, $birth_date, $gender, $blood_type, $weight, $allergies, $existing_conditions, $db_file_path, $user_id);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Profile updated successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['error_message'] = "Database error: " . $stmt->error;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

$connection->close();
?>