<?php 
include ("../patient_backend/payment-online-receipt.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Starter Page - Medilab Bootstrap Template</title>
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
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <style>
    
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
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          >
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../../index.php" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->

          <h1 class="sitename">Medilab</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../../index.php">Home<br></a></li>
            <li><a href="../patient_backend//test-timeslotsfetching.php">About</a></li>
            <li><a href="services_option.php">Services</a></li>
            <li><a href="#departments">Departments</a></li>
            <li><a href="#doctors">Doctors</a></li>
            <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="#">Deep Dropdown 1</a></li>
                    <li><a href="#">Deep Dropdown 2</a></li>
                    <li><a href="#">Deep Dropdown 3</a></li>
                    <li><a href="#">Deep Dropdown 4</a></li>
                    <li><a href="#">Deep Dropdown 5</a></li>
                  </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
              </ul>
            </li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a>
      </div>
    </div>
  </header>

  <main id="main" class="mt-5 pt-5">
    <section id="payment-section" class="payment-section py-5">
      <div class="container">
        <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #0d3b66;">Payment</h2>

       
        </div>

        <?php if ($payment_success): ?>
        <!-- Show receipt if payment was successful -->
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="alert alert-success">
              <?php echo $payment_message; ?>
            </div><?php endif; ?>
            <div id="printable-area">
              <div class="card mb-4 border">
                <div class="card-header bg-success text-white">
                  <div class="d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0">Payment Receipt</h3>
                    <button type="button" class="btn btn-sm btn-light no-print" onclick="window.print()">
                      <i class="bi bi-printer me-1"></i> Print Receipt
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="text-center mb-4">
                    <h2 class="h4">Medilab Medical Center</h2>
                    <p class="mb-0">A108 Adam Street, New York, NY 535022</p>
                    <p>Phone: +1 5589 55488 55 | Email: info@example.com</p>
                  </div>
                  
                  <div class="row mb-4">
                    <div class="col-6">
                      <h5 class="text-muted h6">Receipt Number</h5>
                      <p class="fw-bold">REC-<?php echo $_SESSION['rand1']; ?></p>
                    </div>
                    <div class="col-6 text-end">
                      <h5 class="text-muted h6">Date & Time</h5>
                      <p class="fw-bold"><?php echo date('Y-m-d H:i:s'); ?></p>
                    </div>
                  </div>
                  
                  <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                      <tr>
                        <th class="bg-light">Patient Name:</th>
                        <td><?php echo $_SESSION['user_name']; ?></td>
                      </tr>
                      <tr>
                        <th class="bg-light">Doctor:</th>
                        <td><?php echo $doctors[0]['Name'] . ' - ' . $doctors[0]['Specialization']; ?></td>
                      </tr>
                      <tr>
                        <th class="bg-light">Date & Time:</th>
                        <td><?php echo date("F j, Y", strtotime($_SESSION['date'])) . ' - ' . $_SESSION['time']; ?></td>
                      </tr>
                      <tr>
                        <th class="bg-light">Service:</th>
                        <td><?php echo $tests[0]['Name']; ?></td>
                      </tr>
                    </table>
                  </div>
                  
                  <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                      <thead class="table-light">
                        <tr>
                          <th>Description</th>
                          <th class="text-end">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo $tests[0]['Name']; ?></td>
                          <td class="text-end"><?php echo $tests[0]['Fee'] . '$'; ?></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <td class="text-end"><?php echo $tests[0]['Fee'] . '$'; ?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  
                  <div class="row mb-3">
                    <div class="col-6">
                      <h5 class="text-muted h6">Payment Method</h5>
                      <p>Credit Card (xxxx-xxxx-xxxx-<?php echo substr( $_SESSION['rand1'], -4); ?>)</p>
                    </div>
                    <div class="col-6 text-end">
                      <h5 class="text-muted h6">Payment Status</h5>
                      <p class="badge bg-success fs-6">PAID</p>
                    </div>
                  </div>
                  
                  <div class="alert alert-info mt-4 mb-0">
                    <p class="mb-0"><small>Please bring this receipt with you on the day of your appointment.</small></p>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        </main>

<footer id="footer" class="footer light-background">
  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="sitename">Medilab</span>
        </a>
        <div class="footer-contact pt-3">
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Terms of service</a></li>
          <li><a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Our Services</h4>
        <ul>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Web Development</a></li>
          <li><a href="#">Product Management</a></li>
          <li><a href="#">Marketing</a></li>
          <li><a href="#">Graphic Design</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Hic solutasetp</h4>
        <ul>
          <li><a href="#">Molestiae accusamus iure</a></li>
          <li><a href="#">Excepturi dignissimos</a></li>
          <li><a href="#">Suscipit distinctio</a></li>
          <li><a href="#">Dilecta</a></li>
          <li><a href="#">Sit quas consectetur</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Nobis illum</h4>
        <ul>
          <li><a href="#">Ipsam</a></li>
          <li><a href="#">Laudantium dolorum</a></li>
          <li><a href="#">Dinera</a></li>
          <li><a href="#">Trodelas</a></li>
          <li><a href="#">Flexo</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
    </div>
  </div>
</footer>


<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



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
  
  // If any alert messages exist, set a timeout to hide them after 4 seconds
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
    }, 4000); // 4 seconds
  }
});
  </script>
</body>
</html>