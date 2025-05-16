<?php
session_start();
include("../database/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Doctor' || $_SESSION['user_Status'] != 'Active') {
    header("location:../unauthorised.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Portal - Prescription Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
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
            background-color: #0d6efd;
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

        .logout-btn {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
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

        .card {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 1rem 1.25rem;
            font-weight: 600;
        }

        .search-container {
            max-width: 600px;
            margin: 2rem auto;
            text-align: center;
            padding: 2rem;
            border-radius: 1rem;
            background-color: white;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .search-container:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
        }

        .search-icon {
            font-size: 4rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }

        .search-title {
            margin-bottom: 1.5rem;
            color: #343a40;
        }

        .search-instruction {
            margin-bottom: 1.5rem;
            color: #6c757d;
        }

        .patient-info-section {
            background-color: #fff;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 5px solid #0d6efd;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .patient-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .patient-info-item {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.5rem;
            border-left: 3px solid #0d6efd;
        }

        .patient-info-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .patient-info-value {
            font-weight: 600;
            color: #343a40;
        }

        .prescription-card {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .active-prescription {
            border-left-color: #198754;
        }

        .inactive-prescription {
            border-left-color: #6c757d;
        }

        .prescription-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #f8f9fa;
            border-top-right-radius: 0.75rem;
            border-top-left-radius: 0;
        }

        .prescription-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        .prescription-status {
            padding: 0.35rem 0.65rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .status-active {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-inactive {
            background-color: #e2e3e5;
            color: #41464b;
        }

        .prescription-body {
            padding: 1rem;
        }

        .prescription-detail {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .prescription-detail-label {
            font-size: 0.85rem;
            color: #6c757d;
            width: 100px;
        }

        .prescription-detail-value {
            font-weight: 500;
        }

        .prescription-date {
            font-size: 0.85rem;
            color: #6c757d;
            text-align: right;
            margin-top: 0.5rem;
        }

        .section-title {
            position: relative;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #343a40;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 50px;
            background-color: #0d6efd;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            border: 1px dashed #dee2e6;
        }

        .empty-icon {
            font-size: 2.5rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            box-shadow: 0 0.125rem 0.25rem rgba(13, 110, 253, 0.2);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-2px);
            box-shadow: 0 0.375rem 0.5rem rgba(13, 110, 253, 0.3);
        }

        .btn-danger {
            box-shadow: 0 0.125rem 0.25rem rgba(220, 53, 69, 0.2);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.375rem 0.5rem rgba(220, 53, 69, 0.3);
        }

        .search-input {
            border-radius: 50rem 0 0 50rem;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }

        .search-button {
            border-radius: 0 50rem 50rem 0;
            padding: 0.5rem 1.5rem;
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
        /* Adjust main content to account for the fixed sidebar */
        .main-content {
            min-height: 100vh;
        }

        /* For smaller screens where sidebar collapses */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                min-height: auto;
            }
        }
    </style>
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
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
                                <a href="doctor_absence_request.php" class="nav-link">
                                    <i class="bi bi-calendar-x"></i> Absence Requests
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="medications.php" class="nav-link active">
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


            <!-- Notification System -->
            <?php if (isset($_SESSION['alert_message'])): ?>
                <div class="notification-container" style="position: fixed; top: 80px; right: 20px; z-index: 1050; width: 350px;">
                    <div class="alert alert-<?php echo $_SESSION['alert_type']; ?> alert-dismissible fade show shadow" role="alert"
                        style="border-radius: 10px; border-left: 5px solid 
            <?php echo ($_SESSION['alert_type'] == 'success') ? '#28a745' : (($_SESSION['alert_type'] == 'danger') ? '#dc3545' : '#ffc107'); ?>; 
            animation: slideIn 0.5s ease-out forwards;">

                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <?php if ($_SESSION['alert_type'] == 'success'): ?>
                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                                <?php elseif ($_SESSION['alert_type'] == 'danger'): ?>
                                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 1.5rem;"></i>
                                <?php else: ?>
                                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 1.5rem;"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h5 class="alert-heading mb-1">
                                    <?php echo ($_SESSION['alert_type'] == 'success') ? 'Success!' : (($_SESSION['alert_type'] == 'danger') ? 'Error!' : 'Warning!'); ?>
                                </h5>
                                <p class="mb-0"><?php echo $_SESSION['alert_message']; ?></p>
                            </div>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>



                <script>
                    // Auto-dismiss the alert after 5 seconds
                    setTimeout(function() {
                        var alertElement = document.querySelector('.alert');
                        if (alertElement) {
                            var bsAlert = new bootstrap.Alert(alertElement);
                            bsAlert.close();
                        }
                    }, 5000);
                </script>

                <?php

                unset($_SESSION['alert_type']);
                unset($_SESSION['alert_message']);
                ?>
            <?php endif; ?>



            <!-- Main Content -->
            <div class="col-lg-10 content">
                <main class="py-4">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="mb-0"><i class="bi bi-prescription2 text-primary me-2"></i>Prescription Overview</h2>
                                </div>
                            </div>
                        </div>

                        <div id="search-section" class="search-container">
                            <div class="search-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h3 class="search-title">Find Patient Prescription</h3>
                            <p class="search-instruction">Enter the patient ID to view their medication details and prescription history</p>
                            <div class="input-group mb-3 mx-auto" style="max-width: 400px;">
                                <input type="number" id="patient-search" class="form-control search-input" placeholder="Enter Patient ID" aria-label="Patient ID">
                                <button class="btn btn-primary search-button" type="button" id="find_patient">
                                    <i class="bi bi-search me-1"></i> Search
                                </button>
                            </div>
                        </div>

                        <div id="datadisplay"></div>
                    </div>



                    <?php
                    // Get the doctor ID associated with the current user
                    $stmt1 = $connection->prepare("
               SELECT Doctor_ID
               FROM doctor
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
                  //we use distinct for preventing duplicated rows if exists
                       $stmt2 = $connection->prepare("
                       SELECT DISTINCT 
                       user.User_ID, 
                       user.Name 
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




                    <div class="card mb-4" id="prescription-form">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-prescription2 text-primary me-2"></i>Prescribe New Medication</h5>
                        </div>
                        <div class="card-body">
                            <form action="doctor_backend/medications.php" method="POST">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <label for="patientSelect" class="form-label mb-md-0">Patient:</label>
                                            </div>
                                            <div class="col-md-10">
                                                <select class="form-select" id="patientSelect" name="patientid">
                                                    <option value="">Choose patient</option>
                                                    <?php foreach ($Patients as $Patient) { ?>
                                                        <option value="<?php echo $Patient['User_ID']; ?>">
                                                            <?php echo $Patient['Name'] . " - ID:  " . $Patient['User_ID']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="med_name" class="form-label">Medication Name *</label>
                                        <input type="text" class="form-control" id="med_name" name="med_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dosage" class="form-label">Dosage</label>
                                        <input type="text" class="form-control" id="dosage" name="dosage" placeholder="e.g., 10mg">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="frequency" class="form-label">Frequency</label>
                                        <input type="text" class="form-control" id="frequency" name="frequency" placeholder="e.g., Twice daily">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label">From</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date">
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label">To</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="form" class="form-label">Form</label>
                                        <input type="text" class="form-control" id="form" name="form">
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="additional_notes" class="form-label">Additional Notes</label>
                                    <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3" placeholder="Special instructions or notes"></textarea>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-1"></i> Add Prescription
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>


                </main>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#find_patient").click(function() {
                var Patient_ID = $("#patient-search").val().trim();

                if (!Patient_ID) {
                    alert("Please enter a valid patient ID.");
                    return;
                }

                $.ajax({
                    url: "../assistant/assistant_backend/medications/fetchdata.php",
                    type: "POST",
                    data: {
                        Patient_ID: Patient_ID
                    },
                    success: function(response) {
                        $("#search-section").hide();
                        $("#datadisplay").html(response);

                        // back to search
                        $("#datadisplay").append(`
                            <div class="text-center mt-4 mb-5">
                                <button class="btn btn-outline-primary" id="back-to-search">
                                    <i class="bi bi-arrow-left me-1"></i> Back to Search
                                </button>
                            </div>
                        `);

                        // Add click button for the back button
                        $("#back-to-search").click(function() {
                            $("#datadisplay").empty();
                            $("#search-section").show();
                        });
                    },
                    error: function() {
                        alert("Error fetching data.");
                    }
                });
            });
        });
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Simple JavaScript for demonstration -->
    <script>
        // Activate tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>

</html>