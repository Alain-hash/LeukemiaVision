<?php
session_start();
include("../database/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Doctor' || $_SESSION['user_Status'] != 'Active') {
    header("location:../unauthorised.php");
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject']);
    $reason = trim($_POST['reason']);
    $date = trim($_POST['date']);
    $user_id = $_SESSION['user_id'];
    $status = 'Pending';

    $validation_error = '';
    $success_message = '';


    $sql = "SELECT Doctor_ID FROM doctor WHERE User_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $doctor_id = $row['Doctor_ID'];
    }

    if (empty($subject) || empty($date) || empty($reason)) {
        $_SESSION['validation_error'] = 'All fields are required.';
    } elseif (!isset($doctor_id)) {
        $_SESSION['validation_error'] = 'Doctor information is missing.';
    } else {
        $sql_insert = "INSERT INTO absence (Subject, Date, Reason, Status, Doctor_ID) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $connection->prepare($sql_insert);
        $stmt_insert->bind_param("ssssi", $subject, $date, $reason, $status, $doctor_id);

        if ($stmt_insert->execute()) {
            $_SESSION['success_message'] = 'Your request has been sent successfully.';
        } else {
            $_SESSION['validation_error'] = 'Request failed to send: ' . $stmt_insert->error;
        }

        $stmt_insert->close();
    }
    $stmt->close();


    
    header("Location: doctor_absence_request.php");
    exit();
}


$validation_error = isset($_SESSION['validation_error']) ? $_SESSION['validation_error'] : '';
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';


unset($_SESSION['validation_error']);
unset($_SESSION['success_message']);


// Fetch doctor absence requests
$user_id = $_SESSION['user_id'];
$doctor_id = null;
$absenceRequests = array();

$doc_stmt = $connection->prepare("SELECT Doctor_ID FROM doctor WHERE User_ID = ?");
$doc_stmt->bind_param("i", $user_id);
$doc_stmt->execute();
$doc_result = $doc_stmt->get_result();

if ($doc_row = $doc_result->fetch_assoc()) {
    $doctor_id = $doc_row['Doctor_ID'];

    $stmt = $connection->prepare(
        "SELECT Subject, Date, Status FROM absence WHERE Doctor_ID = ?"
    );
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($request = $result->fetch_assoc()) {
        $absenceRequests[] = $request;
    }
    $stmt->close();
}
$doc_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Portal</title>
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
                                <a href="doctor_absence_request.php" class="nav-link active">
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

            <!-- Main Content Area -->
            <div class="col-lg-10 p-4">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col">
                            <h2><i class="bi bi-calendar-x"></i> Request Absence</h2>
                            <p class="text-muted">Submit your absence request for approval</p>
                        </div>
                    </div>

                    <?php if (!empty($validation_error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $validation_error; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <form id="absenceRequestForm" method="post" action="">
                                        <div class="mb-3">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Brief description of absence">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="Date" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="Date" name="date">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="reason" class="form-label">Reason for Absence</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="5" placeholder="Please provide details about your absence request"></textarea>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-primary">Submit Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Guidelines</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="bi bi-info-circle text-primary me-2"></i> Submit requests at least 7 days in advance</li>
                                        <li class="mb-2"><i class="bi bi-info-circle text-primary me-2"></i> Emergency absences should be reported by phone</li>
                                        <li class="mb-2"><i class="bi bi-info-circle text-primary me-2"></i> Provide detailed reason for proper evaluation</li>
                                        <li class="mb-2"><i class="bi bi-info-circle text-primary me-2"></i> You will receive email notification upon approval</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Your Absence Requests</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover shadow-sm rounded overflow-hidden">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th class="py-3 px-4 font-medium">Subject</th>
                                                    <th class="py-3 px-4 font-medium">Date</th>
                                                    <th class="py-3 px-4 font-medium">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($absenceRequests)): ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center py-4 text-muted fst-italic">No absence requests found.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($absenceRequests as $request): ?>
                                                        <tr class="border-bottom hover:bg-light transition-all">
                                                            <td class="py-3 px-4"><?php echo htmlspecialchars($request['Subject']); ?></td>
                                                            <td class="py-3 px-4"><?php echo htmlspecialchars($request['Date']); ?></td>
                                                            <td class="py-3 px-4">
                                                                <?php if ($request['Status'] == 'Approved' || $request['Status'] == 'Accepted'): ?>
                                                                    <span class="badge bg-success rounded-pill px-3 py-2"><?php echo htmlspecialchars($request['Status']); ?></span>
                                                                <?php elseif ($request['Status'] == 'Rejected'): ?>
                                                                    <span class="badge bg-danger rounded-pill px-3 py-2"><?php echo htmlspecialchars($request['Status']); ?></span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-warning rounded-pill px-3 py-2"><?php echo htmlspecialchars($request['Status']); ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
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
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>