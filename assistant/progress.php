<?php
session_start();
include("../database/db.php");
if (!isset($_SESSION['user_id']) && $_SESSION['Role'] != 'Assistant') {
    header("location:../../login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Root Variables */
        :root {
            --primary: #0d6efd;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --dark: #34495e;
            --light: #ecf0f1;
        }

        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Layout Container */
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            color: var(--dark);
            font-weight: 600;
            font-size: 1.8rem;
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

        /* Content Area */
        .content {
            padding: 20px;
        }

        /* Top Navigation */
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
            margin-left: 15px;
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

        /* Grid System */
        .grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 20px;
        }

        .col-12 {
            grid-column: span 12;
        }

        .col-6 {
            grid-column: span 6;
        }

        .col-4 {
            grid-column: span 4;
        }

        .col-3 {
            grid-column: span 3;
        }

        /* Card Components */
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 8px;
            color: var(--primary);
        }

        /* Patient Status */
        .patient-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-active {
            background-color: var(--success);
        }

        .status-progress {
            background-color: var(--primary);
        }

        .status-warning {
            background-color: var(--warning);
        }

        .status-danger {
            background-color: var(--danger);
        }

        /* Info Box */
        .info-box {
            display: flex;
            margin-bottom: 15px;
        }

        .info-label {
            width: 140px;
            font-weight: 600;
            color: #666;
        }

        .info-value {
            flex: 1;
        }

        /* Metrics */
        .key-metric {
            text-align: center;
            padding: 15px 10px;
        }

        .metric-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .metric-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Progress Bars */
        .progress-container {
            height: 10px;
            background-color: #eee;
            border-radius: 5px;
            margin-bottom: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--primary);
        }

        /* Timeline */
        .timeline {
            position: relative;
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 20px;
            border-left: 2px solid var(--primary);
            margin-left: 15px;
        }

        .timeline-item:last-child {
            border-left: none;
        }

        .timeline-dot {
            position: absolute;
            left: -10px;
            top: 0;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: var(--primary);
            border: 3px solid white;
        }

        .timeline-date {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 5px;
        }

        .timeline-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .timeline-content {
            font-size: 0.9rem;
            color: #444;
        }

        /* Test Results */
        .test-result {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .test-result:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .test-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .test-icon i {
            color: var(--primary);
        }

        .test-info {
            flex: 1;
        }

        .test-name {
            font-weight: 600;
            margin-bottom: 3px;
        }

        .test-date {
            font-size: 0.8rem;
            color: #666;
        }

        .test-status {
            font-weight: 600;
            text-align: right;
        }

        .status-normal {
            color: var(--success);
        }

        .status-elevated {
            color: var(--warning);
        }

        .status-critical {
            color: var(--danger);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .grid {
                grid-template-columns: repeat(6, 1fr);
            }

            .col-3,
            .col-4 {
                grid-column: span 6;
            }
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: repeat(1, 1fr);
            }

            .col-6,
            .col-3,
            .col-4 {
                grid-column: span 1;
            }

            .sidebar {
                min-height: auto;
            }

            .top-nav .navbar-brand {
                margin-left: 0;
            }

            .info-box {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
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
                            <i class="bi bi-person-circle"></i> <?php echo "Ass." . $_SESSION['user_name']; ?>
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
                                <a href="homepage.php" class="nav-link ">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="account.php" class="nav-link">
                                    <i class="bi bi-person"></i> Account
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="appointment.php" class="nav-link">
                                    <i class="bi bi-calendar-check"></i> Appointments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="doctor_absence.php" class="nav-link">
                                    <i class="bi bi-calendar-x"></i> Absence Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="medications.php" class="nav-link">
                                    <i class="bi bi-capsule"></i> Medication
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="progress.php" class="nav-link active">
                                    <i class="bi bi-graph-up"></i> Patient Progress
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="qa.php" class="nav-link">
                                    <i class="bi bi-question-circle"></i>Q&A
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
            <div class="col-md-9 col-lg-10">



                <?php
                // Get the doctor ID associated with the current user
                $stmt1 = $connection->prepare("
    SELECT Doctor_ID
    FROM assistant
    WHERE User_ID = ?
");

                $stmt1->bind_param("i", $user_id);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                $doctor_id = null;

                if ($row = $result1->fetch_assoc()) {
                    $doctor_id = $row['Doctor_ID'];
                }

               
                $Patients = array();

                if ($doctor_id) {
                  
                    $stmt2 = $connection->prepare("
        SELECT DISTINCT user.User_ID, user.Name
        FROM user
        JOIN patient ON patient.User_ID = user.User_ID
        JOIN appointment ON appointment.Patient_ID = patient.Patient_ID
        WHERE appointment.Doctor_ID = ?
    ");

                    $stmt2->bind_param("i", $doctor_id);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    while ($Patient = $result2->fetch_assoc()) {
                        $Patients[] = $Patient;
                    }
                }
                ?>

                <!-- Patient Selection UI -->
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center mb-4">
                                <h3 class="fw-light">Patient Progress Tracker</h3>
                                <p class="text-muted small">Select a patient to view their detailed progress</p>
                            </div>

                            <div class="card shadow-sm mb-4">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <label for="patientSelect" class="form-label mb-md-0">Patient:</label>
                                        </div>
                                        <div class="col-md-10">
                                            <select class="form-select" id="patientSelect">
                                                <option value="">Choose patient</option>
                                                <?php if (!empty($Patients)) { ?>
                                                    <?php foreach ($Patients as $Patient) { ?>
                                                        <option value="<?php echo $Patient['User_ID']; ?>">
                                                            <?php echo ' PLV-'. $Patient['User_ID']." ".$Patient['Name']?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option disabled>No patients found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (empty($Patients)) { ?>
                                <div class="alert alert-info">
                                    No patients are currently assigned to this doctor.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Simple loading indicator -->
                <div id="loadingIndicator" class="text-center my-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!-- Simple placeholder that spans full width -->
                <div id="emptyState" class="text-center my-5 py-5">
                    <i class="bi bi-person-bounding-box text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Select a patient to view their progress data</p>
                </div>

                <!-- Patient data container that takes full width -->
                <div id="fetcheddata" class="w-100" style="display: none;"></div>
            </div>
        </div>
    </div>

    <script>
   $(document).ready(function() {
    $('#patientSelect').on('change', function() {
        var patientID = $(this).val();

        if (patientID) {
            // Show loading indicator
            $('#emptyState').hide();
            $('#fetcheddata').hide();
            $('#loadingIndicator').show();
            
            $.ajax({
                url: 'assistant_backend/progress/fetchprogressdata.php',
                type: 'POST',
                data: {
                    user_id: patientID
                },
                success: function(data) {
                    // Hide loading indicator
                    $('#loadingIndicator').hide();
                    
                    // Update the content area with the fetched data
                    $('#fetcheddata').html(data).show();
                },
                error: function(xhr, status, error) {
                    // Hide loading indicator
                    $('#loadingIndicator').hide();
                    
                    // Show error message
                    $('#fetcheddata').html('<div class="alert alert-danger m-3">Error loading patient data: ' + error + '</div>').show();
                    console.error("AJAX Error: " + status + " - " + error);
                }
            });
        } else {
            // If no patient is selected, show empty state
            $('#fetcheddata').hide();
            $('#loadingIndicator').hide();
            $('#emptyState').show();
        }
    });
});
    </script>
    </div>
    </div>
    </div>
</body>

</html>