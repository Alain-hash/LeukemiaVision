<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Content management - leukemiaVision</title>
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
  <main id="main" class="pt-5">
    <div class="container mt-4">
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
              User Statistics
            </div>
            <div class="card-body">
              <div class="mb-3">
                <h6 class="mb-1">Total Doctors</h6>
                <h3 class="text-primary mb-0" id="doctorCount">12</h3>
              </div>
              <div class="mb-3">
                <h6 class="mb-1">Total Assistants</h6>
                <h3 class="text-success mb-0" id="assistantCount">28</h3>
              </div>
              <div>
                <h6 class="mb-1">Total Patients</h6>
                <h3 class="text-info mb-0" id="patientCount">147</h3>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Content Management</h5>
              <ul class="nav nav-tabs card-header-tabs" id="contentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="lifestyle-tab" data-bs-toggle="tab" data-bs-target="#lifestyle" type="button" role="tab" aria-controls="lifestyle" aria-selected="true">Lifestyle Recommendations</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab" aria-controls="education" aria-selected="false">Educational Resources</button>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="contentTabsContent">
                <!-- Lifestyle Recommendations Tab -->
                <div class="tab-pane fade show active" id="lifestyle" role="tabpanel" aria-labelledby="lifestyle-tab">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5>Manage Lifestyle Recommendations</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLifestyleModal">
                      <i class="bi bi-plus-circle me-2"></i>Add New Recommendation
                    </button>
                  </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Created Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Daily Exercise Recommendations</td>
                          <td>Physical Activity</td>
                          <td>2023-11-10</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Healthy Eating Habits</td>
                          <td>Nutrition</td>
                          <td>2023-11-15</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Stress Management Techniques</td>
                          <td>Mental Health</td>
                          <td>2023-11-20</td>
                          <td><span class="badge bg-warning">Draft</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Sleep Improvement Guide</td>
                          <td>Wellness</td>
                          <td>2023-11-22</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Smoking Cessation Support</td>
                          <td>Health Habits</td>
                          <td>2023-11-25</td>
                          <td><span class="badge bg-danger">Archived</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <nav aria-label="Lifestyle Recommendations pagination">
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
                
                <!-- Educational Resources Tab -->
                <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5>Manage Educational Resources</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                      <i class="bi bi-plus-circle me-2"></i>Add New Resource
                    </button>
                  </div>
                  
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Resource Type</th>
                          <th>Created Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Understanding Blood Test Results</td>
                          <td>PDF Guide</td>
                          <td>2023-10-05</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Diabetes Prevention Strategies</td>
                          <td>Video</td>
                          <td>2023-10-12</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Heart Health Basics</td>
                          <td>Article</td>
                          <td>2023-10-18</td>
                          <td><span class="badge bg-warning">Draft</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>COVID-19 Vaccination FAQs</td>
                          <td>Q&A Document</td>
                          <td>2023-10-25</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Mental Health Support Resources</td>
                          <td>External Links</td>
                          <td>2023-11-01</td>
                          <td><span class="badge bg-success">Published</span></td>
                          <td>
                            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  
                  <nav aria-label="Educational Resources pagination">
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
          
          <!-- Recent Activity Card -->
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1"><strong>Admin</strong> published <strong>Healthy Eating Habits</strong></p>
                    <small class="text-muted">3 days ago</small>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1"><strong>Admin</strong> updated <strong>Stress Management Techniques</strong></p>
                    <small class="text-muted">5 days ago</small>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1"><strong>Admin</strong> added <strong>Heart Health Basics</strong> to educational resources</p>
                    <small class="text-muted">1 week ago</small>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1"><strong>Admin</strong> archived <strong>Smoking Cessation Support</strong></p>
                    <small class="text-muted">1 week ago</small>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1"><strong>Admin</strong> published <strong>COVID-19 Vaccination FAQs</strong></p>
                    <small class="text-muted">2 weeks ago</small>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Add Lifestyle Recommendation Modal -->
  <div class="modal fade" id="addLifestyleModal" tabindex="-1" aria-labelledby="addLifestyleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addLifestyleModalLabel">Add New Lifestyle Recommendation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="lifestyleForm">
            <div class="mb-3">
              <label for="lifestyleTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="lifestyleTitle" required>
            </div>
            <div class="mb-3">
              <label for="lifestyleCategory" class="form-label">Category</label>
              <select class="form-select" id="lifestyleCategory" required>
                <option value="">Select a category</option>
                <option value="Physical Activity">Physical Activity</option>
                <option value="Nutrition">Nutrition</option>
                <option value="Mental Health">Mental Health</option>
                <option value="Wellness">Wellness</option>
                <option value="Health Habits">Health Habits</option>
                <option value="Sleep">Sleep</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="lifestyleContent" class="form-label">Content</label>
              <textarea class="form-control" id="lifestyleContent" rows="6" required></textarea>
            </div>
            <div class="mb-3">
              <label for="lifestyleThumbnail" class="form-label">Thumbnail Image</label>
              <input type="file" class="form-control" id="lifestyleThumbnail">
            </div>
            <div class="mb-3">
              <label for="lifestyleTags" class="form-label">Tags (comma separated)</label>
              <input type="text" class="form-control" id="lifestyleTags" placeholder="health, wellness, nutrition">
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="lifestyleStatus" id="lifestyleStatusPublish" value="publish" checked>
                <label class="form-check-label" for="lifestyleStatusPublish">
                  Publish immediately
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="lifestyleStatus" id="lifestyleStatusDraft" value="draft">
                <label class="form-check-label" for="lifestyleStatusDraft">
                  Save as draft
                </label>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Save Recommendation</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Educational Resource Modal -->
  <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEducationModalLabel">Add New Educational Resource</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="educationForm">
            <div class="mb-3">
              <label for="educationTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="educationTitle" required>
            </div>
            <div class="mb-3">
              <label for="educationType" class="form-label">Resource Type</label>
              <select class="form-select" id="educationType" required>
                <option value="">Select a type</option>
                <option value="PDF Guide">PDF Guide</option>
                <option value="Video">Video</option>
                <option value="Article">Article</option>
                <option value="Q&A Document">Q&A Document</option>
                <option value="External Links">External Links</option>
                <option value="Infographic">Infographic</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="educationSummary" class="form-label">Summary</label>
              <textarea class="form-control" id="educationSummary" rows="2" required></textarea>
            </div>
            <div class="mb-3">
              <label for="educationContent" class="form-label">Content</label>
              <textarea class="form-control" id="educationContent" rows="6" required></textarea>
            </div>
            <div class="mb-3">
              <label for="educationFile" class="form-label">Upload File (PDF, Video, etc.)</label>
              <input type="file" class="form-control" id="educationFile">
            </div>
            <div class="mb-3">
              <label for="educationExternalLink" class="form-label">External Link (if applicable)</label>
              <input type="url" class="form-control" id="educationExternalLink" placeholder="https://example.com/resource">
            </div>
            <div class="mb-3">
              <label class="form-label">Target Audience</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="audiencePatients" value="patients" checked>
                <label class="form-check-label" for="audiencePatients">
                  Patients
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="audienceMedical" value="medical">
                <label class="form-check-label" for="audienceMedical">
                  Medical Professionals
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="audienceGeneral" value="general">
                <label class="form-check-label" for="audienceGeneral">
                  General Public
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="educationStatus" id="educationStatusPublish" value="publish" checked>
                <label class="form-check-label" for="educationStatusPublish">
                  Publish immediately
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="educationStatus" id="educationStatusDraft" value="draft">
                <label class="form-check-label" for="educationStatusDraft">
                  Save as draft
                </label>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Save Resource</button>
        </div>
      </div>
    </div>
  </div>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Medilab</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
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
  <script src="../assets/js/main.js">
// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // Initialize counters with data from backend (simulated here)
  updateUserCounts();
  
  // Initialize event listeners for the admin interface
  initializeEventListeners();
  
  // Initialize form validation
  initializeFormValidation();
  
  // Initialize table actions (view, edit, delete buttons)
  initializeTableActions();
});

/**
 * Updates the user count statistics in the sidebar
 */
function updateUserCounts() {
  // In a real application, these would be fetched from an API
  document.getElementById('doctorCount').textContent = 12;
  document.getElementById('assistantCount').textContent = 28;
  document.getElementById('patientCount').textContent = 147;
}

/**
 * Initializes all event listeners for the admin interface
 */
function initializeEventListeners() {
  // Handle the lifestyle recommendation form submission
  const lifestyleForm = document.getElementById('lifestyleForm');
  if (lifestyleForm) {
    const saveLifestyleBtn = lifestyleForm.closest('.modal').querySelector('.modal-footer .btn-primary');
    saveLifestyleBtn.addEventListener('click', function() {
      handleLifestyleFormSubmit();
    });
  }
  
  // Handle the educational resource form submission
  const educationForm = document.getElementById('educationForm');
  if (educationForm) {
    const saveEducationBtn = educationForm.closest('.modal').querySelector('.modal-footer .btn-primary');
    saveEducationBtn.addEventListener('click', function() {
      handleEducationFormSubmit();
    });
  }
  
  // Handle tab changes to ensure proper content display
  const contentTabs = document.getElementById('contentTabs');
  if (contentTabs) {
    const tabs = contentTabs.querySelectorAll('.nav-link');
    tabs.forEach(tab => {
      tab.addEventListener('click', function(e) {
        e.preventDefault();
        const tabTarget = this.getAttribute('data-bs-target').replace('#', '');
        showTabContent(tabTarget);
      });
    });
  }
  
  // Add event listeners for pagination
  initializePagination();
}

