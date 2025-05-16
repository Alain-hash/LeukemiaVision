<?php
session_start();
include("../database/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Assistant' || $_SESSION['user_Status'] != 'Active') {
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
    <title>Assistant Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
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

        .status-scheduled {
            background-color: #ffeeba;
            color: #856404;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .instructions-card {
            background-color: #e7f3ff;
            border-left: 4px solid #0d6efd;
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
                                <a href="appointment.php" class="nav-link active">
                                    <i class="bi bi-calendar-check"></i> Appointments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="doctor_absence.php" class="nav-link">
                                    <i class="bi bi-calendar-x"></i> Absence 
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
                 SELECT DISTINCT user.User_ID,
                 user.Name,
                 appointment.Appointment_ID,
                 appointment.App_Date,
                 appointment.App_Time,
                 appointment.Status
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
            <!-- Main Content -->
            <div class="col-lg-10 content">
                <div class="container-fluid">
                    <div class="row p-3 mb-4 bg-white shadow-sm">
                          <!-- Instructions Card -->
                    <div class="card mb-4 instructions-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-info-circle me-2"></i>Instructions
                            </h5>
                            <p class="card-text">
                                Below is a list of all patient appointments with your Doctor. Please note:
                            </p>
                            <ul>
                                <li>To assign completion of an appointment, click on the <i class="bi bi-clipboard-check"></i> "mark as completed" button in the Actions column.</li>
                                <li>Your assigned doctor can only make reports for completed appointments.</li>
                                <li>Appointments marked as "Scheduled" or "Cancelled" cannot have reports created.</li>
                            </ul>
                        </div>
                    </div>
                    </div>

                 
                    <?php
                    if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>' . $_SESSION['success'] . '</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

                        unset($_SESSION['success']);
                    }
                    ?>
                    <!-- Appointments Table -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Patient ID</th>
                                            <th>Patient Name</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Patients as $Patient) { ?>
                                            <tr>
                                                <td>PLV-<?= $Patient['User_ID'] ?></td>
                                                <td><?= $Patient['Name'] ?></td>
                                                <td><?= $Patient['App_Date'] ?></td>
                                                <td><?= $Patient['App_Time'] ?></td>
                                                <?php
                                                if ($Patient['Status'] == 'Cancelled') { ?>
                                                    <td><span class="badge status-cancelled px-3 py-2"><?= $Patient['Status'] ?></span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" disabled><i class="bi bi-clipboard-check"></i></button>
                                                    </td>
                                                <?php } elseif ($Patient['Status'] == 'Scheduled') { ?>

                                                    <td><span class="badge status-scheduled px-3 py-2"><?= $Patient['Status'] ?></span></td>

                                                    <td>
                                                        <form action="assistant_backend/mark_as_completed.php" method="POST" style="display:inline;">
                                                            <input type="hidden" name="Appointment_ID" value="<?= $Patient['Appointment_ID'] ?>">
                                                            <button class="btn btn-sm btn-outline-primary" title="Mark as completed">
                                                                <i class="bi bi-clipboard-check"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                <?php } elseif ($Patient['Status'] == 'Completed') { ?>
                                                    <td><span class="badge status-completed px-3 py-2"><?= $Patient['Status'] ?></span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary" disabled><i class="bi bi-clipboard-check"></i></button>
                                                    </td>
                                                <?php } else { ?>
                                                    <td><span class="badge bg-secondary text-white px-3 py-2"><?= $Patient['Status'] ?></span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"><i class="bi bi-clipboard-check"></i></button>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <?php if (empty($Patients)): ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No appointments found</td>
                                            </tr>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>