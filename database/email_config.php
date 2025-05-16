<?php
// File: config/email_config.php

// SMTP server configuration
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'notifications@medicalcenter.example.com');
define('SMTP_PASS', 'your_secure_password_here');
define('SMTP_ENCRYPTION', PHPMailer::ENCRYPTION_STARTTLS);

// Sender information
define('ADMIN_EMAIL', 'admin@medicalcenter.example.com');
define('ADMIN_NAME', 'Medical Center Administration');

// Email templates directory
define('EMAIL_TEMPLATES_DIR', __DIR__ . '/../templates/emails/');

// Other email settings
define('DEBUG_EMAIL', false); // Set to true to enable PHPMailer debugging
define('EMAIL_CHARSET', 'UTF-8');