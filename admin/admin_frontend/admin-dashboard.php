<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - leukemiaVision</title>
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
          <!-- Uncomment the line below if you also wish to use an image logo -->
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
              <button class="btn btn-primary mb-2 w-100"><i class="bi bi-person-plus me-2"></i>New Patient</button>
              <button class="btn btn-success mb-2 w-100"><i class="bi bi-plus-circle me-2"></i>New Test</button>
              <button class="btn btn-info mb-2 w-100"><i class="bi bi-calendar-plus me-2"></i>Schedule Appointment</button>
              <button class="btn btn-warning w-100"><i class="bi bi-file-earmark-plus me-2"></i>Generate Report</button>
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
          <!-- Stats Cards -->
          <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">Total Patients</h6>
                      <h2 class="mb-0">3,852</h2>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                  </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="admin-patients.html">View Details</a>
                  <div class="small text-white"><i class="bi bi-arrow-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-success text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">Tests Today</h6>
                      <h2 class="mb-0">42</h2>
                    </div>
                    <i class="bi bi-clipboard2-pulse fs-1"></i>
                  </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="admin-blood-tests.html">View Details</a>
                  <div class="small text-white"><i class="bi bi-arrow-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">Pending Reports</h6>
                      <h2 class="mb-0">12</h2>
                    </div>
                    <i class="bi bi-clipboard-data fs-1"></i>
                  </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="admin-reports.html">View Details</a>
                  <div class="small text-white"><i class="bi bi-arrow-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-0">Critical Results</h6>
                      <h2 class="mb-0">5</h2>
                    </div>
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                  </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="#">View Details</a>
                  <div class="small text-white"><i class="bi bi-arrow-right"></i></div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Charts Row -->
          <div class="row mb-4">
            <div class="col-xl-6">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div>
                    <i class="bi bi-bar-chart-line me-1"></i>
                    Test Volume (Last 7 Days)
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="#">Export as CSV</a></li>
                      <li><a class="dropdown-item" href="#">Export as PDF</a></li>
                      <li><a class="dropdown-item" href="#">Print Chart</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <img src="/api/placeholder/600/250" alt="Bar chart showing test volumes over the last 7 days" class="img-fluid"/>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div>
                    <i class="bi bi-pie-chart me-1"></i>
                    Test Type Distribution
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <li><a class="dropdown-item" href="#">Export as CSV</a></li>
                      <li><a class="dropdown-item" href="#">Export as PDF</a></li>
                      <li><a class="dropdown-item" href="#">Print Chart</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <img src="/api/placeholder/600/250" alt="Pie chart showing distribution of test types" class="img-fluid"/>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Recent Tests & Tasks -->
          <div class="row">
            <div class="col-xl-8">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div>
                    <i class="bi bi-table me-1"></i>
                    Recent Test Reports
                  </div>
                  <a href="admin-blood-tests.html" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Report ID</th>
                          <th>Patient</th>
                          <th>Test Type</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>BST-1082</td>
                          <td>Maria Johnson</td>
                          <td>CBC</td>
                          <td>Mar 10, 2025</td>
                          <td><span class="badge bg-success">Completed</span></td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <a href="blood-smear-test.html" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-info"><i class="bi bi-printer"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>BST-1081</td>
                          <td>John Smith</td>
                          <td>Lipid Panel</td>
                          <td>Mar 10, 2025</td>
                          <td><span class="badge bg-warning">Pending</span></td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <a href="#" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-info"><i class="bi bi-printer"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>BST-1080</td>
                          <td>Sarah Davis</td>
                          <td>Blood Glucose</td>
                          <td>Mar 10, 2025</td>
                          <td><span class="badge bg-danger">Critical</span></td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <a href="#" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-info"><i class="bi bi-printer"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>BST-1079</td>
                          <td>Robert Brown</td>
                          <td>CBC</td>
                          <td>Mar 9, 2025</td>
                          <td><span class="badge bg-success">Completed</span></td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <a href="#" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-info"><i class="bi bi-printer"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>BST-1078</td>
                          <td>Emily Wilson</td>
                          <td>Thyroid Panel</td>
                          <td>Mar 9, 2025</td>
                          <td><span class="badge bg-success">Completed</span></td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <a href="#" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-info"><i class="bi bi-printer"></i></button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
         
              
              <!-- AI System Status -->
              <div class="card">
                <div class="card-header bg-info text-white">
                  <i class="bi bi-robot me-1"></i>
                  AI System Status
                </div>
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <div class="progress flex-grow-1 me-3" style="height: 10px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 86%;" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="text-success fw-bold">86%</span>
                  </div>
                  <p class="card-text small">AI analysis system operating normally. Processing 86% of tests automatically with high confidence.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <span class="badge bg-success me-1">RBC Analysis</span>
                      <span class="badge bg-success me-1">WBC Analysis</span>
                      <span class="badge bg-warning">Platelet</span>
                    </div>
                    <button class="btn btn-sm btn-outline-info">Details</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer id="footer" class="footer light-background">
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
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>

</html>



