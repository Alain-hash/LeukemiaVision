<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Schedule Setup - leukemiaVision</title>
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
          <div class="card mb-4">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Schedule Configuration</h5>
            </div>
            <div class="card-body">
              <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i> Configure your facility's scheduling parameters to optimize appointment management.
              </div>

              <!-- Working Hours Settings -->
              <div class="card mb-4">
                <div class="card-header bg-light">
                  <h6 class="mb-0"><i class="bi bi-clock me-2"></i>Working Hours</h6>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr class="bg-light">
                              <th>Day</th>
                              <th>Active</th>
                              <th>Start Time</th>
                              <th>End Time</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Monday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="monday-active" checked>
                                  <label class="form-check-label" for="monday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="08:00">
                              </td>
                              <td>
                                <input type="time" class="form-control" value="17:00">
                              </td>
                            </tr>
                            <tr>
                              <td>Tuesday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="tuesday-active" checked>
                                  <label class="form-check-label" for="tuesday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="08:00">
                              </td>
                              <td>
                                <input type="time" class="form-control" value="17:00">
                              </td>
                            </tr>
                            <tr>
                              <td>Wednesday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="wednesday-active" checked>
                                  <label class="form-check-label" for="wednesday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="08:00">
                              </td>
                              <td>
                                <input type="time" class="form-control" value="17:00">
                              </td>
                            </tr>
                            <tr>
                              <td>Thursday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="thursday-active" checked>
                                  <label class="form-check-label" for="thursday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="08:00">
                              </td>
                              <td>
                                <input type="time" class="form-control" value="17:00">
                              </td>
                            </tr>
                            <tr>
                              <td>Friday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="friday-active" checked>
                                  <label class="form-check-label" for="friday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="08:00">
                              </td>
                              <td>
                                <input type="time" class="form-control" value="16:00">
                              </td>
                            </tr>
                            <tr>
                              <td>Saturday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="saturday-active">
                                  <label class="form-check-label" for="saturday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="09:00" >
                              </td>
                              <td>
                                <input type="time" class="form-control" value="13:00" >
                              </td>
                            </tr>
                            <tr>
                              <td>Sunday</td>
                              <td>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" id="sunday-active">
                                  <label class="form-check-label" for="sunday-active"></label>
                                </div>
                              </td>
                              <td>
                                <input type="time" class="form-control" value="09:00">
                              </td>
                              <td>
                                <input type="time" class="form-control" value="13:00">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Buffer Time Settings -->
              <div class="card mb-4">
                <div class="card-header bg-light">
                  <h6 class="mb-0"><i class="bi bi-hourglass-split me-2"></i>Buffer Time Configuration</h6>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row mb-3">
                      <label for="buffer-time" class="col-sm-4 col-form-label">Buffer Time Between Appointments</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <input type="number" class="form-control" id="buffer-time" value="15" min="0" max="60">
                          <span class="input-group-text">minutes</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-text text-muted mb-3">
                      Buffer time provides a gap between appointments to prepare for the next patient or handle any delays.
                    </div>
                  </form>
                </div>
              </div>

              <!-- Default Appointment Duration for Services -->
              <div class="card mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                  <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Default Service Durations</h6>
                  <button class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-plus"></i> Add Service

                  </button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr class="bg-light">
                          <th>Service Name</th>
                          <th>Duration (minutes)</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Blood Smear Analysis</td>
                          <td>
                            <div class="input-group">
                              <input type="number" class="form-control" value="30" min="5" max="240">
                              <span class="input-group-text">min</span>
                            </div>
                          </td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Complete Blood Count (CBC)</td>
                          <td>
                            <div class="input-group">
                                <input type="number" class="form-control" value="45" min="5" max="240">
                              <span class="input-group-text">min</span>
                            </div>
                          </td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Leukemia Screening</td>
                          <td>
                            <div class="input-group">
                              <input type="number" class="form-control" value="60" min="5" max="240">
                              <span class="input-group-text">min</span>
                            </div>
                          </td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>Consultation</td>
                          <td>
                            <div class="input-group">
                              <input type="number" class="form-control" value="20" min="5" max="240">
                              <span class="input-group-text">min</span>
                            </div>
                          </td>
                          <td>
                            <div class="btn-group btn-group-sm" role="group">
                              <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                              <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

              <!-- Save Settings -->
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2">Cancel</button>
                <button type="button" class="btn btn-primary">
                  <i class="bi bi-save me-1"></i> Save Settings
                </button>
              </div>
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
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>
</html>
                             