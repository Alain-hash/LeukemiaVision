<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Change Password - LeukemiaVision</title>
  <meta name="description" content="Change your LeukemiaVision account password">
  <meta name="keywords" content="leukemiavision, password, healthcare, patient portal">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
   
   .header, .footer {
     background-color: rgba(227, 224, 224, 0.721); 
     position: relative;
     z-index: 10;
   }
   </style>
</head>

<body class="bg-light">

  <!-- Header from main template -->
  <header id="header" class="header sticky-top bg-light bg-opacity-75">
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
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>
        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html#about">About</a></li>
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#departments">Departments</a></li>
            <li><a href="index.html#doctors">Doctors</a></li>
            <li><a href="index.html#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <!-- Change Password Section -->
    <section class="py-5">
      <div class="container" data-aos="fade-up">
        <div class="text-center mb-5">
          <h2>Change Password</h2>
          <p class="text-muted">Update your account with a new secure password</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
              <div class="card-body p-4">
                
                <!-- Success Message (Initially Hidden) -->
                <div id="successMessage" class="alert alert-success d-none" role="alert">
                  <i class="bi bi-check-circle-fill me-2"></i>
                  Password changed successfully! You will be redirected to the login page.
                </div>
                
                <!-- Error Message (Initially Hidden) -->
                <div id="errorMessage" class="alert alert-danger d-none" role="alert">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>
                  <span id="errorText">An error occurred. Please try again.</span>
                </div>
                
                <!-- Change Password Form -->
                <div id="changePasswordForm">
                  <form class="row g-3" id="passwordForm">
                    <!-- Current Password -->
                    <div class="col-md-12 mb-3">
                      <label for="currentPassword" class="form-label fw-bold">Current Password</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="currentPassword" placeholder="Enter your current password" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                    
                    <!-- New Password -->
                    <div class="col-md-12 mb-3">
                      <label for="newPassword" class="form-label fw-bold">New Password</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="newPassword" placeholder="Enter your new password" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      <div class="progress mt-2" style="height: 5px;">
                        <div class="progress-bar" id="passwordStrength" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <div class="mt-2">
                        <p class="text-muted mb-1 small">Password must include:</p>
                        <ul class="text-muted ps-4 small mb-0">
                          <li id="req-length">At least 8 characters</li>
                          <li id="req-uppercase">At least one uppercase letter</li>
                          <li id="req-lowercase">At least one lowercase letter</li>
                          <li id="req-number">At least one number</li>
                          <li id="req-special">At least one special character</li>
                        </ul>
                      </div>
                    </div>
                    
                    <!-- Confirm New Password -->
                    <div class="col-md-12 mb-3">
                      <label for="confirmPassword" class="form-label fw-bold">Confirm New Password</label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your new password" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      <div class="invalid-feedback" id="passwordMatch">Passwords do not match.</div>
                    </div>
                    
                    <!-- Submit Buttons -->
                    <div class="col-12 d-flex justify-content-between">
                      <button type="button" class="btn btn-outline-secondary px-4" id="cancelBtn">Cancel</button>
                      <button type="submit" class="btn btn-primary px-4" id="changePasswordBtn">Update Password</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
            <!-- Additional Notes -->
            <div class="mt-4 text-center">
              <p class="text-muted small">
                <i class="bi bi-info-circle me-1"></i>
                For security reasons, you will be logged out after changing your password.
              </p>
              <p class="text-muted small">
                <i class="bi bi-shield-lock me-1"></i>
                We recommend using a unique password that you don't use for other accounts.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer bg-light bg-opacity-75">
    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">LeukemiaVision</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
        </div>
      </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- Custom Change Password Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Form elements
      const passwordForm = document.getElementById('passwordForm');
      const currentPassword = document.getElementById('currentPassword');
      const newPassword = document.getElementById('newPassword');
      const confirmPassword = document.getElementById('confirmPassword');
      const passwordStrength = document.getElementById('passwordStrength');
      const cancelBtn = document.getElementById('cancelBtn');
      const successMessage = document.getElementById('successMessage');
      const errorMessage = document.getElementById('errorMessage');
      const errorText = document.getElementById('errorText');
      
      // Password requirement elements
      const reqLength = document.getElementById('req-length');
      const reqUppercase = document.getElementById('req-uppercase');
      const reqLowercase = document.getElementById('req-lowercase');
      const reqNumber = document.getElementById('req-number');
      const reqSpecial = document.getElementById('req-special');
      
      // Toggle password visibility functions
      function setupTogglePassword(inputId, toggleId) {
        const input = document.getElementById(inputId);
        const toggle = document.getElementById(toggleId);
        
        toggle.addEventListener('click', function() {
          const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
          input.setAttribute('type', type);
          this.querySelector('i').classList.toggle('bi-eye');
          this.querySelector('i').classList.toggle('bi-eye-slash');
        });
      }
      
      // Setup toggle for all password fields
      setupTogglePassword('currentPassword', 'toggleCurrentPassword');
      setupTogglePassword('newPassword', 'toggleNewPassword');
      setupTogglePassword('confirmPassword', 'toggleConfirmPassword');
      
      // Password strength checker
      newPassword.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        // Check password requirements
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);
        
        // Update requirement indicators
        reqLength.classList.toggle('text-success', hasLength);
        reqUppercase.classList.toggle('text-success', hasUppercase);
        reqLowercase.classList.toggle('text-success', hasLowercase);
        reqNumber.classList.toggle('text-success', hasNumber);
        reqSpecial.classList.toggle('text-success', hasSpecial);
        
        // Calculate strength
        if (hasLength) strength += 1;
        if (hasUppercase) strength += 1;
        if (hasLowercase) strength += 1;
        if (hasNumber) strength += 1;
        if (hasSpecial) strength += 1;
        
        // Update strength meter
        passwordStrength.className = 'progress-bar';
        
        if (password === '') {
          passwordStrength.style.width = '0%';
          passwordStrength.setAttribute('aria-valuenow', '0');
        } else if (strength <= 2) {
          passwordStrength.style.width = '25%';
          passwordStrength.setAttribute('aria-valuenow', '25');
          passwordStrength.classList.add('bg-danger');
        } else if (strength <= 3) {
          passwordStrength.style.width = '50%';
          passwordStrength.setAttribute('aria-valuenow', '50');
          passwordStrength.classList.add('bg-warning');
        } else if (strength <= 4) {
          passwordStrength.style.width = '75%';
          passwordStrength.setAttribute('aria-valuenow', '75');
          passwordStrength.classList.add('bg-success');
        } else {
          passwordStrength.style.width = '100%';
          passwordStrength.setAttribute('aria-valuenow', '100');
          passwordStrength.classList.add('bg-primary');
        }
      });
      
      // Check password match
      confirmPassword.addEventListener('input', function() {
        if (this.value === newPassword.value) {
          this.setCustomValidity('');
          this.classList.remove('is-invalid');
        } else {
          this.setCustomValidity('Passwords do not match');
          this.classList.add('is-invalid');
        }
      });
      
      // Form submission
      passwordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate form
        if (!this.checkValidity()) {
          e.stopPropagation();
          this.classList.add('was-validated');
          return;
        }
        
        // Check if new password and confirm password match
        if (newPassword.value !== confirmPassword.value) {
          confirmPassword.classList.add('is-invalid');
          return;
        }
        
        // Simulate form processing
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        changePasswordBtn.disabled = true;
        changePasswordBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Updating...';
        
        // Simulate API call with timeout
        setTimeout(function() {
          // Check if current password is correct (for demo purposes)
          const isCurrentPasswordCorrect = true; // In a real app, this would be verified by the server
          
          if (isCurrentPasswordCorrect) {
            // Show success message
            successMessage.classList.remove('d-none');
            passwordForm.classList.add('d-none');
            
            // Redirect to login page after 3 seconds
            setTimeout(function() {
              window.location.href = 'login.php';
            }, 3000);
          } else {
            // Show error message
            errorText.textContent = 'Current password is incorrect. Please try again.';
            errorMessage.classList.remove('d-none');
            changePasswordBtn.disabled = false;
            changePasswordBtn.innerHTML = 'Update Password';
          }
        }, 1500);
      });
      
      // Cancel button
      cancelBtn.addEventListener('click', function() {
        // Redirect to account settings or dashboard
        window.location.href = 'login.php';
      });
    });
  </script>

</body>
</html>