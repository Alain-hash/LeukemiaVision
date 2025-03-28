<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Services Management - leukemiaVision</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">
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
            <li class="list-group-item active"><a href="admin-dashboard.php" class="text-decoration-none text-white"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li class="list-group-item"><a href="admin-blood-tests.php" class="text-decoration-none"><i class="bi bi-droplet me-2"></i>Upload Smear</a></li>
            <li class="list-group-item"><a href="admin-reports.php" class="text-decoration-none"><i class="bi bi-file-earmark-text me-2"></i> Test Reports</a></li>
            <li class="list-group-item"><a href="admin-insights.php" class="text-decoration-none"><i class="bi bi-graph-up me-2"></i> Insights</a></li>
            <li class="list-group-item"><a href="admin-user-management.php" class="text-decoration-none"><i class="bi bi-person-badge me-2"></i> Users </a></li>
            <li class="list-group-item"><a href="admin-services.php" class="text-decoration-none"><i class="bi bi-people me-2"></i>Services </a></li>
             <li class="list-group-item "><a href="admin-platform&content.php" class="text-decoration-none"><i class="bi bi-heart-pulse me-2"></i>Contents</a></li>
             <li class="list-group-item "><a href="admin-system-security.php" class="text-decoration-none"><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
             <li class="list-group-item "><a href="admin-schedule_setup.php" class="text-decoration-none"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
             <li class="list-group-item"><a href="../login.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
          </ul>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              Quick Actions
            </div>
            <div class="card-body">
              <button class="btn btn-primary mb-2 w-100" data-bs-toggle="modal" data-bs-target="#addServiceModal"><i class="bi bi-plus-circle me-2"></i>Add New Service</button>
              <button class="btn btn-success mb-2 w-100" id="refreshServicesBtn"><i class="bi bi-arrow-clockwise me-2"></i>Refresh Services</button>
              <button class="btn btn-info mb-2 w-100"><i class="bi bi-file-earmark-arrow-down me-2"></i>Export Services</button>
              <button class="btn btn-warning w-100"><i class="bi bi-printer me-2"></i>Print Service List</button>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              System Status
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <span>Database</span>
                <span class="badge bg-success">Online</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>AI System</span>
                <span class="badge bg-success">Online</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>Lab Equipment</span>
                <span class="badge bg-success">Connected</span>
              </div>
              <div class="d-flex justify-content-between">
                <span>Backup System</span>
                <span class="badge bg-warning">Pending</span>
              </div>
              <hr>
              <div class="d-flex justify-content-between align-items-center">
                <span>Last Update:</span>
                <span class="text-muted small">Today, 14:30</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <!-- Services Header -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-hospital"></i> Services Management</h2>
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
                      <h2 class="mb-0">12</h2>
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
                      <h2 class="mb-0">10</h2>
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
                      <h6 class="mb-0">Pending Services</h6>
                      <h2 class="mb-0">2</h2>
                    </div>
                    <i class="bi bi-clock fs-1"></i>
                  </div>
                </div>
              </div>
            </div>
          
          </div>

          <!-- Search and Filter -->
          <div class="card mb-4">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-4">
                  <input type="text" class="form-control" id="searchService" placeholder="Search services...">
                </div>
                <div class="col-md-3">
                  <select class="form-select" id="filterCategory">
                    <option value="">All Categories</option>
                    <option value="Blood Test">Blood Test</option>
                    <option value="Imaging">Imaging</option>
                    <option value="Consultation">Consultation</option>
                    <option value="Laboratory">Laboratory</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="form-select" id="filterStatus">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-primary w-100" id="applyFilters">Apply</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Services Table -->
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <i class="bi bi-table me-1"></i>
                Services List
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="servicesTable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Service Name</th>
                      <th>Category</th>
                      <th>Fee ($)</th>
                      <th>Availability</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr data-id="SRV001">
                      <td>SRV001</td>
                      <td>Complete Blood Count (CBC)</td>
                      <td>Blood Test</td>
                      <td>75.00</td>
                      <td>Mon-Sat, 8AM-7PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV001"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV001"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV002">
                      <td>SRV002</td>
                      <td>Lipid Panel</td>
                      <td>Blood Test</td>
                      <td>95.00</td>
                      <td>Mon-Fri, 9AM-5PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV002"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV002"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV003">
                      <td>SRV003</td>
                      <td>Bone Marrow Biopsy</td>
                      <td>Laboratory</td>
                      <td>350.00</td>
                      <td>Mon-Fri, 9AM-3PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV003"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV003"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV004">
                      <td>SRV004</td>
                      <td>Leukemia Screening</td>
                      <td>Blood Test</td>
                      <td>125.00</td>
                      <td>Mon-Sat, 8AM-6PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV004"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV004"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV005">
                      <td>SRV005</td>
                      <td>Hematology Consultation</td>
                      <td>Consultation</td>
                      <td>200.00</td>
                      <td>Mon-Fri, 10AM-4PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV005"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV005"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV006">
                      <td>SRV006</td>
                      <td>Peripheral Blood Smear</td>
                      <td>Laboratory</td>
                      <td>85.00</td>
                      <td>Mon-Sat, 8AM-7PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV006"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV006"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV007">
                      <td>SRV007</td>
                      <td>Flow Cytometry</td>
                      <td>Laboratory</td>
                      <td>280.00</td>
                      <td>Mon-Fri, 9AM-4PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV007"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV007"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV008">
                      <td>SRV008</td>
                      <td>Molecular Diagnostics</td>
                      <td>Laboratory</td>
                      <td>350.00</td>
                      <td>Mon-Fri, 9AM-3PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV008"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV008"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV009">
                      <td>SRV009</td>
                      <td>MRI Scan</td>
                      <td>Imaging</td>
                      <td>425.00</td>
                      <td>Mon-Fri, 9AM-5PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV009"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV009"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV010">
                      <td>SRV010</td>
                      <td>CT Scan</td>
                      <td>Imaging</td>
                      <td>375.00</td>
                      <td>Mon-Fri, 8AM-6PM</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV010"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV010"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV011">
                      <td>SRV011</td>
                      <td>Genetic Testing</td>
                      <td>Laboratory</td>
                      <td>450.00</td>
                      <td>By Appointment</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV011"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV011"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr data-id="SRV012">
                      <td>SRV012</td>
                      <td>Immunotherapy Consultation</td>
                      <td>Consultation</td>
                      <td>275.00</td>
                      <td>Tuesday, Thursday</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td>
                        <div class="btn-group btn-group-sm" role="group">
                          <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="SRV012"><i class="bi bi-pencil"></i></button>
                          <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="SRV012"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                  <span class="me-2">Show</span>
                  <select class="form-select form-select-sm d-inline-block w-auto">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                  <span class="ms-2">entries</span>
                </div>
                <nav>
                  <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>

         

  <!-- Add Service Modal -->
  <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addServiceModalLabel"><i class="bi bi-plus-circle me-2"></i>Add New Service</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addServiceForm">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="serviceName" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="serviceName" required>
              </div>
              <div class="col-md-6">
                <label for="serviceCategory" class="form-label">Category</label>
                <select class="form-select" id="serviceCategory" required>
                  <option value="">Select Category</option>
                  <option value="Blood Test">Blood Test</option>
                  <option value="Laboratory">Laboratory</option>
                  <option value="Imaging">Imaging</option>
                  <option value="Consultation">Consultation</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="serviceFee" class="form-label">Fee ($)</label>
                <input type="number" class="form-control" id="serviceFee" min="0" step="0.01" required>
              </div>
              <div class="col-md-4">
                <label for="serviceAvailability" class="form-label">Availability</label>
                <input type="text" class="form-control" id="serviceAvailability" placeholder="e.g. Mon-Fri, 9AM-5PM" required>
              </div>
              <div class="col-md-4">
                <label for="serviceStatus" class="form-label">Status</label>
                <select class="form-select" id="serviceStatus" required>
                  <option value="">Select Status</option>
                  <option value="Active">Active</option>
                  <option value="Pending">Pending</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="serviceDescription" class="form-label">Description</label>
              <textarea class="form-control" id="serviceDescription" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="serviceRequirements" class="form-label">Requirements</label>
              <textarea class="form-control" id="serviceRequirements" rows="2" placeholder="Any prerequisites or requirements for this service"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="saveNewService">Save Service</button>
        </div>
      </div>
    </div>
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
          <form id="editServiceForm">
            <input type="hidden" id="editServiceId">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="editServiceName" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="editServiceName" required>
              </div>
              <div class="col-md-6">
                <label for="editServiceCategory" class="form-label">Category</label>
                <select class="form-select" id="editServiceCategory" required>
                  <option value="">Select Category</option>
                  <option value="Blood Test">Blood Test</option>
                  <option value="Laboratory">Laboratory</option>
                  <option value="Imaging">Imaging</option>
                  <option value="Consultation">Consultation</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="editServiceFee" class="form-label">Fee ($)</label>
                <input type="number" class="form-control" id="editServiceFee" min="0" step="0.01" required>
              </div>
              <div class="col-md-4">
                <label for="editServiceAvailability" class="form-label">Availability</label>
                <input type="text" class="form-control" id="editServiceAvailability" placeholder="e.g. Mon-Fri, 9AM-5PM" required>
              </div>
              <div class="col-md-4">
                <label for="editServiceStatus" class="form-label">Status</label>
                <select class="form-select" id="editServiceStatus" required>
                  <option value="">Select Status</option>
                  <option value="Active">Active</option>
                  <option value="Pending">Pending</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="editServiceDescription" class="form-label">Description</label>
              <textarea class="form-control" id="editServiceDescription" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="editServiceRequirements" class="form-label">Requirements</label>
              <textarea class="form-control" id="editServiceRequirements" rows="2" placeholder="Any prerequisites or requirements for this service"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="updateService">Update Service</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Service Modal -->
  <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
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

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  <!-- Custom JavaScript -->
  <script src="js/services-management.js"></script>
  <script>document.addEventListener('DOMContentLoaded', function() {
    // Service data (in a real application, this would come from a backend)
    const services = [
        {id: "SRV001", name: "Complete Blood Count (CBC)", category: "Blood Test", fee: 75.00, availability: "Mon-Sat, 8AM-7PM", status: "Active", description: "Analysis of all blood cell types", requirements: "Fasting not required"},
        {id: "SRV002", name: "Lipid Panel", category: "Blood Test", fee: 95.00, availability: "Mon-Fri, 9AM-5PM", status: "Active", description: "Measures cholesterol and triglycerides", requirements: "Fasting 9-12 hours required"},
        {id: "SRV003", name: "Bone Marrow Biopsy", category: "Laboratory", fee: 350.00, availability: "Mon-Fri, 9AM-3PM", status: "Active", description: "Extraction and examination of bone marrow", requirements: "Doctor referral required"},
        {id: "SRV004", name: "Leukemia Screening", category: "Blood Test", fee: 125.00, availability: "Mon-Sat, 8AM-6PM", status: "Active", description: "Comprehensive blood analysis for leukemia markers", requirements: "None"},
        {id: "SRV005", name: "Hematology Consultation", category: "Consultation", fee: 200.00, availability: "Mon-Fri, 10AM-4PM", status: "Active", description: "Expert consultation with hematologist", requirements: "Previous test results recommended"},
        {id: "SRV006", name: "Peripheral Blood Smear", category: "Laboratory", fee: 85.00, availability: "Mon-Sat, 8AM-7PM", status: "Active", description: "Microscopic examination of blood cells", requirements: "None"},
        {id: "SRV007", name: "Flow Cytometry", category: "Laboratory", fee: 280.00, availability: "Mon-Fri, 9AM-4PM", status: "Active", description: "Analysis of cell characteristics", requirements: "Doctor referral required"},
        {id: "SRV008", name: "Molecular Diagnostics", category: "Laboratory", fee: 350.00, availability: "Mon-Fri, 9AM-3PM", status: "Active", description: "Genetic analysis for diagnostic purposes", requirements: "Doctor referral required"},
        {id: "SRV009", name: "MRI Scan", category: "Imaging", fee: 425.00, availability: "Mon-Fri, 9AM-5PM", status: "Active", description: "Magnetic resonance imaging", requirements: "Doctor referral required"},
        {id: "SRV010", name: "CT Scan", category: "Imaging", fee: 375.00, availability: "Mon-Fri, 8AM-6PM", status: "Active", description: "Computed tomography scan", requirements: "Doctor referral required"},
        {id: "SRV011", name: "Genetic Testing", category: "Laboratory", fee: 450.00, availability: "By Appointment", status: "Pending", description: "Comprehensive genetic analysis", requirements: "Genetic counseling required"},
        {id: "SRV012", name: "Immunotherapy Consultation", category: "Consultation", fee: 275.00, availability: "Tuesday, Thursday", status: "Pending", description: "Consultation for immunotherapy options", requirements: "Previous diagnosis required"}
    ];

    // DOM Elements
    const searchInput = document.getElementById('searchService');
    const filterCategory = document.getElementById('filterCategory');
    const filterStatus = document.getElementById('filterStatus');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const servicesTable = document.getElementById('servicesTable');
    const refreshServicesBtn = document.getElementById('refreshServicesBtn');
    const saveNewServiceBtn = document.getElementById('saveNewService');
    const updateServiceBtn = document.getElementById('updateService');
    const confirmDeleteServiceBtn = document.getElementById('confirmDeleteService');
    const alertContainer = document.getElementById('alertContainer');

    // Event Listeners
    applyFiltersBtn.addEventListener('click', filterServices);
    refreshServicesBtn.addEventListener('click', refreshServices);
    saveNewServiceBtn.addEventListener('click', saveNewService);
    updateServiceBtn.addEventListener('click', updateService);
    confirmDeleteServiceBtn.addEventListener('click', deleteService);

    // Add event listeners to edit and delete buttons
    document.querySelectorAll('.edit-service').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-id');
            populateEditForm(serviceId);
        });
    });

    document.querySelectorAll('.delete-service').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-id');
            document.getElementById('deleteServiceId').value = serviceId;
        });
    });

    // Functions
    function filterServices() {
        const searchTerm = searchInput.value.toLowerCase();
        const categoryFilter = filterCategory.value;
        const statusFilter = filterStatus.value;
        
        const tableBody = servicesTable.querySelector('tbody');
        const rows = tableBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const serviceName = row.cells[1].textContent.toLowerCase();
            const category = row.cells[2].textContent;
            const statusElement = row.cells[5].querySelector('span');
            const status = statusElement ? statusElement.textContent.toLowerCase() : '';
            
            const matchesSearch = searchTerm === '' || serviceName.includes(searchTerm);
            const matchesCategory = categoryFilter === '' || category === categoryFilter;
            const matchesStatus = statusFilter === '' || status.includes(statusFilter.toLowerCase());
            
            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        showAlert('Filters applied successfully!', 'success');
    }

    function refreshServices() {
        // In a real application, this would re-fetch data from the server
        searchInput.value = '';
        filterCategory.value = '';
        filterStatus.value = '';
        
        const tableBody = servicesTable.querySelector('tbody');
        const rows = tableBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            row.style.display = '';
        });
        
        showAlert('Services refreshed successfully!', 'success');
    }

    function populateEditForm(serviceId) {
        // Find the service data based on ID
        const service = services.find(s => s.id === serviceId);
        if (!service) return;
        
        // Populate the edit form with service data
        document.getElementById('editServiceId').value = service.id;
        document.getElementById('editServiceName').value = service.name;
        document.getElementById('editServiceCategory').value = service.category;
        document.getElementById('editServiceFee').value = service.fee;
        document.getElementById('editServiceAvailability').value = service.availability;
        document.getElementById('editServiceStatus').value = service.status;
        document.getElementById('editServiceDescription').value = service.description || '';
        document.getElementById('editServiceRequirements').value = service.requirements || '';
    }

    function saveNewService() {
        // Get form values
        const name = document.getElementById('serviceName').value;
        const category = document.getElementById('serviceCategory').value;
        const fee = document.getElementById('serviceFee').value;
        const availability = document.getElementById('serviceAvailability').value;
        const status = document.getElementById('serviceStatus').value;
        
        // Validate form inputs
        if (!name || !category || !fee || !availability || !status) {
            showAlert('Please fill in all required fields.', 'danger');
            return;
        }
        
        // In a real application, this would send data to the server
        // Generate a new service ID (for demo purposes)
        const newId = 'SRV' + (services.length + 1).toString().padStart(3, '0');
        
        // Add the new service to the table
        const tableBody = servicesTable.querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-id', newId);
        
        // Format the status badge
        const statusBadgeClass = status === 'Active' ? 'bg-success' : 
                                status === 'Pending' ? 'bg-warning' : 'bg-secondary';
        
        newRow.innerHTML = `
            <td>${newId}</td>
            <td>${name}</td>
            <td>${category}</td>
            <td>${parseFloat(fee).toFixed(2)}</td>
            <td>${availability}</td>
            <td><span class="badge ${statusBadgeClass}">${status}</span></td>
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <button class="btn btn-primary edit-service" data-bs-toggle="modal" data-bs-target="#editServiceModal" data-id="${newId}"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-danger delete-service" data-bs-toggle="modal" data-bs-target="#deleteServiceModal" data-id="${newId}"><i class="bi bi-trash"></i></button>
                </div>
            </td>
        `;
        
        tableBody.appendChild(newRow);
        
        // Add event listeners to new buttons
        newRow.querySelector('.edit-service').addEventListener('click', function() {
            const serviceId = this.getAttribute('data-id');
            populateEditForm(serviceId);
        });
        
        newRow.querySelector('.delete-service').addEventListener('click', function() {
            const serviceId = this.getAttribute('data-id');
            document.getElementById('deleteServiceId').value = serviceId;
        });
        
        // Save to services array (in a real app, this would go to the backend)
        services.push({
            id: newId,
            name: name,
            category: category,
            fee: parseFloat(fee),
            availability: availability,
            status: status,
            description: document.getElementById('serviceDescription').value,
            requirements: document.getElementById('serviceRequirements').value
        });
        
        // Close the modal and show success message
        const modal = bootstrap.Modal.getInstance(document.getElementById('addServiceModal'));
        modal.hide();
        
        // Reset the form
        document.getElementById('addServiceForm').reset();
        
        showAlert('Service added successfully!', 'success');

        // Update service counts
        updateServiceCounts();
    }

    function updateService() {
        const serviceId = document.getElementById('editServiceId').value;
        const name = document.getElementById('editServiceName').value;
        const category = document.getElementById('editServiceCategory').value;
        const fee = document.getElementById('editServiceFee').value;
        const availability = document.getElementById('editServiceAvailability').value;
        const status = document.getElementById('editServiceStatus').value;
        
        // Validate form inputs
        if (!name || !category || !fee || !availability || !status) {
            showAlert('Please fill in all required fields.', 'danger');
            return;
        }
        
        // Find the row in the table
        const row = document.querySelector(`tr[data-id="${serviceId}"]`);
        if (!row) return;
        
        // Update the row in the table
        row.cells[1].textContent = name;
        row.cells[2].textContent = category;
        row.cells[3].textContent = parseFloat(fee).toFixed(2);
        row.cells[4].textContent = availability;
        
        // Update the status badge
        const statusBadgeClass = status === 'Active' ? 'bg-success' : 
                                status === 'Pending' ? 'bg-warning' : 'bg-secondary';
        row.cells[5].innerHTML = `<span class="badge ${statusBadgeClass}">${status}</span>`;
        
        // Update the services array (in a real app, this would update the backend)
        const serviceIndex = services.findIndex(s => s.id === serviceId);
        if (serviceIndex !== -1) {
            services[serviceIndex] = {
                ...services[serviceIndex],
                name: name,
                category: category,
                fee: parseFloat(fee),
                availability: availability,
                status: status,
                description: document.getElementById('editServiceDescription').value,
                requirements: document.getElementById('editServiceRequirements').value
            };
        }
        
        // Close the modal and show success message
        const modal = bootstrap.Modal.getInstance(document.getElementById('editServiceModal'));
        modal.hide();
        
        showAlert('Service updated successfully!', 'success');

        // Update service counts
        updateServiceCounts();
    }

    function deleteService() {
        const serviceId = document.getElementById('deleteServiceId').value;
        
        // Find the row in the table
        const row = document.querySelector(`tr[data-id="${serviceId}"]`);
        if (!row) return;
        
        // Remove the row from the table
        row.remove();
        
        // Remove from the services array (in a real app, this would update the backend)
        const serviceIndex = services.findIndex(s => s.id === serviceId);
        if (serviceIndex !== -1) {
            services.splice(serviceIndex, 1);
        }
        
        // Close the modal and show success message
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteServiceModal'));
        modal.hide();
        
        showAlert('Service deleted successfully!', 'success');

        // Update service counts
        updateServiceCounts();
    }

    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        alertContainer.innerHTML = '';
        alertContainer.appendChild(alertDiv);
        
        // Auto-dismiss after 3 seconds
        setTimeout(() => {
            const alert = bootstrap.Alert.getOrCreateInstance(alertDiv);
            alert.close();
        }, 3000);
    }

    function updateServiceCounts() {
        // This would update the service statistics displays
        // In a real application, this would recalculate based on actual data
        
        // For this demo, we're just simulating the update
        // In a real app, you would recalculate these values from the services array
        document.querySelector('.bg-primary h2').textContent = services.length;
        
        const activeServices = services.filter(s => s.status === 'Active').length;
        document.querySelector('.bg-success h2').textContent = activeServices;
        
        const pendingServices = services.filter(s => s.status === 'Pending').length;
        document.querySelector('.bg-warning h2').textContent = pendingServices;
        
        // Update category counts
        const categories = [...new Set(services.map(s => s.category))];
        document.querySelector('.bg-info h2').textContent = categories.length;
    }
});</script>
</body>
</html>