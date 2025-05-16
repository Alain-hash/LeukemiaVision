<?php 
session_start();

if(!isset($_SESSION['user_id']) && $_SESSION['Role']!='Admin'){
    header("location:../../login.php");
    exit();
}

// Include the data file that will prepare our chart data
include('../admin_backend/admin-insights/admin-insights-data.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Insights- leukemiaVision</title>
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

  <!-- Add Chart.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <style>
    .sticky-sidebar {
      position: sticky;
      top: 90px; /* Adjust this value based on your header height */
      max-height: calc(100vh - 120px); /* Adjust based on header + some padding */
      overflow-y: auto;
    }
    .chart-container {
      position: relative;
      min-height: 250px;
    }
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card-header {
      background-color: #f8f9fa;
      font-weight: 600;
    }
    .date-filter {
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 5px;
      background-color: #f8f9fa;
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
          <div class="card mb-4 sticky-sidebar">
            <div class="card-header">
              Admin Menu
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item active"><a href="admin-insights.php" class="text-decoration-none text-white"><i class="bi bi-graph-up me-2"></i> Insights</a></li>
              <li class="list-group-item"><a href="admin-user-management.php" class="text-decoration-none"><i class="bi bi-person-badge me-2"></i> Users </a></li>
              <li class="list-group-item "><a href="admin-services.php" class="text-decoration-none "><i class="bi bi-people me-2"></i>Services </a></li>
              <li class="list-group-item "><a href="admin-appointments.php" class="text-decoration-none" ><i class="bi bi-calendar-check me-2"></i>Appointments</a></li>
              <li class="list-group-item "><a href="admin-system-security.php" class="text-decoration-none  "><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
              <li class="list-group-item "><a href="admin-schedule_setup.php" class="text-decoration-none"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
              <li class="list-group-item"><a href="../../logout.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
          </div>
      
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Blood Test Analytics Dashboard</h5>
              
              <!-- Date filter -->
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dateFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-calendar3"></i> Date Filter
                </button>
                <div class="dropdown-menu p-3" style="width: 300px;">
                  <form id="dateFilterForm">
                    <div class="mb-3">
                      <label for="startDate" class="form-label">Start Date</label>
                      <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="mb-3">
                      <label for="endDate" class="form-label">End Date</label>
                      <input type="date" class="form-control" id="endDate">
                    </div>
                    <div class="d-grid">
                      <button type="button" class="btn btn-primary" id="applyDateRange">Apply</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
           
              <!-- Diagnosis Distribution -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Test Results Distribution</h5>
                    </div>
                    <div class="card-body">
                      <div class="chart-container">
                        <canvas id="diagnosisDistributionChart"></canvas>
                      </div>
                      <div class="mt-3 text-center">
                        <span class="badge bg-success p-2 me-2">Normal Tests: <?php echo $data['testResults']['normal']; ?></span>
                        <span class="badge bg-danger p-2">Diagnosed Tests: <?php echo $data['testResults']['diagnosed']; ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Leukemia Types Distribution</h5>
                    </div>
                    <div class="card-body">
                      <div class="chart-container">
                        <canvas id="leukemiaTypesChart"></canvas>
                      </div>
                      <div class="mt-3 small text-center">
                        <p class="mb-0">Total diagnosed cases: <?php echo array_sum($data['leukemiaTypes']); ?></p>
                      </div>
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
                      <div class="chart-container">
                        <canvas id="genderDistributionChart"></canvas>
                      </div>
                      <div class="mt-3 text-center">
                        <span class="badge bg-primary p-2 me-2">Male: <?php echo $data['genderDistribution']['male']; ?></span>
                        <span class="badge bg-danger p-2">Female: <?php echo $data['genderDistribution']['female']; ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Leukemia Cases by Age Group</h5>
                    </div>
                    <div class="card-body">
                      <div class="chart-container">
                        <canvas id="ageDistributionChart"></canvas>
                      </div>
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
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
  // Get data from PHP
  const data = <?php echo json_encode($data); ?>;
  
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
            boxWidth: 12,
            font: {
              size: 10
            }
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
      maintainAspectRatio: true,
      aspectRatio: 2,
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
            boxWidth: 10,
            padding: 6
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
    // Update active state of buttons
    document.querySelectorAll('[data-period]').forEach(btn => btn.classList.remove('active'));
    this.classList.add('active');
    
    // Get the selected period
    const period = this.getAttribute('data-period');
    
    // Update chart data based on selected period
    if (period === 'monthly') {
      leukemiaTrendChart.data.labels = data.monthlyTrends.labels;
      leukemiaTrendChart.data.datasets[0].data = data.monthlyTrends.normalTests;
      leukemiaTrendChart.data.datasets[1].data = data.monthlyTrends.diagnosedTests;
      leukemiaTrendChart.data.datasets[2].data = data.monthlyTrends.leukemiaCases;
    } else if (period === 'quarterly') {
      // Create quarterly data by aggregating monthly data
      const quarters = ['Q1', 'Q2', 'Q3', 'Q4'];
      const normalQuarterly = [
        data.monthlyTrends.normalTests.slice(0, 3).reduce((a, b) => a + b, 0),
        data.monthlyTrends.normalTests.slice(3, 6).reduce((a, b) => a + b, 0),
        data.monthlyTrends.normalTests.slice(6, 9).reduce((a, b) => a + b, 0),
        data.monthlyTrends.normalTests.slice(9, 12).reduce((a, b) => a + b, 0)
      ];
      const diagnosedQuarterly = [
        data.monthlyTrends.diagnosedTests.slice(0, 3).reduce((a, b) => a + b, 0),
        data.monthlyTrends.diagnosedTests.slice(3, 6).reduce((a, b) => a + b, 0),
        data.monthlyTrends.diagnosedTests.slice(6, 9).reduce((a, b) => a + b, 0),
        data.monthlyTrends.diagnosedTests.slice(9, 12).reduce((a, b) => a + b, 0)
      ];
      const leukemiaQuarterly = [
        data.monthlyTrends.leukemiaCases.slice(0, 3).reduce((a, b) => a + b, 0),
        data.monthlyTrends.leukemiaCases.slice(3, 6).reduce((a, b) => a + b, 0),
        data.monthlyTrends.leukemiaCases.slice(6, 9).reduce((a, b) => a + b, 0),
        data.monthlyTrends.leukemiaCases.slice(9, 12).reduce((a, b) => a + b, 0)
      ];
      
      leukemiaTrendChart.data.labels = quarters;
      leukemiaTrendChart.data.datasets[0].data = normalQuarterly;
      leukemiaTrendChart.data.datasets[1].data = diagnosedQuarterly;
      leukemiaTrendChart.data.datasets[2].data = leukemiaQuarterly;
    } else if (period === 'yearly') {
      // Create yearly data by summing all monthly data
      const years = [new Date().getFullYear().toString()];
      const normalYearly = [data.monthlyTrends.normalTests.reduce((a, b) => a + b, 0)];
      const diagnosedYearly = [data.monthlyTrends.diagnosedTests.reduce((a, b) => a + b, 0)];
      const leukemiaYearly = [data.monthlyTrends.leukemiaCases.reduce((a, b) => a + b, 0)];
      
      leukemiaTrendChart.data.labels = years;
      leukemiaTrendChart.data.datasets[0].data = normalYearly;
      leukemiaTrendChart.data.datasets[1].data = diagnosedYearly;
      leukemiaTrendChart.data.datasets[2].data = leukemiaYearly;
    }
    
    // Update the chart
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
      backgroundColor: ['#007bff', '#dc3545'],
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

// 5. Age Distribution Chart (Bar chart)
const ageDistributionCtx = document.getElementById('ageDistributionChart').getContext('2d');
new Chart(ageDistributionCtx, {
  type: 'bar',
  data: {
    labels: Object.keys(data.ageDistribution),
    datasets: [{
      label: 'Cases',
      data: Object.values(data.ageDistribution),
      backgroundColor: '#6610f2',
      borderWidth: 1
    }]
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
        ticks: {
          precision: 0
        }
      }
    },
    plugins: {
      legend: {
        display: false
      }
    }
  }
});

