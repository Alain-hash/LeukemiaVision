<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Doctor' || $_SESSION['user_Status'] != 'Active') {
    header("location:../../unauthorised.php");
    exit();
}

$user_id = $_SESSION['user_id'];
include ("doctor_backend/account/fetchaccount.php");
include ("doctor_backend/schedule/schedule.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeukemiaVision - Schedule Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
        }

        .sidebar .nav-link {
            color: #343a40;
            border-radius: 0.5rem;
            padding: 12px 20px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.25);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        
        .top-nav {
            background-image: url('/api/placeholder/1200/100');
            background-size: cover;
            background-position: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .top-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(13, 110, 253, 0.85);
            z-index: 0;
        }
        
        .top-nav .container-fluid {
            position: relative;
            z-index: 1;
        }
        
        .top-nav .navbar-brand {
            color: white;
            font-weight: bold;
            margin-left: 15px; /* Align with sidebar */
        }
        
        .logout-btn {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }

            .top-nav .navbar-brand {
                margin-left: 0;
            }
        }
        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            z-index: 100;
        }
        /* Additional styles for the integrated content */
        .stat-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .icon {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
        }
        
        .icon i {
            font-size: 24px;
            color: #0d6efd;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }
        
        .stat-label {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
        }
        
        .appointment {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .appointment:last-child {
            border-bottom: none;
        }
        
        .patient-name {
            font-weight: bold;
        }
        
        .appointment-time {
            color: #6c757d;
            font-size: 14px;
        }

        /* Day selection styles */
        .day-pill {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .day-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .day-pill.active {
            border: 2px solid #0d6efd;
        }
        
        .day-off {
            opacity: 0.7;
        }
        
        </style>
</head>

<body class="bg-light">
<!-- View Profile Image Modal -->
<div class="modal fade" id="viewProfileImageModal" tabindex="-1" aria-labelledby="viewProfileImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProfileImageModalLabel">Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo '..'.htmlspecialchars($accountData['profile_image']); ?>" alt="Profile Image" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid p-0">
         <!-- Top Navigation -->
         <nav class="navbar navbar-expand-lg top-nav">
            <div class="container-fluid">
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand ms-lg-3" href="#">LeukemiaVision</a>
                <div class="ms-auto d-flex">
                    <div class="dropdown me-3">

                    </div>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?php echo "Dr. " . $_SESSION['user_name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="account.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-lg-2 sidebar p-0">
                <div class="collapse d-lg-block" id="sidebarMenu">
                    <div class="d-flex flex-column p-3">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="homepage.php" class="nav-link active ">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="account.php" class="nav-link">
                                    <i class="bi bi-person"></i> Account
                                </a>
                            </li>
                          
                            <li class="nav-item">
                                <a href="appointment.php" class="nav-link ">
                                    <i class="bi bi-calendar-check"></i> Appointments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="doctor_absence_request.php" class="nav-link">
                                    <i class="bi bi-calendar-x"></i> Absence Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="medications.php" class="nav-link">
                                    <i class="bi bi-capsule"></i> Medication
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="progress.php" class="nav-link">
                                    <i class="bi bi-graph-up"></i> Patient Progress
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="test_report.php" class="nav-link">
                                    <i class="bi bi-file-earmark-text"></i> Test Report
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="treatment_report.php" class="nav-link">
                                    <i class="bi bi-file-earmark-text"></i> Treatment Report
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="qa.php" class="nav-link">
                                    <i class="bi bi-question-circle"></i> Q&A
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <div>
                            <a href="../logout.php" class="btn btn-danger w-100">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 py-4 bg-body-tertiary">
                   <!-- Stats Row -->
                   <div class="row mb-4">
                    <div class="col-md-4 align-content-center">
                        <div class="card stat-card">
                            <div class="icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="stat-value"><?php echo $PatientCount; ?></div>
                            <div class="stat-label">Today's Patients</div>
                        </div>
                    </div>

                </div>
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-header bg-white border-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="mb-0 text-primary fw-bold">
                                            <i class="bi bi-gear-fill me-2"></i>Schedule Settings
                                        </h4>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">Currently Viewing:</span>
                                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                                <i class="bi bi-calendar-day me-1"></i>
                                                <?php echo $selected_day; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <!-- Time Settings Card -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0 shadow-sm rounded-3 bg-white">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0">
                                                        <i class="bi bi-clock me-2"></i>Time Settings for <?php echo $selected_day; ?>
                                                        <?php if ($selectedDayData && $selectedDayData['Status'] == 'Active'): ?>
                                                            <span class="badge bg-success float-end">Active Day</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary float-end">Day Off</span>
                                                        <?php endif; ?>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php if ($selectedDayData && $selectedDayData['Status'] == 'Active'): ?>
                                                    <div class="mb-4">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="fw-bold mb-0">Working Hours</h6>
                                                        </div>
                                                        <div class="bg-light p-3 rounded-3 d-flex justify-content-between">
                                                            <div>
                                                                <span class="text-muted">Start Time</span>
                                                                <div class="fw-bold fs-5 text-primary">
                                                                    <i class="bi bi-sunrise me-1"></i>
                                                                    <?php echo $selectedDayData['Start_Time_Formatted']; ?>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <span class="text-muted">End Time</span>
                                                                <div class="fw-bold fs-5 text-primary">
                                                                    <i class="bi bi-sunset me-1"></i>
                                                                    <?php echo $selectedDayData['End_Time_Formatted']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-4">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="fw-bold mb-0">Break Period</h6>
                                                        </div>
                                                        <div class="bg-light p-3 rounded-3 d-flex justify-content-between">
                                                            <div>
                                                                <span class="text-muted">Start Time</span>
                                                                <div class="fw-bold fs-5 text-primary">
                                                                    <i class="bi bi-cup-hot me-1"></i>
                                                                    <?php echo $selectedDayData['Break_Period_Start_Formatted'] ?? 'Not set'; ?>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <span class="text-muted">End Time</span>
                                                                <div class="fw-bold fs-5 text-primary">
                                                                    <i class="bi bi-arrow-right-circle me-1"></i>
                                                                    <?php echo $selectedDayData['Break_Period_End_Formatted'] ?? 'Not set'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div>
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <h6 class="fw-bold mb-0">Appointment Settings</h6>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col-6">
                                                                <div class="bg-light p-3 rounded-3 h-100">
                                                                    <span class="text-muted d-block mb-1">Default Duration</span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="display-6 fw-bold text-primary me-2"><?php echo $serviceData['Service_Duration']; ?></span>
                                                                        <span class="fw-light">minutes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="bg-light p-3 rounded-3 h-100">
                                                                    <span class="text-muted d-block mb-1">Buffer Time</span>
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="display-6 fw-bold text-primary me-2"><?php echo $selectedDayData['Buffer_Time']; ?></span>
                                                                        <span class="fw-light">minutes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="text-center p-5">
                                                        <i class="bi bi-calendar-x fs-1 text-secondary mb-3"></i>
                                                        <h4 class="text-secondary">Day Off</h4>
                                                        <p class="text-muted">No scheduling available for <?php echo $selected_day; ?>.</p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Days and Services Card -->
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0 shadow-sm rounded-3 bg-white">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Days & Services</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-4">
                                                        <h6 class="fw-bold mb-3">Working Days</h6>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <?php 
                                                            foreach ($allDays as $day) {
                                                                $isWorkingDay = in_array($day, $workingDays);
                                                                $isActive = isset($dayStatus[$day]) && $dayStatus[$day] == 'Active';
                                                                $isSelected = ($day == $selected_day);
                                                                
                                                                // Determine badge class based on status
                                                                $badgeClass = 'bg-light text-dark';
                                                                if ($isWorkingDay) {
                                                                    $badgeClass = $isActive ? 'bg-primary' : 'bg-secondary';
                                                                    if (!$isActive) {
                                                                        $badgeClass .= ' day-off';
                                                                    }
                                                                }
                                                                
                                                                // Add active class if selected
                                                                $activeClass = $isSelected ? 'active' : '';
                                                                
                                                                echo '<a href="?day=' . $day . '" class="text-decoration-none">';
                                                                echo '<span class="badge ' . $badgeClass . ' rounded-pill px-3 py-2 day-pill ' . $activeClass . '">';
                                                                
                                                                // Add icon based on status
                                                                if ($isWorkingDay && $isActive) {
                                                                    echo '<i class="bi bi-check-circle-fill me-1"></i>';
                                                                } elseif ($isWorkingDay && !$isActive) {
                                                                    echo '<i class="bi bi-x-circle-fill me-1"></i>';
                                                                }
                                                                
                                                                echo $day . '</span>';
                                                                echo '</a>';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-3">
                                                        <!-- Test Services -->
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold mb-3">
                                                                <i class="bi bi-clipboard2-pulse me-1"></i>Test Services
                                                            </h6>
                                                            <?php if (empty($testData)): ?>
                                                                <div class="alert alert-info">No test services available</div>
                                                            <?php else: ?>
                                                                <div class="list-group">
                                                                    <?php foreach ($testData as $index => $test): ?>
                                                                        <div class="list-group-item list-group-item-action d-flex align-items-center">
                                                                            <span class="badge bg-info rounded-pill me-2"><?php echo $index + 1; ?></span>
                                                                            <?php echo htmlspecialchars($test); ?>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        
                                                        <!-- Treatment Services -->
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold mb-3">
                                                                <i class="bi bi-bandaid me-1"></i>Treatment Services
                                                            </h6>
                                                            <?php if (empty($treatmentData)): ?>
                                                                <div class="alert alert-info">No treatment services available</div>
                                                            <?php else: ?>
                                                                <div class="list-group">
                                                                    <?php foreach ($treatmentData as $index => $treatment): ?>
                                                                        <div class="list-group-item list-group-item-action d-flex align-items-center">
                                                                            <span class="badge bg-success rounded-pill me-2"><?php echo $index + 1; ?></span>
                                                                            <?php echo htmlspecialchars($treatment); ?>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</body>
</html>