/**
 * Handles the pagination for both lifestyle recommendations and educational resources
 */
function initializePagination() {
  const paginationElements = document.querySelectorAll('.pagination');
  paginationElements.forEach(pagination => {
    const pageLinks = pagination.querySelectorAll('.page-link');
    pageLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        
        // In a real app, this would load data for the selected page
        // For now, we'll just update the active class
        const parentItem = this.parentElement;
        if (!parentItem.classList.contains('disabled')) {
          pagination.querySelector('.active').classList.remove('active');
          parentItem.classList.add('active');
          
          // Simulate loading data for the new page
          console.log('Loading data for page:', this.textContent);
        }
      });
    });
  });
}

/**
 * Initializes form validation for all forms
 */
function initializeFormValidation() {
  // Lifestyle form validation
  const lifestyleForm = document.getElementById('lifestyleForm');
  if (lifestyleForm) {
    lifestyleForm.addEventListener('submit', function(e) {
      if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      this.classList.add('was-validated');
    });
  }
  
  // Education form validation
  const educationForm = document.getElementById('educationForm');
  if (educationForm) {
    educationForm.addEventListener('submit', function(e) {
      if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      this.classList.add('was-validated');
    });
  }
}

/**
 * Initialize actions for table rows (view, edit, delete)
 */
function initializeTableActions() {
  // Get all action buttons
  const actionButtons = document.querySelectorAll('.table .btn');
  
  actionButtons.forEach(button => {
    button.addEventListener('click', function() {
      const row = this.closest('tr');
      const id = row.cells[0].textContent;
      const title = row.cells[1].textContent;
      
      if (this.classList.contains('btn-info')) {
        // View button
        viewItem(id, title);
      } else if (this.classList.contains('btn-warning')) {
        // Edit button
        editItem(id, title);
      } else if (this.classList.contains('btn-danger')) {
        // Delete button
        deleteItem(id, title);
      }
    });
  });
}

/**
 * Handles viewing an item's details
 */
function viewItem(id, title) {
  console.log(`Viewing item #${id}: ${title}`);
  // In a real application, this would open a modal or navigate to a detail page
  alert(`Viewing details for "${title}"`);
}

/**
 * Handles editing an item
 */
function editItem(id, title) {
  console.log(`Editing item #${id}: ${title}`);
  // In a real application, this would populate and open the edit modal
  
  // Determine which modal to open based on current tab
  const activeTab = document.querySelector('#contentTabs .nav-link.active').getAttribute('id');
  
  if (activeTab === 'lifestyle-tab') {
    // Open and populate lifestyle modal
    const modal = new bootstrap.Modal(document.getElementById('addLifestyleModal'));
    
    // Populate form fields (simulated here)
    document.getElementById('lifestyleTitle').value = title;
    
    // Set modal title to indicate editing
    document.getElementById('addLifestyleModalLabel').textContent = 'Edit Lifestyle Recommendation';
    
    modal.show();
  } else {
    // Open and populate education modal
    const modal = new bootstrap.Modal(document.getElementById('addEducationModal'));
    
    // Populate form fields (simulated here)
    document.getElementById('educationTitle').value = title;
    
    // Set modal title to indicate editing
    document.getElementById('addEducationModalLabel').textContent = 'Edit Educational Resource';
    
    modal.show();
  }
}

