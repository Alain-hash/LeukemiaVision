<?php 
session_start();

if(!isset($_SESSION['user_id']) && $_SESSION['Role']!='Assistant'){
    header("location:../../login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/doctordashboard.css">
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


            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 py-5 main-content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Main content will go here -->
                        <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Your Schedule</h4>

                                </div>
                                <div class="card-body">
                                    <!-- Date Navigation -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <button class="btn btn-outline-primary">
                                            <i class="bi bi-chevron-left me-2"></i>Previous day
                                        </button>
                                        <h5 class="mb-0 fw-bold">Friday March-28</h5>
                                        <button class="btn btn-outline-primary">
                                            Next day<i class="bi bi-chevron-right ms-2"></i>
                                        </button>
                                    </div>

                                    <!-- Schedule Search/Filter -->
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Date Range</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="bi bi-calendar"></i></span>
                                                        <input type="date" class="form-control" value="2025-03-18">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tuesday Schedule -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-white">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 fw-bold">Tuesday, 18 March 2025</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">01:10
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">01:50
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">01:55
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">02:00
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">02:05
                                                        PM</button>
                                                </div>
                                            </div>
                                            <div class="row g-2 mt-2">
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">02:50
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">02:55
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:00
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:25
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:30
                                                        PM</button>
                                                </div>
                                            </div>
                                            <div class="row g-2 mt-2">
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:35
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:40
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:45
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:50
                                                        PM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">03:55
                                                        PM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Friday Schedule -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-white">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 fw-bold">Friday, 21 March 2025</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">09:50
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">09:55
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:00
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:05
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:10
                                                        AM</button>
                                                </div>
                                            </div>
                                            <div class="row g-2 mt-2">
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:15
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:15
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:20
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:25
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:30
                                                        AM</button>
                                                </div>
                                                <div class="col d-grid">
                                                    <button class="btn btn-outline-primary p-3 text-center">10:35
                                                        AM</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Advanced Schedule Settings (Static) -->
                                    <div class="card mb-4 static-schedule-settings">
                                        <div class="card-header bg-white">
                                            <h5 class="mb-0 fw-bold">Schedule Settings</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Default Appointment Duration</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">15</span>
                                                        <span class="input-group-text">minutes</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Buffer Time Between
                                                        Appointments</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">5</span>
                                                        <span class="input-group-text">minutes</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Working Hours Start</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">09:00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Working Hours End</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">17:00</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Default Working Days</label>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="form-check me-3">
                                                            <label class="form-check-label">Monday</label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <label class="form-check-label">Tuesday</label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <label class="form-check-label">Wednesday</label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <label class="form-check-label">Thursday</label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <label class="form-check-label">Friday</label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <label class="form-check-label">Saturday</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">Sunday</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Appointment Types</label>
                                                    <div class="card border">
                                                        <div class="card-body p-2">
                                                            <div class="d-flex flex-column gap-1">
                                                                <span>Regular Checkup (15 min)</span>
                                                                <span>New Patient Consultation (30 min)</span>
                                                                <span>Follow-up Visit (10 min)</span>
                                                                <span>Emergency Consultation (20 min)</span>
                                                                <span>Procedure (45 min)</span>
                                                                <span>Lab Results Review (15 min)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="form-label">Break Periods</label>
                                                    <div class="card border">
                                                        <div class="card-body">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-3">
                                                                <div>Lunch Break: 12:00 PM - 01:00 PM</div>
                                                            </div>
                                                            <div
                                                                class="d-flex justify-content-between align-items-center">
                                                                <div>Coffee Break: 03:00 PM - 03:15 PM</div>
                                                            </div>
                                                            <hr>
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
        </div>
    </main>
    </div>
    </div>

    <!-- Time Slot Modal -->
    <div class="modal fade" id="timeSlotModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Time Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" value="2025-03-18">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Start Time</label>
                                <input type="time" class="form-control" value="09:00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Time</label>
                                <input type="time" class="form-control" value="09:15">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Appointment Type</label>
                            <select class="form-select">
                                <option>Any Type</option>
                                <option>Regular Checkup</option>
                                <option>New Patient Consultation</option>
                                <option>Follow-up Visit</option>
                                <option>Emergency Consultation</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Optional notes about this time slot"></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="recurringSlot">
                            <label class="form-check-label" for="recurringSlot">
                                Make this a recurring time slot
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Time Slot</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Block Day Modal -->
    <div class="modal fade" id="blockDayModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Block Day</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" value="2025-03-18">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason</label>
                            <select class="form-select">
                                <option>Vacation</option>
                                <option>Conference</option>
                                <option>Training</option>
                                <option>Personal Leave</option>
                                <option>Medical Leave</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Additional details"></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="notifyPatients" checked>
                            <label class="form-check-label" for="notifyPatients">
                                Notify patients with existing appointments
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Block Day</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle mobile sidebar
            const hamburgerMenu = document.getElementById('hamburgerMenu');
            const mobileSidebar = document.getElementById('mobileSidebar');
            const closeSidebar = document.getElementById('closeSidebar');

            hamburgerMenu.addEventListener('click', function () {
                mobileSidebar.style.display = 'block';
            });

            closeSidebar.addEventListener('click', function () {
                mobileSidebar.style.display = 'none';
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', function (event) {
                if (mobileSidebar.style.display === 'block' && !mobileSidebar.contains(event.target) && !hamburgerMenu.contains(event.target)) {
                    mobileSidebar.style.display = 'none';
                }
            });

            // Sidebar navigation
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('click', function () {
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    // Redirect to different pages based on the data-target attribute
                    const targetPage = this.dataset.target;
                    switch (targetPage) {
                        case 'dashboard':
                            window.location.href = 'homepage.html';
                            break;
                        case 'manage-account':
                            window.location.href = 'account.html';
                            break;
                        case 'manage-schedule':
                            window.location.href = 'schedule.html';
                            break;
                        case 'patient-appointments':
                            window.location.href = 'appointment.html';
                            break;
                        case 'medications':
                            window.location.href = 'medications.html';
                            break;
                        case 'patient-progress':
                            window.location.href = 'progress.html';
                            break;
                        case 'reports':
                            window.location.href = 'reports.html';
                            break;
                        case 'qa':
                            window.location.href = 'qa.html';
                            break;
                        case 'logout':
                            window.location.href = 'logout.php';
                            break;
                        default:
                            console.log(`No page defined for target: ${targetPage}`);
                    }
                });
            });

            // Initialize Chart.js
            const ctx = document.getElementById('patientProgressChart').getContext('2d');
            const patientProgressChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [
                        {
                            label: 'Patient Recovery Rate',
                            data: [65, 72, 68, 75, 82, 88],
                            borderColor: '#3498db',
                            backgroundColor: 'rgba(52, 152, 219, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Treatment Effectiveness',
                            data: [70, 75, 72, 78, 85, 90],
                            borderColor: '#1abc9c',
                            backgroundColor: 'rgba(26, 188, 156, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Treatment Outcomes (Last 6 Months)'
                        }
                    }
                }
            });
        });
    </script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Example JS to handle time slot clicks
        document.querySelectorAll('.btn-outline-primary').forEach(button => {
            if (button.textContent.includes(':')) {  // Only target time buttons
                button.addEventListener('click', function () {
                    // Toggle selected state
                    this.classList.toggle('btn-outline-primary');
                    this.classList.toggle('btn-primary');
                });
            }
        });

        // Example JS to open modal on "Add Time Slot" button click
        document.querySelectorAll('[class*="btn-sm btn-outline-primary"]').forEach(button => {
            if (button.innerHTML.includes('Add Time Slot')) {
                button.addEventListener('click', function () {
                    var timeSlotModal = new bootstrap.Modal(document.getElementById('timeSlotModal'));
                    timeSlotModal.show();
                });
            }
        });

        // Example JS to open modal on "Block Day" button click
        document.querySelectorAll('[class*="btn-sm btn-outline-danger"]').forEach(button => {
            if (button.innerHTML.includes('Block Day')) {
                button.addEventListener('click', function () {
                    var blockDayModal = new bootstrap.Modal(document.getElementById('blockDayModal'));
                    blockDayModal.show();
                });
            }
        });
    </script>
</body>

</html>