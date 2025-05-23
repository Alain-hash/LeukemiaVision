<?php
session_start();
include("../../database/db.php");
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Admin') {
  header("location:../../login.php");
  exit();
}
include("../admin_backend/user-management/refresh_doctor_schedule.php");

//--------------------user statistics------------------//
$doctorQuery = "SELECT COUNT(*) as doctor_count FROM user WHERE Role = 'Doctor'";
$doctorResult = $connection->query($doctorQuery);
$doctorCount = $doctorResult->fetch_assoc()['doctor_count'];

$assistantQuery = "SELECT COUNT(*) as assistant_count FROM user WHERE Role = 'Assistant'";
$assistantResult = $connection->query($assistantQuery);
$assistantCount = $assistantResult->fetch_assoc()['assistant_count'];

$patientQuery = "SELECT COUNT(*) as patient_count FROM user WHERE Role = 'Patient'";
$patientResult = $connection->query($patientQuery);
$patientCount = $patientResult->fetch_assoc()['patient_count'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>User management - leukemiaVision</title>
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

          <img src="../../assets/img/logo.png" alt="">
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
              <li class="list-group-item "><a href="admin-insights.php" class="text-decoration-none"><i class="bi bi-graph-up me-2"></i> Insights</a></li>
              <li class="list-group-item active"><a href="admin-user-management.php" class="text-decoration-none text-white"><i class="bi bi-person-badge me-2"></i> Users </a></li>
              <li class="list-group-item  "><a href="admin-services.php" class="text-decoration-none "><i class="bi bi-people me-2"></i>Services </a></li>
              <li class="list-group-item "><a href="admin-appointments.php" class="text-decoration-none" ><i class="bi bi-calendar-check me-2"></i>Appointments</a></li>
              <li class="list-group-item "><a href="admin-system-security.php" class="text-decoration-none "><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
              <li class="list-group-item "><a href="admin-schedule_setup.php" class="text-decoration-none"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
              <li class="list-group-item"><a href="../../logout.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
          </div>

          <div class="card">
            <div class="card-header">
              User Statistics
            </div>
            <div class="card-body">
              <div class="mb-3">
                <h6 class="mb-1">Total Doctors</h6>
                <h3 class="text-primary mb-0" id="doctorCount"><?php echo $doctorCount; ?></h3>
              </div>
              <div class="mb-3">
                <h6 class="mb-1">Total Assistants</h6>
                <h3 class="text-success mb-0" id="assistantCount"><?php echo $assistantCount; ?></h3>
              </div>
              <div>
                <h6 class="mb-1">Total Patients</h6>
                <h3 class="text-info mb-0" id="patientCount"><?php echo $patientCount; ?></h3>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <!-- Tabs -->
          <?php
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo '<ul class="list-unstyled mb-0">';
    foreach ($_SESSION['errors'] as $error) {
        echo '<li><i class="bi bi-x-circle me-2"></i>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
  
    
    // Display each error in the list
   
    
    // Add dismiss button
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    
    // Optional: Clear errors after displaying them
    // unset($_SESSION['errors']);
}
?>

          <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="doctors-tab" data-bs-toggle="tab" data-bs-target="#doctors" type="button" role="tab" aria-controls="doctors" aria-selected="true">
                <i class="bi bi-clipboard2-pulse me-2"></i>Doctors
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="assistants-tab" data-bs-toggle="tab" data-bs-target="#assistants" type="button" role="tab" aria-controls="assistants" aria-selected="false">
                <i class="bi bi-person-badge me-2"></i>Assistants
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="patients-tab" data-bs-toggle="tab" data-bs-target="#patients" type="button" role="tab" aria-controls="patients" aria-selected="false">
                <i class="bi bi-people me-2"></i>Patients
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="assignments-tab" data-bs-toggle="tab" data-bs-target="#assignments" type="button" role="tab" aria-controls="assignments" aria-selected="false">
                <i class="bi bi-diagram-3 me-2"></i>Assignments
              </button>
            </li>
          </ul>


          <!-- Tab Content -->
          <div class="tab-content" id="userTabsContent">
            <!-- Doctors Tab -->
            <div class="tab-pane fade show active" id="doctors" role="tabpanel" aria-labelledby="doctors-tab">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Create New Doctor</h5>
                  <button type="button" class="btn btn-sm btn-primary" id="toggleDoctorForm">
                    <i class="bi bi-plus-circle me-1"></i> New Doctor
                  </button>
                </div>

                <div class="card-body" id="doctorFormContainer" style="display: none;">





                  <form id="createDoctorForm" action="../admin_backend/user-management/doctor-management_backend.php" method="post">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="doctorUsername" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" id="doctorUsername" name="username">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="doctorEmail" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="doctorEmail" name="email">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="doctorPassword" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="doctorPassword" name="password">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="doctorLicenseNumber" class="form-label fw-bold">License Number</label>
                        <input type="text" class="form-control" id="doctorLicenseNumber" name="lisence_number">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="doctorcreationdate" class="form-label fw-bold">Creation Date</label>
                        <input type="date" class="form-control" id="doctorcreationdate" name="date" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="doctorSpecialty" class="form-label fw-bold">Specialty</label>
                        <input type="text" class="form-control" id="doctorSpecialty" name="speciality">
                      </div>
                    </div>

                    <div class="text-end">
                      <button type="button" class="btn btn-secondary me-2" id="cancelDoctorBtn">Cancel</button>
                      <button type="submit" class="btn btn-primary">Create Doctor</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Manage Doctors</h5>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr></tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Specialty</th>
                        <th>Creation Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="doctorsTableBody">
                        <!-- Doctors will be loaded here by JavaScript -->
                      </tbody>
                    </table>
                  </div>

                </div>




                <script>
                  //-------------------doctor JS------------------//

                  $(document).ready(function() {

                    // Centralized toast function (can be moved to a separate utility file)
                    function showToast(message, type) {
                      // Create a toast container if it doesn't exist
                      if ($('#toast-container').length === 0) {
                        $('body').append('<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>');
                      }
                      // Create unique ID for each toast to prevent conflicts
                      const toastId = 'toast-' + Date.now();
                      // Create toast element with unique ID
                      const toastElement = $(`
                       <div id="${toastId}" class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                      <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                     </div>
                      </div>
                      `);
                      // Add to container and show
                      $('#toast-container').append(toastElement);
                      const toast = new bootstrap.Toast(`#${toastId}`);
                      toast.show();
                      // Remove toast after it's hidden
                      toastElement.on('hidden.bs.toast', function() {
                        $(this).remove();
                      });
                    }


                    function loadDoctors() {
                      $.ajax({
                        url: '../admin_backend/user-management/doctor_display.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                          let tableBody = $('#doctorsTableBody');
                          tableBody.empty();

                          response.forEach(function(doctor) {
                            let isActive = doctor.Status === 'Active';

                            let statusBadge = isActive ?
                              '<span class="badge bg-success">Active</span>' :
                              '<span class="badge bg-danger">Not Active</span>';

                            let Specialization = doctor.Specialization ? doctor.Specialization : "N/A";
                            let createdAt = doctor.Account_Creation_Date ? doctor.Account_Creation_Date : "Unknown Date";

                            let toggleButton = `
                        <button class="btn ${isActive ? 'btn-warning' : 'btn-success'} btn-sm toggle-doctor-status" 
                            data-id="${doctor.User_ID}" 
                            data-name="${doctor.Name}"
                            data-status="${doctor.Status}">
                            ${isActive ? 'Deactivate' : 'Activate'}
                        </button>`;

                            let row = `<tr>
                        <td>${doctor.Name}</td>
                        <td>${doctor.Email}</td>
                        <td>${Specialization}</td>  
                        <td>${createdAt}</td>  
                        <td>${statusBadge}</td>
                        <td>${toggleButton}</td>
                    </tr>`;

                            tableBody.append(row);
                          });
                        },
                        error: function(xhr, status, error) {
                          showToast(`Error fetching doctors: ${error}`, 'danger');
                          console.error("Error fetching doctors:", error);
                        }
                      });
                    }

                    // Centralized status toggle handler
                    $(document).on('click', '.toggle-doctor-status', function() {
                      let doctorId = $(this).data('id');
                      let doctorName = $(this).data('name');
                      let currentStatus = $(this).data('status');
                      let newStatus = currentStatus === 'Active' ? 'Not Active' : 'Active';
                      // Unique modal ID for doctors
                      const modalId = 'doctor-confirm-modal';
                      // Confirmation Modal with unique ID
                      const confirmModal = `
            <div class="modal fade" id="${modalId}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Doctor Account Status Change</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to ${newStatus === 'Active' ? 'activate' : 'deactivate'} 
                            the account for Dr. ${doctorName}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="confirmDoctorStatusChange">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

                      // Remove any existing modal first
                      $(`#${modalId}`).remove();
                      $('body').append(confirmModal);

                      // Show the modal
                      const modal = new bootstrap.Modal(`#${modalId}`);
                      modal.show();

                      // Confirm button handler
                      $(document).off('click', '#confirmDoctorStatusChange').on('click', '#confirmDoctorStatusChange', function() {
                        $.ajax({
                          url: '../admin_backend/user-management/doctor_toggle_status.php',
                          type: 'POST',
                          data: {
                            id: doctorId,
                            status: newStatus
                          },
                          success: function(response) {
                            // Close the modal
                            modal.hide();
                            // Show success toast
                            showToast(`Doctor ${doctorName}'s account has been ${newStatus === 'Active' ? 'activated' : 'deactivated'} successfully.`, 'success');
                            // Reload doctors list
                            loadDoctors();
                          },
                          error: function(xhr, status, error) {
                            // Close the modal
                            modal.hide();
                            // Show error toast
                            showToast(`Error updating doctor's account status: ${error}`, 'danger');
                            console.error("Error updating doctor status:", error);
                          }
                        });
                      });
                    });
                    // Initial load of doctors
                    loadDoctors();
                  });
                </script>


              </div>
            </div>


            <!-- Assistants Tab -->
            <div class="tab-pane fade" id="assistants" role="tabpanel" aria-labelledby="assistants-tab">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Create New Assistant</h5>
                  <button type="button" class="btn btn-sm btn-primary" id="toggleAssistantForm">
                    <i class="bi bi-plus-circle me-1"></i> New Assistant
                  </button>
                </div>
                <div class="card-body" id="assistantFormContainer" style="display: none;">
                  <form id="createAssistantForm" action="../admin_backend/user-management/assistant-management_backend.php" method="post">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="assistantUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="assistantUsername" name="username">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="assistantEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="assistantEmail" name="email">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="assistantPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="assistantPassword" name="password">
                      </div>
                      <div class="col-md-6 mb-3">

                        <label for="doctorcreationdate" class="form-label fw-bold">Creation Date</label>
                        <input type="date" class="form-control" id="doctorcreationdate" name="date" value="<?php echo date('Y-m-d'); ?>">
                      </div>

                    </div>
                    <div class="text-end">
                      <button type="button" class="btn btn-secondary me-2" id="cancelAssistantBtn">Cancel</button>
                      <button type="submit" class="btn btn-primary">Create Assistant</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Manage Assistants</h5>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Creation Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="assistantsTableBody">
                        <!-- Assistants will be loaded here by JavaScript -->
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
            <script>
              //assistantjs
              $(document).ready(function() {
                // Centralized toast function (can be moved to a separate utility file)
                function showToast(message, type) {
                  // Create a toast container if it doesn't exist
                  if ($('#toast-container').length === 0) {
                    $('body').append('<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>');
                  }

                  // Create unique ID for each toast to prevent conflicts
                  const toastId = 'toast-' + Date.now();

                  // Create toast element with unique ID
                  const toastElement = $(`
            <div id="${toastId}" class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `);

                  // Add to container and show
                  $('#toast-container').append(toastElement);
                  const toast = new bootstrap.Toast(`#${toastId}`);
                  toast.show();

                  // Remove toast after it's hidden
                  toastElement.on('hidden.bs.toast', function() {
                    $(this).remove();
                  });
                }

                function loadAssistants() {
                  $.ajax({
                    url: '../admin_backend/user-management/assistant_display.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                      let tableBody = $('#assistantsTableBody');
                      tableBody.empty();

                      response.forEach(function(assistant) {
                        let isActive = assistant.Status === 'Active';

                        let statusBadge = isActive ?
                          '<span class="badge bg-success">Active</span>' :
                          '<span class="badge bg-danger">Not Active</span>';

                        let createdAt = assistant.Account_Creation_Date ? assistant.Account_Creation_Date : "Unknown Date";

                        let toggleButton = `
                        <button class="btn ${isActive ? 'btn-warning' : 'btn-success'} btn-sm toggle-assistant-status" 
                            data-id="${assistant.User_ID}" 
                            data-name="${assistant.Name}"
                            data-status="${assistant.Status}">
                            ${isActive ? 'Deactivate' : 'Activate'}
                        </button>`;

                        let row = `<tr>
                        <td>${assistant.Name}</td>
                        <td>${assistant.Email}</td> 
                        <td>${createdAt}</td>  
                        <td>${statusBadge}</td>
                        <td>${toggleButton}</td>
                    </tr>`;

                        tableBody.append(row);
                      });
                    },
                    error: function(xhr, status, error) {
                      console.error("Full error details:", {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        errorThrown: error
                      });

                      // Show error toast with more detailed message
                      showToast(`Error fetching Assistants: ${error} (Status: ${xhr.status})`, 'danger');
                    }
                  });
                }

                // Centralized status toggle handler
                $(document).on('click', '.toggle-assistant-status', function() {
                  let assistantId = $(this).data('id');
                  let assistantName = $(this).data('name');
                  let currentStatus = $(this).data('status');
                  let newStatus = currentStatus === 'Active' ? 'Not Active' : 'Active';

                  // Unique modal ID for assistants
                  const modalId = 'assistant-confirm-modal';

                  // Confirmation Modal with unique ID
                  const confirmModal = `
            <div class="modal fade" id="${modalId}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Assistant Account Status Change</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to ${newStatus === 'Active' ? 'activate' : 'deactivate'} 
                            the account for ${assistantName}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="confirmAssistantStatusChange">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

                  // Remove any existing modal first
                  $(`#${modalId}`).remove();
                  $('body').append(confirmModal);

                  // Show the modal
                  const modal = new bootstrap.Modal(`#${modalId}`);
                  modal.show();

                  // Confirm button handler
                  $(document).off('click', '#confirmAssistantStatusChange').on('click', '#confirmAssistantStatusChange', function() {
                    $.ajax({
                      url: '../admin_backend/user-management/assistant_toggle_status.php',
                      type: 'POST',
                      data: {
                        id: assistantId,
                        status: newStatus
                      },
                      success: function(response) {
                        // Close the modal
                        modal.hide();

                        // Show success toast
                        showToast(`${assistantName}'s account has been ${newStatus === 'Active' ? 'activated' : 'deactivated'} successfully.`, 'success');

                        // Reload assistants list
                        loadAssistants();
                      },
                      error: function(xhr, status, error) {
                        // Close the modal
                        modal.hide();

                        // Show error toast
                        showToast(`Error updating assistant's account status: ${error}`, 'danger');

                        console.error("Error updating assistant status:", error);
                      }
                    });
                  });
                });

                // Initial load of assistants
                loadAssistants();
              });
            </script>



            <!-- Patients Tab -->
            <div class="tab-pane fade" id="patients" role="tabpanel" aria-labelledby="patients-tab">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Manage Patients</h5>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>

                          <th>Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="patientsTableBody">
                        <!-- Patients will be loaded here by JavaScript -->
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>

            <script>
              //patientjs
              $(document).ready(function() {
                // Centralized toast function (can be moved to a separate utility file)
                function showToast(message, type) {
                  // Create a toast container if it doesn't exist
                  if ($('#toast-container').length === 0) {
                    $('body').append('<div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1050;"></div>');
                  }

                  // Create unique ID for each toast to prevent conflicts
                  const toastId = 'toast-' + Date.now();

                  // Create toast element with unique ID
                  const toastElement = $(`
            <div id="${toastId}" class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `);

                  // Add to container and show
                  $('#toast-container').append(toastElement);
                  const toast = new bootstrap.Toast(`#${toastId}`);
                  toast.show();

                  // Remove toast after it's hidden
                  toastElement.on('hidden.bs.toast', function() {
                    $(this).remove();
                  });
                }

                function loadPatients() {
                  $.ajax({
                    url: '../admin_backend/user-management/patient_display.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                      let tableBody = $('#patientsTableBody');
                      tableBody.empty();

                      response.forEach(function(patient) {
                        let isActive = patient.Status === 'Active';

                        let statusBadge = isActive ?
                          '<span class="badge bg-success">Active</span>' :
                          '<span class="badge bg-danger">Not Active</span>';

                        let toggleButton = `
                        <button class="btn ${isActive ? 'btn-warning' : 'btn-success'} btn-sm toggle-patient-status" 
                            data-id="${patient.User_ID}" 
                            data-name="${patient.Name}"
                            data-status="${patient.Status}">
                            ${isActive ? 'Deactivate' : 'Activate'}
                        </button>`;

                        let row = `<tr>
                        <td>${patient.Name}</td>
                        <td>${patient.Email}</td> 
                        <td>${statusBadge}</td>
                        <td>${toggleButton}</td>
                    </tr>`;

                        tableBody.append(row);
                      });
                    },
                    error: function(xhr, status, error) {
                      console.error("Full error details:", {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        errorThrown: error
                      });

                      // Show error toast with more detailed message
                      showToast(`Error fetching Patients: ${error} (Status: ${xhr.status})`, 'danger');
                    }
                  });
                }

                // Centralized status toggle handler
                $(document).on('click', '.toggle-patient-status', function() {
                  let patientId = $(this).data('id');
                  let patientName = $(this).data('name');
                  let currentStatus = $(this).data('status');
                  let newStatus = currentStatus === 'Active' ? 'Not Active' : 'Active';

                  // Unique modal ID for patients
                  const modalId = 'patient-confirm-modal';

                  // Confirmation Modal with unique ID
                  const confirmModal = `
            <div class="modal fade" id="${modalId}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Patient Account Status Change</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to ${newStatus === 'Active' ? 'activate' : 'deactivate'} 
                            the account for ${patientName}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="confirmPatientStatusChange">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

                  // Remove any existing modal first
                  $(`#${modalId}`).remove();
                  $('body').append(confirmModal);

                  // Show the modal
                  const modal = new bootstrap.Modal(`#${modalId}`);
                  modal.show();

                  // Confirm button handler
                  $(document).off('click', '#confirmPatientStatusChange').on('click', '#confirmPatientStatusChange', function() {
                    $.ajax({
                      url: '../admin_backend/user-management/patient_toggle_status.php', // FIXED: Corrected URL from previous version
                      type: 'POST',
                      data: {
                        id: patientId,
                        status: newStatus
                      },
                      success: function(response) {
                        // Close the modal
                        modal.hide();

                        // Show success toast
                        showToast(`${patientName}'s account has been ${newStatus === 'Active' ? 'activated' : 'deactivated'} successfully.`, 'success');

                        // Reload patients list
                        loadPatients();
                      },
                      error: function(xhr, status, error) {
                        // Close the modal
                        modal.hide();

                        // Show error toast
                        showToast(`Error updating patient's account status: ${error}`, 'danger');

                        console.error("Error updating patient status:", error);
                      }
                    });
                  });
                });

                // Initial load of patients
                loadPatients();
              });
            </script>

            <!-- Assignments Tab -->
            <div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="assignments-tab">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Assign Assistant to Doctor</h5>
                  <button type="button" class="btn btn-sm btn-primary" id="toggleAssignmentForm">
                    <i class="bi bi-link me-1"></i> New Assignment
                  </button>
                </div>
                <div class="card-body" id="assignmentFormContainer" style="display: none;">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="assignDoctor" class="form-label">Select Doctor</label>
                      <select class="form-select" id="assignDoctor" name="doctor_id" required>
                        <option value="" selected disabled>Choose a doctor...</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="assignAssistant" class="form-label">Select Assistant</label>
                      <select class="form-select" id="assignAssistant" name="assistant_id" required>
                        <option value="" selected disabled>Choose an assistant...</option>
                      </select>
                    </div>
                  </div>
                  <div class="text-end">
                    <button class="btn btn-primary" id="assignBTN">Assign</button>
                  </div>
                </div>
              </div>




              <div class="card">
                <div class="card-header">
                  <h5 class="mb-0">Current Assignments</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Doctor</th>
                          <th>Assistant</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="assignmentsTableBody">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

            <!-- Toast Notifications for Success and Error Messages -->
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
              <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                  <div class="toast-body">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span id="successToastMessage">Assignment successful!</span>
                  </div>
                  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>
            </div>

            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
              <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                  <div class="toast-body">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <span id="errorToastMessage">An error occurred!</span>
                  </div>
                  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>
            </div>


            <script>
              // Wait for the document to be fully loaded
              document.addEventListener('DOMContentLoaded', function() {
                console.log("Document loaded, setting up event handlers");

                // Set up jQuery toggle
                if (typeof jQuery !== 'undefined') {
                  console.log("jQuery is available, setting up jQuery handlers");
                  $('#toggleAssignmentForm').on('click', function() {
                    console.log("jQuery toggle button clicked");
                    $('#assignmentFormContainer').toggle();
                  });
                }

                // Load doctors
                if (typeof jQuery !== 'undefined') {
                  $.ajax({
                    url: '../admin_backend/user-management/doctor_display.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(doctors) {
                      if (doctors.length === 0) {
                        $('#assignDoctor').append(
                          '<option value="" disabled>No doctors available</option>'
                        );
                        $('#createAssignmentForm button[type="submit"]').prop('disabled', true);
                      } else {
                        doctors.forEach(function(doctor) {
                          $('#assignDoctor').append(
                            `<option value="${doctor.User_ID}">
                                ${doctor.Name} - ${doctor.Specialization}
                            </option>`
                          );
                        });
                      }
                    },
                    error: function(xhr, status, error) {
                      console.error("Error loading doctors:", error);
                      showErrorToast("Failed to load doctors. Please try again.");
                    }
                  });

                  // Load unassigned assistants
                  $.ajax({
                    url: '../admin_backend/user-management/assistant_display.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(assistants) {
                      if (assistants.length === 0) {
                        $('#assignAssistant').append(
                          '<option value="" disabled selected>No unassigned assistants available</option>'
                        );
                        $('#createAssignmentForm button[type="submit"]').prop('disabled', true);
                      } else {
                        assistants.forEach(function(assistant) {
                          $('#assignAssistant').append(
                            `<option value="${assistant.User_ID}">
                                ${assistant.Name}
                            </option>`
                          );
                        });
                      }
                    },
                    error: function(xhr, status, error) {
                      console.error("Error loading assistants:", error);
                      showErrorToast("Failed to load assistants. Please try again.");
                    }
                  });

                  let assignBTN = document.getElementById("assignBTN");

                  assignBTN.addEventListener('click', function() {
                    let docID = document.getElementById("assignDoctor").value;
                    let asstID = document.getElementById("assignAssistant").value;

                    // Validation
                    if (!docID || !asstID) {
                      showErrorToast("Please select both a doctor and an assistant");
                      return;
                    }

                    // Show loading state
                    $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Assigning...');

                    $.ajax({
                      url: '../admin_backend/user-management/assignments.php',
                      method: 'POST',
                      data: {
                        doctor_id: docID,
                        assistant_id: asstID
                      },
                      dataType: 'json',
                      success: function(response) {
                        if (response.success) {
                          loadAssignments();

                          showSuccessToast("Doctor and assistant successfully assigned!");
                          // Reset the form
                          $('#assignDoctor').val('');
                          $('#assignAssistant').val('');
                          $('#assignmentFormContainer').hide();
                        } else if (response.message) {
                          showErrorToast("Failed to assign: " + response.message);
                        }
                        // Reset button state
                        $('#assignBTN').prop('disabled', false).text('Assign');
                      },
                      error: function(xhr, status, error) {
                        console.error("Assignment error details:", {
                          status: status,
                          error: error,
                          responseText: xhr.responseText
                        });

                        // Try to parse the response if possible
                        try {
                          const errorData = JSON.parse(xhr.responseText);
                          showErrorToast(errorData.message || "Failed to assign. Please try again.");
                        } catch (e) {
                          showErrorToast("Assignment failed: " + xhr.status + " " + xhr.statusText);
                        }

                        // Reset button state
                        $('#assignBTN').prop('disabled', false).text('Assign');
                      }
                    });
                  });

                  // Functions to show toast notifications
                  function showSuccessToast(message) {
                    $('#successToastMessage').text(message);
                    var successToast = new bootstrap.Toast(document.getElementById('successToast'), {
                      delay: 5000,
                      animation: true
                    });
                    successToast.show();
                  }

                  function showErrorToast(message) {
                    console.log(message)
                    $('#errorToastMessage').text(message);
                    var errorToast = new bootstrap.Toast(document.getElementById('errorToast'), {
                      delay: 5000,
                      animation: true
                    });
                    errorToast.show();
                  }
                }
              });
            </script>





            <script>
              // Function to load assignments
              function loadAssignments() {
                $.ajax({
                  url: '../admin_backend/user-management/loadassignments.php',
                  type: 'GET',
                  success: function(data) {
                    $('#assignmentsTableBody').html(data);
                  }
                });
              }

              // Add modal HTML to the page if it doesn't exist
              if (!$('#confirmationModal').length) {
                $('body').append(`
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Unassignment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to proceed with the unassignment?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmUnassign">Yes, Unassign</button>
                    </div>
                </div>
            </div>
        </div>
    `);
              }

              if (!$('#successModal').length) {
                $('body').append(`
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                        </div>
                        <p id="successMessage" class="text-center"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    `);
              }

              // Variable to store the current ID being processed
              let currentUnassignId = null;

              // Event handler for unassign button
              $(document).on('click', '.unassign-btn', function() {
                currentUnassignId = $(this).data('id');
                const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmationModal.show();
              });

              // Event handler for the confirmation button in the modal
              $(document).on('click', '#confirmUnassign', function() {
                if (currentUnassignId) {
                  // Hide the confirmation modal
                  bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();

                  // Show a loading spinner
                  $('#assignmentsTableBody').html('<tr><td colspan="3" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>');

                  // Process the unassignment
                  $.ajax({
                    url: '../admin_backend/user-management/unassign.php',
                    type: 'POST',
                    data: {
                      id: currentUnassignId
                    },
                    success: function(response) {
                      // Update the success modal with the response message
                      $('#successMessage').text(response);

                      // Show the success modal
                      const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                      successModal.show();

                      // Reload the assignments
                      loadAssignments();

                      // Reset the current ID
                      currentUnassignId = null;
                    },
                    error: function() {
                      // Handle error case
                      $('#successMessage').text('An error occurred during unassignment.');
                      const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                      successModal.show();
                      loadAssignments();
                    }
                  });
                }
              });

              // Load assignments when the page loads
              $(document).ready(function() {
                loadAssignments();
              });
            </script>
  </main>

  <footer id="footer" class="footer light-background">
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">leukemiaVision</strong> <span>All Rights Reserved</span></p>

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

  <!-- User Management JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle form visibility buttons
      document.getElementById('toggleDoctorForm').addEventListener('click', function() {
        document.getElementById('doctorFormContainer').style.display = 'block';
      });

      document.getElementById('cancelDoctorBtn').addEventListener('click', function() {
        document.getElementById('doctorFormContainer').style.display = 'none';
      });

      document.getElementById('toggleAssistantForm').addEventListener('click', function() {
        document.getElementById('assistantFormContainer').style.display = 'block';
      });

      document.getElementById('cancelAssistantBtn').addEventListener('click', function() {
        document.getElementById('assistantFormContainer').style.display = 'none';
      });

      document.getElementById('toggleAssignmentForm').addEventListener('click', function() {
        document.getElementById('assignmentFormContainer').style.display = 'block';
      });

      document.getElementById('cancelAssignmentBtn').addEventListener('click', function() {
        document.getElementById('assignmentFormContainer').style.display = 'none';
      });
    });
  </script>

  <?php
  // Clear session data when user leaves the page or navigates away
  if (isset($_SESSION['message']) && strpos($_SESSION['message'], 'successful') !== false) {
    unset($_SESSION['form_data']);
    unset($_SESSION['message']);
  }

  if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
  }
  ?>



  <?php

  if (isset($_SESSION['message']) && strpos($_SESSION['message'], 'successful') !== false) {
    // Clear form data since submission was successful
    unset($_SESSION['form_data']);
    // Clear the success message too so it doesn't persist
    unset($_SESSION['message']);
  }

  // JavaScript to clear session data when user leaves the page or navigates away
  echo "<script>
    document.getElementById('cancelDoctorBtn').addEventListener('click', function() {
        // Make an AJAX call to clear session data when cancel is clicked
        fetch('clear_session.php');
    });
</script>";



  unset($_SESSION['form_data']);
  unset($_SESSION['errors']);
  ?>