// 6. Age and Gender Correlation Chart (Grouped Bar chart)
const ageGenderCorrelationCtx = document.getElementById('ageGenderCorrelationChart').getContext('2d');
const ageGenderCorrelationChart = new Chart(ageGenderCorrelationCtx, {
  type: 'bar',
  data: {
    labels: data.ageGenderCorrelation.labels,
    datasets: [
      {
        label: 'Male',
        data: data.ageGenderCorrelation.male,
        backgroundColor: '#007bff',
        borderWidth: 1
      },
      {
        label: 'Female',
        data: data.ageGenderCorrelation.female,
        backgroundColor: '#dc3545',
        borderWidth: 1
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
        ticks: {
          precision: 0
        }
      }
    }
  }
});

// Handle percentage toggle for Age/Gender correlation
document.getElementById('showPercentageToggle').addEventListener('change', function() {
  const showPercentage = this.checked;
  
  if (showPercentage) {
    // Calculate percentages for each age group
    const maleData = [...data.ageGenderCorrelation.male];
    const femaleData = [...data.ageGenderCorrelation.female];
    
    data.ageGenderCorrelation.labels.forEach((_, index) => {
      const total = maleData[index] + femaleData[index];
      if (total > 0) {
        maleData[index] = Math.round((maleData[index] / total) * 100);
        femaleData[index] = Math.round((femaleData[index] / total) * 100);
      }
    });
    
    ageGenderCorrelationChart.data.datasets[0].data = maleData;
    ageGenderCorrelationChart.data.datasets[1].data = femaleData;
    ageGenderCorrelationChart.options.scales.y.ticks.callback = function(value) {
      return value + '%';
    };
  } else {
    // Restore original data
    ageGenderCorrelationChart.data.datasets[0].data = data.ageGenderCorrelation.male;
    ageGenderCorrelationChart.data.datasets[1].data = data.ageGenderCorrelation.female;
    ageGenderCorrelationChart.options.scales.y.ticks.callback = undefined;
  }
  
  ageGenderCorrelationChart.update();
});

