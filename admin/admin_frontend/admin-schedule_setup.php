<?php
session_start();
include("../../database/db.php");
include("../admin_backend/user-management/refresh_doctor_schedule.php");

if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Admin') {
  header("location:../../login.php");
  exit();
}

// Initialize default values
$breakPeriodStart = "12:00"; 
$breakPeriodEnd = "13:00"; 
$bufferTime = 15;
$schedule = array();

// Fetch schedule data
$stmt = $connection->prepare("SELECT Day, Status, Start_Time, End_Time, Break_Period_Start, Break_Period_End, Buffer_Time FROM schedule");
$stmt->execute();
$result = $stmt->get_result();

// Process the result set
while ($row = $result->fetch_assoc()) {
  $schedule[$row['Day']] = $row;
  
  // Since these values should be the same for all records, just update them if they exist
  if (isset($row['Break_Period_Start']) && !empty($row['Break_Period_Start'])) {
    $breakPeriodStart = $row['Break_Period_Start'];
  }
  
  if (isset($row['Break_Period_End']) && !empty($row['Break_Period_End'])) {
    $breakPeriodEnd = $row['Break_Period_End'];
  }
  
  if (isset($row['Buffer_Time']) && !empty($row['Buffer_Time'])) {
    $bufferTime = $row['Buffer_Time'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- [Head content remains the same] -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Schedule Setup - leukemiaVision</title>
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
              <li class="list-group-item "><a href="admin-insights.php" class="text-decoration-none"><i class="bi bi-graph-up me-2"></i> Insights</a></li>
              <li class="list-group-item"><a href="admin-user-management.php" class="text-decoration-none"><i class="bi bi-person-badge me-2"></i> Users </a></li>
              <li class="list-group-item "><a href="admin-services.php" class="text-decoration-none "><i class="bi bi-people me-2"></i>Services </a></li>
              <li class="list-group-item "><a href="admin-appointments.php" class="text-decoration-none" ><i class="bi bi-calendar-check me-2"></i>Appointments</a></li>
              <li class="list-group-item "><a href="admin-system-security.php" class="text-decoration-none "><i class="bi bi-send-arrow-down-fill me-2"></i>System & Security</a></li>
              <li class="list-group-item active "><a href="admin-schedule_setup.php" class="text-decoration-none text-white"><i class="bi bi-calendar-week me-2"></i>Schedule Setup</a></li>
              <li class="list-group-item"><a href="../../logout.php" class="text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
            </ul>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
          <div class="card mb-4">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Schedule Configuration</h5>
            </div>
            <div class="card-body">
              <div class="alert alert-info">
                <?php
                if (isset($_SESSION['message'])) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill fs-4 me-2"></i>
              <strong>' . $_SESSION['message'] . '</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
                  unset($_SESSION['message']); // Clear the message after displaying
                }
                ?>
                <i class="bi bi-info-circle me-2"></i> Configure your facility's scheduling parameters to optimize appointment management.
              </div>

              <!-- Combined Working Hours and Break Period Settings -->
              <form action="../admin_backend/schedule-setup_backend/schedule_setup.php" method="post">
                <!-- Working Hours Settings -->
                <div class="card mb-4">
                  <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-clock me-2"></i>Working Hours</h6>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="bg-light">
                            <th>Day</th>
                            <th>Active</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Monday</td>
                            <td>
                              <div class="form-check form-switch">
                                <?php if (isset($schedule['Monday']) && $schedule['Monday']['Status'] == 'Active') { ?>
                                  <input class="form-check-input" type="checkbox" id="monday-active" name="monday-active" checked>
                                <?php } else { ?>
                                  <input class="form-check-input" type="checkbox" id="monday-active" name="monday-active">
                                <?php } ?>
                                <label class="form-check-label" for="monday-active"></label>
                              </div>
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Monday']) ? $schedule['Monday']['Start_Time'] : '08:00'; ?>" name="monday-start-time">
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Monday']) ? $schedule['Monday']['End_Time'] : '17:00'; ?>" name="monday-end-time">
                            </td>
                          </tr>
                          <tr>
                            <td>Tuesday</td>
                            <td>
                              <div class="form-check form-switch">
                                <?php if (isset($schedule['Tuesday']) && $schedule['Tuesday']['Status'] == 'Active') { ?>
                                  <input class="form-check-input" type="checkbox" id="tuesday-active" name="tuesday-active" checked>
                                <?php } else { ?>
                                  <input class="form-check-input" type="checkbox" id="tuesday-active" name="tuesday-active">
                                <?php } ?>
                                <label class="form-check-label" for="tuesday-active"></label>
                              </div>
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Tuesday']) ? $schedule['Tuesday']['Start_Time'] : '08:00'; ?>" name="tuesday-start-time">
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Tuesday']) ? $schedule['Tuesday']['End_Time'] : '17:00'; ?>" name="tuesday-end-time">
                            </td>
                          </tr>
                          <tr>
                            <td>Wednesday</td>
                            <td>
                              <div class="form-check form-switch">
                                <?php if (isset($schedule['Wednesday']) && $schedule['Wednesday']['Status'] == 'Active') { ?>
                                  <input class="form-check-input" type="checkbox" id="wednesday-active" name="wednesday-active" checked>
                                <?php } else { ?>
                                  <input class="form-check-input" type="checkbox" id="wednesday-active" name="wednesday-active">
                                <?php } ?>
                                <label class="form-check-label" for="wednesday-active"></label>
                              </div>
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Wednesday']) ? $schedule['Wednesday']['Start_Time'] : '08:00'; ?>" name="wednesday-start-time">
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Wednesday']) ? $schedule['Wednesday']['End_Time'] : '17:00'; ?>" name="wednesday-end-time">
                            </td>
                          </tr>
                          <tr>
                            <td>Thursday</td>
                            <td>
                              <div class="form-check form-switch">
                                <?php if (isset($schedule['Thursday']) && $schedule['Thursday']['Status'] == 'Active') { ?>
                                  <input class="form-check-input" type="checkbox" id="thursday-active" name="thursday-active" checked>
                                <?php } else { ?>
                                  <input class="form-check-input" type="checkbox" id="thursday-active" name="thursday-active">
                                <?php } ?>
                                <label class="form-check-label" for="thursday-active"></label>
                              </div>
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Thursday']) ? $schedule['Thursday']['Start_Time'] : '08:00'; ?>" name="thursday-start-time">
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Thursday']) ? $schedule['Thursday']['End_Time'] : '17:00'; ?>" name="thursday-end-time">
                            </td>
                          </tr>
                          <tr>
                            <td>Friday</td>
                            <td>
                              <div class="form-check form-switch">
                                <?php if (isset($schedule['Friday']) && $schedule['Friday']['Status'] == 'Active') { ?>
                                  <input class="form-check-input" type="checkbox" id="friday-active" name="friday-active" checked>
                                <?php } else { ?>
                                  <input class="form-check-input" type="checkbox" id="friday-active" name="friday-active">
                                <?php } ?>
                                <label class="form-check-label" for="friday-active"></label>
                              </div>
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Friday']) ? $schedule['Friday']['Start_Time'] : '08:00'; ?>" name="friday-start-time">
                            </td>
                            <td>
                              <input type="time" class="form-control" value="<?php echo isset($schedule['Friday']) ? $schedule['Friday']['End_Time'] : '16:00'; ?>" name="friday-end-time">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- Break Period Settings -->
                <div class="card mb-4">
                  <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-cup-hot me-2"></i>Break Period Configuration</h6>
                  </div>
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="break-start-time" class="form-label">Break Start Time</label>
                        <input type="time" class="form-control" id="break-start-time" value="<?php echo $breakPeriodStart; ?>" name="break-start-time">
                      </div>
                      <div class="col-md-6">
                        <label for="break-end-time" class="form-label">Break End Time</label>
                        <input type="time" class="form-control" id="break-end-time" value="<?php echo $breakPeriodEnd; ?>" name="break-end-time">
                      </div>
                    </div>
                    <div class="form-text text-muted mb-3">
                      Break period applies to all working days. During this time, no appointments will be scheduled.
                    </div>
                  </div>
                </div>

                <!-- Buffer Time Settings -->
                <div class="card mb-4">
                  <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-hourglass-split me-2"></i>Buffer Time Configuration</h6>
                  </div>
                  <div class="card-body">
                    <div class="row mb-3">
                      <label for="buffer-time" class="col-sm-4 col-form-label">Buffer Time Between Appointments</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <input type="number" class="form-control" id="buffer-time" value="<?php echo $bufferTime; ?>" min="0" max="60" name="buffer-time">
                          <span class="input-group-text">minutes</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-text text-muted mb-3">
                      Buffer time provides a gap between appointments to prepare for the next patient or handle any delays.
                    </div>
                  </div>
                </div>

                <!-- Save Settings -->
                <div class="d-flex justify-content-end">
                  <button type="button" class="btn btn-secondary me-2">Cancel</button>
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Save Settings
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer id="footer" class="footer">
    <div class="container-fluid copyright text-center py-4">
      <small>&copy; 2023 <strong><span>leukemiaVision</span></strong>. All Rights Reserved.</small>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/aos/aos.js"></script>
  <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../../assets/js/main.js"></script>

</body>

</html>