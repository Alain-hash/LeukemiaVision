<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Upload smear - leukemiaVision</title>
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
          
          <div class="card">
            <div class="card-header">
              Quick Statistics
            </div>
            <div class="card-body">
              <div class="mb-3">
                <h6 class="mb-1">Pending Tests</h6>
                <h3 class="text-primary mb-0">24</h3>
              </div>
              <div class="mb-3">
                <h6 class="mb-1">Completed Today</h6>
                <h3 class="text-success mb-0">16</h3>
              </div>
              <div>
                <h6 class="mb-1">Total This Month</h6>
                <h3 class="text-info mb-0">147</h3>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Upload Blood Smear Image</h5>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Upload Smear</li>
                </ol>
              </nav>
            </div>
            <div class="card-body">
              <form id="uploadSmearForm">
                <div class="row">
              
                  
                  <div class="col-md-6 mb-4">
              
                    <select class="form-select" id="testType" required>
                      <option value="" selected disabled>Select test type</option>
                      <option value="cbc">leukemia</option>
                    </select>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label for="patientName" class="form-label">Patient Email</label>
                    <input type="text" class="form-control" id="patientName" placeholder="Patient Email will appear here" readonly>
                  </div>
                  
                  <div class="col-md-6 mb-4">
                    <label for="requestDate" class="form-label">Upload Date</label>
                    <input type="date" class="form-control" id="requestDate" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 mb-4">
                    <label for="smearImage" class="form-label">Blood Smear Image</label>
                    <input class="form-control" type="file" id="smearImage" accept="image/*" required>
                    <small class="form-text text-muted">Supported formats: JPG, PNG, TIFF. Max size: 10MB</small>
                  </div>
                </div>
                
                <div class="card mb-4">
                  <div class="card-header">
                    Image Preview
                  </div>
                  <div class="card-body text-center">
                    <div class="image-preview-container border rounded d-flex align-items-center justify-content-center" style="height: 300px; background-color: #f8f9fa;">
                      <div id="previewPlaceholder">
                        <i class="bi bi-image" style="font-size: 3rem; color: #adb5bd;"></i>
                        <p class="mt-2 text-muted">Image preview will appear here</p>
                      </div>
                      <img id="preview" src="#" alt="Blood Smear Preview" style="max-width: 100%; max-height: 280px; display: none;">
                    </div>
                  </div>
                </div>
                
                <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-secondary"><i class="bi bi-x-circle me-2"></i>Cancel</button>
                  <div>
                    <button type="button" class="btn btn-primary me-2"><i class="bi bi-save me-2"></i>Save Draft</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-upload me-2"></i>Upload & Generate Report</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Recent Blood Smear Uploads</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                   
                      <th>Patient</th>
                      <th>Test Type</th>
                      <th>Upload Date</th>
                    
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    
                      <td>Maria Johnson</td>
                      <td>Leukemia</td>
                      <td>2025-03-10</td>
                 
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                          <button type="button" class="btn btn-outline-success"><i class="bi bi-file-earmark-text"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                    
                      <td>Robert Smith</td>
                      <td>Leukemia</td>
                      <td>2025-03-10</td>
                  
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                          <button type="button" class="btn btn-outline-success"><i class="bi bi-file-earmark-text"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                   
                      <td>Jennifer Davis</td>
                      <td>Leukemia</td>
                      <td>2025-03-09</td>
                    
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                          <button type="button" class="btn btn-outline-success"><i class="bi bi-file-earmark-text"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                   
                      <td>Michael Brown</td>
                      <td>leukemia</td>
                      <td>2025-03-09</td>
                    
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                          <button type="button" class="btn btn-outline-success"><i class="bi bi-file-earmark-text"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-3 mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
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
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

  <!-- Custom Script for Image Preview -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const smearImage = document.getElementById('smearImage');
      const preview = document.getElementById('preview');
      const previewPlaceholder = document.getElementById('previewPlaceholder');
      
      smearImage.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          
          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            previewPlaceholder.style.display = 'none';
          }
          
          reader.readAsDataURL(file);
        } else {
          preview.style.display = 'none';
          previewPlaceholder.style.display = 'block';
        }
      });
      
      // Example patient lookup
      document.getElementById('patientId').addEventListener('input', function() {
        // This is just an example - in a real app this would query a database
        if (this.value === "P12345") {
          document.getElementById('patientName').value = "John Doe";
        } else if (this.value === "P54321") {
          document.getElementById('patientName').value = "Jane Smith";
        } else {
          document.getElementById('patientName').value = "";
        }
      });
    });
  </script>
</body>

</html>