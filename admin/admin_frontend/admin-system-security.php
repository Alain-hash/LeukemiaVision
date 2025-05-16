<?php 
session_start();

if(!isset($_SESSION['user_id']) && $_SESSION['Role']!='Admin'){
    header("location:../../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>System & Security management - leukemiaVision</title>
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
              <li class="list-group-item"><a href="admin-insights.php" class="text-decoration-none"><i class="bi bi-graph-up me-2"></i> Insights</a></li>
              <li class="list-group-item"><a href="admin-user-management.php" class="text-decoration-none"><i class="bi bi-person-badge me-2"></i> Users </a></li>
              <li class="list-group-item "><a href="admin-services.php" class="text-decoration-none "><i class="bi bi-people me-2"></i>Services </a></li>
              <li class="list-group-item "><a href="admin-appointments.php" class="text-decoration-none" ><i class="bi bi-calendar-check me-2"></i>Appointments</a></li>
              <li class="list-group-item active"><a href="admin-system-security.php" class="text-decoration-none  text-white"><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
              <li class="list-group-item "><a href="admin-schedule_setup.php" class="text-decoration-none"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
              <li class="list-group-item"><a href="../../logout.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
        </div>
    
      </div>
      
      <!-- Main Content Area -->
      <div class="col-lg-9">
  
       <!-- Dashboard Summary Cards -->
<div class="row mb-4">
  <div class="col-md-4">
    <div class="card bg-primary text-white">
      <div class="card-body">
        <h5 class="card-title">Active Testimonials</h5>
        <h2 class="card-text" id="totalTestimonials">0</h2>
        <p>Last updated: <span id="lastUpdated">Loading...</span></p>
      </div>
    </div>
  </div>
</div>

        <!-- Testimonials Table -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between align-items-center">
              <span>Doctor Testimonials</span>
             
            </h5>
            
            <div class="table-responsive" id="testimonialTable">
              <!-- Table content will be loaded here via AJAX -->
            </div>
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
        <!-- JS will insert content here -->
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal - Now used for Status Toggle confirmation -->
<div class="modal fade" id="statusConfirmModal" tabindex="-1" aria-labelledby="statusConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title" id="statusConfirmModalLabel">Confirm Status Change</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning">
          <i class="bi bi-exclamation-triangle-fill"></i> Warning: This will change the visibility of the testimonial.
        </div>
        <p id="statusConfirmMessage">Are you sure you want to change this testimonial's status?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmStatusBtn">Confirm</button>
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
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>
<script src="../../assets/vendor/aos/aos.js"></script>
<script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="../../assets/js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  loadTestimonialCount();
  loadTestimonialTable();

  // Initialize modals
  const viewTestimonialModal = new bootstrap.Modal(document.getElementById('viewTestimonialModal'));
  const statusConfirmModal = new bootstrap.Modal(document.getElementById('statusConfirmModal'));

  // Load testimonial count
  function loadTestimonialCount() {
    $.ajax({
      url: "../admin_backend/admin-system-security/admin-get-testimonial-count.php",
      method: "GET",
      dataType: "json",
      success: function(data) {
        $('#totalTestimonials').text(data.count);
        $('#lastUpdated').text(data.last_updated);
      },
      error: function(xhr, status, error) {
        console.error("Error loading testimonial count:", error);
      }
    });
  }

  function loadTestimonialTable() {
    $.ajax({
      url: "../admin_backend/admin-system-security/admin-load-testimonials.php",
      method: "GET",
      success: function(data) {
        $('#testimonialTable').html(data);

        // Add event listeners to the view buttons after the table is loaded
        $('.view-btn').on('click', function() {
          const feedbackId = $(this).data('id');
          
          // Fetch testimonial details
          $.ajax({
            url: '../admin_backend/admin-system-security/admin-get-testimonials-details.php',
            method: 'GET',
            data: { 
              feedbackId: feedbackId
            },
            dataType: 'json',
            success: function(response) {
              if (response.success) {
                const t = response.testimonial;
                
                // Update modal title
                $('#viewTestimonialModalLabel').text('Doctor Testimonial Details');
                
                // Generate status badge
                const statusBadge = t.status === 'Active' ? 
                  '<span class="badge bg-success">Active</span>' : 
                  '<span class="badge bg-secondary">Inactive</span>';
                
                // Update modal content
                $('#viewTestimonialModal .modal-body').html(`
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <p><strong>Patient:</strong> ${t.patient_name}</p>
                      <p><strong>Date Submitted:</strong> ${t.date}</p>
                      <p><strong>Status:</strong> ${statusBadge}</p>
                    </div>
                    <div class="col-md-6">
                      <h6>Doctor Information</h6>
                      <p><strong>Doctor:</strong> ${t.doctor_name || 'N/A'}</p>
                      <p><strong>Rating:</strong> ${renderStars(t.doctor_rating)} (${t.doctor_rating}/5.0)</p>
                    </div>
                  </div>
                  <div class="card mb-3">
                    <div class="card-header"><h6 class="mb-0">Testimonial Content</h6></div>
                    <div class="card-body">
                      <p>${t.doctor_feedback || '<em>No feedback provided</em>'}</p>
                    </div>
                  </div>
                `);
                
                // Show the modal
                viewTestimonialModal.show();
              } else {
                alert(response.message);
              }
            },
            error: function(xhr, status, error) {
              console.error("Error fetching testimonial details:", error);
              alert('An error occurred while fetching testimonial details.');
            }
          });
        });

        // Add event listeners to toggle status buttons
        $('.toggle-status-btn').on('click', function() {
          const feedbackId = $(this).data('id');
          const currentStatus = $(this).data('current');
          
          // Update modal content based on current status
          if (currentStatus === 'Active') {
            $('#statusConfirmMessage').text('Are you sure you want to deactivate this testimonial? It will no longer be visible to users.');
            $('#confirmStatusBtn').removeClass('btn-success').addClass('btn-warning').text('Deactivate');
          } else {
            $('#statusConfirmMessage').text('Are you sure you want to activate this testimonial? It will become visible to users.');
            $('#confirmStatusBtn').removeClass('btn-warning').addClass('btn-success').text('Activate');
          }
          
          // Store the data with jQuery data method
          $('#confirmStatusBtn').data({
            'id': feedbackId,
            'status': currentStatus
          });
          
          // Show the confirmation modal
          statusConfirmModal.show();
        });
      },
      error: function(xhr, status, error) {
        console.error("Error loading testimonials:", error);
        $('#testimonialTable').html('<div class="text-danger">Failed to load testimonials.</div>');
      }
    });
  }

  // Handle status toggle confirmation
  $('#confirmStatusBtn').on('click', function() {
    const feedbackId = $(this).data('id');
    const currentStatus = $(this).data('status');
    
    // Send the status toggle request
    $.ajax({
      url: '../admin_backend/admin-system-security/admin-toggle-testimonial-status.php',
      method: 'POST',
      data: { 
        feedbackId: feedbackId,
        status: currentStatus
      },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Hide the modal
          statusConfirmModal.hide();
          
          // Update the count in the dashboard card
          $('#totalTestimonials').text(response.count);
          $('#lastUpdated').text(response.last_updated);
        
          
          // Reload the testimonial table
          loadTestimonialTable();
        } else {
          alert(response.message || 'An error occurred while updating the testimonial status.');
        }
      },
      error: function(xhr, status, error) {
        console.error("Error updating testimonial status:", error, xhr.responseText);
        alert('An error occurred while processing your request.');
      }
    });
  });

  // Set focus AFTER modal is fully shown (avoid aria-hidden issue)
  $('#viewTestimonialModal').on('shown.bs.modal', function () {
    $(this).find('.btn-close').trigger('focus');
  });

  // Render star rating utility
  function renderStars(rating) {
    if (!rating) return '<span class="text-muted">No rating</span>';
    
    let html = '<span class="text-warning">';
    for (let i = 1; i <= 5; i++) {
      html += i <= rating ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
    }
    html += '</span>';
    return html;
  }
});
</script>

</body>

</html>