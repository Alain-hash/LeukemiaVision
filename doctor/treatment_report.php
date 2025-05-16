<?php
session_start();
include("../database/db.php");


if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Doctor' || $_SESSION['user_Status'] != 'Active') {
    header("location:../unauthorised.php");
    exit();
}


if (isset($_GET['patient_id'])) {

    $patient_id = $_GET['patient_id'];
    $_SESSION['patient_id'] = $patient_id;

} elseif (isset($_SESSION['patient_id'])) {

    $patient_id = $_SESSION['patient_id']; 

} else {

    $no_selected_patient = 'No patient chosen, please go back to appointment page and choose your patient';
}




if (isset($_GET['patient_name'])) {

    $patient_name = $_GET['patient_name'];
    $_SESSION['patient_name'] = $patient_name;

} elseif (isset($_SESSION['patient_name'])) {

    $patient_name = $_SESSION['patient_name'];

} else {

    $patient_name = null;
}


if (isset($_GET['app_id'])) {

    $Appointment_ID = $_GET['app_id'];
    $_SESSION['Appointment_ID'] = $Appointment_ID;

} elseif (isset($_SESSION['Appointment_ID'])) {

    $Appointment_ID = $_SESSION['Appointment_ID'];
} else {
    $Appointment_ID ='';
}


$user_id = $_SESSION['user_id'];


if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
} else {
    $error = '';
}

