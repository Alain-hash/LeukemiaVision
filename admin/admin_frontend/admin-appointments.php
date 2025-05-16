<?php
session_start();
include("../../database/db.php");
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Admin') {
  header("location:../../login.php");
  exit();
}
include("../admin_backend/admin-appointments/appointments.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Appointment Management - leukemiaVision</title>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body class="starter-page-page">

  <header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="admin-dashboard.html" class="logo d-flex align-items-center me-auto">
          <img src="../assets/img/logo.png" alt="">
          <h1 class="sitename">leukemiaVision</h1>
        </a>
      </div>
    </div>
  </header>

  <main id="main" class="main">
    <div class="container py-5">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
          <div class="card mb-4">
            <div class="card-header">
              Admin Menu
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href="admin-insights.php" class="text-decoration-none"><i class="bi bi-graph-up me-2"></i> Insights</a></li>
              <li class="list-group-item"><a href="admin-user-management.php" class="text-decoration-none"><i class="bi bi-person-badge me-2"></i> Users </a></li>
              <li class="list-group-item "><a href="admin-services.php" class="text-decoration-none "><i class="bi bi-people me-2"></i>Services </a></li>
              <li class="list-group-item active"><a href="admin-appointments.php" class="text-decoration-none text-white" ><i class="bi bi-calendar-check me-2"></i>Appointments</a></li>
              <li class="list-group-item "><a href="admin-system-security.php" class="text-decoration-none  "><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
              <li class="list-group-item "><a href="admin-schedule_setup.php" class="text-decoration-none"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
              <li class="list-group-item"><a href="../../logout.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">

          <!-- Doctor Absence Requests Section -->
          <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="bi bi-calendar-x me-2"></i>Doctor Absence Requests</h5>
              <span class="badge bg-light text-dark" id="absence-count">
                <?php
                $pending_count = 0;
                if ($result->num_rows > 0) {
                  $result->data_seek(0);
                  while ($row = $result->fetch_assoc()) {
                    if ($row['Status'] == 'Pending') $pending_count++;
                  }
                  $result->data_seek(0);
                }
                echo $pending_count . " Pending";
                ?>
              </span>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-striped">
                  <thead class="table-light">
                    <tr>
                      <th>Doctor</th>
                      <th>Subject</th>
                      <th>Date</th>
                      <th>Reason</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              
                               
                              <div>
                                <div class="fw-bold"><?php echo $row['Name']; ?></div>
                                <div class="small text-muted"><?php echo $row['Specialization']; ?></div>
                              </div>
                            </div>
                          </td>
                          <td><?php echo $row['Subject']; ?></td>
                          <td><?php echo $row['Date']; ?></td>
                          <td><?php echo $row['Reason']; ?></td>

                          <td>
                            <span class="badge bg-<?php
                                                  if ($row['Status'] == 'Pending') echo 'warning text-dark';
                                                  else if ($row['Status'] == 'Accepted') echo 'success';
                                                  else echo 'danger';
                                                  ?>">
                              <?php echo $row['Status']; ?>

                            </span>
                          </td>
                          <td>
                            <?php if ($row['Status'] == 'Pending'): ?>
                              <div class="btn-group" role="group">
                                <button type="button" class="btn btn-success btn-sm" onclick="acceptAbsence('<?php echo $row['Absence_ID']; ?>','<?php echo $row['Doctor_ID']; ?>','<?php echo $row['Email']; ?>')">
                                  <i class="bi bi-check-circle"></i> Accept
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="declineAbsence('<?php echo $row['Absence_ID']; ?>','<?php echo $row['Doctor_ID']; ?>','<?php echo $row['Email']; ?>')">
                                  <i class="bi bi-x-circle"></i> Decline
                                </button>
                              </div>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td colspan="6" class="text-center">No absence requests found</td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <script>
           // Function to accept absence request
// Function to accept absence request
function acceptAbsence(Absence_ID, Doctor_ID, Email) {
  // Create and show the modal
  const modalHTML = `
<div class="modal fade" id="confirmAcceptModal" tabindex="-1" aria-labelledby="confirmAcceptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="confirmAcceptModalLabel"><i class="bi bi-check-circle me-2"></i>Accept Absence Request</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center mb-3">
          <div class="bg-light rounded-circle p-3 me-3">
            <i class="bi bi-calendar-check text-success fs-3"></i>
          </div>
          <div>
            <h5 class="mb-1">Confirm Acceptance</h5>
            <p class="text-muted mb-0">This will approve the doctor's absence request</p>
          </div>
        </div>
        
        <div class="alert alert-info">
          <i class="bi bi-info-circle me-2"></i> The following actions will be taken:
        </div>
        
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-envelope me-3 text-primary"></i>
            <div>
              <strong>Email Notification</strong>
              <div class="small text-muted">An email will be sent to the doctor confirming approval</div>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-people me-3 text-primary"></i>
            <div>
              <strong>Patient Notifications</strong>
              <div class="small text-muted">All patients with affected appointments will be notified</div>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center">
            <i class="bi bi-calendar-x me-3 text-primary"></i>
            <div>
              <strong>Schedule Blocked</strong>
              <div class="small text-muted">The doctor's schedule will be blocked for this date</div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success px-4" id="confirmAcceptBtn">
          <i class="bi bi-check-lg me-2"></i>Confirm Acceptance
        </button>
      </div>
    </div>
  </div>
</div>
`;

  // Add modal to document
  const modalContainer = document.createElement('div');
  modalContainer.innerHTML = modalHTML;
  document.body.appendChild(modalContainer);

  // Initialize and show the modal
  const modal = new bootstrap.Modal(document.getElementById('confirmAcceptModal'));
  modal.show();

  // Handle confirm button click
  document.getElementById('confirmAcceptBtn').addEventListener('click', function() {
    // Show loading state
    this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';
    this.disabled = true;

    // Make AJAX request with console logging for debugging
    console.log("Sending request with: ", {
      Absence_ID: Absence_ID,
      Doctor_ID: Doctor_ID,
      Email: Email
    });
    
    $.ajax({
      url: "../admin_backend/admin-appointments/accept_absence.php",
      type: "POST",
      data: {
        Absence_ID: Absence_ID,
        Doctor_ID: Doctor_ID,
        Email: Email
      },
      success: function(response) {
        console.log("Success response:", response);
        modal.hide();
        
        // Show success notification
        showNotification('Success!', 'Absence request approved successfully. Email notifications sent.', 'success');

        // Reload page after delay
        setTimeout(function() {
          location.reload();
        }, 1500);
      },
      error: function(xhr, status, error) {
        console.error("Error details:", xhr.responseText);
        
        // Reset button
        document.getElementById('confirmAcceptBtn').innerHTML = '<i class="bi bi-check-lg me-2"></i>Confirm Acceptance';
        document.getElementById('confirmAcceptBtn').disabled = false;

        // Show error message with details if available
        const errorMessage = xhr.responseText || "Error processing request. Please try again.";
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger mt-3';
        errorDiv.innerHTML = `<i class="bi bi-exclamation-triangle me-2"></i>${errorMessage}`;
        document.querySelector('#confirmAcceptModal .modal-body').appendChild(errorDiv);
      }
    });
  });
}

// Function to decline absence request
function declineAbsence(Absence_ID, Doctor_ID, Email) {
  // Create and show the modal
  const modalHTML = `
<div class="modal fade" id="confirmDeclineModal" tabindex="-1" aria-labelledby="confirmDeclineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmDeclineModalLabel"><i class="bi bi-x-circle me-2"></i>Decline Absence Request</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex align-items-center mb-3">
          <div class="bg-light rounded-circle p-3 me-3">
            <i class="bi bi-calendar-x text-danger fs-3"></i>
          </div>
          <div>
            <h5 class="mb-1">Confirm Decline</h5>
            <p class="text-muted mb-0">This will reject the doctor's absence request</p>
          </div>
        </div>
        
        <div class="alert alert-warning">
          <i class="bi bi-exclamation-triangle me-2"></i> An email will be sent to the doctor upon Rejection.
        </div>
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger px-4" id="confirmDeclineBtn">
          <i class="bi bi-x-lg me-2"></i>Confirm Decline
        </button>
      </div>
    </div>
  </div>
</div>
`;

  // Add modal to document
  const modalContainer = document.createElement('div');
  modalContainer.innerHTML = modalHTML;
  document.body.appendChild(modalContainer);

  // Initialize and show the modal
  const modal = new bootstrap.Modal(document.getElementById('confirmDeclineModal'));
  modal.show();

  // Handle confirm button click
  document.getElementById('confirmDeclineBtn').addEventListener('click', function() {
  
    // Show loading state
    this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';
    this.disabled = true;

    // Make AJAX request
    $.ajax({
      url: "../admin_backend/admin-appointments/reject_absence.php",
      type: "POST",
      data: {
        Absence_ID: Absence_ID,
        Doctor_ID: Doctor_ID,
        Email: Email
      },
      success: function(response) {
        modal.hide();
        
        // Show success notification
        showNotification('Request Declined', 'The absence request has been declined. Doctor has been notified via email.', 'warning');

        // Reload page after delay
        setTimeout(function() {
          location.reload();
        }, 1500);
      },
      error: function() {
        // Reset button
        document.getElementById('confirmDeclineBtn').innerHTML = '<i class="bi bi-x-lg me-2"></i>Confirm Decline';
        document.getElementById('confirmDeclineBtn').disabled = false;

        // Show error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger mt-3';
        errorDiv.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>Error processing request. Please try again.';
        document.querySelector('#confirmDeclineModal .modal-body').appendChild(errorDiv);
      }
    });
  });

  // Handle input validation on change
  document.getElementById('decline-reason').addEventListener('input', function() {
    if (this.value.trim()) {
      this.classList.remove('is-invalid');
    }
  });
}

// Function to show toast notification
function showNotification(title, message, type) {
  const notificationHTML = `
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1056">
  <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-${type} text-white">
      <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'danger' ? 'x-circle' : 'exclamation-triangle'} me-2"></i>
      <strong class="me-auto">${title}</strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      ${message}
    </div>
  </div>
</div>
`;

  const notificationContainer = document.createElement('div');
  notificationContainer.innerHTML = notificationHTML;
  document.body.appendChild(notificationContainer);

  // Auto remove after 3 seconds
  setTimeout(() => {
    notificationContainer.remove();
  }, 3000);
}

// Document ready function for appointment finding
$(document).ready(function() {
  $("#find-appointments").click(function() {
    var doctorId = $("#doctor-select").val();
    var appointmentDate = $("#appointment-date").val();

    if (!doctorId || !appointmentDate) {
      alert("Please select a doctor and a date.");
      return;
    }

    $.ajax({
      url: "../admin_backend/admin-appointments/fetch_patient_app.php",
      type: "POST",
      data: {
        doctor_id: doctorId,
        appointment_date: appointmentDate
      },
      success: function(response) {
        $("#appointment-results").html(response);
      },
      error: function() {
        alert("Error fetching appointments.");
      }
    });
  });
});
          </script>






          <?php
          //--------------get doctor----------------//
          $stmt = $connection->prepare("
SELECT 
    user.User_ID, 
    user.Name, 
    doctor.Doctor_ID,
    doctor.Specialization
FROM user
JOIN doctor ON user.User_ID = doctor.User_ID
WHERE user.Role = 'Doctor'
");

          $stmt->execute();
          $result = $stmt->get_result();

          $Doctors = array();
          while ($Doctor = $result->fetch_assoc()) {
            $Doctors[] = $Doctor;
          }
          ?>

          <!-- Appointment Management Section -->
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Appointment Management</h5>
            </div>
            <div class="card-body">
              <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i> Select a doctor and date to view appointments.
              </div>

              <form id="appointment-filter-form" class="row g-3 mb-4">
                <div class="col-md-5">
                  <label for="doctor-select" class="form-label">Select Doctor</label>
                  <select id="doctor-select" name="doctor_id" class="form-select" required>
                    <option value="" selected disabled>Choose a doctor...</option>
                    <?php foreach ($Doctors as $Doctor) { ?>
                      <option value="<?php echo $Doctor["Doctor_ID"]; ?>"><?php echo $Doctor["Name"] . " - " . $Doctor["Specialization"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-5">
                  <label for="appointment-date" class="form-label">Select Date</label>
                  <input type="date" class="form-control" id="appointment-date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                  <button type="button" id="find-appointments" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Find
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Appointments Results Section -->
          <div id="appointment-results" class="mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="mb-0">Appointments for <span id="selected-doctor">Dr. Sarah Johnson</span> on <span id="selected-date">April 5, 2025</span></h6>

            </div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Patient</th>
                    <th>Time</th>
                    <th>Service</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>


          </div>

          <script>
            $(document).ready(function() {
              $("#find-appointments").click(function() {
                var doctorId = $("#doctor-select").val();
                var appointmentDate = $("#appointment-date").val();

                if (!doctorId || !appointmentDate) {
                  alert("Please select a doctor and a date.");
                  return;
                }

                $.ajax({
                  url: "../admin_backend/admin-appointments/fetch_patient_app.php",
                  type: "POST",
                  data: {
                    doctor_id: doctorId,
                    appointment_date: appointmentDate
                  },
                  success: function(response) {
                    $("#appointment-results").html(response);
                  },
                  error: function() {
                    alert("Error fetching appointments.");
                  }
                });
              });
            });
          </script>




        </div>
      </div>
    </div>
    </div>
    </div>
  </main>



  <footer id="footer" class="footer">
    <div class="container-fluid copyright text-center py-4">
      <small>&copy; 2023 <strong><span>leukemiaVision</span></strong>. All Rights Reserved.</small>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>
  <?php $connection->close(); ?>
</body>

</html>