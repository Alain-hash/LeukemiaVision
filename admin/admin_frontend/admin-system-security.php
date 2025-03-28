<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>System & Security management - leukemiaVision</title>
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
<!-- Main Content Section - Admin Testimonial Management -->
<main id="main">
  <div class="container py-4">
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
            <h5 class="mb-0">Date Range</h5>
          </div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startDate" value="2025-01-01">
              </div>
              <div class="mb-3">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="endDate" value="2025-03-10">
              </div>
              <button type="button" class="btn btn-primary w-100" id="applyDateRange">
                <i class="bi bi-calendar-check me-2"></i>Apply
              </button>
            </form>
          </div>
        </div>
        
        <div class="card mt-4">
          <div class="card-header">
            <h5 class="mb-0">Export Options</h5>
          </div>
          <div class="card-body">
            <div class="d-grid gap-2">
              <button type="button" class="btn btn-outline-primary">
                <i class="bi bi-file-pdf me-2"></i>Export as PDF
              </button>
              <button type="button" class="btn btn-outline-success">
                <i class="bi bi-file-excel me-2"></i>Export as Excel
              </button>
              <button type="button" class="btn btn-outline-secondary">
                <i class="bi bi-printer me-2"></i>Print Report
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Main Content Area -->
      <div class="col-lg-9">
        <!-- Dashboard Summary Cards -->
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h5 class="card-title">Total Testimonials</h5>
                <h2 class="card-text">124</h2>
                <p>Last updated: 10 Mar 2025</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-warning text-dark">
              <div class="card-body">
                <h5 class="card-title">Pending Review</h5>
                <h2 class="card-text">17</h2>
                <p>Requires administrator attention</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-danger text-white">
              <div class="card-body">
                <h5 class="card-title">Flagged Content</h5>
                <h2 class="card-text">5</h2>
                <p>Potentially harmful testimonials</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Filter Controls -->
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Filter Testimonials</h5>
            <div class="row">
              <div class="col-md-3 mb-2">
                <select class="form-select" id="filterType">
                  <option selected>All Types</option>
                  <option>Doctor Rating</option>
                  <option>User Experience</option>
                </select>
              </div>
             
             
              <div class="col-md-3 mb-2">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                  <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Testimonials Table -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between align-items-center">
              <span>Patient Testimonials</span>
              <button class="btn btn-sm btn-outline-danger" id="bulkDeleteBtn" disabled>
                <i class="bi bi-trash"></i> Delete Selected
              </button>
            </h5>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                      </div>
                    </th>
                  
                    <th>Patient</th>
                    <th>Type</th>
                    <th>Rating</th>
                    <th>Content Preview</th>
                    <th>Date</th>
                 
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Testimonial Row 1 - Example of Flagged Content -->
                  <tr class="table-danger">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input testimonial-select" type="checkbox" id="testimonial1">
                      </div>
                    </td>
                   
                    <td>John Smith</td>
                    <td>Doctor Review</td>
                    <td>
                      <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                      </div>
                    </td>
                    <td>
                      <span class="text-truncate d-inline-block" style="max-width: 200px;">
                        Very unprofessional staff. Dr. Williams was rude and dismissive...
                      </span>
                     
                    </td>
                    <td>Mar 9, 2025</td>
                
                    <td>
                      <button class="btn btn-sm btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  
                  <!-- Testimonial Row 2 - Normal Published -->
                  <tr>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input testimonial-select" type="checkbox" id="testimonial2">
                      </div>
                    </td>
                 
                    <td>Sarah Johnson</td>
                    <td>System Feedback</td>
                    <td>
                      <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                      </div>
                    </td>
                    <td>
                      <span class="text-truncate d-inline-block" style="max-width: 200px;">
                        The new appointment system is much more efficient. I was able to...
                      </span>
                    </td>
                    <td>Mar 8, 2025</td>
               
                    <td>
                      <button class="btn btn-sm btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  
                  <!-- Testimonial Row 3 - Pending Review -->
                  <tr class="table-warning">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input testimonial-select" type="checkbox" id="testimonial3">
                      </div>
                    </td>
                 
                    <td>Robert Lee</td>
                    <td>Doctor Review</td>
                    <td>
                      <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                      </div>
                    </td>
                    <td>
                      <span class="text-truncate d-inline-block" style="max-width: 200px;">
                        Dr. Patel's diagnosis was incorrect and I had to get a second opinion...
                      </span>
                 
                    </td>
                    <td>Mar 7, 2025</td>
                   
                    <td>
                      <button class="btn btn-sm btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  
                  <!-- Testimonial Row 4 - Normal Published -->
                  <tr>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input testimonial-select" type="checkbox" id="testimonial4">
                      </div>
                    </td>
                  
                    <td>Emily Davis</td>
                    <td>System Feedback</td>
                    <td>
                      <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </div>
                    </td>
                    <td>
                      <span class="text-truncate d-inline-block" style="max-width: 200px;">
                        The facilities were impeccable and staff was very attentive...
                      </span>
                    </td>
                    <td>Mar 6, 2025</td>
                  
                    <td>
                      <button class="btn btn-sm btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                  
                  <!-- Testimonial Row 5 - Flagged -->
                  <tr class="table-danger">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input testimonial-select" type="checkbox" id="testimonial5">
                      </div>
                    </td>
                
                    <td>Michael Wilson</td>
                    <td>Doctor Review</td>
                    <td>
                      <div class="text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                      </div>
                    </td>
                    <td>
                      <span class="text-truncate d-inline-block" style="max-width: 200px;">
                        This hospital is a complete scam. They overcharge for everything and...
                      </span>
                    
                    </td>
                    <td>Mar 5, 2025</td>
                  
                    <td>
                      <button class="btn btn-sm btn-info view-btn" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal"><i class="bi bi-eye"></i></button>
                      <button class="btn btn-sm btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
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

