<?php
session_start();

// Include necessary files
include("signup_model.php");

// Check if user has a verification code in session
if (!isset($_SESSION['verification_code']) || !isset($_SESSION['user_email'])) {
    header("Location: registration.php");
    exit();
}

$email = $_SESSION['user_email'];
$emailParts = explode('@', $email);
$maskedEmail = substr($emailParts[0], 0, 3) . '***@' . $emailParts[1];

// Process verification submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_code'])) {
    $submittedCode = $_POST['verification_code'];
    
    if ($submittedCode == $_SESSION['verification_code']) {
        // Verification successful
        // Retrieve form data from session
        $formData = $_SESSION['form_data'];
        
        // Extract form data
        $name = $formData['name'];
        $email = $formData['email'];
        $password = $formData['password'];
        $phone_number = $formData['phone_number'];
        $address = $formData['address'];
        $emergency_contact = $formData['emergency_contact'];
        $birth_date = $formData['birth_date'];
        $gender = $formData['gender'];
        $blood_type = $formData['blood_type'];
        $weight = $formData['weight'];
        $allergies = $formData['allergies'];
        $existing_conditions = $formData['existing_conditions'];
        $role = "Patient"; // Assuming the role is always "Patient"

        // Create user in the database
        if (createUser(
            $name,
            $email,
            $password,
            $phone_number,
            $address,
            $emergency_contact,
            $birth_date,
            $gender,
            $blood_type,
            $weight,
            $allergies,
            $existing_conditions,
            $role,
            $connection
        )) {
            // Clear verification data
            unset($_SESSION['verification_code']);
            unset($_SESSION['user_email']);
            unset($_SESSION['form_data']);
            
            // Set success message
            $_SESSION['verification_success'] = true;
            
            // Redirect to success page or login
            header("Location: registration_success.php");
            exit();
        } else {
            $verificationError = "Failed to create user in the database. Please try again.";
        }
    } else {
        $verificationError = "Invalid verification code. Please try again.";
    }
}

