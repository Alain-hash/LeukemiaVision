<?php

function validateDoctorData(
    $username,
    $email,
    $password,
    $lisence_number,
    $date,
    $speciality
) {
    $errors = [];
    // Create a data array to maintain the existing logic
    $data = [
        'name' => $username,
        'email' => $email,
        'password' => $password,
        'lisence_number' => $lisence_number,
        'date' => $date,
        'speciality' => $speciality
    ];

    // Trim all input values
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
    }

    // Name validation
    if (empty($data['name']) || empty($data['email'])|| empty($data['password']) || empty($data['lisence_number']) || empty($data['speciality'])) {
        $errors["errors"] = "fields are required.";
    } 
    return $errors; // Return errors if any exist
}
function validateAssistantData(
    $username,
    $email,
    $password,
    $date,
) {
    $errors = [];

    
    $data = [
        'name' => $username,
        'email' => $email,
        'password' => $password,
        'date' => $date,      
    ];

   
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
    }

   
    if (empty($data['name']) || empty($data['email'])|| empty($data['password']) ) {
        $errors["errors"] = "fields are required.";
    }


    return $errors; 
}

function checkUserExists($username, $email, $connection)
{
    $stmt = $connection->prepare("SELECT User_ID FROM user WHERE Name = ? OR Email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if any results were found
    if ($stmt->num_rows > 0) {
        $stmt->close();
        return true; // user already exists
    } else {
        $stmt->close();
        return false; // user does not exist
    }
}
$errors=$_SESSION['errors'];
?>
