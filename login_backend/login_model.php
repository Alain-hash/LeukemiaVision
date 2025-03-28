<?php

include_once("../database/db.php");

/**
 * Authenticate a user with email and password
 * 
 * @param string $email User's email
 * @param string $password User's password (plain text)
 * @param mysqli $connection Database connection
 * @return array|false User data as array or false if authentication fails
 */
function authenticateUser($email, $password, $connection) {
    // Prepare the SQL statement
    $stmt = $connection->prepare("SELECT User_ID, Name, Email, Password, Role FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['Password'])) {
            return $user;
        }
    }
    
    return false;
}

/**
 * Store a remember me token for a user
 * 
 * @param int $userId User ID
 * @param string $token Remember me token
 * @param mysqli $connection Database connection
 * @return boolean Success status
 */
function storeRememberMeToken($userId, $token, $connection) {
    // First, delete any existing tokens for this user
    $stmt = $connection->prepare("DELETE FROM remember_tokens WHERE User_ID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    // Insert the new token with expiry date (30 days from now)
    $expiry = date('Y-m-d H:i:s', time() + (86400 * 30));
    
    $stmt = $connection->prepare("INSERT INTO remember_tokens (User_ID, Token, Expiry) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $token, $expiry);
    
    return $stmt->execute();
}

/**
 * Get user by remember me token
 * 
 * @param string $token Remember me token
 * @param mysqli $connection Database connection
 * @return array|false User data or false if token invalid/expired
 */
function getUserByRememberToken($token, $connection) {
    $stmt = $connection->prepare("
        SELECT u.User_ID, u.Name, u.Email, u.Role 
        FROM user u 
        JOIN remember_tokens t ON u.User_ID = t.User_ID 
        WHERE t.Token = ? AND t.Expiry > NOW()
    ");
    
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    }
    
    return false;
}

/**
 * Logout user and clear remember me token
 * 
 * @param int $userId User ID
 * @param mysqli $connection Database connection
 * @return void
 */
function logoutUser($userId, $connection) {
    // Clear token from database
    $stmt = $connection->prepare("DELETE FROM remember_tokens WHERE User_ID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    // Clear cookie
    setcookie('remember_token', '', time() - 3600, "/", "", true, true);
    
    // Clear session
    session_unset();
    session_destroy();
}
?>