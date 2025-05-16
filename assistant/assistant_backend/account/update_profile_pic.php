<?php
session_start();
include("../../../database/db.php");

// Security check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Assistant' || $_SESSION['user_Status'] != 'Active') {
    header("location:../../../unauthorised.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql1 = "SELECT Assistant_ID from assistant WHERE User_ID = ?";
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param('i', $user_id);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $_SESSION['Assistant_ID'] = $row['Assistant_ID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {
    // Validate file upload
    if ($_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../../uploads/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileName = basename($_FILES['profileImage']['name']);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
        // Check file type
        if (in_array($fileType, $allowedTypes)) {
            $newFileName = uniqid('profile_', true) . '.' . $fileType;
            $filePath = $uploadDir . $newFileName;
            
            // Move the uploaded file
            if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $filePath)) {
                // Store the relative path in the database
                $relativePath = '/uploads/' . $newFileName;
                
                // Fix: Use the correct way to access Assistant_ID
                $assistantId = $_SESSION['Assistant_ID'];
                
                // Update the database
                $stmt = $connection->prepare("UPDATE assistant SET profile_image = ? WHERE Assistant_ID = ?");
                $stmt->bind_param("si", $relativePath, $assistantId);
                
                if ($stmt->execute()) {
                    $_SESSION['upload_success'] = "Profile picture updated successfully!";
                } else {
                    $_SESSION['upload_error'] = "Database update failed: " . $connection->error;
                }
                $stmt->close();
            } else {
                $_SESSION['upload_error'] = "Failed to move uploaded file. Check permissions.";
            }
        } else {
            $_SESSION['upload_error'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        // Handle upload errors
        $uploadErrors = [
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
            UPLOAD_ERR_NO_FILE => "No file was uploaded",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
        ];
        $_SESSION['upload_error'] = "Upload error: " . 
            ($uploadErrors[$_FILES['profileImage']['error']] ?? "Unknown error");
    }
    
    // Redirect back to the account page
    header("Location: ../../account.php");
    exit;
} else {
    $_SESSION['upload_error'] = "No file uploaded or invalid request.";
    header("Location: ../../account.php");
    exit;
}
?>