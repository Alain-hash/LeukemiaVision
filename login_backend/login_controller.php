<?php

function validateLoginData($email, $password) {
    $errors = [];

    // Create a data array to maintain the existing logic
    $data = [
        'email' => $email,
        'password' => $password,
    ];

    // Trim all input values
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
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
    }

    return $errors; // Return errors if any exist
}
?>