<!-- View Testimonial Modal -->
<div class="modal fade" id="viewTestimonialModal" tabindex="-1" aria-labelledby="viewTestimonialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewTestimonialModalLabel">View Testimonial Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-6">
           
            <p><strong>Patient:</strong> John Smith</p>
            <p><strong>Date Submitted:</strong> March 9, 2025</p>
            <p><strong>Type:</strong> Doctor Review</p>
           
          </div>
          <div class="col-md-6">
            <h6>Doctor Information</h6>
            <p><strong>Doctor:</strong> Dr. Williams</p>
    
            <p><strong>Rating:</strong> 
              <span class="text-warning">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
                <i class="bi bi-star"></i>
              </span>
              (1.0/5.0)
            </p>
          </div>
        </div>
        
      
        <div class="card mb-3">
          <div class="card-header">
            <h6 class="mb-0">Testimonial Content</h6>
          </div>
          <div class="card-body">
            <p>Very unprofessional staff. Dr. Williams was rude and dismissive of my concerns. I waited over two hours past my appointment time and when I finally saw the doctor, he spent less than 5 minutes with me. The diagnosis felt rushed and I'm seeking a second opinion elsewhere. I would not recommend this doctor or this facility to anyone. Complete waste of time and money.</p>
          </div>
        </div>
        
        <div class="card">
          <div class="card-header">
            <h6 class="mb-0">Admin Notes</h6>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="adminNotes" class="form-label">Add/Edit Notes</label>
              <textarea class="form-control" id="adminNotes" rows="3" placeholder="Enter administrative notes here...">This review appears to be from a legitimately dissatisfied patient but contains some harsh language. Flag for review by department head.</textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
              
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">Delete Testimonial</button>
       
        <button type="button" class="btn btn-success">Approve & Publish</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning">
          <i class="bi bi-exclamation-triangle-fill"></i> Warning: This action cannot be undone.
        </div>
        <p>Are you sure you want to delete this testimonial? This will permanently remove all data associated with it from the system.</p>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="deleteReason">
          <label class="form-check-label" for="deleteReason">
            Record reason for deletion
          </label>
        </div>
        <div class="mb-3">
          <select class="form-select mb-2" id="deleteReasonSelect">
            <option selected>Select reason for deletion...</option>
            <option>Contains inappropriate content</option>
            <option>Violates community guidelines</option>
            <option>Contains false information</option>
            <option>Contains personal/private information</option>
            <option>Spam/promotional content</option>
            <option>Other reason (please specify)</option>
          </select>
          <textarea class="form-control" id="deleteReasonText" rows="2" placeholder="Provide additional details..."></textarea>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="blockUserCheck">
          <label class="form-check-label" for="blockUserCheck">
            Block this user from submitting future testimonials
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete Testimonial</button>
      </div>
    </div>
  </div>
</div>

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
<!-- Bootstrap JavaScript -->
<script>
  // This would normally be in an external JS file
  document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const testimonialCheckboxes = document.querySelectorAll('.testimonial-select');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    
    selectAllCheckbox.addEventListener('change', function() {
      testimonialCheckboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
      });
      updateBulkDeleteButton();
    });
    
    testimonialCheckboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateBulkDeleteButton);
    });
    
    function updateBulkDeleteButton() {
      const checkedCount = document.querySelectorAll('.testimonial-select:checked').length;
      bulkDeleteBtn.disabled = checkedCount === 0;
      
      if (checkedCount > 0) {
        bulkDeleteBtn.textContent = `Delete Selected (${checkedCount})`;
      } else {
        bulkDeleteBtn.textContent = 'Delete Selected';
      }
    }
    
    // Confirm delete button
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    if (confirmDeleteBtn) {
      confirmDeleteBtn.addEventListener('click', function() {
        // This would normally make an AJAX call to delete the testimonial
        alert('Testimonial deleted successfully!');
        
        // Close the modal and refresh the page or update the table
        const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
        deleteModal.hide();
        
        // This is just for demo purposes - in a real app, you'd update the UI without refreshing
        setTimeout(() => {
          // Simulate successful deletion by removing row or refreshing data
          alert('Table updated!');
        }, 500);
      });
    }
  });
</script>
</body>

</html>