// Date range filter functionality
document.getElementById('applyDateRange').addEventListener('click', function() {
  const startDate = document.getElementById('startDate').value;
  const endDate = document.getElementById('endDate').value;
  
  if (startDate && endDate) {
    // Here you would typically make an AJAX request to fetch filtered data
    // For this example, we'll simulate a request and update charts
    fetch(`admin-insights-data.php?startDate=${startDate}&endDate=${endDate}`)
      .then(response => response.json())
      .then(filteredData => {
        // Update all charts with the new filtered data
        // This would replace the current data with filtered data from server
        
        // Example of updating the test results chart:
        // Update test result distribution
        updateCharts(filteredData);
      })
      .catch(error => {
        console.error('Error fetching filtered data:', error);
        alert('Failed to apply date filter. Please try again.');
      });
  } else {
    alert('Please select both start and end dates.');
  }
});

// Function to update all charts with new data
function updateCharts(newData) {
  // Update charts with new data
  // This is a placeholder for actual implementation
  console.log('Updating charts with filtered data:', newData);
  
  // Reload the page or update charts individually
  // location.reload(); // Simple solution but not user-friendly
  
  // Better approach: update each chart individually
  // Example code for updating test results chart:
  /*
  diagnosisDistributionChart.data.datasets[0].data = [
    newData.testResults.normal, 
    newData.testResults.diagnosed
  ];
  diagnosisDistributionChart.update();
  
  // Update other charts similarly
  */
}

// Responsive behavior for charts
window.addEventListener('resize', function() {
  // Adjust chart dimensions if needed
  Chart.instances.forEach(chart => {
    chart.resize();
  });
});
});
</script>