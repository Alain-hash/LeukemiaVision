<?php
session_start();

// Store form data for repopulation after validation errors
$old_email = isset($_SESSION['old_input']['email']) ? htmlspecialchars($_SESSION['old_input']['email']) : '';
$remember_checked = isset($_SESSION['old_input']['rememberMe']) ? 'checked' : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Patient Login - LeukemiaVision</title>
  <meta name="description" content="Login to your LeukemiaVision patient account">
  <meta name="keywords" content="LeukemiaVision, login, healthcare, patient portal">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    body {
      background: url('assets/img/signback.jpg') no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body>
  <!-- Header from main template -->
  <header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@leukemivision.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+961 76 491 905</span></i>
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
        <a href="index.php" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.php">Home</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
          <!-- Page Title -->
          <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Patient Login</h2>
            <div class="col-lg-8 mx-auto">
              <p class="text-muted">Access your healthcare services and appointments</p>
            </div>
          </div>
          <!-- Card with Form -->
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
              <h5 class="card-title mb-0">
                <i class="bi bi-person-circle me-2"></i>Account Access
              </h5>
            </div>
            <div class="card-body p-4">
              
              <!-- Success message -->
              <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                  <i class="bi bi-check-circle-fill fs-4 me-2"></i>
                  <div>
                    <?php 
                      echo $_SESSION['success'];
                      unset($_SESSION['success']);
                    ?>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              
              <!-- Error message - for general errors -->
              <?php if (isset($_SESSION['errors']) && !is_array($_SESSION['errors'])): ?>
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                  <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                  <div>
                    <?php
                      echo $_SESSION['errors'];
                      unset($_SESSION['errors']);
                    ?>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              
              <!-- Login Form -->
              <form id="loginForm" class="needs-validation" action="login_backend/login_server.php" method="POST" novalidate>
                <!-- Email -->
                <div class="mb-4">
                  <label for="email" class="form-label fw-semibold">
                    <i class="bi bi-envelope-fill text-primary me-2"></i>Email Address
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input 
                      type="email" 
                      class="form-control <?php echo (isset($_SESSION['errors']['email'])) ? 'is-invalid' : ''; ?>" 
                      id="email" 
                      name="email" 
                      placeholder="Enter your email address" 
                      value="<?php echo $old_email; ?>"
                      required
                    >
                    <?php if (isset($_SESSION['errors']['email'])): ?>
                      <div class="invalid-feedback">
                        <?php echo $_SESSION['errors']['email']; ?>
                      </div>
                    <?php else: ?>
                      <div class="invalid-feedback">
                        Please enter a valid email address.
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                  <label for="password" class="form-label fw-semibold">
                    <i class="bi bi-lock-fill text-primary me-2"></i>Password
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-lock-fill"></i>
                    </span>
                    <input 
                      type="password" 
                      class="form-control <?php echo (isset($_SESSION['errors']['password'])) ? 'is-invalid' : ''; ?>" 
                      id="password" 
                      name="password" 
                      placeholder="Enter your password" 
                      required
                    >
                    <button 
                      class="btn btn-outline-secondary" 
                      type="button" 
                      id="togglePassword" 
                      aria-label="Toggle password visibility"
                    >
                      <i class="bi bi-eye"></i>
                    </button>
                    <?php if (isset($_SESSION['errors']['password'])): ?>
                      <div class="invalid-feedback">
                        <?php echo $_SESSION['errors']['password']; ?>
                      </div>
                    <?php else: ?>
                      <div class="invalid-feedback">
                        Please enter your password.
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                
                <div class="row mb-4">
                  <!-- Remember Me -->
                  <div class="col-6">
                    <div class="form-check">
                      <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="rememberMe" 
                        name="rememberMe"
                        <?php echo $remember_checked; ?>
                      >
                      <label class="form-check-label" for="rememberMe">
                        Remember me
                      </label>
                    </div>
                  </div>
                  
                  <!-- Forgot Password -->
                  <div class="col-6 text-end">
                    <a href="changepass.php" class="text-decoration-none">Forgot password?</a>
                  </div>
                </div>
                
                <!-- Login Error Message (for login attempt failures) -->
                <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0 && !isset($_SESSION['errors']['email']) && !isset($_SESSION['errors']['password'])): ?>
                  <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>
                      Invalid email or password. Please try again.
                    </div>
                  </div>
                <?php endif; ?>
              
                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-4">
                  <button type="submit" class="btn btn-primary btn-lg" id="loginBtn">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Log In
                  </button>
                </div>
                
                <?php 
                  // Clear session errors and old input after displaying
                  if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
                  if (isset($_SESSION['old_input'])) unset($_SESSION['old_input']);
                ?>
              </form>

              <!-- Register Link -->
              <div class="text-center border-top pt-3">
                <p class="mb-0">Don't have an account? 
                  <a href="signup.php" class="fw-semibold text-decoration-none">Register Now</a>
                </p>
              </div>
            </div>
          </div>
          
          <!-- Additional Security Notes -->
          <div class="mt-4">
            <div class="card bg-light border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">
                  <i class="bi bi-info-circle-fill text-primary me-2"></i>Security Information
                </h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-shield-lock text-primary me-2"></i>
                    Your connection to this site is secure and encrypted.
                  </li>
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-eye-slash text-primary me-2"></i>
                    We never store or share your password with anyone.
                  </li>
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-question-circle text-primary me-2"></i>
                    Having trouble logging in? <a href="#" class="text-decoration-none">Contact support</a>.
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
            <li><a href="index.php" class="text-decoration-none text-secondary">Home</a></li>
            <li><a href="index.php#about" class="text-decoration-none text-secondary">About Us</a></li>
            <li><a href="index.php#services" class="text-decoration-none text-secondary">Services</a></li>
            <li><a href="index.php#contact" class="text-decoration-none text-secondary">Contact</a></li>
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
         
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="btn btn-primary btn-lg rounded-circle position-fixed bottom-0 end-0 m-4 shadow" id="back-to-top">
    <i class="bi bi-arrow-up"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- Custom Login Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle password visibility
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');
      
      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('bi-eye');
        this.querySelector('i').classList.toggle('bi-eye-slash');
      });
      
      // Form validation
      const form = document.getElementById('loginForm');
      
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          
          // Manually add is-invalid class to empty required fields
          const email = document.getElementById('email');
          const password = document.getElementById('password');
          
          if (!email.value) {
            email.classList.add('is-invalid');
          } else if (!isValidEmail(email.value)) {
            email.classList.add('is-invalid');
          }
          
          if (!password.value) {
            password.classList.add('is-invalid');
          }
        }
        
        form.classList.add('was-validated');
      });
      
      // Helper function to validate email
      function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      }
      
      // Auto-dismiss alerts after 5 seconds
      const alerts = document.querySelectorAll('.alert:not(.alert-dismissible)');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          alert.classList.add('fade');
          setTimeout(function() {
            alert.remove();
          }, 500);
        }, 5000);
      });
    });
  </script>
  
</body>
</html>