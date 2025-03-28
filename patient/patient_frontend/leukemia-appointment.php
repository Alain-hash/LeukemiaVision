<?php
session_start();
include("../../database/db.php");

// Fetch doctors from the database
$sql = "SELECT 
    u.Name,
    u.User_ID,
    d.Doctor_ID,
    d.Specialization
FROM 
    user u
LEFT JOIN 
    doctor d ON u.User_ID = d.User_ID
WHERE   u.role = 'Doctor'";
$result = $connection->query($sql);

// Fetch leukemia est info from the database
$name = 'leukemia test';
$sql = "SELECT  
s.Name,
s.Description,
a.Appoitment_Duration,
FROM services s
LEFT JOIN 
appoitment a ON s.Doctor_ID=a.Doctor_ID 
WHERE s.Name=$name";
$result = $connection->query($sql);
?>

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
  <!-- Add this to your CSS file or include it in a style tag in the head section -->
  <style>
    /* Print-specific styles */
    @media print {
      body * {
        visibility: hidden;
      }

      #voucher-card,
      #voucher-card * {
        visibility: visible;
      }

      #voucher-card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: 1px solid #ddd;
      }

      .btn-light {
        display: none;
      }
    }
  </style>
</head>

<body class="starter-page-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-center-items">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@LeukemiaVision.com</a></i>
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
        <a href="../../index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../../index.php">Home<br></a></li>
            <li><a href="../../index.php#about">About</a></li>
            <li><a href="../../index.php#doctors">Doctors</a></li>
            <li><a href="../../index.php#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <main id="main">
    <section id="leukemia-test" class="leukemia-test section-bg py-5">
      <div class="container">
        <div class="section-title text-center mb-5">
          <h2>Leukemia Test Appointment Reservation</h2>
          <p>Schedule your leukemia test based on doctor and test availability</p>
        </div>

        <div class="row">
          <!-- Appointment Form -->
          <div class="col-lg-8">
            <div class="card shadow-sm">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Appointment Request Form</h5>
              </div>
              <div class="card-body">
                <form action="" method="post" role="form" class="needs-validation" novalidate>
                  <div class="row g-3">

                    <!-- Doctor Selection -->
                    <div class="col-12 mt-4">
                      <h5 class="border-bottom pb-2">Doctor Selection</h5>
                    </div>
                    <div class="col-md-6">
                      <label for="doctor" class="form-label">Select Doctor</label>
                      <select class="form-select" id="doctor" name="doctor" required>

                        <?php
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["Doctor_ID"] . "'>" . htmlspecialchars($row["Name"]) . " - " . htmlspecialchars($row["Specialization"]) . "</option>";
                          }
                        } else {
                          echo "<option value=''>No doctors available at the moment</option>";
                        }
                        ?>

                      </select>
                      <div class="invalid-feedback">Please select a doctor.</div>
                    </div>

                    <!-- Date & Time Selection -->
                    <div class="col-12 mt-4">
                      <h5 class="border-bottom pb-2">Appointment Date & Time</h5>
                    </div>

                    <div class="col-md-6">
                      <label for="appointment-time" class="form-label">Available Time Slots</label>
                      <select class="form-select" id="appointment-time" required disabled>
                        <option value="" selected disabled>First select date and doctor</option>
                      </select>
                      <div class="invalid-feedback">Please select a time slot.</div>
                    </div>

                    <div class="col-12 mt-4">
                      <button type="submit" class="btn btn-primary w-100">Submit Appointment Reservation</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Sidebar Information -->
          <div class="col-lg-4 mt-4 mt-lg-0">
            <!-- Doctor Availability Card -->
            <div class="card shadow-sm mb-4">
              <div class="card-header bg-info text-white">
                <h5 class="mb-0">Doctor Availability</h5>
              </div>
              <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<li class='list-group-item'>";
                      echo "<strong>" . htmlspecialchars($row["Name"]) . " - " . htmlspecialchars($row["Specialization"]) . "</strong>";
                      echo "<p class='mb-0'>Mon, Wed, Fri: 9:00 AM - 2:00 PM</p>"; // Replace with actual availability if needed
                      echo "</li>";
                    }
                  } else {
                    echo "<li class='list-group-item'><strong>No doctors available at the moment</strong></li>";
                  }
                  ?>
                </ul>
              </div>
            </div>

            <!-- Test Information Card -->
            <div class="card shadow-sm mb-3">
              <div class="card-header bg-success text-white">
                <h5 class="mb-2">Leukemia Test Information</h5>
              </div>
              <div class="card-body">
                <div class="accordion" id="testAccordion">

                  <div class="accordion-item">
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo " <p> Duration: 60 min.</p>";
                      }
                    } else {
                      echo "No Current Information";
                    }
                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Add this to your main.js file or include it in a script tag at the bottom of the page -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Set the current date on the voucher
        const today = new Date();
        document.getElementById('generation-date').textContent = today.toLocaleDateString() + ' ' + today.toLocaleTimeString();

        // Form submission handler to update voucher with form data
        const appointmentForm = document.querySelector('.needs-validation');
        if (appointmentForm) {
          appointmentForm.addEventListener('submit', function(event) {
            event.preventDefault();

            if (appointmentForm.checkValidity()) {
              // Get form values
              const doctor = document.getElementById('doctor');
              const doctorName = doctor.options[doctor.selectedIndex].text;
              const appointmentDate = document.getElementById('appointment-date').value;
              const appointmentTime = document.getElementById('appointment-time');
              const timeSlot = appointmentTime.options[appointmentTime.selectedIndex].text;

              // Update voucher
              document.getElementById('patient-name').textContent = 'Patient Name: ' + 'John Doe'; // placeholder
              document.getElementById('patient-id').textContent = 'Patient ID: ' + 'PT-' + Math.floor(10000 + Math.random() * 90000);
              document.getElementById('appointment-doctor').textContent = 'Doctor: ' + doctorName;
              document.getElementById('appointment-date-time').textContent = 'Date & Time: ' + appointmentDate + ' ' + timeSlot;

              // Scroll to voucher
              document.getElementById('payment-voucher').scrollIntoView({
                behavior: 'smooth'
              });
            }

            appointmentForm.classList.add('was-validated');
          });
        }

        // Populate time slots when date and doctor are selected
        const doctorSelect = document.getElementById('doctor');
        const dateInput = document.getElementById('appointment-date');
        const timeSelect = document.getElementById('appointment-time');

        function updateTimeSlots() {
          if (doctorSelect.value && dateInput.value) {
            // Enable time selection
            timeSelect.disabled = false;
            timeSelect.innerHTML = '<option value="" selected disabled>Select a time slot</option>';

            // Demo time slots based on selected doctor
            const timeSlots = {
              'dr-smith': ['9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM'],
              'dr-johnson': ['10:00 AM', '11:30 AM', '2:00 PM', '3:30 PM'],
              'dr-williams': ['1:00 PM', '2:30 PM', '4:00 PM', '5:30 PM']
            };

            // Add time options
            if (timeSlots[doctorSelect.value]) {
              timeSlots[doctorSelect.value].forEach(time => {
                const option = document.createElement('option');
                option.value = time.toLowerCase().replace(/\s/g, '');
                option.textContent = time;
                timeSelect.appendChild(option);
              });
            }
          } else {
            timeSelect.disabled = true;
            timeSelect.innerHTML = '<option value="" selected disabled>First select date and doctor</option>';
          }
        }

        doctorSelect.addEventListener('change', updateTimeSlots);
        dateInput.addEventListener('change', updateTimeSlots);
      });
    </script>
  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="../../index.html" class="logo d-flex align-items-center">
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
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>