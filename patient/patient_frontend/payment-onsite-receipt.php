<?php 
include ("../patient_backend/payment-online-receipt.php");
include ("../patient_backend/payment-onsite-receipt.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Payment Voucher - Medilab Medical Center</title>
  <meta name="description" content="Medilab Medical Center Payment Voucher">
  <meta name="keywords" content="healthcare, payment, receipt, medical, voucher">

  <!-- Favicons -->
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    
    .voucher-container {
      max-width: 800px;
      margin: 2rem auto;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      border-radius: 0.5rem;
      overflow: hidden;
    }
    
    .voucher-header {
      background: linear-gradient(135deg, #0d6efd, #0a58ca);
      color: white;
      padding: 2rem;
      position: relative;
    }
    
    .voucher-logo {
      width: 80px;
      height: 80px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    }
    
    .voucher-watermark {
      position: absolute;
      top: 1rem;
      right: 1rem;
      opacity: 0.1;
      font-size: 6rem;
      transform: rotate(-20deg);
    }
    
    .info-label {
      color: #6c757d;
      font-size: 0.85rem;
      margin-bottom: 0.25rem;
    }
    
    .info-value {
      font-weight: 600;
      margin-bottom: 1rem;
    }
    
    .voucher-divider {
      width: 100%;
      height: 1px;
      background: linear-gradient(to right, transparent, #dee2e6, transparent);
      margin: 1.5rem 0;
    }
    
    .badge-pending {
      background-color: #ffc107;
      color: #212529;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 1rem;
    }
    
    .instructions {
      background-color: #f8f9fa;
      border-left: 4px solid #0d6efd;
    }
    
    .print-button {
      background: linear-gradient(135deg, #0d6efd, #0a58ca);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 2rem;
      transition: all 0.3s ease;
      box-shadow: 0 0.25rem 0.5rem rgba(13, 110, 253, 0.3);
    }
    
    .print-button:hover {
      background: linear-gradient(135deg, #0a58ca, #084298);
      box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.4);
    }
    
    .print-button i {
      margin-right: 0.5rem;
    }
    
    .back-button {
      background-color: white;
      color: #0d6efd;
      border: 1px solid #0d6efd;
      padding: 0.75rem 1.5rem;
      border-radius: 2rem;
      transition: all 0.3s ease;
    }
    
    .back-button:hover {
      background-color: #f0f8ff;
      color: #0a58ca;
      border-color: #0a58ca;
    }
    
    @media print {
      .no-print {
        display: none !important;
      }
      
      body {
        margin: 0;
        padding: 0;
        background-color: white;
      }
      
      .voucher-container {
        box-shadow: none;
        margin: 0;
        max-width: 100%;
      }
      
      .container {
        max-width: 100%;
        width: 100%;
      }
    }
  </style>
</head>
<body>
<header id="header" class="header sticky-top no-print">
    <div class="topbar d-flex align-items-center bg-primary py-2">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center text-white">
          <i class="bi bi-envelope d-flex align-items-center ms-2"><a href="mailto:contact@medilab.com" class="text-white text-decoration-none ms-1">contact@medilab.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span class="ms-1">+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter text-white px-2"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook text-white px-2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="linkedin text-white px-2"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-center shadow-sm bg-white py-2">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../../index.php" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename text-primary fw-bold m-0">Medilab</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul class="d-flex list-unstyled m-0">
            <li class="me-4"><a href="../../index.php" class="text-decoration-none fw-medium">Home</a></li>
            <li class="me-4"><a href="../patient_backend/test-timeslotsfetching.php" class="text-decoration-none fw-medium">About</a></li>
            <li class="me-4"><a href="services_option.php" class="text-decoration-none fw-medium">Services</a></li>
            <li class="me-4"><a href="#departments" class="text-decoration-none fw-medium">Departments</a></li>
            <li class="me-4"><a href="#doctors" class="text-decoration-none fw-medium">Doctors</a></li>
            <li class="me-4"><a href="#contact" class="text-decoration-none fw-medium">Contact</a></li>
          </ul>
        </nav>

        <a class="cta-btn btn btn-primary rounded-pill px-4 py-2 d-none d-sm-block" href="#appointment">Make an Appointment</a>
      </div>
    </div>
  </header>
  
  <main class="py-5">
    <div class="container">
      <div class="voucher-container bg-white">
        <!-- Voucher Header -->
        <div class="voucher-header text-center position-relative">
          <div class="voucher-watermark">
            <i class="bi bi-check-circle-fill"></i>
          </div>
          <div class="d-flex justify-content-center">
            <div class="voucher-logo">
              <h1 class="m-0 text-primary">M</h1>
            </div>
          </div>
          <h2 class="mb-1">Payment Voucher</h2>
          <p class="mb-0 opacity-75">Medilab Medical Center</p>
        </div>
        
        <!-- Voucher Body -->
        <div class="p-4 p-lg-5">
          <!-- Print Button -->
          <div class="text-end mb-4 no-print">
            <button type="button" class="print-button d-inline-flex align-items-center" onclick="window.print()">
              <i class="bi bi-printer"></i> Print Voucher
            </button>
          </div>
          
          <!-- Medical Center Information -->
          <div class="text-center mb-4">
            <p class="text-secondary mb-1">A108 Adam Street, New York, NY 535022</p>
            <p class="text-secondary mb-0">
              <span class="me-2"><i class="bi bi-telephone-fill text-primary me-1"></i> +1 5589 55488 55</span>
              <span><i class="bi bi-envelope-fill text-primary me-1"></i> info@example.com</span>
            </p>
          </div>
          
          <div class="voucher-divider"></div>
          
          <!-- Voucher Details -->
          <div class="row mb-4">
            <div class="col-sm-6">
              <div class="info-label">Voucher Number</div>
              <div class="info-value">VC-<?php echo $_SESSION['rand2']; ?></div>
            </div>
            <div class="col-sm-6 text-sm-end">
              <div class="info-label">Issue Date</div>
              <div class="info-value"><?php echo date('F j, Y - h:i A'); ?></div>
            </div>
          </div>
          
          <!-- Patient Information -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                  <h5 class="card-title border-bottom pb-3 mb-3">Patient Information</h5>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="info-label">Patient Name</div>
                      <div class="info-value"><?php echo $_SESSION['user_name']; ?></div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-label">Doctor</div>
                      <div class="info-value"><?php echo $_SESSION['doctor_name'] . ' - ' . $_SESSION['doctor_specialization']; ?></div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-label">Appointment Date</div>
                      <div class="info-value"><?php echo date("F j, Y", strtotime($_SESSION['date'])); ?></div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-label">Appointment Time</div>
                      <div class="info-value"><?php echo $_SESSION['time']; ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Payment Details -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                  <h5 class="card-title border-bottom pb-3 mb-3">Payment Details</h5>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="info-label">Service</div>
                      <div class="info-value"><?php echo $tests[0]['Name']; ?></div>
                    </div>
                    <div class="col-md-6">
                      <div class="info-label">Amount Due</div>
                      <div class="info-value fw-bold text-primary">$<?php echo $tests[0]['Fee']; ?></div>
                    </div>
                    <div class="col-12">
                      <div class="info-label">Payment Status</div>
                      <div class="info-value">
                        <span class="badge-pending">PENDING</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Instructions -->
          <div class="instructions p-4 rounded mb-4">
            <h5 class="d-flex align-items-center"><i class="bi bi-info-circle-fill text-primary me-2"></i> Important Instructions</h5>
            <ol class="mb-0 ps-3">
              <li class="mb-2">Please bring this voucher to the clinic on the day of your appointment.</li>
              <li class="mb-2">Payment can be made at the reception desk via cash, credit/debit card, or insurance.</li>
              <li class="mb-2">Please arrive 15 minutes before your scheduled appointment time.</li>
              <li>This voucher is valid only for the appointment date and time specified above.</li>
            </ol>
          </div>
          
          <!-- QR Code (for demonstration) -->
          <div class="text-center mb-4">
            <div class="d-inline-block p-3 border rounded">
              <div style="width: 100px; height: 100px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-qr-code" style="font-size: 3rem; color: #6c757d;"></i>
              </div>
              <div class="mt-2 text-secondary small">Scan for verification</div>
            </div>
          </div>
        </div>
        
        <!-- Voucher Footer -->
        <div class="bg-light p-3 text-center">
          <p class="small text-secondary mb-0">Thank you for choosing Medilab Medical Center</p>
        </div>
      </div>
      
      <!-- Back to Home button -->
      <div class="text-center mt-4 no-print">
        <a href="../../index.php" class="back-button text-decoration-none">
          <i class="bi bi-arrow-left me-2"></i> Back to Home
        </a>
      </div>
    </div>
  </main>

  <!-- Footer - Only visible when not printing -->
  <footer id="footer" class="footer bg-white border-top mt-5 no-print">
    <div class="container py-4">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
          <h4 class="text-primary mb-4">Medilab</h4>
          <div class="footer-contact">
            <p class="mb-1"><i class="bi bi-geo-alt text-primary me-2"></i> A108 Adam Street, New York, NY 535022</p>
            <p class="mb-1"><i class="bi bi-telephone text-primary me-2"></i> +1 5589 55488 55</p>
            <p class="mb-3"><i class="bi bi-envelope text-primary me-2"></i> info@example.com</p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="" class="me-2 d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 36px; height: 36px;"><i class="bi bi-twitter-x text-secondary"></i></a>
            <a href="" class="me-2 d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 36px; height: 36px;"><i class="bi bi-facebook text-secondary"></i></a>
            <a href="" class="me-2 d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 36px; height: 36px;"><i class="bi bi-instagram text-secondary"></i></a>
            <a href="" class="d-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 36px; height: 36px;"><i class="bi bi-linkedin text-secondary"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
          <h5 class="text-primary mb-3">Useful Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Home</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">About us</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Services</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Terms of service</a></li>
            <li><a href="#" class="text-secondary text-decoration-none">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
          <h5 class="text-primary mb-3">Our Services</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Consultations</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Diagnostics</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Treatments</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Surgeries</a></li>
            <li><a href="#" class="text-secondary text-decoration-none">Follow-ups</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6">
          <h5 class="text-primary mb-3">Newsletter</h5>
          <p class="text-secondary">Subscribe to our newsletter for health tips and updates.</p>
          <form action="" class="mt-3">
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Enter your email">
              <button class="btn btn-primary" type="button">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid bg-light py-3">
      <div class="container text-center">
        <p class="mb-0 text-secondary">&copy; <span>Copyright</span> <strong class="text-primary">Medilab</strong> <span>All Rights Reserved</span></p>
        <div class="small text-secondary mt-2">
          Designed by <a href="https://bootstrapmade.com/" class="text-decoration-none">BootstrapMade</a> | Distributed by <a href="https://themewagon.com" class="text-decoration-none">ThemeWagon</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center no-print"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Find all alert messages
    const alertMessages = document.querySelectorAll('.alert');
    
    // If any alert messages exist, set a timeout to hide them after 10 seconds
    if (alertMessages.length > 0) {
      setTimeout(function() {
        alertMessages.forEach(function(alert) {
          // Fade out effect
          alert.style.transition = 'opacity 1s';
          alert.style.opacity = '0';
          
          // After fade completes, remove the element from DOM
          setTimeout(function() {
            alert.remove();
          }, 1000);
        });
      }, 10000);
    }
  });
  </script>
</body>
</html>