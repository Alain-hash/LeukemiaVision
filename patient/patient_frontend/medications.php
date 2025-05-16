<?php
session_start();
include("../../database/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Patient') {
  header("location:../../login.php");
  exit();
  
}elseif( $_SESSION['user_Status'] != 'Active'){
  header("location:../../unauthorised.php");
}else{
if (isset($_SESSION['user_id']) && $_SESSION['user_Status'] == 'Active' && $_SESSION['user_role'] == 'Patient') {
  include "../../patient-profileimage.php";
  $_SESSION['profile_image'] = $profile_image;
}
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
  <title>My Medications - LeukemiaVision</title>
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

  <!-- Main CSS File -->
  <link href="../../assets/css/main.css" rel="stylesheet">

  <style>
      
   /* Move Medications text slightly to the right */
   .page-header {
        padding-left: 30px; /* Adjusted from original padding */
      }
    

    
   
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
  <main class="dashboard-container">
    <div class="page-header" data-aos="fade-up">
      <h1><i class="bi bi-capsule me-2"></i> My Medications</h1>
      <p>Track your current medications and view your medication history</p>
    </div>

    <?php
    $stmt = $connection->prepare(
      "SELECT 
            user.Name AS Patient_Name, 
            patient.Birth_Date, 
            patient.Gender, 
            patient.Blood_Type, 
            patient.Weight, 
            patient.Allergies, 
            patient.Existing_Conditions, 
            medications.Med_Name, 
            medications.Dosage, 
            medications.Frequency, 
            medications.Start_Date, 
            medications.End_Date, 
            medications.Status,
             medications.Additional_Notes
        FROM patient
        JOIN user ON user.User_ID = patient.User_ID
        LEFT JOIN medications ON medications.Patient_ID = patient.Patient_ID
        WHERE user.User_ID =? ;"
    );

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $patient_info = [];
    $active_prescriptions = [];
    $history_prescriptions = [];

    while ($row = $result->fetch_assoc()) {
      
      if (!empty($row['End_Date'])) {
          $currentDate = date('Y-m-d'); 
          if ($row['End_Date'] < $currentDate) {
              $stmt2 = $connection->prepare("UPDATE medications SET Status='Completed' WHERE End_Date < CURDATE()");
              $stmt2->execute();
              $stmt2->close();
              
              $row['Status'] = 'Completed';
          }
      }
      if (empty($patient_info)) {
        $patient_info = $row;
      }

      if (!empty($row['Med_Name'])) {
        if ($row['Status'] === 'Active') {
          $active_prescriptions[] = $row;
        } else {
          $history_prescriptions[] = $row;
        }
      }
    }

    if (!empty($patient_info)) {

      // Calculate age from birthdate
      $birthdate = new DateTime($patient_info['Birth_Date']);
      $today = new DateTime();
      $age = $birthdate->diff($today)->y;
      $formatted_birth_date = date('M d, Y', strtotime($patient_info['Birth_Date']));
    ?>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="patient-profile">
                <div class="patient-avatar">
                  <i class="bi bi-person"></i>
                </div>
                <div class="patient-details">
                  <h2><?= htmlspecialchars($patient_info['Patient_Name']) ?></h2>
                  <p class="text-muted mb-0">Patient ID: #<?= $user_id ?></p>
                </div>
              </div>

              <div class="patient-info-grid">
                <div class="patient-info-item">
                  <div class="patient-info-label">Age</div>
                  <div class="patient-info-value"><?= $age ?> years</div>
                </div>
                <div class="patient-info-item">
                  <div class="patient-info-label">Gender</div>
                  <div class="patient-info-value"><?= htmlspecialchars($patient_info['Gender']) ?></div>
                </div>
                <div class="patient-info-item">
                  <div class="patient-info-label">Blood Type</div>
                  <div class="patient-info-value"><?= htmlspecialchars($patient_info['Blood_Type']) ?></div>
                </div>
                <div class="patient-info-item">
                  <div class="patient-info-label">Weight</div>
                  <div class="patient-info-value"><?= htmlspecialchars($patient_info['Weight']) ?> kg</div>
                </div>
                <div class="patient-info-item">
                  <div class="patient-info-label">Birth Date</div>
                  <div class="patient-info-value"><?= htmlspecialchars($formatted_birth_date) ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card medical-alerts">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Medical Alerts</h5>

              <div class="mt-4">
                <h6 class="d-flex align-items-center">
                  <span class="badge bg-warning text-dark me-2"><i class="bi bi-bandaid"></i></span>
                  Allergies
                </h6>
                <?php if ($patient_info['Allergies'] == 'None'): ?>
                  <p class="text-muted"><i>No known allergies</i></p>
                <?php else: ?>
                  <p><?= htmlspecialchars($patient_info['Allergies']) ?></p>
                <?php endif; ?>
              </div>

              <div class="mt-4">
                <h6 class="d-flex align-items-center">
                  <span class="badge bg-danger text-white me-2"><i class="bi bi-heart-pulse"></i></span>
                  Medical Conditions
                </h6>
                <?php if ($patient_info['Existing_Conditions'] == 'None'): ?>
                  <p class="text-muted"><i>No existing conditions</i></p>
                <?php else: ?>
                  <p><?= htmlspecialchars($patient_info['Existing_Conditions']) ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Medications Section -->
      <div class="card" data-aos="fade-up" data-aos-delay="200">
        <div class="card-body">
          <div class="section-header">
            <div class="section-title">
              <div class="section-icon active">
                <i class="bi bi-capsule"></i>
              </div>
              <h3>Active Medications</h3>
            </div>
            <span class="badge bg-success rounded-pill px-3 py-2"><?= count($active_prescriptions) ?> Active</span>
          </div>

          <?php if (!empty($active_prescriptions)) : ?>
            <div class="medication-cards">
              <?php foreach ($active_prescriptions as $prescription) :
                $start_date = date('M d, Y', strtotime($prescription['Start_Date']));
                $end_date = !empty($prescription['End_Date']) ? date('M d, Y', strtotime($prescription['End_Date'])) : 'Ongoing';

                // Calculate days left if end date exists
                $days_left = '';
                if ($end_date !== 'Ongoing') {
                  $today = new DateTime();
                  $end = new DateTime($prescription['End_Date']);
                  $diff = $today->diff($end);
                  $days_left = $diff->days;
                  $expired = $today > $end;
                }
              ?>
                <div class="medication-card">
                  <div class="medication-card-header">
                    <h5 class="med-name"><?= htmlspecialchars($prescription['Med_Name']) ?></h5>
                    <span class="badge bg-success">Active</span>
                  </div>
                  <div class="medication-details">
                    <div class="detail-row">
                      <div class="detail-label">Dosage</div>
                      <div class="detail-value"><?= htmlspecialchars($prescription['Dosage']) ?></div>
                    </div>
                    <div class="detail-row">
                      <div class="detail-label">Frequency</div>
                      <div class="detail-value"><?= htmlspecialchars($prescription['Frequency']) ?></div>
                    </div>
                    <div class="detail-row">
                      <div class="detail-label">Started</div>
                      <div class="detail-value"><?= $start_date ?></div>
                    </div>
                    <div class="detail-row">
                      <div class="detail-label">Ends</div>
                      <div class="detail-value">
                        <?php if ($end_date === 'Ongoing'): ?>
                          <span class="badge bg-info">Ongoing</span>
                        <?php else: ?>
                          <?= $end_date ?>
                          <?php if (isset($days_left)): ?>
                            <?php if ($expired): ?>
                              <span class="badge bg-danger ms-1">Expired</span>
                            <?php elseif ($days_left <= 5): ?>
                              <span class="badge bg-warning text-dark ms-1"><?= $days_left ?> days left</span>
                            <?php else: ?>
                              <span class="badge bg-secondary ms-1"><?= $days_left ?> days left</span>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="medication-footer d-flex justify-content-center align-items-center" style="height: 100px;">

                    <?= htmlspecialchars($prescription['Additional_Notes']) ?>
                  </div>
                </div>

            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="empty-state">
          <div class="empty-icon">
            <i class="bi bi-clipboard-x"></i>
          </div>
          <h5>No Active Medications</h5>
          <p class="text-muted">You don't have any active medications at the moment.</p>
        </div>
      <?php endif; ?>
      </div>
      </div>

      <!-- Medication History Section -->
      <div class="card" data-aos="fade-up" data-aos-delay="300">
        <div class="card-body">
          <div class="section-header">
            <div class="section-title">
              <div class="section-icon history">
                <i class="bi bi-clock-history"></i>
              </div>
              <h3>Medication History</h3>
            </div>
            <span class="badge bg-secondary rounded-pill px-3 py-2"><?= count($history_prescriptions) ?> Records</span>
          </div>

          <?php if (!empty($history_prescriptions)) : ?>
            <div class="table-responsive">
              <table class="table history-table">
                <thead>
                  <tr>
                    <th>Medication</th>
                    <th>Dosage</th>
                    <th>Frequency</th>
                    <th>Period</th>
                    <th>Duration</th>
                    <th>Status</th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($history_prescriptions as $prescription) :
                    $start_date = date('M d, Y', strtotime($prescription['Start_Date']));
                    $end_date = date('M d, Y', strtotime($prescription['End_Date']));

                    // Calculate treatment duration
                    $start = new DateTime($prescription['Start_Date']);
                    $end = new DateTime($prescription['End_Date']);
                    $duration = $start->diff($end);
                    $duration_text = '';

                    if ($duration->y > 0) {
                      $duration_text .= $duration->y . 'y ';
                    }
                    if ($duration->m > 0) {
                      $duration_text .= $duration->m . 'm ';
                    }
                    $duration_text .= $duration->d . 'd';
                  ?>
                    <tr>
                      <td class="fw-medium"><?= htmlspecialchars($prescription['Med_Name']) ?></td>
                      <td><?= htmlspecialchars($prescription['Dosage']) ?></td>
                      <td><?= htmlspecialchars($prescription['Frequency']) ?></td>
                      <td><?= $start_date ?> to <?= $end_date ?></td>
                      <td><?= $duration_text ?></td>
                      <td>
                        <?php if ($prescription['Status'] === 'Completed') { ?>
                          <span class="badge bg-success">Completed</span>
                        <?php } else { ?>
                          <span class="badge bg-danger">Discontinued</span>
                        <?php } ?>
                      </td>

                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else : ?>
            <div class="empty-state">
              <div class="empty-icon">
                <i class="bi bi-hourglass"></i>
              </div>
              <h5>No Medication History</h5>
              <p class="text-muted">You don't have any historical medication records.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>

    <?php
    } else {
      echo '<div class="alert alert-warning mt-4" role="alert">
      <div class="d-flex align-items-center">
          <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
          <div>
              <h4 class="alert-heading">No Medication Records Found</h4>
              <p>We couldn\'t find any medication records in our system. If you believe this is an error, please contact your healthcare provider.</p>
          </div>
      </div>
    </div>';
      exit;
    }
    ?>

    <div class="card bg-light border-0" data-aos="fade-up" data-aos-delay="400">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h4><i class="bi bi-question-circle text-primary me-2"></i> Need Help With Your Medications?</h4>
            <p class="mb-md-0">Contact your healthcare provider or schedule an appointment to discuss your medication plan.</p>
          </div>

        </div>
      </div>
    </div>
  </main>


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
  <script src="..../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>