/**
 * Handles deleting an item
 */
function deleteItem(id, title) {
  console.log(`Deleting item #${id}: ${title}`);
  // In a real application, this would show a confirmation dialog
  
  if (confirm(`Are you sure you want to delete "${title}"?`)) {
    // Simulate backend deletion
    alert(`"${title}" has been deleted.`);
    
    // Remove the row from the table
    const tables = document.querySelectorAll('.table');
    tables.forEach(table => {
      const rows = table.querySelectorAll('tbody tr');
      rows.forEach(row => {
        if (row.cells[0].textContent === id) {
          row.remove();
        }
      });
    });
  }
}

/**
 * Handles the submission of the lifestyle recommendation form
 */
function handleLifestyleFormSubmit() {
  const form = document.getElementById('lifestyleForm');
  
  if (!form.checkValidity()) {
    // If the form is invalid, trigger validation UI
    form.classList.add('was-validated');
    return;
  }
  
  // Get form values
  const title = document.getElementById('lifestyleTitle').value;
  const category = document.getElementById('lifestyleCategory').value;
  const content = document.getElementById('lifestyleContent').value;
  const tags = document.getElementById('lifestyleTags').value;
  const status = document.querySelector('input[name="lifestyleStatus"]:checked').value;
  
  // In a real application, you would send this data to your backend
  console.log('Saving lifestyle recommendation:', {
    title,
    category,
    content,
    tags,
    status
  });
  
  // Simulate successful save
  alert(`Lifestyle recommendation "${title}" has been saved.`);
  
  // Close the modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('addLifestyleModal'));
  modal.hide();
  
  // Add the new item to the table (in a real app, you'd refresh from server)
  addNewLifestyleToTable({
    id: Math.floor(Math.random() * 1000),
    title,
    category,
    date: new Date().toISOString().split('T')[0],
    status: status === 'publish' ? 'Published' : 'Draft'
  });
  
  // Reset the form
  form.reset();
  form.classList.remove('was-validated');
  document.getElementById('addLifestyleModalLabel').textContent = 'Add New Lifestyle Recommendation';
}

/**
 * Handles the submission of the educational resource form
 */
function handleEducationFormSubmit() {
  const form = document.getElementById('educationForm');
  
  if (!form.checkValidity()) {
    // If the form is invalid, trigger validation UI
    form.classList.add('was-validated');
    return;
  }
  
  // Get form values
  const title = document.getElementById('educationTitle').value;
  const type = document.getElementById('educationType').value;
  const summary = document.getElementById('educationSummary').value;
  const content = document.getElementById('educationContent').value;
  const link = document.getElementById('educationExternalLink').value;
  const status = document.querySelector('input[name="educationStatus"]:checked').value;
  
  // Get target audience - checkboxes
  const audience = [];
  if (document.getElementById('audiencePatients').checked) audience.push('Patients');
  if (document.getElementById('audienceMedical').checked) audience.push('Medical Professionals');
  if (document.getElementById('audienceGeneral').checked) audience.push('General Public');
  
  // In a real application, you would send this data to your backend
  console.log('Saving educational resource:', {
    title,
    type,
    summary,
    content,
    link,
    audience,
    status
  });
  
  // Simulate successful save
  alert(`Educational resource "${title}" has been saved.`);
  
  // Close the modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('addEducationModal'));
  modal.hide();
  
  // Add the new item to the table (in a real app, you'd refresh from server)
  addNewEducationToTable({
    id: Math.floor(Math.random() * 1000),
    title,
    type,
    date: new Date().toISOString().split('T')[0],
    status: status === 'publish' ? 'Published' : 'Draft'
  });
  
  // Reset the form
  form.reset();
  form.classList.remove('was-validated');
  document.getElementById('addEducationModalLabel').textContent = 'Add New Educational Resource';
}

/**
 * Adds a new lifestyle recommendation to the table
 */
