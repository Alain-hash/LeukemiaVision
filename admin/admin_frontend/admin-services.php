<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Services Management - leukemiaVision</title>
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

</head>

<body class="starter-page-page">

  <header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="admin-dashboard.html" class="logo d-flex align-items-center me-auto">

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
              <li class="list-group-item"><a href="admin-user-management.php" class="text-decoration-none"><i class="bi bi-person-badge me-2"></i> Users </a></li>
              <li class="list-group-item active "><a href="admin-services.php" class="text-decoration-none text-white"><i class="bi bi-people me-2"></i>Services </a></li>
              <li class="list-group-item "><a href="admin-appointments.php" class="text-decoration-none" ><i class="bi bi-calendar-check me-2"></i>Appointments</a></li>
              <li class="list-group-item "><a href="admin-system-security.php" class="text-decoration-none  "><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
              <li class="list-group-item "><a href="admin-schedule_setup.php" class="text-decoration-none"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
              <li class="list-group-item"><a href="../../logout.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
          </div>


        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <!-- Services Header -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-hospital"></i> Service Management</h2>
            <div class="alert-container" id="alertContainer"></div>
          </div>

          <!-- Services Statistics -->

          <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">Total Services</h6>
                      <!-- Change this line: -->
                      <h2 class="mb-0 total-services-count"></h2>
                    </div>
                    <i class="bi bi-hospital fs-1"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-success text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">Active Services</h6>
                      <!-- Change this line: -->
                      <h2 class="mb-0 active-services-count">

                      </h2>
                    </div>
                    <i class="bi bi-check-circle fs-1"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">InActive Services</h6>
                      <!-- Change this line: -->
                      <h2 class="mb-0 inactive-services-count">

                      </h2>
                    </div>
                    <i class="bi bi-clock fs-1"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"> <?php echo $success_message; ?> </div>
          <?php endif; ?>
          <?php if (!empty($errors['general'])): ?>
            <div class="alert alert-danger"> <?php echo $errors['general']; ?> </div>
          <?php endif; ?>
          <!-- Services Table -->
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <i class="bi bi-table me-1"></i>
                Services List
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive" id="serviceTable">
                <!-- ajax load service will display here -->
              </div>

            </div>
          </div>

          <div class="modal-body">
            <form id="addServiceForm" method="post">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="serviceName" class="form-label">Service Name</label>
                  <input type="text" class="form-control" id="serviceName" name="serviceName">
                  <small class="text-danger <?php echo empty($errors['serviceName']) ? 'd-none' : ''; ?>">
                    <?php echo $errors['serviceName'] ?? ''; ?>
                  </small>

                </div>

                <div class="col-md-6">
                  <label for="categoryDropdown" class="form-label">Category</label>
                  <select class="form-select" id="categoryDropdown" name="categoryDropdown">
                  <option value=''>Select Category</option>
                        <option value='Test'>Test</option>
                        <option value='Treatment'>Treatment</option>
                  </select>
                  <small class="text-danger <?php echo empty($errors['categoryDropdown']) ? 'd-none' : ''; ?>">
                    <?php echo $errors['categoryDropdown'] ?? ''; ?>
                  </small>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="serviceFee" class="form-label">Fee $</label>
                  <input type="text" class="form-control" id="serviceFee" name="serviceFee">
                  <small class="text-danger <?php echo empty($errors['serviceFee']) ? 'd-none' : ''; ?>">
                    <?php echo $errors['serviceFee'] ?? ''; ?>
                  </small>
                </div>

                <div class="col-md-4">
                  <label for="serviceDuration" class="form-label">Duration (min)</label>
                  <input type="text" class="form-control" id="serviceDuration" name="serviceDuration">
                  <small class="text-danger <?php echo empty($errors['serviceDuration']) ? 'd-none' : ''; ?>">
                    <?php echo $errors['serviceDuration'] ?? ''; ?>
                  </small>
                </div>

                <div class="col-md-4">
                  <label for="statusDropdown" class="form-label">Status</label>
                  <select class="form-select" id="statusDropdown" name="statusDropdown">
                  <option value=''>Select Availability</option>
                        <option value='Available'>Available</option>
                        <option value='Unavailable'>Unavailable</option>
                  </select>
                  <small class="text-danger <?php echo empty($errors['statusDropdown']) ? 'd-none' : ''; ?>">
                    <?php echo $errors['statusDropdown'] ?? ''; ?>
                  </small>
                </div>
              </div>

              <div class="mb-3">
                <label for="serviceDescription" class="form-label">Description</label>
                <textarea class="form-control" id="serviceDescription" name="serviceDescription" rows="3"></textarea>
                <small class="text-danger <?php echo empty($errors['serviceDescription']) ? 'd-none' : ''; ?>">
                  <?php echo $errors['serviceDescription'] ?? ''; ?>
                </small>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Service</button>
              </div>
            </form>
          </div>

          <!-- Edit Service Modal -->
          <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editServiceModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Service</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="editServiceForm" method="post">
                    <input type="hidden" id="editServiceId" name="serviceId">

                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="editServiceName" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="editServiceName" name="serviceName">
                        <small class="text-danger edit-error-serviceName d-none"></small>
                      </div>

                      <div class="col-md-6">
                        <label for="editCategoryDropdown" class="form-label">Category</label>
                        <select class="form-select" id="editCategoryDropdown" name="categoryDropdown">
                        <option value=''>Select Category</option>
                        <option value='Test'>Test</option>
                        <option value='Treatment'>Treatment</option>
                        </select>
                        <small class="text-danger edit-error-categoryDropdown d-none"></small>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-4">
                        <label for="editServiceFee" class="form-label">Fee $</label>
                        <input type="text" class="form-control" id="editServiceFee" name="serviceFee">
                        <small class="text-danger edit-error-serviceFee d-none"></small>
                      </div>

                      <div class="col-md-4">
                        <label for="editServiceDuration" class="form-label">Duration (min)</label>
                        <input type="text" class="form-control" id="editServiceDuration" name="serviceDuration">
                        <small class="text-danger edit-error-serviceDuration d-none"></small>
                      </div>

                      <div class="col-md-4">
                        <label for="editStatusDropdown" class="form-label">Status</label>
                        <select class="form-select" id="editStatusDropdown" name="statusDropdown">
                        <option value=''>Select Availability</option>
                        <option value='Available'>Available</option>
                        <option value='Unavailable'>Unavailable</option>
                        </select>
                        <small class="text-danger edit-error-statusDropdown d-none"></small>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="editServiceDescription" class="form-label">Description</label>
                      <textarea class="form-control" id="editServiceDescription" name="serviceDescription" rows="3"></textarea>
                      <small class="text-danger edit-error-serviceDescription d-none"></small>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update Service</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Delete Service Modal -->
          <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteServiceModalLabel"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Confirm Deletion</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="deleteServiceId">
                  <p>Are you sure you want to delete this service? This action cannot be undone.</p>
                  <div class="alert alert-warning">
                    <i class="bi bi-info-circle me-2"></i>Deleting this service may affect existing appointments and patient records.
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                  <button type="button" class="btn btn-danger" id="confirmDeleteService">Delete Service</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Scripts -->

          <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="../../assets/vendor/aos/aos.js"></script>
          <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
          <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
          <script src="../../assets/js/main.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
          <script>
            $(document).ready(function() {
              loadServiceTable();
              loadServiceStats();

              // Clear form errors when user starts typing
              $('#addServiceForm input, #addServiceForm select, #addServiceForm textarea').on('input change', function() {
                $(this).siblings('small.text-danger').addClass('d-none');
              });

              $('#addServiceForm').submit(function(e) {
                e.preventDefault();

                // Clear any previous error messages
                $('#addServiceForm small.text-danger').addClass('d-none');

                $.ajax({
                  type: "POST",
                  url: "../admin_backend/admin-services/admin-add-service.php",
                  data: $(this).serialize(),
                  dataType: 'json',
                  success: function(response) {
                    if (response.status === 'success') {
                      // Show success message
                      showAlert('Service added successfully!', 'success');

                      // Clear form
                      $('#addServiceForm')[0].reset();

                      // Reload service table and stats
                      loadServiceTable();
                      loadServiceStats();
                    } else {
                      // Display errors in the form
                      displayFormErrors(response.errors);
                    }
                  },
                  error: function(xhr, status, error) {
                    showAlert('Error adding service: ' + error, 'danger');
                  }
                });
              });

              $(document).on('click', '.delete-service', function() {
                const serviceId = $(this).data('id');
                $('#deleteServiceId').val(serviceId);
                
              });

              // Confirm delete service
              $('#confirmDeleteService').on('click', function() {
                const serviceId = $('#deleteServiceId').val();

                // Validate that we have a service ID
                if (!serviceId) {
                  showAlert('Error: Service ID is missing. Please try again.', 'danger');
                  return;
                }

                $.ajax({
                  url: '../admin_backend/admin-services/admin-delete-service.php',
                  type: 'POST',
                  data: {
                    id: serviceId
                  },
                  dataType: 'json',
                  success: function(response) {
                    if (response.status === 'success') {
                      $('#deleteServiceModal').modal('hide');
                      showAlert('Service deleted successfully!', 'success');
                      loadServiceTable();
                      loadServiceStats();
                    } else {
                      showAlert('Failed to delete service: ' + (response.message || ''), 'danger');
                    }
                  },
                  error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    showAlert('An error occurred while deleting the service: ' + error, 'danger');
                  }
                });
              });
              ///////////////////////////////////////////////////////////////////////////
              $(document).on('click', '.edit-service', function() {
                const serviceId = $(this).data('id');
                loadServiceForEditing(serviceId);
              });

              // Load service data for editing
              function loadServiceForEditing(serviceId) {
                // Clear previous errors
                $('#editServiceForm small.text-danger').addClass('d-none');

                // Fetch service data
                $.ajax({
                  url: '../admin_backend/admin-services/admin-get-service.php',
                  type: 'GET',
                  data: {
                    id: serviceId
                  },
                  dataType: 'json',
                  success: function(response) {
                    if (response.status === 'success') {
                      const service = response.data;

                      // Populate form fields
                      $('#editServiceId').val(service.Service_ID);
                      $('#editServiceName').val(service.Name);
                      $('#editServiceFee').val(service.Fee);
                      $('#editServiceDuration').val(service.Service_Duration);
                      $('#editServiceDescription').val(service.Description);

                      // Set category and status dropdowns (with slight delay to ensure options are loaded)
                      setTimeout(() => {
                        $('#editCategoryDropdown').val(service.Type);
                        $('#editStatusDropdown').val(service.Availability);
                      }, 500);
                    } else {
                      showAlert('Failed to load service data: ' + response.message, 'danger');
                    }
                  },
                  error: function(xhr, status, error) {
                    showAlert('An error occurred while loading service data: ' + error, 'danger');
                  }
                });
              }


              // Clear form errors when user starts typing in edit form
              $('#editServiceForm input, #editServiceForm select, #editServiceForm textarea').on('input change', function() {
                $(this).siblings('small.text-danger').addClass('d-none');
              });

              // Handle edit service form submission
              $('#editServiceForm').submit(function(e) {
                e.preventDefault();

                // Clear any previous error messages
                $('#editServiceForm small.text-danger').addClass('d-none');

                $.ajax({
                  type: "POST",
                  url: "../admin_backend/admin-services/admin-update-service.php",
                  data: $(this).serialize(),
                  dataType: 'json',
                  success: function(response) {
                    if (response.status === 'success') {
                      // Show success message
                      showAlert('Service updated successfully!', 'success');

                      // Close modal
                      $('#editServiceModal').modal('hide');

                      // Reload service table and stats
                      loadServiceTable();
                      loadServiceStats();
                    } else {
                      // Display errors in the form
                      displayEditFormErrors(response.errors);
                    }
                  },
                  error: function(xhr, status, error) {
                    showAlert('Error updating service: ' + error, 'danger');
                  }
                });
              });

              // Display errors in edit form
              function displayEditFormErrors(errors) {
                // Display each error under its corresponding field
                for (const field in errors) {
                  if (field !== 'general') {
                    const errorMessage = errors[field];
                    const errorElement = $('.edit-error-' + field);

                    errorElement.text(errorMessage);
                    errorElement.removeClass('d-none');
                  }
                }

                // If there's a general error, show it as an alert
                if (errors.general) {
                  showAlert(errors.general, 'danger');
                }
              }

              //////////////////////////////

              function loadServiceTable() {
                $.get("../admin_backend/admin-services/admin-load-services.php", function(data) {
                  $('#serviceTable').html(data);
                });
              }

              function loadServiceStats() {
                $.ajax({
                  url: "../admin_backend/admin-services/admin-get-service-stats.php",
                  dataType: 'json',
                  success: function(data) {
                    // Update the statistics in the UI
                    $('.total-services-count').text(data.total);
                    $('.active-services-count').text(data.active);
                    $('.inactive-services-count').text(data.inactive);
                  },
                  error: function(xhr, status, error) {
                    console.error("Error loading service statistics:", error);
                  }
                });
              }

              function displayFormErrors(errors) {
                // Display each error under its corresponding field
                for (const field in errors) {
                  const errorMessage = errors[field];
                  const errorElement = $('#' + field).siblings('small.text-danger');

                  errorElement.text(errorMessage);
                  errorElement.removeClass('d-none');
                }

                // If there's a general error, show it as an alert
                if (errors.general) {
                  showAlert(errors.general, 'danger');
                }
              }

              function showAlert(message, type) {
                const alertHtml = `
      <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

                $('#alertContainer').html(alertHtml);

                // Auto-dismiss after 5 seconds
                setTimeout(function() {
                  $('.alert').alert('close');
                }, 5000);
              }

              // Optional: Refresh stats periodically (every 30 seconds)
              setInterval(function() {
                loadServiceStats();
              }, 30000);
            });
          </script>


</body>

</html>