// Resend verification code
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resend_code'])) {
    // You would call your sendVerificationEmail function here
    // For this example, we'll just simulate a resend
    $_SESSION['verification_code'] = rand(100000, 999999);
    $resendSuccess = "A new verification code has been sent to your email.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Email Verification - LeukemiaVision</title>
  <meta name="description" content="Verify your email for LeukemiaVision">
  <meta name="keywords" content="leukemiavision, verification, healthcare">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

  <style>
    body {
      background: url('../assets/img/signback.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .code-input {
      letter-spacing: 15px;
      font-size: 24px;
      text-align: center;
      padding: 0.5rem;
      font-weight: 600;
    }
    
    .email-icon {
      font-size: 3.5rem;
      color: #1977cc;
      margin-bottom: 1rem;
    }
    
    .verify-btn {
      background-color: #1977cc;
      border-color: #1977cc;
      padding: 0.75rem 0;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s ease;
    }
    
    .verify-btn:hover {
      background-color: #166ab9;
      border-color: #166ab9;
      transform: translateY(-2px);
    }
    
    .resend-btn {
      color: #1977cc;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    
    .resend-btn:hover {
      color: #166ab9;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../index.php">Home</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <!-- Page Title -->
          <div class="text-center mb-4">
            <h2 class="fw-bold mb-3">Email Verification</h2>
            <div class="col-lg-10 mx-auto">
              <p class="text-muted">Please verify your email to complete registration</p>
            </div>
          </div>

          <!-- Card with Verification Form -->
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
              <h5 class="card-title mb-0">
                <i class="bi bi-envelope-check-fill me-2"></i>Verify Your Email
              </h5>
            </div>
            <div class="card-body p-4 p-md-5">
              <div class="text-center mb-4">
                <div class="email-icon">
                  <i class="bi bi-envelope-check"></i>
                </div>
                <p class="text-muted">We've sent a 6-digit verification code to</p>
                <p class="fw-bold"><?php echo htmlspecialchars($maskedEmail); ?></p>
              </div>
              
              <?php if (isset($verificationError)): ?>
                <div class="alert alert-danger">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>
                  <?php echo $verificationError; ?>
                </div>
              <?php endif; ?>
              
              <?php if (isset($resendSuccess)): ?>
                <div class="alert alert-success">
                  <i class="bi bi-check-circle-fill me-2"></i>
                  <?php echo $resendSuccess; ?>
                </div>
              <?php endif; ?>
              
              <form method="post" action="verify_email.php">
                <div class="mb-4">
                  <label for="verification_code" class="form-label fw-semibold">
                    <i class="bi bi-shield-lock-fill text-primary me-2"></i>Enter Verification Code
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-shield-lock"></i>
                    </span>
                    <input type="text" class="form-control code-input" id="verification_code" name="verification_code" 
                           maxlength="6" required autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                  </div>
                  <div class="form-text text-center mt-2">Please enter the 6-digit code sent to your email</div>
                </div>
                
                <div class="d-grid gap-2 mt-4">
                  <button type="submit" name="verify_code" class="btn btn-primary btn-lg verify-btn">
                    <i class="bi bi-check-circle-fill me-2"></i>Verify & Continue
                  </button>
                </div>
              </form>
              
              <div class="mt-4 text-center">
                <p class="mb-2">Didn't receive the code?</p>
                <form method="post" action="verify_email.php">
                  <button type="submit" name="resend_code" class="btn btn-link resend-btn">
                    <i class="bi bi-arrow-repeat me-1"></i>Resend Code
                  </button>
                </form>
                <p class="mt-3 small text-muted">Please check your spam folder if you don't see the email</p>
              </div>
            </div>
          </div>
          
          <!-- Additional Security Notes -->
          <div class="mt-4">
            <div class="card bg-light border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">
                  <i class="bi bi-shield-lock-fill text-primary me-2"></i>Verification Tips
                </h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-envelope-check text-primary me-2"></i>
                    Check your inbox and spam folder for the verification email.
                  </li>
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-clock text-primary me-2"></i>
                    The verification code is valid for 30 minutes.
                  </li>
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-question-circle text-primary me-2"></i>
                    Problems with verification? <a href="#" class="text-decoration-none">Contact support</a>.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-light mt-5 py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5 class="fw-bold text-primary mb-3">LeukemiaVision</h5>
          <p class="text-muted">Providing advanced healthcare solutions and patient care.</p>
        </div>
        <div class="col-md-3">
          <h6 class="fw-bold mb-3">Quick Links</h6>
          <ul class="list-unstyled">
            <li><a href="index.html" class="text-decoration-none text-secondary">Home</a></li>
            <li><a href="index.html#about" class="text-decoration-none text-secondary">About Us</a></li>
            <li><a href="index.html#services" class="text-decoration-none text-secondary">Services</a></li>
            <li><a href="index.html#contact" class="text-decoration-none text-secondary">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="fw-bold mb-3">Connect With Us</h6>
          <div class="d-flex gap-3">
            <a href="#" class="text-secondary fs-5"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-secondary fs-5"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-secondary fs-5"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-secondary fs-5"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0 text-muted">&copy; <?php echo date('Y'); ?> LeukemiaVision. All Rights Reserved.</p>
          <p class="small text-muted">
            Designed by <a href="https://bootstrapmade.com/" class="text-decoration-none">BootstrapMade</a> | 
            Distributed by <a href="https://themewagon.com" class="text-decoration-none">ThemeWagon</a>
          </p>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="btn btn-primary btn-lg rounded-circle position-fixed bottom-0 end-0 m-4 shadow" id="back-to-top">
    <i class="bi bi-arrow-up"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script>
    // Auto-focus the verification code input when page loads
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('verification_code').focus();
      
      // Additional validation for numeric input only
      const codeInput = document.getElementById('verification_code');
      codeInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
      });
      
      // Back to top button
      const backToTop = document.getElementById('back-to-top');
      if (backToTop) {
        window.addEventListener('scroll', () => {
          if (window.scrollY > 100) {
            backToTop.classList.add('d-flex');
            backToTop.classList.remove('d-none');
          } else {
            backToTop.classList.add('d-none');
            backToTop.classList.remove('d-flex');
          }
        });
      }
    });
  </script>
</body>
</html>