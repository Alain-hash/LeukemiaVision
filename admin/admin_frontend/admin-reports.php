<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>reports - leukemiaVision</title>
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
              Test History
            </div>
            <div class="card-body">
              <div class="mb-3">
                <h6 class="mb-1">Previous Tests</h6>
                <button class="btn btn-sm btn-outline-primary mt-2 w-100"><i class="bi bi-file-earmark-text me-2"></i>CBC (2025-02-15)</button>
                <button class="btn btn-sm btn-outline-primary mt-2 w-100"><i class="bi bi-file-earmark-text me-2"></i>Malaria Test (2025-01-10)</button>
                <button class="btn btn-sm btn-outline-primary mt-2 w-100"><i class="bi bi-file-earmark-text me-2"></i>CBC (2024-11-22)</button>
              </div>
            </div>
          </div>
          
          <div class="card">
            <div class="card-header">
              Actions
            </div>
            <div class="card-body">
              <button class="btn btn-primary mb-2 w-100"><i class="bi bi-printer me-2"></i>Print Report</button>
              <button class="btn btn-success mb-2 w-100"><i class="bi bi-envelope me-2"></i>Email to Patient</button>
              <button class="btn btn-info mb-2 w-100"><i class="bi bi-file-earmark-pdf me-2"></i>Export as PDF</button>
              <button class="btn btn-danger w-100"><i class="bi bi-trash me-2"></i>Delete Report</button>
            </div>
          </div>
        </div>
        
        <!-- Main Content - Test Report -->
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-white text-white">
              <h5 class="mb-0">Blood Smear Test Report</h5>
             
            </div>
            <div class="card-body">
              <!-- Patient Information -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <h6 class="text-primary mb-3">Patient Information</h6>
                  <table class="table table-borderless table-sm">
                    <tbody>
                      <tr>
                        <td class="fw-bold" style="width: 40%">Patient Email:</td>
                        <td>patient@gmail.com</td>
                      </tr>
                      <tr>
                        <td class="fw-bold">Patient Name:</td>
                        <td>Maria Johnson</td>
                      </tr>
                      <tr>
                        <td class="fw-bold">Age/Gender:</td>
                        <td>34 years / Female</td>
                      </tr>
                      <tr>
                        <td class="fw-bold">Contact:</td>
                        <td>+1 (555) 123-4567</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <h6 class="text-primary mb-3">Test Information</h6>
                  <table class="table table-borderless table-sm">
                    <tbody>
                      <tr>
                        <td class="fw-bold" style="width: 40%">Test Type:</td>
                        <td>Leukemia Test (LT)</td>
                      </tr>
                      <tr>
                        <td class="fw-bold">Test Date:</td>
                        <td>March 10, 2025</td>
                      </tr>
                      <tr>
                        <td class="fw-bold">Report Date:</td>
                        <td>March 10, 2025</td>
                      </tr>
                      <tr>
                        <td class="fw-bold">Referring Doctor:</td>
                        <td>Dr. Robert Williams</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              
              <hr>
              
              <!-- Test Image Analysis -->
              <div class="row mb-4">
                <div class="col-12">
                  <h6 class="text-primary mb-3">Blood Smear Image Analysis</h6>
                </div>
                <div class="col-md-5">
                  <div class="card">
                    <div class="card-body p-2 text-center">
                      <img src="assets/img/blood-smear-sample.jpg" alt="Blood Smear Image" class="img-fluid rounded" style="max-height: 250px;">
                      <p class="small text-muted mt-2 mb-0">Original Blood Smear Image</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="card">
                    <div class="card-body p-2">
                      <h6 class="card-title">AI Analysis Results</h6>
                      <div class="progress mb-2" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 98%;" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">RBC Morphology (98%)</div>
                      </div>
                      <div class="progress mb-2" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">WBC Differential (95%)</div>
                      </div>
                      <div class="progress mb-2" style="height: 20px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 82%;" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100">Platelet Estimation (82%)</div>
                      </div>
                      <div class="progress mb-2" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 97%;" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100">Image Quality (97%)</div>
                      </div>
                      <p class="small text-muted mt-2 mb-0">Analysis confidence levels shown above</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Test Results -->
              <div class="row mb-4">
                <div class="col-12">
                  <h6 class="text-primary mb-3">Blood Count Results</h6>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead class="table-light">
                        <tr>
                          <th>Parameter</th>
                          <th>Result</th>
                          <th>Reference Range</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Red Blood Cell (RBC) Count</td>
                          <td>4.2 × 10^6/μL</td>
                          <td>4.0-5.5 × 10^6/μL</td>
                          <td><span class="badge bg-success">Normal</span></td>
                        </tr>
                        <tr>
                          <td>Hemoglobin (Hgb)</td>
                          <td>11.8 g/dL</td>
                          <td>12.0-16.0 g/dL</td>
                          <td><span class="badge bg-warning">Slightly Low</span></td>
                        </tr>
                        <tr>
                          <td>Hematocrit (Hct)</td>
                          <td>36%</td>
                          <td>36-46%</td>
                          <td><span class="badge bg-success">Normal</span></td>
                        </tr>
                        <tr>
                          <td>Mean Corpuscular Volume (MCV)</td>
                          <td>85 fL</td>
                          <td>80-100 fL</td>
                          <td><span class="badge bg-success">Normal</span></td>
                        </tr>
                        <tr>
                          <td>Mean Corpuscular Hemoglobin (MCH)</td>
                          <td>28 pg</td>
                          <td>27-33 pg</td>
                          <td><span class="badge bg-success">Normal</span></td>
                        </tr>
                        <tr>
                          <td>White Blood Cell (WBC) Count</td>
                          <td>10.2 × 10^3/μL</td>
                          <td>4.5-11.0 × 10^3/μL</td>
                          <td><span class="badge bg-success">Normal</span></td>
                        </tr>
                        <tr>
                          <td>Platelet Count</td>
                          <td>380 × 10^3/μL</td>
                          <td>150-450 × 10^3/μL</td>
                          <td><span class="badge bg-success">Normal</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
             
              <!-- AI Interpretation & Comments -->
              <div class="row mb-4">
                <div class="col-12">
                  <div class="alert alert-info">
                    <h6 class="text-primary mb-2"><i class="bi bi-robot me-2"></i>AI Analysis Interpretation</h6>
                    <p class="mb-0">The blood smear analysis reveals mild anisocytosis and poikilocytosis with slight hypochromia. The patient's hemoglobin is marginally below the reference range (11.8 g/dL vs. 12.0-16.0 g/dL), suggesting a mild anemia. The red cell indices (MCV, MCH) are within normal ranges, ruling out significant microcytosis or macrocytosis. White blood cell count and differential are within normal limits with no evidence of left shift or toxic granulation. Platelet count and morphology appear normal. These findings are consistent with mild iron deficiency anemia in its early stages. Further iron studies are recommended for confirmation.</p>
                  </div>
                </div>
              </div>
              
              <!-- Laboratory Comments -->
              <div class="row">
                <div class="col-12">
                  <h6 class="text-primary mb-3">Laboratory Comments</h6>
                  <div class="card">
                    <div class="card-body">
                      <p class="mb-0"><strong>Recommendations:</strong> Follow-up with serum ferritin, iron, TIBC, and transferrin saturation recommended. Clinical correlation advised.</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Report Footer -->
              <div class="row mt-4">
                <div class="col-12">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <p class="mb-0"><strong>Analyzed by:</strong> AI System v2.5</p>
                      <p class="mb-0"><strong>Reviewed by:</strong> Dr. Elizabeth Chen, MD</p>
                    </div>
                    <div class="text-end">
                      <p class="mb-0"><strong>Report Generated:</strong> March 10, 2025, 14:30</p>
                      <p class="mb-0"><strong>Report ID:</strong> BST-1082-CBC</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons Below Report -->
          <div class="d-flex justify-content-between">
            <a href="admin-blood-tests.html" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Back to Tests</a>
            <div>
            
              <button class="btn btn-primary me-2"><i class="bi bi-printer me-2"></i>Print</button>
              <button class="btn btn-success"><i class="bi bi-envelope me-2"></i>Send to Doctor</button>
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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script>
    // Add any report-specific JavaScript functionality here
    document.addEventListener('DOMContentLoaded', function() {
      // Print report functionality
      document.querySelectorAll('.btn-primary').forEach(button => {
        if (button.innerHTML.includes('Print')) {
          button.addEventListener('click', function() {
            window.print();
          });
        }
      });
    });
  </script>
</body>

</html>