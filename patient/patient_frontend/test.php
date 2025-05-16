<?php
session_start();
include("../database/db.php");
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Patient') {
  header("location:../../login.php");
  exit();
  
}elseif( $_SESSION['user_Status'] != 'Active'){
  header("location:../../unauthorised.php");
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>My Progress - LeukemiaVision</title>
  <meta name="description" content="Track and view your medication history">
  <meta name="keywords" content="leukemia, medications, patient portal">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4154f1;
      --primary-light: #f0f4ff;
      --secondary-color: #6c757d;
      --success-color: #20c997;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --body-bg: #f9fafb;
      --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      --border-radius: 12px;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--body-bg);
      color: #444;
    }

    .dashboard-container {
      padding: 30px 20px;
      max-width: 1400px;
      margin: 0 auto;
    }


    /* Cards styling */
    .card {
      border: none;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      margin-bottom: 25px;
      overflow: hidden;
    }

    .card-header {
      border-bottom: none;
      padding: 18px 25px;
    }

    .card-body {
      padding: 25px;
    }

    /* Patient info section */
    .patient-profile {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .patient-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: var(--primary-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      color: var(--primary-color);
      margin-right: 20px;
    }

    .patient-details h2 {
      margin: 0;
      font-weight: 600;
    }

    .patient-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 15px;
    }

    .patient-info-item {
      background-color: #fff;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .patient-info-label {
      font-size: 12px;
      color: var(--secondary-color);
      margin-bottom: 5px;
    }

    .patient-info-value {
      font-weight: 600;
      font-size: 16px;
    }

    .medical-alerts {
      background: linear-gradient(to right, #fff8e6, #fff);
      border-left: 4px solid var(--warning-color);
    }

    /* Medications section */
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .section-title {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      margin: 0;
    }

    .section-icon {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
    }

    .section-icon.active {
      background-color: rgba(32, 201, 151, 0.15);
      color: var(--success-color);
    }

    .section-icon.history {
      background-color: rgba(108, 117, 125, 0.15);
      color: var(--secondary-color);
    }

    .medication-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }

    .medication-card {
      border-radius: var(--border-radius);
      border: 1px solid #eee;
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .medication-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .medication-card-header {
      padding: 15px;
      border-bottom: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .med-name {
      font-weight: 600;
      margin: 0;
      color: var(--primary-color);
    }

    .medication-details {
      padding: 15px;
    }

    .detail-row {
      display: flex;
      margin-bottom: 10px;
    }

    .detail-label {
      width: 40%;
      color: var(--secondary-color);
      font-size: 14px;
    }

    .detail-value {
      width: 60%;
      font-weight: 500;
    }

    .medication-footer {
      padding: 15px;
      background-color: #f8f9fa;
      text-align: center;
    }

    /* History table */
    .history-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }

    .history-table th {
      background-color: #f8f9fa;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
      color: var(--secondary-color);
      padding: 12px 15px;
    }

    .history-table td {
      padding: 12px 15px;
      border-top: 1px solid #eee;
      vertical-align: middle;
    }

    .history-table tr:hover {
      background-color: #f8f9fa;
    }

    /* Empty states */
    .empty-state {
      text-align: center;
      padding: 40px 20px;
    }

    .empty-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      color: var(--secondary-color);
      margin: 0 auto 20px;
    }

    /* Footer */
    footer {
      background-color: #fff;
      padding-top: 60px;
      margin-top: 60px;
      box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.03);
    }

    /* Responsive */
    @media (max-width: 992px) {
      .patient-info-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .medication-cards {
        grid-template-columns: 1fr;
      }

      .page-header {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body class="page-medications">

  <header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@leukemiavision.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 (800) 555-1234</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="index.html#about">About</a></li>
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#doctors">Doctors</a></li>
            <li class="dropdown"><a href="#" class="active"><span>Patient Portal</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                        <li><a href="medications.php"> Medications</a></li>
                        <li><a href="patient_progress.php">  Results & Progress</a></li>
                        <li><a href="patient/patient_frontend/appointments.php">Your Appointments </a></li>
                       
                    </ul>
            </li>
            <li><a href="index.html#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="cta-btn d-none d-sm-block" href="book-appointment.php">Book Appointment</a>
      </div>
    </div>
  </header>

  <?php



    $sqlTreatment = "SELECT 
                   treatment.Treatment_Progression,
                   treatment.Treatment_Cycles,
                   treatment.Next_Cycle_Date,
                   treatment.Treatment_Result_Date
                   FROM treatment 
                   JOIN appointment ON treatment.Appointment_ID=appointment.appointment_ID
                   JOIN patient ON appointment.Patient_ID=patient.Patient_ID
                   JOIN user ON patient.User_ID=user.User_ID
                   WHERE user.User_ID = ?";
    
   
    $stmtTreatment = $connection->prepare($sqlTreatment);
    $stmtTreatment->bind_param("i", $user_id);
    $stmtTreatment->execute();
    $resultTreatment = $stmtTreatment->get_result();
    $patientInfo = $resultTreatment->fetch_assoc();

    // Get leukemia info
    $sqlLeuk = "SELECT 
       Current_Stage,
       WBC_Count,
       Blast_Cells_Percentage,
       Hemoglobin,
       Platelets,
       Test_Result,
       Test_Result_Date
       FROM leukemia_test   
       JOIN appointment ON leukemia_test.Appointment_ID=appointment.appointment_ID
       JOIN patient ON appointment.Patient_ID=patient.Patient_ID
       JOIN user ON patient.User_ID=user.User_ID
       WHERE user.User_ID = ?";

    $stmtLeuk = $connection->prepare($sqlLeuk);
    $stmtLeuk->bind_param("i", $user_id);
    $stmtLeuk->execute();
    $resultLeuk = $stmtLeuk->get_result();
    $leukInfo = $resultLeuk->fetch_assoc();

    // Get recent test results
    $sqlTests = "SELECT 
        leukemia_test.Test_Result_Date,
        leukemia_test.Test_Result,
        services.Name
        FROM leukemia_test
        JOIN appointment ON appointment.Appointment_ID=leukemia_test.Appointment_ID
        JOIN services ON services.Service_ID=appointment.Service_ID
        JOIN patient ON appointment.Patient_ID=patient.Patient_ID
        JOIN user ON patient.User_ID=user.User_ID
        WHERE user.User_ID = ?";
    
    $stmtTests = $connection->prepare($sqlTests);
    $stmtTests->bind_param("i", $user_id);
    $stmtTests->execute();
    $resultTests = $stmtTests->get_result();
    
    // Get diagnosis info
    $sqlDiagnosis = "SELECT 
    diagnosis_date, 
    leukemia_type, 
    current_stage, 
    current_status, 
    previous_stage, 
    current_blast_count, 
    blast_count_change, 
    current_wbc_count, 
    wbc_status, 
    current_cycle, 
    total_cycles, 
    next_cycle_date 
FROM patient_diagnosis
JOIN patient ON patient.Patient_ID = patient_diagnosis.patient_id
JOIN user ON user.User_ID = patient.User_ID  
WHERE user.User_ID = ?;";
    
    $stmtDiagnosis = $connection->prepare($sqlDiagnosis);
    $stmtDiagnosis->bind_param("i", $user_id);
    $stmtDiagnosis->execute();
    $resultDiagnosis = $stmtDiagnosis->get_result();
    $diagnosisInfo = $resultDiagnosis->fetch_assoc();
    
    // Get treatments timeline
    $sqlTreatments = "SELECT 
        treatment.Treatment_Name,
         treatment.Treatment_Start_Date, 
         treatment.Treatment_End_Date,
        treatment.Treatment_Outcome,
        medications.Med_Name
        FROM treatment 
        JOIN medications ON medications.Medication_ID=treatment.Medication_ID
        JOIN appointment ON appointment.Appointment_ID=treatment.Appointment_ID
        JOIN patient ON appointment.Patient_ID=patient.Patient_ID
        JOIN user ON patient.User_ID=user.User_ID
        WHERE user.User_ID = ?
        ORDER BY Treatment_Start_Date DESC";
    
    $stmtTreatments = $connection->prepare($sqlTreatments);
    $stmtTreatments->bind_param("i", $user_id);
    $stmtTreatments->execute();
    $resultTreatments = $stmtTreatments->get_result();
    
    // Chart data preparation
    $sqlChartData = "SELECT 
        Test_Result_Date, 
        WBC_Count, 
        Hemoglobin, 
        Platelets, 
        Blast_Cells_Percentage 
        FROM  leukemia_test 
        JOIN appointment ON appointment.Appointment_ID=leukemia_test.Appointment_ID
        JOIN patient ON patient.Patient_ID=appointment.Patient_ID
        JOIN user ON user.User_ID=patient.User_ID
        WHERE user.User_ID = ?
        ORDER BY Test_Result_Date ASC 
        LIMIT 10";
    
    $stmtChartData = $connection->prepare($sqlChartData);
    $stmtChartData->bind_param("i", $user_id);
    $stmtChartData->execute();
    $resultChartData = $stmtChartData->get_result();
    
    // Initialize arrays for chart data
    $bloodCountLabels = [];
    $wbcData = [];
    $hgbData = [];
    $pltData = [];
    $blastCellLabels = [];
    $blastCellData = [];
    
    // Process chart data
    while ($row = $resultChartData->fetch_assoc()) {
        $testDate = date('M d', strtotime($row['Test_Result_Date']));
        
        // For blood count chart
        $bloodCountLabels[] = $testDate;
        $wbcData[] = $row['WBC_Count'];
        $hgbData[] = $row['Hemoglobin'];
        $pltData[] = $row['Platelets'];
        
        // For blast cell chart
        $blastCellLabels[] = $testDate;
        $blastCellData[] = $row['Blast_Cells_Percentage'];
    }
?>


<!-- Patient Treatment Progress and Analysis -->
<div class="treatment-progress-container">
    <!-- Main Diagnosis Info -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5>Treatment Progress</h5>
        </div>
        <div class="card-body">
            <?php if ($diagnosisInfo): ?>


                
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Diagnosis Date:</strong> <?= date('M d, Y', strtotime($diagnosisInfo['diagnosis_date'])) ?></p>
                    <p><strong>Leukemia Type:</strong> <?= $diagnosisInfo['leukemia_type'] ?></p>
                    <p><strong>Current Stage:</strong> <?= $diagnosisInfo['current_stage'] ?> 
                       <?php if($diagnosisInfo['previous_stage']): ?>
                       <span class="badge <?= ($diagnosisInfo['current_stage'] < $diagnosisInfo['previous_stage']) ? 'bg-success' : 'bg-danger' ?>">
                           <?= ($diagnosisInfo['current_stage'] < $diagnosisInfo['previous_stage']) ? 'Improved' : 'Progressed' ?>
                       </span>
                       <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> <?= $diagnosisInfo['current_status'] ?></p>
                    <p><strong>Treatment Cycle:</strong> <?= $diagnosisInfo['current_cycle'] ?> of <?= $diagnosisInfo['total_cycles'] ?></p>
                    <p><strong>Next Cycle:</strong> <?= date('M d, Y', strtotime($diagnosisInfo['next_cycle_date'])) ?></p>
                </div>
            </div>
            <?php endif; ?>



            <!-- Blood Count Analysis -->
            <div class="mt-3">
                <h6>Blood Analysis</h6>
                <div class="row">
                    <?php if ($leukInfo): ?>
                    <div class="col-md-6">
                        <p><strong>WBC:</strong> <?= $leukInfo['WBC_Count'] ?> 
                           <span class="badge <?= ($diagnosisInfo['wbc_status'] == 'Improving') ? 'bg-success' : 'bg-warning' ?>">
                               <?= $diagnosisInfo['wbc_status'] ?>
                           </span>
                        </p>
                        <p><strong>Hemoglobin:</strong> <?= $leukInfo['Hemoglobin'] ?> g/dL</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Platelets:</strong> <?= $leukInfo['Platelets'] ?></p>
                        <p><strong>Blast Cells:</strong> <?= $leukInfo['Blast_Cells_Percentage'] ?>% 
                           <span class="badge <?= ($diagnosisInfo['blast_count_change'] < 0) ? 'bg-success' : 'bg-danger' ?>">
                               <?= ($diagnosisInfo['blast_count_change'] < 0) ? 'Decreasing' : 'Increasing' ?> (<?= abs($diagnosisInfo['blast_count_change']) ?>%)
                           </span>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Current Treatment -->
            <?php if ($patientInfo): ?>
            <div class="mt-3">
                <h6>Treatment Status</h6>
                <p><strong>Progression:</strong> <?= $patientInfo['Treatment_Progression'] ?></p>
                <p><strong>Cycles Completed:</strong> <?= $patientInfo['Treatment_Cycles'] ?></p>
                <p><strong>Next Results Expected:</strong> <?= date('M d, Y', strtotime($patientInfo['Treatment_Result_Date'])) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
<!-- Simple Charts for Blood Values -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Blood Count Trends</div>
            <div class="card-body">
                <canvas id="bloodCountChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Blast Cells Percentage</div>
            <div class="card-body">
                <canvas id="blastCellChart"></canvas>
            </div>
        </div>
    </div>
</div>
    <!-- Treatment Timeline -->
    <div class="card mb-3">
        <div class="card-header bg-info text-white">
            <h5>Recent Treatments</h5>
        </div>
        <div class="card-body">
            <div class="timeline">
                <?php 
                $count = 0;
                while ($treatment = $resultTreatments->fetch_assoc()): 
                    if ($count++ >= 3) break; // Show only 3 most recent treatments
                ?>
                <div class="timeline-item">
                    <div class="timeline-marker <?= ($treatment['Treatment_Outcome'] == 'Successful') ? 'bg-success' : 'bg-warning' ?>"></div>
                    <div class="timeline-content">
                        <h6><?= $treatment['Treatment_Name'] ?> (<?= $treatment['Med_Name'] ?>)</h6>
                        <p><?= date('M d, Y', strtotime($treatment['Treatment_Start_Date'])) ?> - 
                           <?= $treatment['Treatment_End_Date'] ? date('M d, Y', strtotime($treatment['Treatment_End_Date'])) : 'Ongoing' ?></p>
                        <span class="badge <?= ($treatment['Treatment_Outcome'] == 'Successful') ? 'bg-success' : 'bg-warning' ?>">
                            <?= $treatment['Treatment_Outcome'] ?>
                        </span>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Test Results -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5>Recent Test Results</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Test</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 0;
                    while ($test = $resultTests->fetch_assoc()): 
                        if ($count++ >= 5) break; // Show only 5 most recent tests
                    ?>
                    <tr>
                        <td><?= date('M d, Y', strtotime($test['Test_Result_Date'])) ?></td>
                        <td><?= $test['Name'] ?></td>
                        <td>
                            <span class="badge <?= ($test['Test_Result'] == 'Positive' || $test['Test_Result'] == 'Abnormal') ? 'bg-danger' : 'bg-success' ?>">
                                <?= $test['Test_Result'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Blood Count Chart
const bloodCtx = document.getElementById('bloodCountChart').getContext('2d');
const bloodChart = new Chart(bloodCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($bloodCountLabels) ?>,
        datasets: [{
            label: 'WBC',
            data: <?= json_encode($wbcData) ?>,
            borderColor: 'rgba(255, 99, 132, 1)',
            fill: false,
            tension: 0.1
        }, {
            label: 'Hemoglobin',
            data: <?= json_encode($hgbData) ?>,
            borderColor: 'rgba(54, 162, 235, 1)',
            fill: false,
            tension: 0.1
        }, {
            label: 'Platelets',
            data: <?= json_encode($pltData) ?>,
            borderColor: 'rgba(75, 192, 192, 1)',
            fill: false,
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});

// Blast Cell Chart
const blastCtx = document.getElementById('blastCellChart').getContext('2d');
const blastChart = new Chart(blastCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($blastCellLabels) ?>,
        datasets: [{
            label: 'Blast Cells %',
            data: <?= json_encode($blastCellData) ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});
</script>

<?php


$connection->close();
?>

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
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>