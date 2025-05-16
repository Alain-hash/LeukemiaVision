<?php 
include("../patient_backend/payment-online-receipt.php");
include("../patient_backend/payment-onsite-receipt.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Payment - Medilab</title>
  <meta name="description" content="Secure payment processing for Medilab healthcare appointments">
  <meta name="keywords" content="medical payment, healthcare, appointment, secure checkout">

  <!-- Favicons -->
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    :root {
      --primary-color: var(--accent-color);
      --secondary-color: var(--accent-color);
      --light-blue: #f8fbfe;
      --text-gray: #555555;
    }
    
    .bg-light-blue {
      background-color: var(--light-blue);
    }
    
    .text-primary {
      color: var(--primary-color) !important;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }
    
    .card {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .card:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    .bg-primary {
      background-color: var(--primary-color) !important;
    }
    
    @media print {
      .no-print {
        display: none;
      }
      body {
        margin: 0;
        padding: 0;
      }
    }
  </style>
</head>

<body>
  <header id="header" class="header sticky-top">
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

  <main id="main" class="mt-5 pt-3">
    <section id="payment-section" class="payment-section py-5 bg-light-blue">
      <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-delay="100">
          <h2 class="fw-bold text-primary display-5 mb-2">Secure Payment</h2>
          <div class="d-flex justify-content-center">
            <div class="border-bottom border-primary" style="width: 80px;"></div>
          </div>
          <p class="text-muted mt-3">Complete your payment securely to confirm your appointment</p>
        </div>
        
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-10">

          <?php 
          
          ?>

            <!-- Appointment Summary Card -->
            <div class="card mb-4 border-0">
              <div class="card-header bg-primary text-white py-3">
                <h3 class="h5 mb-0 fw-bold"><i class="bi bi-calendar-check me-2"></i>Appointment Summary</h3>
              </div>
              <div class="card-body bg-white">
                <div class="table-responsive">
                  <table class="table table-bordered mb-0">
                    <tr>
                      <th class="bg-light w-25 text-secondary">Patient Name:</th>
                      <td id="summary-patient-name" class="fw-medium"><?= $_SESSION['user_name']; ?></td>
                    </tr>
                    <tr>
                      <th class="bg-light text-secondary">Doctor:</th>
                      <td id="summary-doctor" class="fw-medium"><?= $doctors[0]['Name'] . ' - ' . $doctors[0]['Specialization']; ?></td>
                    </tr>
                    <tr>
                      <th class="bg-light text-secondary">Date & Time:</th>
                      <td id="summary-datetime" class="fw-medium"><?php echo date("F j, Y", strtotime($_SESSION['date'])) . ' - ' . $_SESSION['time']; ?></td>
                    </tr>
                    <tr>
                      <th class="bg-light text-secondary">Service:</th>
                      <td id="summary-servicetype" class="fw-medium"><?= $tests[0]['Name'] ?></td>
                    </tr>
                    <tr>
                      <th class="bg-light text-secondary">Amount:</th>
                      <td id="summary-service-fee" class="fw-bold text-primary"><?= $tests[0]['Fee'] . '$' ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            <!-- Payment Method Selection -->
            <div class="card mb-4 border-0">
              <div class="card-header bg-primary text-white py-3">
                <h3 class="h5 mb-0 fw-bold"><i class="bi bi-credit-card me-2"></i>Select Payment Method</h3>
              </div>
              <div class="card-body bg-white p-4">
                <div class="row g-4">
                  <!-- Online Payment Option -->
                  <div class="col-md-6">
                    <div class="card h-100 border shadow-sm" id="online-option">
                      <div class="card-body text-center p-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment-method" id="online-payment" value="online">
                          <label class="form-check-label" for="online-payment">
                            <div class="mb-3">
                              <i class="bi bi-credit-card text-primary fs-1"></i>
                            </div>
                            <h4 class="fw-bold">Pay Online Now</h4>
                            <p class="text-muted">Complete your payment now using a credit/debit card and receive an electronic receipt.</p>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- On-site Payment Option -->
                  <div class="col-md-6">
                    <div class="card h-100 border shadow-sm" id="onsite-option">
                      <div class="card-body text-center p-4">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="payment-method" id="onsite-payment" value="onsite">
                          <label class="form-check-label" for="onsite-payment">
                            <div class="mb-3">
                              <i class="bi bi-hospital text-primary fs-1"></i>
                            </div>
                            <h4 class="fw-bold">Pay at the Clinic</h4>
                            <p class="text-muted">Get a payment voucher to bring to the clinic. Pay on the day of your appointment.</p>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Online Payment Form (Initially Hidden) -->
                <div id="online-payment-form" class="mt-4 d-none">
                  <form action="payment-online-receipt.php" method="POST">
                    <div class="card border">
                      <div class="card-header bg-light">
                        <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-lock-fill me-2"></i>Credit/Debit Card Information</h5>
                      </div>
                      <div class="card-body">
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="card-name" class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control form-control-lg" id="card-name" name="card-name" placeholder="Name on card" required>
                          </div>

                          <div class="col-12">
                            <label for="card-number" class="form-label">Card Number</label>
                            <div class="input-group">
                              <input type="text" class="form-control form-control-lg" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>
                              <span class="input-group-text bg-white">
                                <i class="bi bi-credit-card text-primary"></i>
                              </span>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <label for="expiry-date" class="form-label">Expiration Date</label>
                            <input type="text" class="form-control form-control-lg" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>
                          </div>

                          <div class="col-md-6">
                            <label for="cvv" class="form-label">CVV</label>
                            <div class="input-group">
                              <input type="text" class="form-control form-control-lg" id="cvv" name="cvv" placeholder="123" required>
                              <span class="input-group-text bg-white" data-bs-toggle="tooltip" data-bs-placement="right" title="3-digit security code on the back of your card">
                                <i class="bi bi-question-circle text-primary"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white border-top-0 p-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold"><i class="bi bi-shield-lock me-2"></i><?= 'Pay ' . $tests[0]['Fee'] . '$' ?></button>
                        <div class="text-center mt-3">
                          <small class="text-muted"><i class="bi bi-shield-check me-1"></i>Your payment information is secured with SSL encryption</small>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- On-site Payment Option (Initially Hidden) -->
                <div id="onsite-payment-instructions" class="mt-4 d-none">
                  <div class="card border bg-light">
                    <div class="card-body p-4">
                      <h5 class="fw-bold text-primary"><i class="bi bi-info-circle me-2"></i>Payment Instructions</h5>
                      <ol class="mt-3">
                        <li class="mb-2">Click the "Generate Payment Voucher" button below</li>
                        <li class="mb-2">Print the voucher that appears</li>
                        <li class="mb-2">Bring the printed voucher to the clinic on the day of your appointment</li>
                        <li>Make the payment at our reception desk</li>
                      </ol>
                      <!-- Form for Generating Voucher -->
                      <form action="payment-onsite-receipt.php" method="POST">
                        <button type="submit" id="generate-voucher-btn" class="btn btn-primary btn-lg mt-3 w-100 fw-bold" name="generate_voucher">
                          <i class="bi bi-printer me-2"></i>Generate Payment Voucher
                        </button>
                        <!-- Hidden Fields to pass data to backend -->
                        <input type="hidden" name="patient_name" value="<?php echo $_SESSION['user_name']; ?>">
                        <input type="hidden" name="doctor_name" value="<?php echo $doctors[0]['Name']; ?>">
                        <input type="hidden" name="doctor_specialization" value="<?php echo $doctors[0]['Specialization']; ?>">
                        <input type="hidden" name="appointment_date" value="<?php echo date("F j, Y", strtotime($_SESSION['date'])); ?>">
                        <input type="hidden" name="appointment_time" value="<?php echo $_SESSION['time']; ?>">
                        <input type="hidden" name="service_name" value="<?php echo $tests[0]['Name']; ?>">
                        <input type="hidden" name="fee" value="<?php echo $tests[0]['Fee']; ?>">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer bg-white border-top">
    <div class="container footer-top py-5">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename text-primary fw-bold">Medilab</span>
          </a>
          <div class="footer-contact pt-3 text-muted">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="" class="bg-primary text-white p-2 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
              <i class="bi bi-twitter-x"></i>
            </a>
            <a href="" class="bg-primary text-white p-2 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="" class="bg-primary text-white p-2 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="" class="bg-primary text-white p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
              <i class="bi bi-linkedin"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4 class="text-primary fw-bold">Useful Links</h4>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Home</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>About us</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Services</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Terms of service</a></li>
            <li><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4 class="text-primary fw-bold">Our Services</h4>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>General Checkup</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Laboratory Tests</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Specialist Consult</a></li>
            <li class="mb-2"><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Emergency Care</a></li>
            <li><a href="#" class="text-decoration-none text-muted"><i class="bi bi-chevron-right me-1 text-primary"></i>Online Support</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6">
          <h4 class="text-primary fw-bold">Newsletter</h4>
          <p class="text-muted">Subscribe to our newsletter for health tips and updates</p>
          <form action="" method="post" class="mt-3">
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Your Email">
              <button class="btn btn-primary" type="button">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container copyright text-center py-3 border-top">
      <p class="m-0 text-muted">© <span>Copyright</span> <strong class="px-1 text-primary">Medilab</strong> <span>All Rights Reserved</span></p>
      <div class="credits text-muted">
        Designed by <a href="https://bootstrapmade.com/" class="text-primary">BootstrapMade</a> Distributed by <a href="https://themewagon.com" class="text-primary">ThemeWagon</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow" style="width: 40px; height: 40px; position: fixed; right: 20px; bottom: 20px; z-index: 999;">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>
  
  <!-- Payment Page Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize AOS
      AOS.init({
        duration: 1000,
        once: true
      });
      
      // Initialize tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });
      
      // Get elements
      const onlinePaymentRadio = document.getElementById('online-payment');
      const onsitePaymentRadio = document.getElementById('onsite-payment');
      const onlinePaymentForm = document.getElementById('online-payment-form');
      const onsitePaymentInstructions = document.getElementById('onsite-payment-instructions');
      const onlineOption = document.getElementById('online-option');
      const onsiteOption = document.getElementById('onsite-option');
      const generateVoucherBtn = document.getElementById('generate-voucher-btn');
      const voucherArea = document.getElementById('voucher-area');

      // Payment method selection
      onlinePaymentRadio.addEventListener('change', function() {
        if (this.checked) {
          onlinePaymentForm.classList.remove('d-none');
          onsitePaymentInstructions.classList.add('d-none');
          if (voucherArea) voucherArea.classList.add('d-none');
          onlineOption.classList.add('border-primary');
          onsiteOption.classList.remove('border-primary');
        }
      });

      onsitePaymentRadio.addEventListener('change', function() {
        if (this.checked) {
          onsitePaymentInstructions.classList.remove('d-none');
          onlinePaymentForm.classList.add('d-none');
          onsiteOption.classList.add('border-primary');
          onlineOption.classList.remove('border-primary');
        }
      });

      // Generate voucher for on-site payment
      if (generateVoucherBtn && voucherArea) {
        generateVoucherBtn.addEventListener('click', function() {
          voucherArea.classList.remove('d-none');
          voucherArea.scrollIntoView({ behavior: 'smooth' });
        });
      }
      
      // Credit card input formatting
      const cardNumberInput = document.getElementById('card-number');
      if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function (e) {
          // Remove non-digits
          let value = this.value.replace(/\D/g, '');
          // Add space after every 4 digits
          value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
          // Update input value
          this.value = value;
        });
      }
      
      const expiryDateInput = document.getElementById('expiry-date');
      if (expiryDateInput) {
        expiryDateInput.addEventListener('input', function (e) {
          // Remove non-digits
          let value = this.value.replace(/\D/g, '');
          // Format as MM/YY
          if (value.length > 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
          }
          // Update input value
          this.value = value;
        });
      }
    });
  </script>
</body>
</html>