<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Patient Registration - LeukemiaVision</title>
  <meta name="description" content="Register as a new patient at LeukemiaVision">
  <meta name="keywords" content="LeukemiaVision, registration, healthcare">

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
  <!-- Header -->
  <header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">LeukemiaVision.com</a></i>
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
        <div class="col-lg-8">
          <!-- Page Title -->
          <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Patient Registration</h2>
            <div class="col-lg-8 mx-auto">
              <p class="text-muted">Create your account to access our healthcare services</p>
            </div>
          </div>

          <!-- Card with Form -->
          <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-3">
              <h5 class="card-title mb-0">
                <i class="bi bi-person-plus-fill me-2"></i>Create Your Account
              </h5>
            </div>
            <div class="card-body p-4">
              <!-- Registration Form -->
              <form id="signupForm" action="signup_backend/signup_server.php" method="post">

                <!-- Personal Information Section -->
                <div class="mb-4">
                  <h5 class="border-bottom pb-2 mb-3">Personal Information</h5>
                </div>




                <?php if (isset($_SESSION['errors']['existance'])): ?>
                  <div class="alert alert-danger d-flex align-items-center mt-2 mb-3" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div><?php echo htmlspecialchars($_SESSION['errors']['existance']); ?></div>
                  </div>
                <?php endif; ?>

                <!-- Full Name -->
                <div class="mb-3">
                  <label for="fullName" class="form-label fw-semibold">
                    <i class="bi bi-person-fill text-primary me-2"></i>Full Name
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-person-fill"></i>
                    </span>
                    <input type="text" class="form-control <?php echo (isset($_SESSION['errors']['name'])) ? 'is-invalid' : ''; ?>"
                      id="fullName" name="name" placeholder="Enter your full name">
                    <?php if (isset($_SESSION['errors']['name'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['name']);  ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label fw-semibold">
                    <i class="bi bi-envelope-fill text-primary me-2"></i>Email Address
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input type="email" class="form-control <?php echo (isset($_SESSION['errors']['email'])) ? 'is-invalid' : ''; ?>"
                      id="email" name="email" placeholder="Enter your email address">
                    <?php if (isset($_SESSION['errors']['email'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['email']); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-text">We'll send a verification code to this email</div>
                </div>

                <!-- Password -->
                <div class="row mb-3">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label for="password" class="form-label fw-semibold">
                      <i class="bi bi-lock-fill text-primary me-2"></i>Password
                    </label>
                    <div class="input-group">
                      <span class="input-group-text bg-light">
                        <i class="bi bi-lock-fill"></i>
                      </span>
                      <input type="password" class="form-control <?php echo (isset($_SESSION['errors']['password'])) ? 'is-invalid' : ''; ?>"
                        id="password" name="password" placeholder="Create a password">
                      <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i>
                      </button>
                      <?php if (isset($_SESSION['errors']['password'])): ?>
                        <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['password']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div class="progress mt-2" style="height: 5px;">
                      <div id="passwordStrength" class="progress-bar bg-danger" role="progressbar" style="width: 0%"></div>
                    </div>
                    <div id="passwordFeedback" class="form-text text-muted">Password must be at least 8 characters</div>
                  </div>

                  <!-- Confirm Password -->
                  <div class="col-md-6">
                    <label for="confirmPassword" class="form-label fw-semibold">
                      <i class="bi bi-lock-fill text-primary me-2"></i>Confirm Password
                    </label>
                    <div class="input-group">
                      <span class="input-group-text bg-light">
                        <i class="bi bi-lock-fill"></i>
                      </span>
                      <input type="password" class="form-control <?php echo (isset($_SESSION['errors']['cpassword'])) ? 'is-invalid' : ''; ?>"
                        id="confirmPassword" name="cpassword" placeholder="Confirm your password">
                      <?php if (isset($_SESSION['errors']['cpassword'])): ?>
                        <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['cpassword']); ?></div>
                      <?php endif; ?>
                    </div>
                    <div id="passwordMatch" class="form-text"></div>
                  </div>
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                  <label for="phoneNumber" class="form-label fw-semibold">
                    <i class="bi bi-telephone-fill text-primary me-2"></i>Phone Number
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-telephone-fill"></i>
                    </span>
                    <input type="tel" class="form-control <?php echo (isset($_SESSION['errors']['phone_number'])) ? 'is-invalid' : ''; ?>"
                      id="phoneNumber" name="phone_number" placeholder="Enter your phone number">
                    <?php if (isset($_SESSION['errors']['phone_number'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['phone_number']); ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Gender and Birth Date -->
                <div class="row mb-3">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label for="gender" class="form-label fw-semibold">
                      <i class="bi bi-gender-ambiguous text-primary me-2"></i>Gender
                    </label>
                    <select class="form-select <?php echo (isset($_SESSION['errors']['gender'])) ? 'is-invalid' : ''; ?>"
                      id="gender" name="gender">
                      <option value="" selected disabled>Select your gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                    <?php if (isset($_SESSION['errors']['gender'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['gender']); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-6">
                    <label for="age" class="form-label fw-semibold">
                      <i class="bi bi-calendar-date text-primary me-2"></i>Birth Date
                    </label>
                    <input type="date" class="form-control <?php echo (isset($_SESSION['errors']['birth_date'])) ? 'is-invalid' : ''; ?>"
                      id="age" name="birth_date">
                    <?php if (isset($_SESSION['errors']['birth_date'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['birth_date']); ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Weight and Blood Type -->
                <div class="row mb-3">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label for="weight" class="form-label fw-semibold">
                      <i class="bi bi-star-fill text-primary me-2"></i>Weight (kg)
                    </label>
                    <input type="number" class="form-control <?php echo (isset($_SESSION['errors']['weight'])) ? 'is-invalid' : ''; ?>"
                      id="weight" name="weight" min="0" step="0.1" placeholder="Enter your weight in kg">
                    <?php if (isset($_SESSION['errors']['weight'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['weight']); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-6">
                    <label for="bloodType" class="form-label fw-semibold">
                      <i class="bi bi-droplet-fill text-primary me-2"></i>Blood Type
                    </label>
                    <select class="form-select <?php echo (isset($_SESSION['errors']['blood_type'])) ? 'is-invalid' : ''; ?>"
                      id="bloodType" name="blood_type">
                      <option value="" selected disabled>Select your blood type</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                    <?php if (isset($_SESSION['errors']['blood_type'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['blood_type']); ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Address -->
                <div class="mb-4">
                  <label for="address" class="form-label fw-semibold">
                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>Address
                  </label>
                  <textarea class="form-control <?php echo (isset($_SESSION['errors']['address'])) ? 'is-invalid' : ''; ?>"
                    id="address" name="address" rows="2" placeholder="Enter your full address"></textarea>
                  <?php if (isset($_SESSION['errors']['address'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['address']); ?></div>
                  <?php endif; ?>
                </div>

                <!-- Medical Information Section -->
                <div class="mb-4">
                  <h5 class="border-bottom pb-2 mb-3">Medical Information</h5>
                </div>

                <!-- Allergies -->
                <div class="mb-3">
                  <label for="allergies" class="form-label fw-semibold">
                    <i class="bi bi-exclamation-triangle-fill text-primary me-2"></i>Allergies
                  </label>
                  <textarea class="form-control <?php echo (isset($_SESSION['errors']['allergies'])) ? 'is-invalid' : ''; ?>"
                    id="allergies" name="allergies" rows="2" placeholder="List any allergies you have or write 'None'"></textarea>
                  <?php if (isset($_SESSION['errors']['allergies'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['allergies']); ?></div>
                  <?php endif; ?>
                </div>

                <!-- Existing Conditions -->
                <div class="mb-4">
                  <label for="existingConditions" class="form-label fw-semibold">
                    <i class="bi bi-clipboard2-pulse-fill text-primary me-2"></i>Existing Medical Conditions
                  </label>
                  <textarea class="form-control <?php echo (isset($_SESSION['errors']['existing_conditions'])) ? 'is-invalid' : ''; ?>"
                    id="existingConditions" name="existing_conditions" rows="2" placeholder="List any existing medical conditions or write 'None'"></textarea>
                  <?php if (isset($_SESSION['errors']['existing_conditions'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['existing_conditions']); ?></div>
                  <?php endif; ?>
                </div>

                <!-- Emergency Contact Section -->
                <div class="mb-4">
                  <h5 class="border-bottom pb-2 mb-3">Emergency Contact</h5>
                </div>

                <!-- Emergency Contact Phone -->
                <div class="mb-4">
                  <label for="emergencyContactPhone" class="form-label fw-semibold">
                    <i class="bi bi-telephone-fill text-primary me-2"></i>Emergency Contact Phone
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="bi bi-telephone-fill"></i>
                    </span>
                    <input type="tel" class="form-control <?php echo (isset($_SESSION['errors']['emergency_contact'])) ? 'is-invalid' : ''; ?>"
                      id="emergencyContactPhone" name="emergency_contact" placeholder="Enter phone number">
                    <?php if (isset($_SESSION['errors']['emergency_contact'])): ?>
                      <div class="invalid-feedback"><?php echo htmlspecialchars($_SESSION['errors']['emergency_contact']); ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">
                      I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                    </label>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-4">
                  <button type="submit" class="btn btn-primary btn-lg" id="registerBtn">
                    <i class="bi bi-person-plus-fill me-2"></i>Register
                  </button>
                </div>

                <!-- Login Link -->
                <div class="text-center border-top pt-3">
                  <p class="mb-0">Already have an account?
                    <a href="login.php" class="fw-semibold text-decoration-none">Log In</a>
                  </p>
                </div>
              </form>
            </div>
          </div>

          <!-- Additional Security Notes -->
          <div class="mt-4">
            <div class="card bg-light border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">
                  <i class="bi bi-shield-lock-fill text-primary me-2"></i>Privacy Information
                </h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-shield-check text-primary me-2"></i>
                    Your health information is protected and confidential.
                  </li>
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-lock text-primary me-2"></i>
                    We use secure encryption to protect your personal data.
                  </li>
                  <li class="list-group-item bg-transparent border-0 py-2">
                    <i class="bi bi-question-circle text-primary me-2"></i>
                    Questions about registration? <a href="#" class="text-decoration-none">Contact support</a>.
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

  <!-- Custom Registration Script -->
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

      // Password strength check
      const confirmPasswordInput = document.getElementById('confirmPassword');
      const passwordStrength = document.getElementById('passwordStrength');
      const passwordFeedback = document.getElementById('passwordFeedback');
      const passwordMatch = document.getElementById('passwordMatch');

      // Password strength indicator
      passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength += 1;
        if (password.match(/[A-Z]/)) strength += 1;
        if (password.match(/[0-9]/)) strength += 1;
        if (password.match(/[^A-Za-z0-9]/)) strength += 1;

        switch (strength) {
          case 0:
            passwordStrength.className = 'progress-bar bg-danger';
            passwordStrength.style.width = '0%';
            passwordFeedback.textContent = 'Password must be at least 8 characters';
            break;
          case 1:
            passwordStrength.className = 'progress-bar bg-danger';
            passwordStrength.style.width = '25%';
            passwordFeedback.textContent = 'Weak password';
            break;
          case 2:
            passwordStrength.className = 'progress-bar bg-warning';
            passwordStrength.style.width = '50%';
            passwordFeedback.textContent = 'Medium password';
            break;
          case 3:
            passwordStrength.className = 'progress-bar bg-info';
            passwordStrength.style.width = '75%';
            passwordFeedback.textContent = 'Good password';
            break;
          case 4:
            passwordStrength.className = 'progress-bar bg-success';
            passwordStrength.style.width = '100%';
            passwordFeedback.textContent = 'Strong password';
            break;
        }
      });

      confirmPasswordInput.addEventListener('input', function() {
        if (this.value === passwordInput.value) {
          passwordMatch.textContent = 'Passwords match';
          passwordMatch.className = 'form-text text-success';
        } else {
          passwordMatch.textContent = 'Passwords do not match';
          passwordMatch.className = 'form-text text-danger';
        }
      });
    });
  </script>

  <?php
  // Clear the errors after displaying them
  if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
  }
  ?>

</body>

</html>