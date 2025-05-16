<?php include("../patient_backend/editprofile.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Profile - LeukemiaVision</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../../assets/css/main.css" rel="stylesheet">

  <style>
    /* Profile image styling */
    .profile-section {
      text-align: center;
      margin-bottom: 2rem;
    }

    .profile-image-wrapper {
      position: relative;
      display: inline-block;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 1rem;
    }

    .profile-image-container {
      position: relative;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
    }

    .profile-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .profile-actions {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .profile-action-btn {
      font-size: 0.85rem;
      padding: 0.35rem 0.75rem;
      border-radius: 50px;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: all 0.3s ease;
    }

    .profile-action-btn:hover {
      transform: translateY(-2px);
    }

    .profile-action-btn i {
      font-size: 0.9rem;
    }

    /* Form styling */
    .form-message {
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    .form-message.error {
      color: #dc3545;
    }

    .form-control.is-invalid {
      border-color: #dc3545;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right calc(0.375em + 0.1875rem) center;
      background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
      padding-right: calc(1.5em + 0.75rem);
    }

    .card {
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      border: none;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-header {
      background-color: #f8f9fa;
      border-radius: 1rem 1rem 0 0 !important;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      padding: 1.25rem 1.5rem;
    }

    .card-body {
      padding: 1.5rem;
    }

    .form-section {
      margin-bottom: 2rem;
    }

    .form-section-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: #333;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #eee;
    }

    /* Gender checkboxes styling */
    .gender-checkboxes {
      display: flex;
      gap: 1.5rem;
    }
    
    .checkbox-wrapper {
      display: flex;
      align-items: center;
      position: relative;
    }
    
    .checkbox-wrapper input[type="checkbox"] {
      opacity: 0;
      position: absolute;
    }
    
    .checkbox-wrapper label {
      display: flex;
      align-items: center;
      cursor: pointer;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      background-color: #f8f9fa;
      border: 1px solid #e9ecef;
      transition: all 0.2s ease;
    }
    
    .checkbox-wrapper label:before {
      content: '';
      width: 18px;
      height: 18px;
      border: 2px solid #adb5bd;
      border-radius: 4px;
      margin-right: 8px;
      transition: all 0.2s ease;
      display: inline-block;
    }
    
    .checkbox-wrapper input[type="checkbox"]:checked + label {
      background-color: #e3f2fd;
      border-color: #90caf9;
    }
    
    .checkbox-wrapper input[type="checkbox"]:checked + label:before {
      background-color: #0d6efd;
      border-color: #0d6efd;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
      background-size: 10px;
      background-repeat: no-repeat;
      background-position: center;
    }
    
    /* Button styling */
    .btn-primary {
      padding: 0.5rem 1.5rem;
      font-weight: 500;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
      background-color: #0d6efd;
      border-color: #0d6efd;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0a58ca;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }

    .btn-secondary {
      padding: 0.5rem 1.5rem;
      font-weight: 500;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      transform: translateY(-2px);
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #bb2d3b;
      border-color: #b02a37;
    }
    /* Notification styling */
    <?php if(!empty($success_message)): ?>
    .success-message {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #28a745;
      color: white;
      padding: 15px 20px;
      border-radius: 8px;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      animation: fadeInOut 5s forwards;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .success-message i {
      font-size: 20px;
    }
    <?php endif; ?>
    
    <?php if(!empty($error_message)): ?>
    .error-message {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #dc3545;
      color: white;
      padding: 15px 20px;
      border-radius: 8px;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      animation: fadeInOut 5s forwards;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .error-message i {
      font-size: 20px;
    }
    <?php endif; ?>

    @keyframes fadeInOut {
      0% { opacity: 0; transform: translateY(-20px); }
      10% { opacity: 1; transform: translateY(0); }
      90% { opacity: 1; transform: translateY(0); }
      100% { opacity: 0; transform: translateY(-20px); }
    }
  </style>
</head>

<body class="starter-page-page">
  <header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a
              href="mailto:contact@example.com">contact@leukemivision.com</a></i>
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
            <li><a href="../../index.php" class="active">Home<br></a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#doctors">Doctors</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <div class="d-flex align-items-center">
          <a class="cta-btn btn-sm d-none d-sm-block me-1" href="patient/patient_frontend/services_option.php">Make an Appointment</a>
          <a href="signup.php">
            <button class="cta-btn btn-sm ms-1 border-0" type="button">
              <i class="bi bi-person-plus"></i> Register
            </button>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main class="container py-5">
  <?php if(!empty($success_message)): ?>
    <div class="success-message">
      <i class="bi bi-check-circle"></i>
      <span><?php echo $success_message; ?></span>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($error_message)): ?>
    <div class="error-message">
      <i class="bi bi-exclamation-circle"></i>
      <span><?php echo $error_message; ?></span>
    </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="mb-0 fs-4"><i class="bi bi-person-lines-fill me-2"></i>Edit Profile</h2>
        <div>
          <a href="../../index.php" class="btn btn-secondary me-2"><i class="bi me-1"></i>Cancel</a>
          <button type="submit" form="editProfileForm" class="btn btn-primary"><i class="bi me-1"></i>Save Changes</button>
        </div>
      </div>
      <div class="card-body">
        <!-- Profile Image Section -->
        <div class="profile-section">
          <div class="profile-image-wrapper">
            <div class="profile-image-container">
              <img src="<?php echo $profile_image; ?>" alt="Patient Photo" class="profile-image" id="profileImage">
            </div>
          </div>
          <div class="profile-actions">
            <!-- Choose Photo Button -->
            <label for="profileImageInput" class="btn btn-outline-primary profile-action-btn">
              <i class="bi bi-upload"></i> Choose Photo
            </label>
            
            <!-- Remove Photo Button (As separate form) -->
            <form method="POST" action="" style="display: inline;">
              <button type="submit" name="remove_photo" value="1" class="btn btn-outline-danger profile-action-btn">
                <i class="bi bi-trash"></i> Remove Photo
              </button>
            </form>
          </div>
          <?php if(!empty($field_errors['profileImage'])): ?>
            <div class="form-message error mt-2"><?php echo $field_errors['profileImage']; ?></div>
          <?php endif; ?>
        </div>

        <form method="POST" action="" enctype="multipart/form-data" id="editProfileForm" novalidate>
          <!-- Hidden file input for choosing photo -->
          <input type="file" name="profileImage" id="profileImageInput" accept="image/jpeg,image/png,image/gif" class="d-none" onchange="this.form.submit()">
          
          <div class="row">
            <!-- Personal Information Section -->
            <div class="col-md-6">
              <div class="form-section">
                <h3 class="form-section-title"><i class="bi bi-person me-2"></i>Personal Information</h3>
                
                <div class="mb-3">
                  <label for="fullName" class="form-label">Full Name</label>
                  <input type="text" class="form-control <?php echo !empty($field_errors['fullName']) ? 'is-invalid' : ''; ?>" 
                        id="fullName" name="fullName" value="<?php echo htmlspecialchars($full_name); ?>" required>
                  <?php if(!empty($field_errors['fullName'])): ?>
                  <div class="form-message error"><?php echo $field_errors['fullName']; ?></div>
                  <?php endif; ?>
                </div>
                
                <div class="mb-3">
                  <label for="dateofbirth" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control <?php echo !empty($field_errors['dateofbirth']) ? 'is-invalid' : ''; ?>" 
                        id="dateofbirth" name="dateofbirth" value="<?php echo htmlspecialchars($birth_date); ?>" required>
                  <?php if(!empty($field_errors['dateofbirth'])): ?>
                  <div class="form-message error"><?php echo $field_errors['dateofbirth']; ?></div>
                  <?php endif; ?>
                </div>
                
                <div class="mb-3">
                  <label for="age" class="form-label">Age</label>
                  <input type="number" class="form-control" id="age" name="age" 
                         value="<?php 
                                  $birth = new DateTime($birth_date); 
                                  $today = new DateTime();
                                  echo $birth_date ? $today->diff($birth)->y : '';
                                ?>" readonly>
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Gender</label>
                  <div>
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?>>
                    <label for="male" class="form-check-label">Male</label>
                    <input class="form-check-input ms-3" type="radio" name="gender" id="female" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
                    <label for="female" class="form-check-label">Female</label>
                  </div>
                  <?php if(!empty($field_errors['gender'])): ?>
                    <div class="form-message error"><?php echo $field_errors['gender']; ?></div>
                  <?php endif; ?>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
                  <small class="text-muted">Email cannot be changed.</small>
                </div>
              </div>
            </div>
            
            <!-- Medical Information Section -->
            <div class="col-md-6">
              <div class="form-section">
                <h3 class="form-section-title"><i class="bi bi-heart-pulse me-2"></i>Medical Information</h3>
                
                <div class="mb-3">
                  <label for="bloodType" class="form-label">Blood Type</label>
                  <select class="form-select <?php echo !empty($field_errors['bloodType']) ? 'is-invalid' : ''; ?>" 
                        id="bloodType" name="bloodType">
                    <option value="">Select Blood Type</option>
                    <option value="A+" <?php echo ($blood_type == 'A+') ? 'selected' : ''; ?>>A+</option>
                    <option value="A-" <?php echo ($blood_type == 'A-') ? 'selected' : ''; ?>>A-</option>
                    <option value="B+" <?php echo ($blood_type == 'B+') ? 'selected' : ''; ?>>B+</option>
                    <option value="B-" <?php echo ($blood_type == 'B-') ? 'selected' : ''; ?>>B-</option>
                    <option value="AB+" <?php echo ($blood_type == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                    <option value="AB-" <?php echo ($blood_type == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                    <option value="O+" <?php echo ($blood_type == 'O+') ? 'selected' : ''; ?>>O+</option>
                    <option value="O-" <?php echo ($blood_type == 'O-') ? 'selected' : ''; ?>>O-</option>
                  </select>
                  <?php if(!empty($field_errors['bloodType'])): ?>
                  <div class="form-message error"><?php echo $field_errors['bloodType']; ?></div>
                  <?php endif; ?>
                </div>
                
                <div class="mb-3">
                  <label for="weight" class="form-label">Weight (kg)</label>
                  <input type="number" class="form-control <?php echo !empty($field_errors['weight']) ? 'is-invalid' : ''; ?>" 
                        id="weight" name="weight" value="<?php echo htmlspecialchars($weight); ?>" required>
                  <?php if(!empty($field_errors['weight'])): ?>
                  <div class="form-message error"><?php echo $field_errors['weight']; ?></div>
                  <?php endif; ?>
                </div>
                
                <div class="mb-3">
                  <label for="allergies" class="form-label">Allergies</label>
                  <textarea class="form-control <?php echo !empty($field_errors['allergies']) ? 'is-invalid' : ''; ?>" 
                        id="allergies" name="allergies" rows="3" placeholder="List any allergies or type 'None'"><?php echo htmlspecialchars($allergies); ?></textarea>
                  <?php if(!empty($field_errors['allergies'])): ?>
                  <div class="form-message error"><?php echo $field_errors['allergies']; ?></div>
                  <?php endif; ?>
                </div>
                
                <div class="mb-3">
                  <label for="existingConditions" class="form-label">Existing Medical Conditions</label>
                  <textarea class="form-control <?php echo !empty($field_errors['existingConditions']) ? 'is-invalid' : ''; ?>" 
                        id="existingConditions" name="existingConditions" rows="3" placeholder="List any existing medical conditions or type 'None'"><?php echo htmlspecialchars($existing_conditions); ?></textarea>
                  <?php if(!empty($field_errors['existingConditions'])): ?>
                  <div class="form-message error"><?php echo $field_errors['existingConditions']; ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Contact Information Section -->
          <div class="form-section">
            <h3 class="form-section-title"><i class="bi bi-telephone me-2"></i>Contact Information</h3>
            
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="phoneNumber" class="form-label">Phone Number</label>
                  <input type="text" class="form-control <?php echo !empty($field_errors['phoneNumber']) ? 'is-invalid' : ''; ?>" 
                        id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($phone_number); ?>" required>
                  <?php if(!empty($field_errors['phoneNumber'])): ?>
                  <div class="form-message error"><?php echo $field_errors['phoneNumber']; ?></div>
                  <?php endif; ?>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="emergencyContact" class="form-label">Emergency Contact</label>
                  <input type="text" class="form-control <?php echo !empty($field_errors['emergencyContact']) ? 'is-invalid' : ''; ?>" 
                        id="emergencyContact" name="emergencyContact" value="<?php echo htmlspecialchars($emergency_contact); ?>" required>
                  <?php if(!empty($field_errors['emergencyContact'])): ?>
                  <div class="form-message error"><?php echo $field_errors['emergencyContact']; ?></div>
                  <?php endif; ?>
                </div>
              </div>
              
              <div class="col-12">
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control <?php echo !empty($field_errors['address']) ? 'is-invalid' : ''; ?>" 
                        id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                  <?php if(!empty($field_errors['address'])): ?>
                  <div class="form-message error"><?php echo $field_errors['address']; ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer id="footer" class="footer">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.php" class="logo d-flex align-items-center">
            <span>LeukemiaVision</span>
          </a>
          <p>Providing advanced tools for detection and management of leukemia through cutting-edge AI technology.</p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            123 Healthcare Avenue<br>
            Beirut, LB 12345<br>
            Lebanon<br><br>
            <strong>Phone:</strong> +961 76 491 905<br>
            <strong>Email:</strong> contact@leukemiavision.com<br>
          </p>
        </div>

        <div class="col-lg-4 col-md-12 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>LeukemiaVision</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // === Profile Image Handling ===
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImage = document.getElementById('profileImage');
    const profileImageOverlay = document.getElementById('profileImageOverlay');
    const choosePhotoBtn = document.getElementById('choosePhotoBtn');
    const removePhotoBtn = document.getElementById('removePhotoBtn');
    const removePhotoField = document.getElementById('removePhotoField');
    const defaultImagePath = '../../assets/img/default-profile.jpg';

    // Trigger file input on button or overlay click
    choosePhotoBtn?.addEventListener('click', () => profileImageInput.click());
    profileImageOverlay?.addEventListener('click', () => profileImageInput.click());

    // Show selected image preview
    profileImageInput?.addEventListener('change', function () {
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          profileImage.src = e.target.result;
          removePhotoField.value = '0';
        };
        reader.readAsDataURL(this.files[0]);
      }
    });

    // Handle remove photo
    removePhotoBtn?.addEventListener('click', () => {
      profileImage.src = defaultImagePath;
      profileImageInput.value = '';
      removePhotoField.value = '1';
    });

    // === Gender Checkbox Exclusivity ===
    const maleCheckbox = document.getElementById('male');
    const femaleCheckbox = document.getElementById('female');

    maleCheckbox?.addEventListener('change', function () {
      if (this.checked) femaleCheckbox.checked = false;
    });

    femaleCheckbox?.addEventListener('change', function () {
      if (this.checked) maleCheckbox.checked = false;
    });

    // === Form Validation (Placeholder for Custom Checks) ===
    const form = document.getElementById('editProfileForm');
    form?.addEventListener('submit', function (event) {
      let isValid = true;

      // TODO: Add specific validation if needed
      if (!isValid) {
        event.preventDefault();
        const firstInvalidField = document.querySelector('.is-invalid');
        if (firstInvalidField) {
          firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }
    });

    // === Age Calculation from DOB ===
    const dobInput = document.getElementById('dateofbirth');
    const ageInput = document.getElementById('age');

    function calculateAge(dob) {
      const dobDate = new Date(dob);
      const today = new Date();
      let age = today.getFullYear() - dobDate.getFullYear();
      const monthDiff = today.getMonth() - dobDate.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
        age--;
      }
      if (ageInput) {
        ageInput.value = age;
      }
    }

    if (dobInput && dobInput.value) {
      calculateAge(dobInput.value);
    }

    dobInput?.addEventListener('change', function () {
      calculateAge(this.value);
    });

    // === Notification Auto-hide ===
    document.querySelectorAll('.success-message, .error-message').forEach(notification => {
      setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        setTimeout(() => {
          notification.style.display = 'none';
        }, 500);
      }, 5000);
    });

    // === Bootstrap Tooltips Initialization ===
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));

    // === AOS Animation Initialization ===
    if (typeof AOS !== 'undefined') {
      AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        mirror: false
      });
    }

    // === Preloader Fade Out ===
    window.addEventListener('load', () => {
      const preloader = document.getElementById('preloader');
      if (preloader) {
        setTimeout(() => {
          preloader.classList.add('fade-out');
          setTimeout(() => {
            preloader.style.display = 'none';
          }, 500);
        }, 300);
      }
    });
  });
</script>

</body>
</html>