if (isset($_SESSION['empty_field'])) {
    $empty_field = $_SESSION['empty_field'];
} else {
    $empty_field = '';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Portal - Patient Search</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
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


        .search-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .patient-data-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 500;
        }

        .blood-data,
        .treatment-data {
            border-left: 4px solid #0d6efd;
            padding-left: 15px;
            margin-top: 10px;
        }

        .treatment-data {
            border-left-color: #20c997;
        }

        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }

            .top-nav .navbar-brand {
                margin-left: 0;
            }
        }

        /* Additional styles for the report */
        .card {
            border-radius: 8px;
        }

        .card-header {
            border-radius: 8px 8px 0 0;
        }

        .signature-box {
            border-bottom: 1px solid #000;
            height: 60px;
            width: 200px;
        }

        .doctor-name {
            font-weight: bold;
        }

        /* Print-specific styles */
        @media print {

            .sidebar,
            form .btn,
            .search-section {
                display: none !important;
            }

            .print-container {
                margin: 0;
                width: 100%;
            }
        }

        /* Custom Message Alert Styling */
        .alert-custom {
            border: none;
            border-left: 4px solid #3366cc;
            background-color: #f8f9fa;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .alert-custom:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, #3366cc, #5c85d6);
        }

        .message-container {
            display: flex;
            align-items: center;
            padding: 15px;
        }

        .message-icon {
            font-size: 24px;
            color: #3366cc;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .message-content {
            flex-grow: 1;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            padding-right: 20px;
        }

        .alert-custom .btn-close {
            opacity: 0.7;
            transition: all 0.2s ease;
        }

        .alert-custom .btn-close:hover {
            opacity: 1;
        }

        /* Animation effect */
        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-custom {
            animation: fadeInSlide 0.4s ease-out forwards;
        }

        /* Error alert styling */
        .alert-error {
            border-left: 4px solid #dc3545;
        }

        .alert-error:before {
            background: linear-gradient(to bottom, #dc3545, #e76874);
        }

        .alert-error .message-icon {
            color: #dc3545;
        }

        .alert-error .message-content {
            color: #dc3545;
            font-weight: 500;
        }

        /* Highlight empty fields */
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        /* Add these styles to your existing <style> section in the head of your document */

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
                                <a href="test_report.php" class="nav-link ">
                                    <i class="bi bi-file-earmark-text"></i> Test Report
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="treatment_report.php" class="nav-link active">
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

            <?php
            //--------------get doctor ID----------------//
            $stmt = $connection->prepare("
            SELECT 
                Doctor_ID
            FROM doctor
            WHERE User_ID=?");

            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();


            $row = $result->fetch_assoc();
            $doctor_id = $row['Doctor_ID'];


            //--------------get all patient ID assign to the doctor in all appointments----------------//
            $stmt = $connection->prepare(" 
          SELECT
          Appointment_ID,
          Patient_ID 
          FROM appointment 
          WHERE Doctor_ID=? AND Status='Completed'
          ");

            $stmt->bind_param("i", $doctor_id);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>

            <!-- Main Content -->
            <div class="col-lg-10 col-md-12 p-4">
                <?php
                if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                    echo '<div class="alert alert-custom fade show" role="alert">
                <div class="message-container">
                <i class="bi bi-info-circle-fill message-icon"></i>
                <div class="message-content">' . $error . '</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>';
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['empty_field']) && !empty($_SESSION['empty_field'])) {
                    echo '<div class="alert alert-custom alert-error fade show" role="alert">
                <div class="message-container">
                <i class="bi bi-exclamation-triangle-fill message-icon"></i>
                <div class="message-content">' . $empty_field . '</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>';
                    unset($_SESSION['empty_field']);
                }

                if (isset($no_selected_patient) && !empty($no_selected_patient)) {
                    echo '<div class="alert alert-custom alert-error fade show" role="alert">
                <div class="message-container">
                <i class="bi bi-exclamation-triangle-fill message-icon"></i>
                <div class="message-content">' . $no_selected_patient . '</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>';
                    unset($no_selected_patient);
                }
                ?>


                <div class="container">
                    <!-- Page Header with Back Button -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="m-0 text-primary">
                            <i class="bi bi-file-earmark-medical me-2"></i>
                            <?= $patient_name ?>'s Treatment Report
                        </h2>
                        <a href="appointment.php" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>

                    <form action="doctor_backend/treatment_report_backend.php" method="post" id="reportForm">
                        <!-- Main Content Cards in Tabs -->
                        <ul class="nav nav-tabs mb-3" id="reportTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="analysis-tab" data-bs-toggle="tab" data-bs-target="#analysis" type="button" role="tab" aria-selected="true">
                                    <i class="bi bi-camera me-1"></i> Treatment information
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="blood-tab" data-bs-toggle="tab" data-bs-target="#blood" type="button" role="tab" aria-selected="false">
                                    <i class="bi bi-clipboard-data me-1"></i> Treatment Cycles
                                </button>
                            </li>

                        </ul>

                        <div class="tab-content" id="reportTabContent">
                            <!-- Treatment information -->
                            <div class="tab-pane fade show active" id="analysis" role="tabpanel">
                                <div class="card shadow-sm border-0 rounded-3">
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="resultDate" class="form-label">Result Date</label>
                                                <input type="date" class="form-control" id="resultDate" name="resultDate" value="<?php echo date('Y-m-d'); ?>">
                                            </div>

                                            <?php
                                            $stmt = $connection->prepare("SELECT Treatment_Name From treatment WHERE Appointment_ID=?");
                                            $stmt->bind_param("i", $Appointment_ID);
                                            $stmt->execute();
                                            $result1 = $stmt->get_result();
                                            ?>



                                            <?php
                                           
                                            if ($result1->num_rows > 0) {
                                                $row = $result1->fetch_assoc();
                                            ?>
                                                <div class="col-md-4">
                                                    <label for="treatmentName" class="form-label">Treatment Name</label>
                                                    <input type="text" class="form-control" id="treatmentName" name="treatmentName" value="<?php echo $row['Treatment_Name']; ?>" readonly>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-md-4">
                                                    <label for="treatmentName" class="form-label">Treatment Name</label>
                                                    <input type="text" class="form-control" id="treatmentName" name="treatmentName" placeholder="No treatment found" readonly>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-md-4">
                                                <label for="treatmentStartDate" class="form-label">Treatment Start Date</label>
                                                <input type="date" class="form-control" id="treatmentStartDate" name="treatmentStartDate" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="treatmentEndDate" class="form-label">Treatment End Date</label>
                                                <input type="date" class="form-control" id="treatmentEndDate" name="treatmentEndDate" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="treatmentOutcome" class="form-label">Treatment Outcome</label>
                                                <select class="form-select" id="treatmentOutcome" name="treatmentOutcome">
                                                    <option value="" selected disabled>Select outcome</option>
                                                    <option value="Complete Response">Complete Response</option>
                                                    <option value="Partial Response">Partial Response</option>
                                                    <option value="Stable Disease">Stable Disease</option>
                                                    <option value="Progressive Disease">Progressive Disease</option>
                                                    <option value="Unknown">Unknown</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="treatmentProgression" class="form-label">Treatment Progression</label>
                                                <select class="form-select" id="treatmentProgression" name="treatmentProgression">
                                                    <option value="" selected disabled>Select progression</option>
                                                    <option value="On Schedule">On Schedule</option>
                                                    <option value="Delayed">Delayed</option>
                                                    <option value="Modified">Modified</option>
                                                    <option value="Discontinued">Discontinued</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab 2: Treatment cycles -->
                            <div class="tab-pane fade" id="blood" role="tabpanel">
                                <div class="card shadow-sm border-0 rounded-3">
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="currentCycle" class="form-label">Current Cycle</label>
                                                <input type="number" min="0" class="form-control" id="currentCycle" name="currentCycle" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="totalCycles" class="form-label">Total Cycles</label>
                                                <input type="number" min="1" class="form-control" id="totalCycles" name="totalCycles" value="">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="nextCycleDate" class="form-label">Next Cycle Date</label>
                                                <input type="date" class="form-control" id="nextCycleDate" name="nextCycleDate" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Action Buttons - Fixed at Bottom -->
                        <div class="action-buttons fixed-bottom bg-light py-3 shadow-lg" style="z-index: 100;">
                            <div class="container d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Submit Report
                                </button>
                            </div>
                        </div>
                    </form>








                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        //function to handle diagnosis status

        document.addEventListener("DOMContentLoaded", function() {
            const yesRadio = document.getElementById("diagnosisYes");
            const noRadio = document.getElementById("diagnosisNo");
            const diagnosisDetails = document.getElementById("diagnosisDetails");

            function toggleDiagnosisDetails() {
                if (yesRadio.checked) {
                    diagnosisDetails.style.display = "flex";
                    diagnosisDetails.classList.add("g-3");
                } else {
                    diagnosisDetails.style.display = "none";
                }
            }

            yesRadio.addEventListener("change", toggleDiagnosisDetails);
            noRadio.addEventListener("change", toggleDiagnosisDetails);

            // Initial check (in case of pre-filled form)
            toggleDiagnosisDetails();
        });


        // Function to handle image analysis
        function analyzeImage() {
            const fileInput = document.getElementById('smearBloodImage');

            if (fileInput.files.length === 0) {
                alert('Please upload a blood smear image first.');
                return;
            }

            // Show loading indicator
            const analysisResult = document.getElementById('analysisResult');
            analysisResult.value = 'Analyzing image, please wait...';

            // Here you would typically send the image to your AI analysis service
            // For demonstration, we'll simulate a response after a delay
            setTimeout(() => {
                // This is a placeholder. In a real implementation, you would process the actual image
                analysisResult.value = 'Analysis complete: The blood smear shows an increased number of immature white blood cells (blasts) ' +
                    'consistent with acute leukemia. Approximately 25-30% blast cells observed with abnormal morphology. ' +
                    'Recommend full CBC panel and bone marrow biopsy for definitive diagnosis.';
            }, 2000);
        }


        // View image button handler
        document.getElementById('viewSmearBloodImage').addEventListener('click', function() {
            const fileInput = document.getElementById('smearBloodImage');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileURL = URL.createObjectURL(file);

                // Open image in a new window
                const imageWindow = window.open('', '_blank');
                imageWindow.document.write(`
            <html>
            <head>
                <title>Blood Smear Image</title>
                <style>
                    body { margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f8f9fa; }
                    img { max-width: 90%; max-height: 90vh; object-fit: contain; }
                    .container { text-align: center; }
                    h3 { font-family: Arial, sans-serif; color: #333; }
                </style>
            </head>
            <body>
                <div class="container">
                    <h3>Blood Smear Image</h3>
                    <img src="${fileURL}" alt="Blood Smear">
                </div>
            </body>
            </html>
        `);
            } else {
                alert('Please upload an image first.');
            }
        });
    </script>

    <style>

    </style>






    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize the Bootstrap modal outside the event listener
        document.addEventListener('DOMContentLoaded', function() {
            const searchButtons = document.querySelectorAll('.btn-primary[type="button"]');
            const searchResultsModal = new bootstrap.Modal(document.getElementById('searchResultsModal'));



            // Function to handle file uploads for blood smear images
            document.getElementById('smearBloodImage').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // In a real application, this would upload the file and display a preview
                    const fileNameDisplay = document.createElement('div');
                    fileNameDisplay.className = 'mt-2 text-muted';
                    fileNameDisplay.innerHTML = `<i class="bi bi-file-earmark-image"></i> ${file.name}`;

                    // Remove any previous filename display
                    const previousDisplay = this.parentElement.querySelector('.text-muted');
                    if (previousDisplay) {
                        previousDisplay.remove();
                    }

                    // Add the new filename display
                    this.parentElement.appendChild(fileNameDisplay);
                }
            });

            // Add event listener for the view button next to smear blood image
            document.getElementById('viewSmearBloodImage').addEventListener('click', function() {
                const fileInput = document.getElementById('smearBloodImage');
                if (fileInput.files.length > 0) {
                    // In a real application, this would display the image in a modal or viewer
                    alert('Image viewer would open here with the selected file.');
                } else {
                    alert('No image file selected.');
                }
            });
        });

        // Function to simulate AI analysis of the blood smear image
        function analyzeImage() {
            const fileInput = document.getElementById('smearBloodImage');
            if (fileInput.files.length === 0) {
                alert('Please upload a blood smear image first.');
                return;
            }

            // Simulate AI analysis (in a real application, this would involve sending the image to a backend service)
            const analysisResult = 'AI analysis result: Abnormal cells detected.';
            const cancerStage = 'Stage 2';
            const wbcCount = 12.5; // Example value
            const blastCellPercentage = 30; // Example value
            const hemoglobin = 10.2; // Example value
            const platelets = 150; // Example value

            document.getElementById('analysisResult').value = analysisResult;
            document.getElementById('cancerStage').value = cancerStage;
            document.getElementById('wbcCount').value = wbcCount;
            document.getElementById('blastCellPercentage').value = blastCellPercentage;
            document.getElementById('hemoglobin').value = hemoglobin;
            document.getElementById('platelets').value = platelets;
        }
    </script>


    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Report Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit this report? Once submitted:</p>
                    <ul>
                        <li>You cannot make changes to the report</li>
                        <li>The report will be sent to the patient via email</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm Submission</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the form element
            const form = document.getElementById('reportForm');

            // Add the submit event listener to the form
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Prevent the default form submission
                    e.preventDefault();

                    // Show the confirmation modal
                    const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    confirmationModal.show();

                    // Handle the confirmation button click
                    document.getElementById('confirmSubmit').addEventListener('click', function() {
                        // Submit the form
                        form.submit();
                    });
                });
            }
        });
    </script>
</body>

</html>