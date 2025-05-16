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
    <title>LeukemiaVision - Doctor Account</title>
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
        
        /* Profile styles */
        .profile-header {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .profile-picture {
            position: relative;
            margin-bottom: 20px;
        }
        
        .profile-picture img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .profile-picture .edit-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #0d6efd;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .profile-picture .edit-icon:hover {
            background-color: #0b5ed7;
            transform: scale(1.1);
        }
        
        .info-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .info-icon i {
            font-size: 24px;
            color: #0d6efd;
        }
        
        .info-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: #212529;
        }
        
        .badge-specialty {
            background-color: #0d6efd;
            color: white;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .rating-stars i {
            color: #ffc107;
            font-size: 18px;
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
            <?php
                if (isset($accountData['profile_image']) && !empty($accountData['profile_image'])) {
                    echo '<img src="..'.htmlspecialchars($accountData['profile_image']).'" alt="Doctor Profile" class="shadow">';
                } else {
                    echo '<img src="../assets/img/default_profile_image.png" alt="Doctor Profile" class="shadow">';
                }
                ?>
                
            </div>
        </div>
    </div>
</div>


    <!-- Edit Profile Picture Modal -->
    <div class="modal fade" id="editProfilePictureModal" tabindex="-1" aria-labelledby="editProfilePictureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfilePictureModalLabel">Update Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="doctor_backend/account/update-profile-pic.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Choose a new profile picture</label>
                            <input class="form-control" type="file" id="profileImage" name="profileImage" accept="image/*" required>
                            <div class="form-text">Accepted formats: JPG, JPEG, PNG, GIF</div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Upload New Picture</button>
                        </div>
                    </form>
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
                                <a href="homepage.php" class="nav-link ">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="account.php" class="nav-link active">
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
                <div class="container-fluid">
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0 text-primary fw-bold">
                            <i class="bi bi-person-circle me-2"></i>Doctor Account
                        </h2>
                        
                        <!-- Display success or error messages if set -->
                        <?php if(isset($_SESSION['upload_success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['upload_success']; unset($_SESSION['upload_success']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(isset($_SESSION['upload_error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['upload_error']; unset($_SESSION['upload_error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Profile Header -->
                    <div class="profile-header mb-4">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="profile-picture">
                                    <img src="<?php echo '..'.htmlspecialchars($accountData['profile_image']); ?>" alt="Doctor Profile" class="shadow">
                                    <div class="edit-icon shadow" data-bs-toggle="modal" data-bs-target="#editProfilePictureModal">
                                        <i class="bi bi-pencil"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex flex-column h-100 justify-content-center">
                                    <h3 class="mb-1 fw-bold"><?php echo htmlspecialchars($accountData['doctorname']); ?></h3>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge-specialty me-3">
                                            <i class="bi bi-star-fill me-1"></i>
                                            <?php echo htmlspecialchars($accountData['Specialization']); ?>
                                        </span>
                                        <div class="rating-stars">
                                            <?php
                                            $rating = isset($accountData['Rating']) ? (int)$accountData['Rating'] : 0;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="bi bi-star-fill"></i>';
                                                } else {
                                                    echo '<i class="bi bi-star"></i>';
                                                }
                                            }
                                            ?>
                                            <span class="ms-1 text-muted">(<?php echo $rating; ?>/5)</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-envelope text-primary me-2"></i>
                                            <span><?php echo htmlspecialchars($accountData['Email']); ?></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-building text-primary me-2"></i>
                                            <span>Clinic: <?php echo htmlspecialchars($accountData['clinic_name']); ?></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people text-primary me-2"></i>
                                            <span>Assistants: <?php echo htmlspecialchars($accountData['assistant_count']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Information Cards -->
                    <div class="row g-4">
                        <!-- License Number -->
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="bi bi-card-text"></i>
                                </div>
                                <div class="info-label">License Number</div>
                                <div class="info-value"><?php echo htmlspecialchars($accountData['License_Number']); ?></div>
                            </div>
                        </div>
                        
                        
                        
                        <!-- Account Creation Date -->
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                                <div class="info-label">Account Created</div>
                                <div class="info-value">
                                    <?php 
                                    $creationDate = new DateTime($accountData['Account_Creation_Date']);
                                    echo $creationDate->format('F j, Y'); 
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Specialization -->
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="bi bi-stars"></i>
                                </div>
                                <div class="info-label">Specialization</div>
                                <div class="info-value"><?php echo htmlspecialchars($accountData['Specialization']); ?></div>
                            </div>
                        </div>
                        
                        <!-- Clinical Institution -->
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="bi bi-hospital"></i>
                                </div>
                                <div class="info-label">Clinical Institution</div>
                                <div class="info-value"><?php echo htmlspecialchars($accountData['clinic_name']); ?></div>
                            </div>
                        </div>
                        
                        <!-- Assistants Count -->
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="info-label">Number of Assistants</div>
                                <div class="info-value"><?php echo htmlspecialchars($accountData['assistant_count']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Show alert messages for 5 seconds then fade out
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>