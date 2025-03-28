<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Insights- leukemiaVision</title>
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

  <!-- Add Chart.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
    .sticky-sidebar {
      position: sticky;
      top: 90px; /* Adjust this value based on your header height */
      max-height: calc(100vh - 120px); /* Adjust based on header + some padding */
      overflow-y: auto;
    }
  </style>
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
        
        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Blood Test Analytics Dashboard</h5>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
              </nav>
            </div>
            <div class="card-body">
              <!-- Key Performance Indicators -->
              <div class="row mb-4">
                <div class="col-md-4">
                  <div class="card bg-success text-white">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="me-3">
                          <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                        </div>
                        <div>
                          <h6 class="card-title">Normal Tests</h6>
                          <h2 class="mb-0">1,248</h2>
                          <small>76.2% of total tests</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="card bg-danger text-white">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="me-3">
                          <i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem;"></i>
                        </div>
                        <div>
                          <h6 class="card-title">Diagnosed Tests</h6>
                          <h2 class="mb-0">389</h2>
                          <small>23.8% of total tests</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="card bg-warning text-white">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="me-3">
                          <i class="bi bi-droplet-half" style="font-size: 3rem;"></i>
                        </div>
                        <div>
                          <h6 class="card-title">Leukemia Cases</h6>
                          <h2 class="mb-0">156</h2>
                          <small>40.1% of diagnosed tests</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Diagnosis Distribution -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Test Results Distribution</h5>
                    </div>
                    <div class="card-body">
                      <canvas id="diagnosisDistributionChart"></canvas>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Leukemia Types Distribution</h5>
                    </div>
                    <div class="card-body">
                      <canvas id="leukemiaTypesChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Leukemia Trends -->
              <div class="card mb-4">
                <div class="card-header">
                  <h5 class="mb-0">Leukemia Tests Trend Over Time</h5>
                </div>
                <div class="card-body">
                  <div class="btn-group mb-3">
                    <button type="button" class="btn btn-outline-primary btn-sm active" data-period="monthly">Monthly</button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-period="quarterly">Quarterly</button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-period="yearly">Yearly</button>
                  </div>
                  <canvas id="leukemiaTrendChart" height="300"></canvas>
                </div>
              </div>
              
              <!-- Gender and Age Analysis -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Leukemia Cases by Gender</h5>
                    </div>
                    <div class="card-body">
                      <canvas id="genderDistributionChart"></canvas>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Leukemia Cases by Age Group</h5>
                    </div>
                    <div class="card-body">
                      <canvas id="ageDistributionChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Detailed Age Analysis -->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Age and Gender Correlation</h5>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="showPercentageToggle">
                    <label class="form-check-label" for="showPercentageToggle">Show as Percentage</label>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="ageGenderCorrelationChart" height="400"></canvas>
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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>
<!-- Charts Initialization Script -->
<script>
// Initialize charts when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // Sample data - in a real application, this would come from your backend
  const data = {
    testResults: {
      normal: 1248,
      diagnosed: 389
    },
    leukemiaTypes: {
      'Acute Lymphoblastic Leukemia (ALL)': 68,
      'Acute Myeloid Leukemia (AML)': 42,
      'Chronic Lymphocytic Leukemia (CLL)': 25,
      'Chronic Myeloid Leukemia (CML)': 21
    },
    monthlyTrends: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      normalTests: [98, 105, 110, 103, 95, 112, 108, 102, 97, 104, 110, 104],
      diagnosedTests: [32, 29, 35, 30, 28, 33, 36, 31, 34, 33, 35, 33],
      leukemiaCases: [12, 10, 15, 12, 11, 14, 16, 13, 14, 13, 14, 12]
    },
    genderDistribution: {
      male: 92,
      female: 64
    },
    ageDistribution: {
      '0-18': 23,
      '19-40': 35,
      '41-60': 58,
      '61+': 40
    },
    ageGenderCorrelation: {
      labels: ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71+'],
      male: [5, 8, 11, 15, 18, 16, 12, 7],
      female: [3, 6, 8, 11, 14, 12, 7, 3]
    }
  };

  // 1. Diagnosis Distribution Chart (Pie chart)
  const diagnosisDistributionCtx = document.getElementById('diagnosisDistributionChart').getContext('2d');
  new Chart(diagnosisDistributionCtx, {
    type: 'pie',
    data: {
      labels: ['Normal Tests', 'Diagnosed Tests'],
      datasets: [{
        data: [data.testResults.normal, data.testResults.diagnosed],
        backgroundColor: ['#28a745', '#dc3545'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              const label = context.label || '';
              const value = context.raw;
              const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
              const percentage = Math.round((value / total) * 100);
              return `${label}: ${value} (${percentage}%)`;
            }
          }
        }
      }
    }
  });

  // 2. Leukemia Types Distribution Chart (Doughnut chart)
  const leukemiaTypesCtx = document.getElementById('leukemiaTypesChart').getContext('2d');
  new Chart(leukemiaTypesCtx, {
    type: 'doughnut',
    data: {
      labels: Object.keys(data.leukemiaTypes),
      datasets: [{
        data: Object.values(data.leukemiaTypes),
        backgroundColor: ['#f44336', '#ff9800', '#2196f3', '#4caf50'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 12
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              const label = context.label || '';
              const value = context.raw;
              const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
              const percentage = Math.round((value / total) * 100);
              return `${label}: ${value} (${percentage}%)`;
            }
          }
        }
      }
    }
  });

  // 3. Leukemia Tests Trend Over Time (Line chart)
  const leukemiaTrendCtx = document.getElementById('leukemiaTrendChart').getContext('2d');
  const leukemiaTrendChart = new Chart(leukemiaTrendCtx, {
    type: 'line',
    data: {
      labels: data.monthlyTrends.labels,
      datasets: [
        {
          label: 'Normal Tests',
          data: data.monthlyTrends.normalTests,
          borderColor: '#28a745',
          backgroundColor: 'rgba(40, 167, 69, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.3
        },
        {
          label: 'Diagnosed Tests',
          data: data.monthlyTrends.diagnosedTests,
          borderColor: '#fd7e14',
          backgroundColor: 'rgba(253, 126, 20, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.3
        },
        {
          label: 'Leukemia Cases',
          data: data.monthlyTrends.leukemiaCases,
          borderColor: '#dc3545',
          backgroundColor: 'rgba(220, 53, 69, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.3
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true, // Changed to true to respect container dimensions
      aspectRatio: 2, // Added aspect ratio control (width/height)
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 20
          }
        }
      },
      plugins: {
        legend: {
          position: 'top',
          labels: {
            boxWidth: 10, // Smaller legend box
            padding: 6 // Reduced padding
          }
        },
        tooltip: {
          mode: 'index',
          intersect: false
        }
      }
    }
  });

  // Handle period change buttons for the trend chart
  document.querySelectorAll('[data-period]').forEach(button => {
    button.addEventListener('click', function() {
      // Remove active class from all buttons
      document.querySelectorAll('[data-period]').forEach(btn => {
        btn.classList.remove('active');
      });
      // Add active class to clicked button
      this.classList.add('active');
      
      // Update chart data based on selected period
      const period = this.getAttribute('data-period');
      
      if (period === 'monthly') {
        leukemiaTrendChart.data.labels = data.monthlyTrends.labels;
        leukemiaTrendChart.data.datasets[0].data = data.monthlyTrends.normalTests;
        leukemiaTrendChart.data.datasets[1].data = data.monthlyTrends.diagnosedTests;
        leukemiaTrendChart.data.datasets[2].data = data.monthlyTrends.leukemiaCases;
      } else if (period === 'quarterly') {
        // Group data by quarters
        leukemiaTrendChart.data.labels = ['Q1', 'Q2', 'Q3', 'Q4'];
        leukemiaTrendChart.data.datasets[0].data = [
          data.monthlyTrends.normalTests.slice(0, 3).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.normalTests.slice(3, 6).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.normalTests.slice(6, 9).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.normalTests.slice(9, 12).reduce((a, b) => a + b, 0) / 3
        ];
        leukemiaTrendChart.data.datasets[1].data = [
          data.monthlyTrends.diagnosedTests.slice(0, 3).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.diagnosedTests.slice(3, 6).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.diagnosedTests.slice(6, 9).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.diagnosedTests.slice(9, 12).reduce((a, b) => a + b, 0) / 3
        ];
        leukemiaTrendChart.data.datasets[2].data = [
          data.monthlyTrends.leukemiaCases.slice(0, 3).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.leukemiaCases.slice(3, 6).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.leukemiaCases.slice(6, 9).reduce((a, b) => a + b, 0) / 3,
          data.monthlyTrends.leukemiaCases.slice(9, 12).reduce((a, b) => a + b, 0) / 3
        ];
      } else if (period === 'yearly') {
        // Show yearly aggregation
        leukemiaTrendChart.data.labels = ['2025'];
        leukemiaTrendChart.data.datasets[0].data = [
          data.monthlyTrends.normalTests.reduce((a, b) => a + b, 0) / 12
        ];
        leukemiaTrendChart.data.datasets[1].data = [
          data.monthlyTrends.diagnosedTests.reduce((a, b) => a + b, 0) / 12
        ];
        leukemiaTrendChart.data.datasets[2].data = [
          data.monthlyTrends.leukemiaCases.reduce((a, b) => a + b, 0) / 12
        ];
      }
      
      leukemiaTrendChart.update();
    });
  });

  // 4. Gender Distribution Chart (Pie chart)
  const genderDistributionCtx = document.getElementById('genderDistributionChart').getContext('2d');
  new Chart(genderDistributionCtx, {
    type: 'pie',
    data: {
      labels: ['Male', 'Female'],
      datasets: [{
        data: [data.genderDistribution.male, data.genderDistribution.female],
        backgroundColor: ['#2196f3', '#e91e63'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              const label = context.label || '';
              const value = context.raw;
              const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
              const percentage = Math.round((value / total) * 100);
              return `${label}: ${value} (${percentage}%)`;
            }
          }
        }
      }
    }
  });

  // 5. Age Distribution Chart (Horizontal bar chart)
  const ageDistributionCtx = document.getElementById('ageDistributionChart').getContext('2d');
  new Chart(ageDistributionCtx, {
    type: 'bar',
    data: {
      labels: Object.keys(data.ageDistribution),
      datasets: [{
        label: 'Leukemia Cases',
        data: Object.values(data.ageDistribution),
        backgroundColor: '#9c27b0',
        borderWidth: 0,
        borderRadius: 4
      }]
    },
    options: {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          beginAtZero: true,
          grid: {
            display: false
          }
        },
        y: {
          grid: {
            display: false
          }
        }
      },
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              const value = context.raw;
              const total = Object.values(data.ageDistribution).reduce((acc, val) => acc + val, 0);
              const percentage = Math.round((value / total) * 100);
              return `Cases: ${value} (${percentage}%)`;
            }
          }
        }
      }
    }
  });

  // 6. Age and Gender Correlation Chart (Grouped bar chart)
  const ageGenderCorrelationCtx = document.getElementById('ageGenderCorrelationChart').getContext('2d');
  const ageGenderChart = new Chart(ageGenderCorrelationCtx, {
    type: 'bar',
    data: {
      labels: data.ageGenderCorrelation.labels,
      datasets: [
        {
          label: 'Male',
          data: data.ageGenderCorrelation.male,
          backgroundColor: 'rgba(33, 150, 243, 0.7)',
          borderWidth: 0,
          borderRadius: 4
        },
        {
          label: 'Female',
          data: data.ageGenderCorrelation.female,
          backgroundColor: 'rgba(233, 30, 99, 0.7)',
          borderWidth: 0,
          borderRadius: 4
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          beginAtZero: true,
          grid: {
            borderDash: [2, 4]
          }
        }
      },
      plugins: {
        legend: {
          position: 'top'
        }
      }
    }
  });

  // Handle percentage toggle for age-gender chart
  document.getElementById('showPercentageToggle').addEventListener('change', function() {
    const showPercentage = this.checked;
    
    if (showPercentage) {
      // Calculate percentage values
      const maleTotal = data.ageGenderCorrelation.male.reduce((a, b) => a + b, 0);
      const femaleTotal = data.ageGenderCorrelation.female.reduce((a, b) => a + b, 0);
      
      const malePercentages = data.ageGenderCorrelation.male.map(value => 
        (value / maleTotal) * 100
      );
      
      const femalePercentages = data.ageGenderCorrelation.female.map(value => 
        (value / femaleTotal) * 100
      );
      
      ageGenderChart.data.datasets[0].data = malePercentages;
      ageGenderChart.data.datasets[1].data = femalePercentages;
      
      // Update y-axis to show percentage
      ageGenderChart.options.scales.y.ticks = {
        callback: function(value) {
          return value + '%';
        }
      };
    } else {
      // Restore original values
      ageGenderChart.data.datasets[0].data = data.ageGenderCorrelation.male;
      ageGenderChart.data.datasets[1].data = data.ageGenderCorrelation.female;
      
      // Update y-axis to show absolute numbers
      ageGenderChart.options.scales.y.ticks = {
        callback: function(value) {
          return value;
        }
      };
    }
    
    ageGenderChart.update();
  });

  // Handle date range application
  document.getElementById('applyDateRange').addEventListener('click', function() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    
    alert(`Date range applied: ${startDate} to ${endDate}\nIn a real application, this would filter the data shown in the charts.`);
    
    // In a real implementation, you would fetch new data based on the date range
    // and update all charts accordingly
  });
});</script>
</body>

</html>