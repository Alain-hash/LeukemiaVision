<?php
session_start();

include("../../database/db.php");

$user_id = $_SESSION['user_id'];

$stmt2 = $connection->prepare("SELECT Patient_ID FROM Patient WHERE User_ID=?");
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$result2 = $stmt2->get_result();

$Patient_ID = null;
while ($row = $result2->fetch_assoc()) {
    $Patient_ID = $row['Patient_ID'];
}
$stmt2->close();

if ($Patient_ID) {
    $stmt = $connection->prepare("SELECT * FROM appointment WHERE Patient_ID=? AND Status='Scheduled'");
    $stmt->bind_param("s", $Patient_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    $Double_Reservation_Restriction='';
    if ($result->num_rows > 0) {
        $Double_Reservation_Restriction = 'You already have an active appointment scheduled. To proceed with a new booking, please manage your existing appointment first.';
    }

    $stmt->close();
  }

// Function to display error message
function display_error($field) {
    if (isset($_SESSION['form_errors']) && isset($_SESSION['form_errors'][$field])) {
        echo '<div class="text-danger mt-1">' . $_SESSION['form_errors'][$field] . '</div>';
        return true;
    }
    return false;
}

// Function to preserve form input values after validation failure
function get_input_value($field) {
    if (isset($_SESSION[$field])) {
        return htmlspecialchars($_SESSION[$field]);
    }
    return '';
}

// Clear errors after displaying them
$display_errors = isset($_SESSION['form_errors']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Test Appointment - Medilab Healthcare Services</title>
  <meta name="description" content="Schedule your medical tests and appointments with top specialists at Medilab">
  <meta name="keywords" content="healthcare, appointment, medical tests, specialists, doctors">

  <!-- Favicons -->
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../../assets/css/main.css" rel="stylesheet">
  
  <!-- Minimal Custom CSS -->
  <style>
    
    
:root {
  --primary-blue: var(--accent-color); /* Change this to your dark blue */
  --light-blue: #e7f5ff;
  --dark-blue: var(--accent-color);   /* Darker shade of your accent */
  --light-grey: #f8f9fa;
  --mid-grey: #e9ecef;
  --dark-grey: #6c757d;
}

    
    .bg-primary-blue {
      background-color: var(--primary-blue) !important;
    }
    
    .text-primary-blue {
      color: var(--primary-blue) !important;
    }
    
    .border-primary-blue {
      border-color: var(--primary-blue) !important;
    }
    
    .btn-primary {
      background-color: var(--primary-blue);
      border-color: var(--primary-blue);
    }
    
    .btn-primary:hover {
      background-color: var(--dark-blue);
      border-color: var(--dark-blue);
    }
    
    .time-slot-btn {
      transition: all 0.2s ease;
    }
    
    .time-slot-btn.selected {
      background-color: var(--primary-blue) !important;
      color: white !important;
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

<body>
  
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
        <a href="../../index.html" class="logo d-flex align-items-center me-auto">
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
                        <li><a href="patient_progress.php"> progress</a></li>
                        <li><a href="appointment-history.php">Your Appointments </a></li>
                        <li><a href="test-results.php">Appointment Results</a></li>
                    </ul>
            </li>
            <li><a href="index.php#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <div class="d-flex align-items-center">
                  

                  
                          <a href="logout.php">
                            <button class="cta-btn btn-sm ms-5 border-0" type="button">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </a>
                   



                </div>
      </div>
    </div>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="bg-light-blue py-4">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-primary-blue mb-3">Schedule Your Medical Test</h1>
            <p class="lead text-dark-grey mb-4">Book your appointment with our specialized doctors and receive the highest quality of care for your health needs.</p>
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill text-primary-blue fs-5 me-2"></i>
              <span>Advanced diagnostic equipment</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-check-circle-fill text-primary-blue fs-5 me-2"></i>
              <span>Experienced medical specialists</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-check-circle-fill text-primary-blue fs-5 me-2"></i>
              <span>Convenient online scheduling</span>
            </div>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0 text-center">
            <img src="../../assets/img/gpt1.png" alt="Medical Test" class="img-fluid rounded shadow">
          </div>
        </div>
      </div>
    </section>

    <!-- Appointment Section -->
    <section id="appointment" class="py-5">
      <div class="container">
        <div class="row g-4">
        <section id="appointment" class="py-5">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="fw-bold text-primary-blue">Test Appointment Booking</h2>
          <div class="d-flex justify-content-center">
            <div class="border-bottom border-3 border-primary-blue" style="width: 50px;"></div>
          </div>
          <p class="mt-3 text-dark-grey">Schedule your test with our specialists based on availability</p>
        </div>


        <?php
if(isset($_SESSION['Absence_message']) && !empty($_SESSION['Absence_message'])) {
  $message = $_SESSION['Absence_message'];
  echo '<div id="absence-alert" class="alert-modal">
          <div class="alert-content">
            <span class="close-btn">&times;</span>
            <p>' . $message . '</p>
          </div>
        </div>';
  

}
unset($_SESSION['Absence_message']);
?>

        <div class="row g-4">
        <?php if(isset($Double_Reservation_Restriction) && !empty($Double_Reservation_Restriction)){ ?>
          <div class="col-lg-12">
  <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-danger text-white p-4">
      <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
        <h4 class="mb-0 text-white" >Appointment Alert</h4>
      </div>
    </div>
    <div class="card-body p-4 text-center">
      <div class="mb-4">
        <i class="bi bi-calendar-x text-danger" style="font-size: 4rem;"></i>
      </div>
      <h5 class="fw-bold mb-3"><?php echo $Double_Reservation_Restriction; ?></h5>
     
      <a href="appointment-history.php" class="btn btn-danger btn-lg rounded-pill px-5 py-3">
        <i class="bi bi-calendar-check me-2"></i>Manage Your Appointments
      </a>
        </div>
  </div>
</div>
<?php } else { ?>
     <!-- Appointment Form -->
<div class="col-lg-8">
  <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-header bg-primary-blue text-white p-4">
      <div class="d-flex align-items-center">
        <i class="bi bi-calendar2-plus fs-3 me-3"></i>
        <h4 class="mb-0">Appointment Request Form</h4>
      </div>
    </div>
    <div class="card-body p-4">
      <!-- Display any general error message -->
      <?php if(isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
          <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        </div>
      <?php endif; ?>
      
      <form id="appointment-form" action="../patient_backend/absence_checking.php" method="POST" class="needs-validation" novalidate>

        <!-- Doctor Selection -->
        <div class="mb-4">
          <h5 class="fw-bold text-primary-blue mb-3 pb-2 border-bottom">
            <i class="bi bi-person-badge me-2"></i>Doctor Selection
          </h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="doctor" class="form-label fw-medium">Select Doctor</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-person-check"></i></span>
                <select class="form-select py-2" id="doctor" name="doctor" required>
                  <option value="" selected disabled>Choose a doctor</option>
                </select>
              </div>
              <?php display_error('doctor'); ?>
            </div>
            <div class="col-md-6">
              <label for="test" class="form-label fw-medium">Select Test</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-clipboard2-pulse"></i></span>
                <select class="form-select py-2" id="test" name="test" required>
                  <option value="" selected disabled>Choose a Test</option>
                </select>
              </div>
              <?php display_error('test'); ?>
            </div>
          </div>
        </div>

        <!-- Date & Time Selection -->
        <div class="mb-4">
          <h5 class="fw-bold text-primary-blue mb-3 pb-2 border-bottom">
            <i class="bi bi-clock-history me-2"></i>Appointment Schedule
          </h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="date" class="form-label fw-medium">Preferred Date</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-calendar-date"></i></span>
                <input type="date" class="form-control py-2" id="date" name="date" required 
                       value="<?php echo get_input_value('date'); ?>">
              </div>
              <?php display_error('date'); ?>
            </div>
            <div class="col-md-6">
              <label for="time" class="form-label fw-medium">Available Time Slots</label>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-clock"></i></span>
                <select class="form-select py-2" id="time" name="time" required>
                  <option value="" selected disabled>Choose a Time Slot</option>
                </select>
              </div>
              <?php display_error('time'); ?>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary w-100 py-3 fw-medium rounded-pill">
            <i class="bi bi-check-circle me-2"></i>Confirm Appointment
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

if ($display_errors) {
    unset($_SESSION['form_errors']);
 
}

unset($_SESSION['doctor_id'], $_SESSION['test_id'], $_SESSION['date'], $_SESSION['time'], $_SESSION['form_errors']);

?>
          <!-- Sidebar Information -->
          <div class="col-lg-4">
           
            
            <!-- Test Information Card -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
              <div class="card-header bg-primary-blue text-white p-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-info-circle me-2"></i>
                  <h5 class="mb-0">Treatment Information</h5>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="d-flex align-items-center mb-3">
                  <div class="rounded-circle bg-light text-primary-blue p-2 me-3">
                    <i class="bi bi-gene fs-4"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-1">Advanced Genetic Analysis</h6>
                    <p class="mb-0 text-muted"><i class="bi bi-clock me-1"></i>Duration: <?php echo $_SESSION['test_service_duration'];?> min</p>
                  </div>
                </div>
                <div class="alert alert-light border-start border-4 border-primary-blue">
                  <i class="bi bi-lightbulb me-2 text-primary-blue"></i>
                  <span>Please arrive 15 minutes before your scheduled appointment time.</span>
                </div>
              </div>
            </div>
            
            <!-- Contact Card -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
              <div class="card-header bg-primary-blue text-white p-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-headset me-2"></i>
                  <h5 class="mb-0">Need Help?</h5>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="d-flex align-items-center mb-3">
                  <div class="rounded-circle bg-light text-primary-blue p-2 me-3">
                    <i class="bi bi-telephone fs-5"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-0">Call Us</h6>
                    <p class="mb-0">+1 (800) MEDILAB</p>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <div class="rounded-circle bg-light text-primary-blue p-2 me-3">
                    <i class="bi bi-envelope fs-5"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-0">Email Us</h6>
                    <p class="mb-0">appointments@medilab.com</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    
    <!-- Why Choose Us Section -->
    <section class="py-5 bg-light">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="fw-bold text-primary-blue">Why Choose LeukemiaVision</h2>
          <div class="d-flex justify-content-center">
            <div class="border-bottom border-3 border-primary-blue" style="width: 50px;"></div>
          </div>
          <p class="mt-3 text-dark-grey">We provide the highest quality healthcare services</p>
        </div>
        
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-3">
              <div class="card-body p-4 text-center">
                <div class="rounded-circle bg-light d-inline-flex p-3 mb-3">
                  <i class="bi bi-award text-primary-blue fs-1"></i>
                </div>
                <h5 class="fw-bold mb-3">Experienced Specialists</h5>
                <p class="text-muted mb-0">Our team consists of board-certified specialists with extensive experience in their fields.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-3">
              <div class="card-body p-4 text-center">
                <div class="rounded-circle bg-light d-inline-flex p-3 mb-3">
                  <i class="bi bi-gear text-primary-blue fs-1"></i>
                </div>
                <h5 class="fw-bold mb-3">Advanced Technology</h5>
                <p class="text-muted mb-0">We utilize state-of-the-art equipment and the latest medical technologies for accurate diagnosis.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-3">
              <div class="card-body p-4 text-center">
                <div class="rounded-circle bg-light d-inline-flex p-3 mb-3">
                  <i class="bi bi-heart-pulse text-primary-blue fs-1"></i>
                </div>
                <h5 class="fw-bold mb-3">Patient-Centered Care</h5>
                <p class="text-muted mb-0">We prioritize your comfort and well-being throughout your healthcare journey with us.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
  
  <div class="bg-primary-blue text-white text-center py-3">
    <p class="mb-0">&copy; 2025 Medilab. All Rights Reserved.</p>
  </div>

  <!-- Scroll Top Button -->
  <a href="#" class="btn btn-primary rounded-circle position-fixed bottom-0 end-0 m-4 shadow" id="back-to-top">
    <i class="bi bi-arrow-up"></i>
  </a>

  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../../assets/js/main.js"></script>
  <script>
  $(document).ready(function() {
  // Set previously selected values if coming back from validation error
  let selectedDoctorId = '<?php echo isset($_SESSION["doctor_id"]) ? $_SESSION["doctor_id"] : ""; ?>';
  let selectedTestId = '<?php echo isset($_SESSION["test_id"]) ? $_SESSION["test_id"] : ""; ?>';
  let selectedDate = '<?php echo isset($_SESSION["date"]) ? $_SESSION["date"] : ""; ?>';
  let selectedTime = '<?php echo isset($_SESSION["time"]) ? $_SESSION["time"] : ""; ?>';
  
  // Set minimum date to today
  const today = new Date().toISOString().split('T')[0];
  $('#date').attr('min', today);
  
  // If there's a selected date from previous form submission
  if (selectedDate) {
    $('#date').val(selectedDate);
  }
  
  // Function to load doctors
  function loadDoctors() {
    $.ajax({
      url: '../patient_backend/test-doctorsfetching.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        let doctorSelect = $('#doctor');
        doctorSelect.empty().append('<option value="" selected disabled>Choose a doctor</option>');
        $.each(data, function(index, doctor) {
          doctorSelect.append('<option value="' + doctor.Doctor_ID + '">Dr. ' + doctor.Name + ' - ' + doctor.Specialization + '</option>');
        });
        
        // Set previously selected doctor if exists
        if (selectedDoctorId) {
          $('#doctor').val(selectedDoctorId);
          // After setting the doctor, load tests
          loadTests();
        }
      },
      error: function(xhr, status, error) {
        console.error("Error loading doctors:", error);
      }
    });
  }

  // Function to load tests/services
  function loadTests() {
    $.ajax({
      url: '../patient_backend/test-servicefetching.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        let testSelect = $('#test');
        testSelect.empty().append('<option value="" selected disabled>Choose a Test</option>');
        $.each(data, function(index, test) {
          testSelect.append('<option value="' + test.Service_ID + '">' + test.Name + ' - ' + test.Service_Duration + ' min </option>');
        });
        
        // Set previously selected test if exists
        if (selectedTestId) {
          $('#test').val(selectedTestId);
          
          // If we have doctor, date, and test, load the time slots
          if (selectedDoctorId && selectedDate) {
            loadTimeSlots(selectedDoctorId, selectedDate, selectedTestId);
          }
        }
      },
      error: function(xhr, status, error) {
        console.error("Error loading tests:", error);
      }
    });
  }

  // Function to load time slots
  function loadTimeSlots(doctorId, date, testId) {
    console.log("Sending request with:", {
      doctor_id: doctorId,
      date: date,
      test_id: testId
    });
    $.ajax({
      url: '../patient_backend/test-timeslotsfetching.php',
      type: 'GET',
      data: {
        doctor_id: doctorId,
        date: date,
        test_id: testId
      },
      success: function(data) {
        let timeSelect = $('#time');
        timeSelect.empty().append('<option value="" selected disabled>Choose a Time Slot</option>');
        $('#time').append(data);
        
        // Set previously selected time if exists
        if (selectedTime) {
          $('#time').val(selectedTime);
        }
      },
      error: function(xhr, status, error) {
        console.error("Error loading time slots:", error);
        console.log("Status:", status);
        console.log("Response:", xhr.responseText);
      }
    });
  }
  
  // Initialize form - load doctors first
  loadDoctors();
  loadTests();
  // Event listener for changes in doctor, date, or test
  $('#doctor').on('change', function() {
    // When doctor changes, we may need to reload time slots
    let doctorId = $(this).val();
    let date = $('#date').val();
    let testId = $('#test').val();
    
    // Store the selected doctor ID
    selectedDoctorId = doctorId;
    
    // If all three fields are filled, load time slots
    if (doctorId && date && testId) {
      loadTimeSlots(doctorId, date, testId);
    }
  });
  
  $('#test').on('change', function() {
    // When test changes, we may need to reload time slots
    let doctorId = $('#doctor').val();
    let date = $('#date').val();
    let testId = $(this).val();
    
    // Store the selected test ID
    selectedTestId = testId;
    
    // If all three fields are filled, load time slots
    if (doctorId && date && testId) {
      loadTimeSlots(doctorId, date, testId);
    }
  });
  
  $('#date').on('change', function() {
    // When date changes, we may need to reload time slots
    let doctorId = $('#doctor').val();
    let date = $(this).val();
    let testId = $('#test').val();
    
    // Store the selected date
    selectedDate = date;
    
    // If all three fields are filled, load time slots
    if (doctorId && date && testId) {
      loadTimeSlots(doctorId, date, testId);
    }
  });
  
  // Client-side form validation before submission
  $('#appointment-form').on('submit', function(e) {
    let isValid = true;
    let errors = {};
    
    // Validate doctor selection
    if (!$('#doctor').val()) {
      isValid = false;
      errors['doctor'] = "Please select a doctor.";
      displayError('doctor', "Please select a doctor.");
    } else {
      clearError('doctor');
    }
    
    // Validate test selection
    if (!$('#test').val()) {
      isValid = false;
      errors['test'] = "Please select a test or service.";
      displayError('test', "Please select a test or service.");
    } else {
      clearError('test');
    }
    
    // Validate date
    if (!$('#date').val()) {
      isValid = false;
      errors['date'] = "Please select a date.";
      displayError('date', "Please select a date.");
    } else {
      const selectedDate = new Date($('#date').val());
      const currentDate = new Date();
      currentDate.setHours(0, 0, 0, 0);
      
      if (selectedDate < currentDate) {
        isValid = false;
        errors['date'] = "Selected date must be today or in the future.";
        displayError('date', "Selected date must be today or in the future.");
      } else {
        clearError('date');
      }
    }
    
    // Validate time
    if (!$('#time').val()) {
      isValid = false;
      errors['time'] = "Please select a time slot.";
      displayError('time', "Please select a time slot.");
    } else {
      clearError('time');
    }
    
    // If validation fails, prevent form submission
    if (!isValid) {
      e.preventDefault();
      return false;
    }
    
    // If valid, let the form submit to the backend validation
    return true;
  });
  
  // Helper function to display error message
  function displayError(field, message) {
    // Remove any existing error message first
    clearError(field);
    
    // Add the new error message
    $('#' + field).closest('.input-group').after(
      '<div class="text-danger mt-1 error-message" id="error-' + field + '">' + message + '</div>'
    );
    
    // Highlight the input field
    $('#' + field).addClass('is-invalid');
  }
  
  // Helper function to clear error message
  function clearError(field) {
    $('#error-' + field).remove();
    $('#' + field).removeClass('is-invalid');
  }

  // Form submission
$('#appointment-form').on('submit', function(e) {
  // Important: Prevent the default form submission
  e.preventDefault();
  
  // Client-side validation
  let isValid = true;
  
  // Validate doctor selection
  if (!$('#doctor').val()) {
    isValid = false;
    displayError('doctor', "Please select a doctor.");
  } else {
    clearError('doctor');
  }
  
  // Validate test selection
  if (!$('#test').val()) {
    isValid = false;
    displayError('test', "Please select a test or service.");
  } else {
    clearError('test');
  }
  
  // Validate date
  if (!$('#date').val()) {
    isValid = false;
    displayError('date', "Please select a date.");
  } else {
    const selectedDate = new Date($('#date').val());
    const currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);
    
    if (selectedDate < currentDate) {
      isValid = false;
      displayError('date', "Selected date must be today or in the future.");
    } else {
      clearError('date');
    }
  }
  
  // Validate time
  if (!$('#time').val()) {
    isValid = false;
    displayError('time', "Please select a time slot.");
  } else {
    clearError('time');
  }
  
  // If validation passes, send data to payment backend
  if (isValid) {
    $.ajax({
      url: '../patient_backend/payment.php',
      type: 'POST',
      data: {
        doctor_id: $('#doctor').val(),
        test_id: $('#test').val(),
        date: $('#date').val(),
        time: $('#time').val()
      },
      dataType: 'json',
      success: function(response) {
        console.log("Appointment data sent successfully:", response);
        window.location.href = "payment.php";
      },
      error: function(xhr, status, error) {
        console.error("Error sending appointment data:", xhr.responseText);
        // Display error to user
        alert("There was an error processing your appointment. Please try again.");
      }
    });
  }
});
});
  </script>


</body>

</html>