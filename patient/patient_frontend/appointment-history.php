<?php 
include("../patient_backend/appointment-history.php"); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>LeukemiaVision - AI-Powered Leukemia Detection</title>
    <meta name="description"
        content="LeukemiaVision uses advanced AI technology to classify leukemia cancer from blood smear images, providing accurate and efficient diagnosis support for medical professionals.">
    <meta name="keywords"
        content="Leukemia detection, AI diagnosis, medical imaging, cancer classification, blood smear analysis">

    <!-- Favicons -->
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../../assets/css/main.css" rel="stylesheet">

  <!-- Main CSS File (Minimal Custom CSS) -->
  <style>
    :root {
      --primary-blue: #1977cc;
      --secondary-blue: #106eea;
      --light-blue: #e7f1fd;
      --dark-blue: #2c4964;
      --white: #ffffff;
      --light-gray: #f8f9fa;
      --medium-gray: #e9ecef;
      --text-color: #444444;
      --success-color: #28a745;
      --danger-color: #dc3545;
      --warning-color: #ffc107;
    }

    body {
      font-family: "Roboto", sans-serif;
      color: var(--text-color);
      background-color: #f5f7fa;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: "Poppins", sans-serif;
      color: var(--dark-blue);
    }

    .bg-primary-blue {
      background-color: var(--primary-blue) !important;
    }

    .text-primary-blue {
      color: var(--primary-blue) !important;
    }

    .btn-primary {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
    }

    .btn-primary:hover {
      background-color: var(--secondary-blue);
      border-color: var(--secondary-blue);
    }

    .btn-outline-primary {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
    }

    .btn-outline-primary:hover {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
    }

    .table-head-blue th {
      background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
      color: white;
      border: none;
    }

    .appointment-card {
      border-radius: 10px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: none;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .appointment-card:hover {
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      transform: translateY(-3px);
    }

    .cancel-btn {
      background-color: var(--danger-color);
      color: white;
      border: none;
      border-radius: 4px;
      padding: 4px 10px;
      font-size: 0.875rem;
      line-height: 1.5;
      height: 30px;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      white-space: nowrap;
    }

    .cancel-btn:hover {
      background-color: #c82333;
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    }

    .badge-status {
      padding: 6px 10px;
      border-radius: 20px;
      font-weight: 500;
      font-size: 12px;
    }

    .bg-status-confirmed {
      background-color: rgba(40, 167, 69, 0.15);
      color: #28a745;
    }

    .bg-status-pending {
      background-color: rgba(255, 193, 7, 0.15);
      color: #d39e00;
    }

    .bg-status-cancelled {
      background-color: rgba(220, 53, 69, 0.15);
      color: #dc3545;
    }

    .bg-status-completed {
      background-color: rgba(108, 117, 125, 0.15);
      color: #6c757d;
    }

    .modal-confirm .modal-header {
      border-bottom: none;
      position: relative;
    }

    .modal-cancel .modal-header {
      background: linear-gradient(to right, #dc3545, #ff4d4d);
      color: white;
    }

    .icon-box {
      text-align: center;
      margin: 0 auto;
      width: 95px;
      height: 95px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }

    .cancel-icon-box {
      background-color: rgba(220, 53, 69, 0.15);
      color: #dc3545;
    }

    .nav-tabs .nav-link {
      color: var(--dark-blue);
      font-weight: 500;
      border: none;
      border-bottom: 3px solid transparent;
    }

    .nav-tabs .nav-link.active {
      color: var(--primary-blue);
      background-color: transparent;
      border-bottom: 3px solid var(--primary-blue);
    }

    .appointment-table th {
      white-space: nowrap;
    }

    .scroll-top {
      position: fixed;
      visibility: hidden;
      opacity: 0;
      right: 15px;
      bottom: 15px;
      z-index: 99999;
      background: var(--primary-blue);
      width: 40px;
      height: 40px;
      border-radius: 4px;
      transition: all 0.4s;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .scroll-top.active {
      visibility: visible;
      opacity: 1;
    }
      /* Styles for header profile image */
.header-profile-container {
  display: flex;
  align-items: center;
}

.header-profile-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 15px;
  border: 2px solid #007bff;
}

@media (max-width: 768px) {
  .header-profile-image {
    width: 40px;
    height: 40px;
    margin-right: 10px;
  }
}
  </style>
</head>


<body class="index-page">

<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@leukemiavision.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 (800) 555-1234</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../../index.php" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="index.html#about">About</a></li>
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#doctors">Doctors</a></li>
            <li class="dropdown"><a href="#" class="active"><span>Patient Portal</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                        <li><a href="medications.php"> Medications</a></li>
                        <li><a href="patient_progress.php"> Results & Progress</a></li>
                        <li><a href="appointment-history.php">Your Appointments </a></li>
                        
                    </ul>
            </li>
            <li><a href="index.html#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="cta-btn d-none d-sm-block" href="book-appointment.php">Book Appointment</a>
      </div>
    </div>
  </header>
</body>

  <!-- Main Content - Appointment History -->
  <main id="main" class="my-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="section-title text-center mb-4">
            <h2 class="fw-bold">My Appointments</h2>
            <p class="text-muted">View and manage all your scheduled appointments</p>
          </div>

          <!-- Appointment Tabs -->
          <ul class="nav nav-tabs justify-content-center mb-4" id="appointmentTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active px-4 py-3" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="true">
                <i class="bi bi-calendar-event me-2"></i>Upcoming
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link px-4 py-3" id="past-tab" data-bs-toggle="tab" data-bs-target="#past" type="button" role="tab" aria-controls="past" aria-selected="false">
                <i class="bi bi-calendar-check me-2"></i>Past
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link px-4 py-3" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">
                <i class="bi bi-calendar-x me-2"></i>Cancelled
              </button>
            </li>
          </ul>

          <div class="tab-content shadow-sm rounded-3 bg-white p-4" id="appointmentTabContent">
            <!-- Upcoming Appointments Tab -->
            <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
              <div class="table-responsive">
                <table class="table table-hover appointment-table">
                  <thead class="table-head-blue">
                    <tr>
                      <th>Date & Time</th>
                      <th>Service</th>
                      <th>Doctor</th>
                      <th>Specialty</th>
                      <th>Status</th>
                      <th>Payment</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = $result1->fetch_assoc()){ ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['App_Date'] . ' / ' . $row['App_Time'])?></td>
                      <td><?php echo $row['service_name']?></td>
                      <td><?php echo $row['doctor_name']?></td>
                      <td><?php echo $row['doctor_specialization']?></td>
                      <td><span class="badge bg-status-confirmed"><?php echo $row['appointment_status']?></span></td>
                      <td><span class="badge bg-light text-dark"><?php echo $row['payment_status']?></span></td>
                      <td>
                      <button type="button" class="btn btn-danger cancel-btn"
        data-bs-toggle="modal"
        data-bs-target="#cancelModal"
        data-id="<?= $row['Appointment_ID'] ?>"
        data-date="<?= $row['App_Date'] . ' ' . $row['App_Time'] ?>"
        data-type="<?= htmlspecialchars($row['service_name']) ?>"
        data-doctor="<?= htmlspecialchars($row['doctor_name']) ?>"
        data-specialty="<?= htmlspecialchars($row['doctor_specialization']) ?>"
        data-downpaymentamount="$<?= number_format($row['Service_Fee'], 2) ?>"
        >
    Cancel
</button>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="alert alert-primary mt-3 d-flex align-items-center">
                <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                <div>
                  <strong>Cancellation Policy:</strong>
                  <ul class="mb-0 mt-2">
                    <li>Full refund (100%) if cancelled within 6 hours of making the reservation.</li>
                    <li>No refund if cancelled after 6 hours of making the reservation.</li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Past Appointments Tab -->
            <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
              <div class="table-responsive">
                <table class="table table-hover appointment-table">
                  <thead class="table-head-blue">
                    <tr>
                      <th>Date & Time</th>
                      <th>Service</th>
                      <th>Doctor</th>
                      <th>Specialty</th>
                      <th>Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = $result3->fetch_assoc()){ ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['App_Date'] . ' / ' . $row['App_Time'])?></td>
                      <td><?php echo $row['service_name']?></td>
                      <td><?php echo $row['doctor_name']?></td>
                      <td><?php echo $row['doctor_specialization']?></td>
                      <td><span class="badge bg-status-completed"><?php echo $row['appointment_status']?></span></td>
                     
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Cancelled Appointments Tab -->
            <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
              <div class="table-responsive">
                <table class="table table-hover appointment-table">
                  <thead class="table-head-blue">
                    <tr>
                      <th>Date & Time</th>
                      <th>Service</th>
                      <th>Doctor</th>
                      <th>Specialty</th>
                      <th>Payment</th>
                      <th>Refund Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = $result4->fetch_assoc()){ ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['App_Date'] . ' / ' . $row['App_Time'])?></td>
                      <td><?php echo $row['service_name']?></td>
                      <td><?php echo $row['doctor_name']?></td>
                      <td><?php echo $row['doctor_specialization']?></td>
                      <td><span class="badge bg-light text-dark"><?php echo $row['payment_status']?></span></td>
                      <td><span class="badge bg-success text-white"><?php echo $row['Refund_status']?></span></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Cancel Appointment Modal (Enhanced) -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content animate__animated animate__fadeIn">
        <div class="modal-header modal-cancel">
          <h5 class="modal-title" id="cancelModalLabel"><i class="bi bi-exclamation-triangle me-2"></i>Cancel Appointment</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <!-- <div class="cancel-icon-box text-center mb-4">
          Are you sure you want to cancel this appointment?
            <i class="bi bi-calendar-x fs-1"></i>
          </div>
           -->
          <h5 class="text-center text-danger mb-4">Are you sure you want to cancel this appointment?</h5>
          
          <div class="appointment-details p-3 mb-4 bg-light rounded">
            <div class="row mb-2">
              <div class="col-5 fw-bold">Appointment:</div>
              <div class="col-7" id="modal-appointment-type"></div>
            </div>
            <div class="row mb-2">
              <div class="col-5 fw-bold">Date/Time:</div>
              <div class="col-7" id="modal-appointment-date"></div>
            </div>
            <div class="row mb-2">
              <div class="col-5 fw-bold">Doctor:</div>
              <div class="col-7" id="modal-appointment-doctor"></div>
            </div>
            <div class="row">
              <div class="col-5 fw-bold">Specialty:</div>
              <div class="col-7" id="modal-appointment-specialty"></div>
            </div>
          </div>

          <div class="alert alert-warning">
            <div class="d-flex">
              <div class="me-3">
                <i class="bi bi-credit-card-2-front fs-4"></i>
              </div>
              <div>
                <h6 class="alert-heading">Payment Information</h6>
                <p class="mb-0"><strong>Amount paid:</strong> <span id="downPaymentAmount"></span></p>

              </div>
            </div>
          </div>
          
          <div class="alert alert-info">
            <div class="d-flex">
              <div class="me-3">
                <i class="bi bi-info-circle fs-4"></i>
              </div>
              <div>
                <h6 class="alert-heading">Refund Policy</h6>
                <p class="mb-0" id="refundMessage">If cancelled within 6 hours of booking, you will receive a <strong>FULL REFUND</strong>. Otherwise, <strong>NO REFUND</strong> will be provided.</p>
              </div>
            </div>
          </div>

          <form id="cancelAppointmentForm" method="POST" action="../patient_backend/appointment-history.php">
            <input type="hidden" id="appointmentIdInput" name="Appointment_ID" value="">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
              <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                <i class="bi bi-x-circle me-2"></i>Keep Appointment
              </button>
              <button type="submit" class="btn btn-danger px-4">
                <i class="bi bi-trash me-2"></i>Cancel Appointment
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Notification -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="appointmentToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-success text-white">
        <i class="bi bi-check-circle me-2"></i>
        <strong class="me-auto">Success</strong>
        <small>Just now</small>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Your appointment has been successfully cancelled. The refund will be processed according to our policy.
      </div>
    </div>
  </div>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer light-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">LeukemiaVision</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@leukemiavision.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href="#"><i class="bi bi-twitter-x"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
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
            <li><a href="#">Leukemia Detection</a></li>
            <li><a href="#">Blood Analysis</a></li>
            <li><a href="#">Medical Consulting</a></li>
            <li><a href="#">Diagnostic Reports</a></li>
            <li><a href="#">Treatment Planning</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Resources</h4>
          <ul>
            <li><a href="#">Research Papers</a></li>
            <li><a href="#">Medical Journals</a></li>
            <li><a href="#">Case Studies</a></li>
            <li><a href="#">Patient Education</a></li>
            <li><a href="#">Doctor Profiles</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Support</h4>
          <ul>
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Help Center</a></li>
            <li><a href="#">Contact Support</a></li>
            <li><a href="#">Book Appointment</a></li>
            <li><a href="#">Feedback</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">LeukemiaVision</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
  // Wait for the DOM to fully load
  document.addEventListener('DOMContentLoaded', function() {
    // Get all cancel buttons
    const cancelButtons = document.querySelectorAll('.cancel-btn');
    
    // Modal data population - this uses the data attributes from the button
document.getElementById('cancelModal').addEventListener('show.bs.modal', function(event) {
  const button = event.relatedTarget;

  const appointmentId = button.getAttribute('data-id');
  const appointmentDate = button.getAttribute('data-date');
  const appointmentType = button.getAttribute('data-type');
  const doctor = button.getAttribute('data-doctor');
  const specialty = button.getAttribute('data-specialty');
  const downPaymentAmount = button.getAttribute('data-downpaymentamount');

  // Populate modal
  document.getElementById('modal-appointment-type').textContent = appointmentType;
  document.getElementById('modal-appointment-date').textContent = appointmentDate;
  document.getElementById('modal-appointment-doctor').textContent = doctor;
  document.getElementById('modal-appointment-specialty').textContent = specialty;
  document.getElementById('downPaymentAmount').textContent = downPaymentAmount;
  document.getElementById('appointmentIdInput').value = appointmentId;
});

    
    // Check URL parameters for showing success toast
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('status') === 'cancelled') {
  // Show the toast notification
  const toast = new bootstrap.Toast(document.getElementById('appointmentToast'));
  toast.show();

  // Remove the query parameter from the URL without reloading
  const newUrl = window.location.origin + window.location.pathname;
  window.history.replaceState({}, document.title, newUrl);
}
});
  </script>
</body>
</html>