function addNewLifestyleToTable(item) {
  const table = document.querySelector('#lifestyle table tbody');
  const row = document.createElement('tr');
  
  row.innerHTML = `
    <td>${item.id}</td>
    <td>${item.title}</td>
    <td>${item.category}</td>
    <td>${item.date}</td>
    <td><span class="badge ${item.status === 'Published' ? 'bg-success' : 'bg-warning'}">${item.status}</span></td>
    <td>
      <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
      <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
      <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
    </td>
  `;
  
  table.appendChild(row);
  
  // Add event listeners to the new buttons
  const buttons = row.querySelectorAll('.btn');
  buttons.forEach(button => {
    button.addEventListener('click', function() {
      if (this.classList.contains('btn-info')) {
        viewItem(item.id, item.title);
      } else if (this.classList.contains('btn-warning')) {
        editItem(item.id, item.title);
      } else if (this.classList.contains('btn-danger')) {
        deleteItem(item.id, item.title);
      }
    });
  });
  
  // Update the Recent Activity section
  addRecentActivity(`Admin added <strong>${item.title}</strong> to lifestyle recommendations`);
}

/**
 * Adds a new educational resource to the table
 */
function addNewEducationToTable(item) {
  const table = document.querySelector('#education table tbody');
  const row = document.createElement('tr');
  
  row.innerHTML = `
    <td>${item.id}</td>
    <td>${item.title}</td>
    <td>${item.type}</td>
    <td>${item.date}</td>
    <td><span class="badge ${item.status === 'Published' ? 'bg-success' : 'bg-warning'}">${item.status}</span></td>
    <td>
      <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
      <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
      <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
    </td>
  `;
  
  table.appendChild(row);
  
  // Add event listeners to the new buttons
  const buttons = row.querySelectorAll('.btn');
  buttons.forEach(button => {
    button.addEventListener('click', function() {
      if (this.classList.contains('btn-info')) {
        viewItem(item.id, item.title);
      } else if (this.classList.contains('btn-warning')) {
        editItem(item.id, item.title);
      } else if (this.classList.contains('btn-danger')) {
        deleteItem(item.id, item.title);
      }
    });
  });
  
  // Update the Recent Activity section
  addRecentActivity(`Admin added <strong>${item.title}</strong> to educational resources`);
}

/**
 * Adds an entry to the Recent Activity section
 */
function addRecentActivity(activityText) {
  const activityList = document.querySelector('.card:last-child .list-group');
  const newItem = document.createElement('li');
  newItem.className = 'list-group-item';
  
  newItem.innerHTML = `
    <div class="d-flex w-100 justify-content-between">
      <p class="mb-1">${activityText}</p>
      <small class="text-muted">Just now</small>
    </div>
  `;
  
  // Insert at the top of the list
  activityList.insertBefore(newItem, activityList.firstChild);
  
  // Remove the last item if there are more than 5
  if (activityList.children.length > 5) {
    activityList.removeChild(activityList.lastChild);
  }
}

/**
 * Shows the content for the selected tab
 */
function showTabContent(tabId) {
  // Hide all tab contents
  document.querySelectorAll('.tab-pane').forEach(tab => {
    tab.classList.remove('show', 'active');
  });
  
  // Show the selected tab content
  document.getElementById(tabId).classList.add('show', 'active');
  
  // Update the tab buttons
  document.querySelectorAll('#contentTabs .nav-link').forEach(tab => {
    tab.classList.remove('active');
    if (tab.getAttribute('data-bs-target') === `#${tabId}`) {
      tab.classList.add('active');
    }
  });
}

/**
 * Handles search functionality
 * @param {string} searchTerm - The term to search for
 * @param {string} tabId - The ID of the tab to search in
 */
function searchContent(searchTerm, tabId) {
  const table = document.querySelector(`#${tabId} table`);
  const rows = table.querySelectorAll('tbody tr');
  
  searchTerm = searchTerm.toLowerCase();
  
  rows.forEach(row => {
    const title = row.cells[1].textContent.toLowerCase();
    const category = row.cells[2].textContent.toLowerCase();
    
    if (title.includes(searchTerm) || category.includes(searchTerm)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}

// Additional function to initialize rich text editor (could be implemented with a library like TinyMCE or CKEditor)
function initializeRichTextEditor() {
  // This would normally initialize a rich text editor for the content textareas
  console.log('Rich text editor initialized');
  
  // Example with a hypothetical editor:
  // const editors = document.querySelectorAll('textarea[id$="Content"]');
  // editors.forEach(editor => {
  //   RichTextEditor.init(editor.id, {
  //     toolbar: ['bold', 'italic', 'link', 'image'],
  //     height: 300
  //   });
  // });
}


  </script>

</body>

</html>