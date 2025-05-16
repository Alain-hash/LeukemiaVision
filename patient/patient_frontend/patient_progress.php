<?php
session_start();
include("../../database/db.php");
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Patient') {
  header("location:../../login.php");
  exit();
} elseif ($_SESSION['user_Status'] != 'Active') {
  header("location:../../unauthorised.php");
}


$user_id = $_SESSION['user_id'];
function getInstitutionLocations($connection)
{
    $locations = [];


    $sql = "SELECT Institution_ID, Name, Address, Phone_Number, Email, Latitude, Longitude 
            FROM clinical_institution 
            WHERE Latitude IS NOT NULL AND Longitude IS NOT NULL";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $locations[] = [
                'id' => $row['Institution_ID'],
                'name' => $row['Name'],
                'address' => $row['Address'],
                'phone' => $row['Phone_Number'],
                'email' => $row['Email'],
                'lat' => $row['Latitude'],
                'lng' => $row['Longitude']
            ];
        }
    }

    return $locations;
}


$locationData = getInstitutionLocations($connection);


$locationsJson = json_encode($locationData);


$stmt = $connection->prepare("SELECT Name FROM user WHERE User_ID = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
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
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../../assets/css/main.css" rel="stylesheet">

  <style>
  :root {
  --primary-color: #003366;  /* Changed to dark blue */
  --primary-light: #e6f0ff;  /* Adjusted to a lighter blue that matches dark blue */
  --secondary-color: #6c757d;
  --success-color: #20c997;
  --warning-color: #ffc107;
  --danger-color: #dc3545;
  --body-bg: #f9fafb;
  --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
  --border-radius: 12px;
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

    .blood-trend-container {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      height: 120px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 25px;
    }

    .trend-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 40px;
    }

    .trend-bar-container {
      height: 100px;
      width: 20px;
      background-color: #f0f0f0;
      display: flex;
      align-items: flex-end;
    }

    .trend-bar {
      width: 100%;
      transition: height 0.5s;
      border-radius: 2px;
    }

    .trend-label {
      font-size: 0.7rem;
      margin-top: 5px;
    }

    .trend-value {
      font-size: 0.7rem;
      font-weight: bold;
    }

    .blast-cell-box {
      padding: 10px;
      border-radius: 5px;
      text-align: center;
      height: 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: all 0.3s;
    }

    .blast-cell-box:hover {
      transform: scale(1.05);
    }

    .blast-date {
      font-size: 0.8rem;
    }

    .blast-value {
      font-size: 1.5rem;
      font-weight: bold;
    }
  </style>
</head>

<body class="page-medications">

<header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <?php if (!empty($locationData)) : ?>
                        <i class="bi bi-envelope d-flex align-items-center">
                            <a href="mailto:<?= htmlspecialchars($locationData[0]['email']) ?>">
                                <?= htmlspecialchars($locationData[0]['email']) ?>
                            </a>
                        </i>
                        <i class="bi bi-phone d-flex align-items-center ms-4">
                            <span><?= htmlspecialchars($locationData[0]['phone']) ?></span>
                        </i>
                    <?php else : ?>
                        <i class="bi bi-envelope d-flex align-items-center">
                            <a href="#">Email not available</a>
                        </i>
                        <i class="bi bi-phone d-flex align-items-center ms-4">
                            <span>Phone not available</span>
                        </i>
                    <?php endif; ?>

                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="#" class="twitter" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div><!-- End Top Bar -->
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">

                <div class="header-profile-container">
                  
                    <div class="profile-info">
                        <?php if (isset($_SESSION['user_id'])) {
                            if ($row = $result->fetch_assoc()) { ?>
                                <span class="fw-bold fs-3" style="color: var(--heading-color);">
                                    <?= $row['Name']; ?>
                                </span>

                            <?php  } ?>



                        <?php } else { ?>
                            <a href="index.php" class="logo d-flex align-items-center me-auto">
                                <h1 class="sitename">LeukemiaVision</h1>
                            </a>
                        <?php } ?>
                    </div>

                </div>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="../../index.php#services">Services</a></li>
                        <li><a href="../../index.php#doctors">Doctors</a></li>
                        <li><a href="../../index.php#contact">Contact</a></li>
                        <li class="dropdown " >
                            <a href="#"  class="active"><span>Patient Portal</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="medications.php"> Medications</a></li>
                                <li><a href="patient_progress.php"> progress & Results</a></li>
                                <li><a href="appointment-history.php">Your Appointments </a></li>
                            </ul>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                <div class="d-flex align-items-center">
                    <a class="cta-btn btn-sm d-none d-sm-block me-1" href="patient/patient_frontend/services_option.php">Make an Appointment</a>

                    <?php
                    if (isset($_SESSION['user_id'])) { ?>
                        <a href="logout.php">
                            <button class="cta-btn btn-sm ms-1 border-0" type="button">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </a>
                    <?php } else { ?>
                        <a href="login.php">
                            <button class="cta-btn btn-sm ms-1 border-0" type="button">
                                <i class="bi bi-person-plus"></i> SignIn
                            </button>
                        </a>

                    <?php }
                    ?>



                </div>
            </div>
        </div>
    </header>

  <?php



  $sqlTreatment = "SELECT 
                   treatment.Treatment_Progression,
                   treatment.Treatment_Result_Date,
                   patient_diagnosis.total_cycles
                   FROM treatment 
                   JOIN appointment ON treatment.Appointment_ID=appointment.appointment_ID
                   JOIN patient ON appointment.Patient_ID=patient.Patient_ID
                   JOIN patient_diagnosis ON patient_diagnosis.Patient_ID=patient.Patient_ID
                   JOIN user ON patient.User_ID=user.User_ID
                   WHERE user.User_ID = ?";


  $stmtTreatment = $connection->prepare($sqlTreatment);
  $stmtTreatment->bind_param("i", $user_id);
  $stmtTreatment->execute();
  $resultTreatment = $stmtTreatment->get_result();
  $patientInfo = $resultTreatment->fetch_assoc();

  // Get leukemia info
  $sqlLeuk = "SELECT 
       
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
    current_status, 
    previous_stage, 
    current_stage,
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
        treatment.Treatment_Outcome
        FROM treatment 
        JOIN appointment ON appointment.Appointment_ID=treatment.Appointment_ID
        JOIN patient ON appointment.Patient_ID=patient.Patient_ID
        JOIN user ON patient.User_ID=user.User_ID
        WHERE user.User_ID = ?
        ORDER BY Treatment_Start_Date DESC";

  $stmtTreatments = $connection->prepare($sqlTreatments);
  $stmtTreatments->bind_param("i", $user_id);
  $stmtTreatments->execute();
  $resultTreatments = $stmtTreatments->get_result();




  ?>

  <div class="container py-4">
    <!-- Latest Progression and Variation Section Redesign -->
    <div class="col-12">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Latest Progression and Variation</h5>

        </div>

        <div class="card-body">
          <?php if ($diagnosisInfo): ?>
            <!-- Treatment Progress Bar -->
            <div class="progress-container mb-4">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Treatment Progress</h6>
                <span class="text-muted small">Cycle <?= $diagnosisInfo['current_cycle'] ?> of <?= $diagnosisInfo['total_cycles'] ?></span>
              </div>
              <div class="progress" style="height: 10px;">
                <div class="progress-bar bg-success" role="progressbar"
                  style="width: <?= ($diagnosisInfo['current_cycle'] / $diagnosisInfo['total_cycles']) * 100 ?>%;"
                  aria-valuenow="<?= $diagnosisInfo['current_cycle'] ?>"
                  aria-valuemin="0"
                  aria-valuemax="<?= $diagnosisInfo['total_cycles'] ?>"></div>
              </div>
              <div class="d-flex justify-content-between mt-1">
                <small class="text-muted">Start</small>
                <small class="text-muted">Next: <?= date('M d', strtotime($diagnosisInfo['next_cycle_date'])) ?></small>
                <small class="text-muted">End</small>
              </div>
            </div>

            <div class="row g-4">
              <!-- Diagnosis Information Card -->
              <div class="col-md-6">
                <div class="card h-100 border-0 bg-light">
                  <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-primary">Diagnosis Information</h6>

                    <div class="d-flex align-items-center mb-3">
                      <div class="flex-shrink-0">
                        <i class="bi bi-calendar-event text-secondary fs-4"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="small text-muted">Diagnosis Date</div>
                        <div class="fw-bold"><?= date('M d, Y', strtotime($diagnosisInfo['diagnosis_date'])) ?></div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                      <div class="flex-shrink-0">
                        <i class="bi bi-file-medical text-secondary fs-4"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="small text-muted">Leukemia Type</div>
                        <div class="fw-bold"><?= $diagnosisInfo['leukemia_type'] ?></div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0">
                        <i class="bi bi-activity text-secondary fs-4"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="small text-muted">Current Status</div>
                        <div class="fw-bold">
                          <span class="me-2"><?= $diagnosisInfo['current_status'] ?></span>
                          <?php if ($diagnosisInfo['current_status'] == 'In Treatment'): ?>
                            <span class="badge bg-info text-white">Active</span>
                          <?php elseif ($diagnosisInfo['current_status'] == 'Remission'): ?>
                            <span class="badge bg-success text-white">Remission</span>
                          <?php elseif ($diagnosisInfo['current_status'] == 'Post-Treatment'): ?>
                            <span class="badge bg-warning text-dark">Monitoring</span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Stage & Progression Card -->
              <div class="col-md-6">
                <div class="card h-100 border-0 bg-light">
                  <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-primary">Stage & Progression</h6>

                    <div class="d-flex align-items-center mb-3">
                      <div class="flex-shrink-0">
                        <i class="bi bi-graph-up text-secondary fs-4"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="small text-muted">Current Stage</div>
                        <div class="d-flex align-items-center">
                          <div class="fw-bold me-2">Stage <?= $diagnosisInfo['current_stage'] ?></div>
                          <?php if ($diagnosisInfo['previous_stage']): ?>
                            <?php if ($diagnosisInfo['current_stage'] < $diagnosisInfo['previous_stage']): ?>
                              <span class="badge bg-success d-flex align-items-center">
                                <i class="bi bi-arrow-down me-1"></i> Improved from Stage <?= $diagnosisInfo['previous_stage'] ?>
                              </span>
                            <?php else: ?>
                              <span class="badge bg-danger d-flex align-items-center">
                                <i class="bi bi-arrow-up me-1"></i> Progressed from Stage <?= $diagnosisInfo['previous_stage'] ?>
                              </span>
                            <?php endif; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                      <div class="flex-shrink-0">
                        <i class="bi bi-calendar-check text-secondary fs-4"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="small text-muted">Next Treatment Cycle</div>
                        <div class="fw-bold"><?= date('M d, Y', strtotime($diagnosisInfo['next_cycle_date'])) ?></div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center">
                      <div class="flex-shrink-0">
                        <i class="bi bi-stopwatch text-secondary fs-4"></i>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <div class="small text-muted">Time Since Diagnosis</div>
                        <div class="fw-bold">
                          <?php
                          $diagnosisDate = new DateTime($diagnosisInfo['diagnosis_date']);
                          $currentDate = new DateTime();
                          $interval = $diagnosisDate->diff($currentDate);

                          if ($interval->y > 0) {
                            echo $interval->y . ' ' . ($interval->y == 1 ? 'year' : 'years');
                            if ($interval->m > 0) {
                              echo ', ' . $interval->m . ' ' . ($interval->m == 1 ? 'month' : 'months');
                            }
                          } else if ($interval->m > 0) {
                            echo $interval->m . ' ' . ($interval->m == 1 ? 'month' : 'months');
                            if ($interval->d > 0) {
                              echo ', ' . $interval->d . ' ' . ($interval->d == 1 ? 'day' : 'days');
                            }
                          } else {
                            echo $interval->d . ' ' . ($interval->d == 1 ? 'day' : 'days');
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Blood Analysis Cards -->
            <h6 class="border-bottom pb-2 mb-3 mt-4">Blood Analysis</h6>
            <div class="row g-3">
              <!-- WBC Card -->
              <div class="col-md-3 col-sm-6">
                <div class="card border-0 h-100">
                  <div class="card-body text-center p-3">
                    <div class="d-inline-block p-3 rounded-circle mb-3 <?= ($diagnosisInfo['wbc_status'] == 'Improving') ? 'bg-success bg-opacity-10' : 'bg-warning bg-opacity-10' ?>">
                      <i class="bi bi-droplet-fill fs-3 <?= ($diagnosisInfo['wbc_status'] == 'Improving') ? 'text-success' : 'text-warning' ?>"></i>
                    </div>
                    <h6 class="card-title">WBC Count</h6>
                    <h3 class="mb-0"><?= $leukInfo['WBC_Count'] ?></h3>
                    <span class="badge <?= ($diagnosisInfo['wbc_status'] == 'Improving') ? 'bg-success' : 'bg-warning' ?> mt-2">
                      <?= $diagnosisInfo['wbc_status'] ?>
                      <i class="bi <?= ($diagnosisInfo['wbc_status'] == 'Improving') ? 'bi-arrow-down' : 'bi-arrow-up' ?> ms-1"></i>
                    </span>
                    <div class="text-muted small mt-2">Normal range: 4,500-11,000/μL</div>
                  </div>
                </div>
              </div>

              <!-- Blast Cells Card -->
              <div class="col-md-3 col-sm-6">
                <div class="card border-0 h-100">
                  <div class="card-body text-center p-3">
                    <div class="d-inline-block p-3 rounded-circle mb-3 ">
                      <i class="bi bi-virus fs-3 "></i>
                    </div>
                    <h6 class="card-title">Blast Cells</h6>
                    <h3 class="mb-0"><?= $leukInfo['Blast_Cells_Percentage'] ?>%</h3>
                    <span class="badge <?= ($diagnosisInfo['blast_count_change'] < 0) ? 'bg-success' : 'bg-danger' ?> mt-2">
                      <?= ($diagnosisInfo['blast_count_change'] < 0) ? 'Decreasing' : 'Increasing' ?>
                      <i class="bi <?= ($diagnosisInfo['blast_count_change'] < 0) ? 'bi-arrow-down' : 'bi-arrow-up' ?> ms-1"></i>
                      (<?= abs($diagnosisInfo['blast_count_change']) ?>%)
                    </span>
                    <div class="text-muted small mt-2">Target: 5% </div>
                    </div>
                  </div>
                </div>

                <!-- Hemoglobin Card -->
                <div class="col-md-3 col-sm-6">
                  <div class="card border-0 h-100">
                    <div class="card-body text-center p-3">
                      <?php
                      $hgbStatus = 'normal';
                      if ($leukInfo['Hemoglobin'] < 12) {
                        $hgbStatus = 'low';
                      } elseif ($leukInfo['Hemoglobin'] > 16) {
                        $hgbStatus = 'high';
                      }
                      ?>
                      <div class="d-inline-block p-3 rounded-circle mb-3 
                <?= ($hgbStatus == 'normal') ? 'bg-success bg-opacity-10' : (($hgbStatus == 'low') ? 'bg-warning bg-opacity-10' : 'bg-info bg-opacity-10') ?>">
                        <i class="bi bi-clipboard2-pulse fs-3 
                   <?= ($hgbStatus == 'normal') ? 'text-success' : (($hgbStatus == 'low') ? 'text-warning' : 'text-info') ?>"></i>
                      </div>
                      <h6 class="card-title">Hemoglobin</h6>
                      <h3 class="mb-0"><?= $leukInfo['Hemoglobin'] ?> g/dL</h3>
                      <span class="badge 
                <?= ($hgbStatus == 'normal') ? 'bg-success' : (($hgbStatus == 'low') ? 'bg-warning' : 'bg-info') ?> mt-2">
                        <?= ucfirst($hgbStatus) ?>
                      </span>
                      <div class="text-muted small mt-2">Normal range: 12-16 g/dL</div>
                    </div>
                  </div>
                </div>

                <!-- Platelets Card -->
                <div class="col-md-3 col-sm-6">
                  <div class="card border-0 h-100">
                    <div class="card-body text-center p-3">
                      <?php
                      $pltStatus = 'normal';
                      if ($leukInfo['Platelets'] < 150000) {
                        $pltStatus = 'low';
                      } elseif ($leukInfo['Platelets'] > 450000) {
                        $pltStatus = 'high';
                      }
                      ?>
                      <div class="d-inline-block p-3 rounded-circle mb-3 
                <?= ($pltStatus == 'normal') ? 'bg-success bg-opacity-10' : (($pltStatus == 'low') ? 'bg-warning bg-opacity-10' : 'bg-info bg-opacity-10') ?>">
                        <i class="bi bi-disc fs-3 
                   <?= ($pltStatus == 'normal') ? 'text-success' : (($pltStatus == 'low') ? 'text-warning' : 'text-info') ?>"></i>
                      </div>
                      <h6 class="card-title">Platelets</h6>
                      <h3 class="mb-0"><?= number_format($leukInfo['Platelets']) ?></h3>
                      <span class="badge 
                <?= ($pltStatus == 'normal') ? 'bg-success' : (($pltStatus == 'low') ? 'bg-warning' : 'bg-info') ?> mt-2">
                        <?= ucfirst($pltStatus) ?>
                      </span>
                      <div class="text-muted small mt-2">Normal range: 150-450K/μL</div>
                    </div>
                  </div>
                </div>
              </div>

            <?php else: ?>
              <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i> No diagnosis information available yet. Please consult with your doctor.
              </div>
            <?php endif; ?>
            </div>
        </div>
      </div>



      <?php
      // Reset the pointer to the beginning of the result set
      $stmtLeuk->execute();
      $resultLeuk = $stmtLeuk->get_result();
      if ($resultLeuk->num_rows > 0) {


        while ($test = $resultLeuk->fetch_assoc()):
      ?>
          <!-- Test Results Card -->
          <div class="col-12 mt-4">
            <div class="card shadow-sm border-0">
              <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Your Test Results</h5>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Date</th>
                        <th>WBC Count</th>
                        <th>Blast Cells</th>
                        <th>Hemoglobin</th>
                        <th>Platelets</th>
                        <th>Result</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                    <tr>
                      <td><?= date('M d, Y', strtotime($test['Test_Result_Date'])) ?></td>
                      <td><?= $test['WBC_Count'] ?></td>
                      <td><?= $test['Blast_Cells_Percentage'] ?>%</td>
                      <td><?= $test['Hemoglobin'] ?> g/dL</td>
                      <td><?= $test['Platelets'] ?></td>
                      <td>
                        <span class="badge <?= ($test['Test_Result'] == 'Positive' || $test['Test_Result'] == 'Abnormal') ? 'bg-danger' : 'bg-success' ?> rounded-pill">
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
          </div>
        <?php  } ?>
        <div class="row"></div>


       
                    <?php

                    $stmtTreatments->execute();
                    $resultTreatments = $stmtTreatments->get_result();
                    if ($resultLeuk->num_rows > 0) {
                    while ($treatment = $resultTreatments->fetch_assoc()):
                    ?>
                     <!-- Treatment Results Card -->
        <div class="col-12 mt-4">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
              <h5 class="card-title mb-0">Treatment Progress</h5>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>Treatment</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Outcome</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td><?= $treatment['Treatment_Name'] ?></td>

                        <td><?= date('M d, Y', strtotime($treatment['Treatment_Start_Date'])) ?></td>
                        <td><?= $treatment['Treatment_End_Date'] ? date('M d, Y', strtotime($treatment['Treatment_End_Date'])) : 'Ongoing' ?></td>
                        <td>
                          <span class="badge rounded-pill <?= ($treatment['Treatment_Outcome'] == 'Successful' || $treatment['Treatment_Outcome'] == 'Improving') ? 'bg-success' : (($treatment['Treatment_Outcome'] == 'Failed' || $treatment['Treatment_Outcome'] == 'Worsening') ? 'bg-danger' : 'bg-warning') ?>">
                            <?= $treatment['Treatment_Outcome'] ?>
                          </span>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <footer id="footer" class="footer light-background">
        <div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
            <button id="chat-toggle" style="background-color: #003366; color: white; border: none; border-radius: 50%; width: 60px; height: 60px; font-size: 24px; cursor: pointer;">💬</button>
            <div id="chat-container" style="display: none; width: 350px; height: 450px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); position: absolute; bottom: 70px; right: 0;">
                <iframe src="chatbot.php" style="width: 100%; height: 100%; border: none; border-radius: 10px;"></iframe>
            </div>
        </div>

        <script>
            document.getElementById('chat-toggle').addEventListener('click', function() {
                const chatContainer = document.getElementById('chat-container');
                chatContainer.style.display = chatContainer.style.display === 'none' ? 'block' : 'none';
            });
        </script>
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">

                        <span class="sitename">LeukemiaVision</span>
                    </a>
                    <div class="footer-contact pt-3">

                        <?php if (!empty($locationData)) : ?>

                            <p><?= htmlspecialchars($locationData[0]['address']) ?></p>
                            <p class="mt-3">
                                <strong>Phone:</strong>
                                <span><?= htmlspecialchars($locationData[0]['phone']) ?></span>
                            </p>
                            <p>
                                <strong>Email:</strong>
                                <span><?= htmlspecialchars($locationData[0]['email']) ?></span>
                            </p>
                        <?php else : ?>
                            <p class="mt-3"><strong>Phone:</strong> <span>Phone not available</span></p>
                            <p><strong>Email:</strong> <span>Email not available</span></p>
                        <?php endif; ?>
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
                        <li><a href="#about">About us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">AI Image Analysis</a></li>
                        <li><a href="#">Chemotherapy</a></li>
                        <li><a href="#">Radiation Therapy</a></li>
                        <li><a href="#">Targeted Therapy</a></li>
                        <li><a href="#">Consultation</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Patient Portal</a></li>
                        <li><a href="#">Clinical Trials</a></li>
                        <li><a href="#">Research Papers</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Connect</h4>
                    <ul>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Career Opportunities</a></li>
                        <li><a href="#">Media Kit</a></li>
                        <li><a href="#">Partnerships</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">LeukemiaVision</strong> <span>All Rights
                    Reserved</span></p>

        </div>
    </footer>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendor/php-email-form/validate.js"></script>
        <script src="../../assets/vendor/aos/aos.js"></script>
        <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../../assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

        <!-- Main JS File -->
        <script src="../../assets/js/main.js"></script>

</body>

</html>