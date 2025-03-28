<?php

function validateSignupData($name, $email, $password, $cpassword, $phone_number, $address,
                          $emergency_contact, $birth_date, $gender, $blood_type, $weight, 
                          $allergies, $existing_conditions) {
    $errors = [];

    // Create a data array to maintain the existing logic
    $data = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'cpassword' => $cpassword,
        'phone_number' => $phone_number,
        'address' => $address,
        'emergency_contact' => $emergency_contact,
        'birth_date' => $birth_date,
        'gender' => $gender,
        'blood_type' => $blood_type,
        'weight' => $weight,
        'allergies' => $allergies,
        'existing_conditions' => $existing_conditions
    ];

    // Trim all input values
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
    }

    // Name validation
    if (empty($data['name'])) {
        $errors["name"] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $data['name'])) {
        $errors["name"] = "Name can only contain letters and spaces.";
    }

    // Email validation
    if (empty($data['email'])) {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format.";
    }

    // Password validation
    if (empty($data['password'])) {
        $errors["password"] = "Password is required.";
    } elseif (strlen($data['password']) < 8) {
        $errors["password"] = "Password must be at least 8 characters.";
    }

    // Confirm Password validation
    if (empty($data['cpassword'])) {
        $errors["cpassword"] = "Confirm password is required.";
    } elseif ($data['password'] !== $data['cpassword']) {
        $errors["cpassword"] = "Passwords do not match.";
    }

    // Phone Number validation
    if (empty($data['phone_number'])) {
        $errors["phone_number"] = "Phone number is required.";
    } elseif (!preg_match('/^\d{8,15}$/', $data['phone_number'])) {
        $errors["phone_number"] = "Phone number must be between 8-15 digits.";
    }

    // Birth Date validation
    if (empty($data['birth_date']) || !strtotime($data['birth_date'])) {
        $errors["birth_date"] = "Valid birth date is required.";
    }

    // Gender validation
    if (empty($data['gender'])) {
        $errors["gender"] = "Gender is required.";
    }

    // Blood Type validation
    if (empty($data['blood_type'])) {
        $errors["blood_type"] = "Blood type is required.";
    }

    // Weight validation
    if (empty($data['weight']) || !filter_var($data['weight'], FILTER_VALIDATE_FLOAT)) {
        $errors["weight"] = "Valid weight is required.";
    }
    
    if ($data['weight']>300 || $data['weight']<20){
        $errors["weight"] = "Weight Should be in range(50-300).";
    }

    // Address validation
    if (empty($data['address'])) {
        $errors["address"] = "Address is required.";
    }

    // Emergency Contact validation
    if (empty($data['emergency_contact']) || !preg_match('/^\d{8,15}$/', $data['emergency_contact'])) {
        $errors["emergency_contact"] = "Valid emergency contact is required.";
    }

    // Medical Information validation
    if (empty($data['allergies'])) {
        $errors["allergies"] = "Please specify allergies (or write 'None').";
    }

    if (empty($data['existing_conditions'])) {
        $errors["existing_conditions"] = "Please specify medical conditions (or write 'None').";
    }

    return $errors; // Return errors if any exist
}
?>