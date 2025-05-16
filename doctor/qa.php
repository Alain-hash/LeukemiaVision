<?php
session_start();
include("../database/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Doctor' || $_SESSION['user_Status'] != 'Active') {
    header("location:../unauthorised.php");
    exit();
}


if (isset($_SESSION['searchResults']) && !empty($_SESSION['searchResults'])) {
    $searchResults = $_SESSION['searchResults'];
}


if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
}


if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
}

if (isset($_SESSION['requied_question_error'])) {
    $requied_question_error = $_SESSION['requied_question_error'];
}

if (isset($_SESSION['requied_answer_error'])) {
    $requied_answer_error = $_SESSION['requied_answer_error'];
}


$doctor_id = $_SESSION['doctor_id'];
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
                                <a href="qa.php" class="nav-link active">
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
            <div class="col-md-9 col-lg-10 p-0 main-content">
                <!-- Top Navigation -->
                <div class="row p-3 mb-4 bg-white shadow-sm m-0">
                    <div class="col-md-6">
                        <h4>Q&A Portal Management</h4>
                    </div>

                </div>

                <!-- Q&A Management Area -->
                <div class="container-fluid px-4">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" id="qaTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-qa-tab" data-bs-toggle="tab" data-bs-target="#all-qa" type="button" role="tab" aria-controls="all-qa" aria-selected="true">
                                All Q&As
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="add-qa-tab" data-bs-toggle="tab" data-bs-target="#add-qa" type="button" role="tab" aria-controls="add-qa" aria-selected="false">
                                Add New Q&A
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="qaTabContent">
                        <!-- All Q&As Tab -->
                        <div class="tab-pane fade show active" id="all-qa" role="tabpanel" aria-labelledby="all-qa-tab">
                            <form action="doctor_backend/search_qa.php" method="post">
                                <!-- Add this alert right before the search and filter row in the "all-qa" tab -->
                                <div class="alert alert-info mb-4">
                                    <i class="bi bi-info-circle-fill me-2"></i>
                                    <strong>Privacy Notice:</strong> You can only edit or delete Q&A entries that you've created. Edit and delete buttons for entries created by other doctors will appear disabled to maintain privacy and ownership of content.
                                </div>

                                <!-- Search and Filter -->
                                <div class="row mb-4">

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Category..." name="questionsearch">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if (isset($_SESSION['success_message'])): ?>
                                            <div class="alert alert-success mb-0 py-2">
                                                <?php
                                                echo $_SESSION['success_message'];
                                                unset($_SESSION['success_message']);
                                                ?>
                                            </div>
                                        <?php endif ?>

                                        <?php if (isset($_SESSION['requied_fields'])): ?>
                                            <div class="alert alert-danger mb-0 py-2">
                                                <?php
                                                echo $_SESSION['requied_fields'];
                                                unset($_SESSION['requied_fields']);
                                                ?>
                                            </div>
                                        <?php endif ?>


                                    </div>
                                </div>
                                <?php if (isset($emptysearch) && !empty($emptysearch)) {
                                    echo $emptysearch;
                                } ?>
                            </form>

                            <!-- Display search results or error messages -->
                            <?php if (isset($_SESSION['searchResults']) && !empty($_SESSION['searchResults'])): ?>
                                <div class="alert alert-info mt-3">
                                    Search results: <?php echo count($_SESSION['searchResults']); ?> question(s) found
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <?php foreach ($_SESSION['searchResults'] as $qa):

                                        ?>
                                            <div class="card mb-4 qa-item">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h5 class="card-title question-text"><?php echo htmlspecialchars($qa['Question']); ?></h5>
                                                        <span class="badge <?php echo ($qa['Status'] == 'Published') ? 'bg-success' : 'bg-secondary'; ?> status-badge">
                                                            <?php echo $qa['Status']; ?>
                                                        </span>
                                                    </div>
                                                    <p class="card-text answer-text"><?php echo htmlspecialchars($qa['Answer']); ?></p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            Category: <?php echo htmlspecialchars($qa['Category']); ?> |
                                                            Last updated: <?php echo date('M j, Y', strtotime($qa['LastUpdated'])); ?>
                                                        </small>
                                                        <div>
                                                            <?php if ($qa['Doctor_ID'] != $_SESSION['doctor_id']): ?>
                                                                <div>
                                                                    <button class="btn btn-outline-primary btn-sm edit-qa-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editQAModal" disabled>
                                                                        <i class="fas fa-edit me-1"></i>Edit
                                                                    </button>
                                                                    <button class="btn btn-outline-danger btn-sm ms-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteConfirmModal" disabled>
                                                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                                                    </button>
                                                                </div>
                                                            <?php else: ?>
                                                                <div>
                                                                    <button class="btn btn-outline-primary btn-sm edit-qa-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editQAModal"
                                                                        data-qa-id="<?php echo $qa['QA_ID']; ?>"
                                                                        data-question="<?php echo htmlspecialchars($qa['Question']); ?>"
                                                                        data-answer="<?php echo htmlspecialchars($qa['Answer']); ?>"
                                                                        data-status="<?php echo $qa['Status']; ?>">
                                                                        <i class="fas fa-edit me-1"></i>Edit
                                                                    </button>
                                                                    <button class="btn btn-outline-danger btn-sm ms-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteConfirmModal"
                                                                        data-qa-id="<?php echo $qa['QA_ID']; ?>">
                                                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                                                    </button>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>



                            <?php elseif (isset($_SESSION['errorMessage'])): ?>
                                <div class="alert alert-warning mt-3">
                                    <?php
                                    echo $_SESSION['errorMessage'];
                                    unset($_SESSION['errorMessage']);
                                    ?>
                                </div>



                            <?php else:
                                $sql = "SELECT 
                                Doctor_ID,
                                QA_ID,
                                Question,
                                Answer, 
                                Status,
                                Category,
                                LastUpdated
                                FROM q_a WHERE Status IN ('Drafted', 'Published')";
                                $stmt = $connection->prepare($sql);

                                if ($stmt) {
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $searchResults = [];
                                    while ($row = $result->fetch_assoc()) {

                                        $searchResults[] = $row;
                                    }

                                    $_SESSION['searchResults'] = $searchResults;
                                }
                            ?>


                                <div class="row">
                                    <div class="col-12">
                                        <?php foreach ($_SESSION['searchResults'] as $qa): ?>
                                            <div class="card mb-4 qa-item">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h5 class="card-title question-text"><?php echo htmlspecialchars($qa['Question']); ?></h5>
                                                        <span class="badge <?php echo ($qa['Status'] == 'Published') ? 'bg-success' : 'bg-secondary'; ?> status-badge">
                                                            <?php echo $qa['Status']; ?>
                                                        </span>
                                                    </div>
                                                    <p class="card-text answer-text"><?php echo htmlspecialchars($qa['Answer']); ?></p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            Category: <?php echo htmlspecialchars($qa['Category']); ?> |
                                                            Last updated: <?php echo date('M j, Y', strtotime($qa['LastUpdated'])); ?>
                                                        </small>

                                                        <?php if ($qa['Doctor_ID'] != $_SESSION['doctor_id']): ?>
                                                            <div>
                                                                <button class="btn btn-outline-primary btn-sm edit-qa-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editQAModal" disabled>
                                                                    <i class="fas fa-edit me-1"></i>Edit
                                                                </button>
                                                                <button class="btn btn-outline-danger btn-sm ms-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteConfirmModal" disabled>
                                                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                                                </button>
                                                            </div>
                                                        <?php else: ?>
                                                            <div>
                                                                <button class="btn btn-outline-primary btn-sm edit-qa-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editQAModal"
                                                                    data-qa-id="<?php echo $qa['QA_ID']; ?>"
                                                                    data-question="<?php echo htmlspecialchars($qa['Question']); ?>"
                                                                    data-answer="<?php echo htmlspecialchars($qa['Answer']); ?>"
                                                                    data-status="<?php echo $qa['Status']; ?>">
                                                                    <i class="fas fa-edit me-1"></i>Edit
                                                                </button>
                                                                <button class="btn btn-outline-danger btn-sm ms-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteConfirmModal"
                                                                    data-qa-id="<?php echo $qa['QA_ID']; ?>">
                                                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                                                </button>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div> 

                        <!-- Add New Q&A Tab -->
                        <div class="tab-pane fade" id="add-qa" role="tabpanel" aria-labelledby="add-qa-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Create New Q&A</h5>
                                    <form id="addQAForm" action="doctor_backend/new_qa.php" method="post">
                                        <div class="mb-3">
                                            <label for="Category" class="form-label">Category</label>
                                            <input type="text" class="form-control" id="Category" placeholder="Enter the Category" name="category">
                                        </div>
                                        <div class="mb-3">
                                            <label for="qaQuestion" class="form-label">Question</label>
                                            <input type="text" class="form-control" id="qaQuestion" placeholder="Enter the question" name="question">
                                        </div>
                                        <div class="mb-3">
                                            <label for="qaAnswer" class="form-label">Answer</label>
                                            <textarea class="form-control" id="qaAnswer" rows="6" placeholder="Enter detailed answer" name="answer"></textarea>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="submit" name="action" value="draft" class="btn btn-outline-secondary">Save as Draft</button>
                                                <button type="submit" name="action" value="publish" class="btn btn-primary">Publish Q&A</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>




                    </div>



                </div>
            </div>
        </div>
    </div>



    <!-- edit Q&A  -->
    <div class="modal fade" id="editQAModal" tabindex="-1" aria-labelledby="editQAModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQAModalLabel">Edit Q&A</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editQAForm" action="doctor_backend/edit_qa.php" method="post">
                        <input type="hidden" id="editQaId" name="qa_id">
                        <div class="mb-3">
                            <label for="editQaQuestion" class="form-label">Question</label>
                            <input type="text" class="form-control" id="editQaQuestion" name="question">
                        </div>
                        <div class="mb-3">

                            <label for="editQaAnswer" class="form-label">Answer</label>
                            <textarea class="form-control" id="editQaAnswer" name="answer" rows="6" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="editPublishStatus" name="status">
                                <label class="form-check-label" for="editPublishStatus">
                                    Publish
                                </label>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="editQAForm" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Q&A? This action cannot be undone.</p>
                    <form id="deleteQAForm" action="doctor_backend/delete_qa.php" method="post">
                        <input type="hidden" id="deleteQaId" name="qa_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="deleteQAForm" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- jQuery for AJAX operations in a real implementation -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script for handling Q&A operations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tabs
            var tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');
            tabElements.forEach(function(tabEl) {
                tabEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    var tab = new bootstrap.Tab(tabEl);
                    tab.show();
                });
            });

            // Sidebar navigation
            var sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    sidebarItems.forEach(function(el) {
                        el.classList.remove('active');
                    });
                    item.classList.add('active');
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tabs
            var tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');
            tabElements.forEach(function(tabEl) {
                tabEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    var tab = new bootstrap.Tab(tabEl);
                    tab.show();
                });
            });

            // Handle Edit Q&A Modal
            document.querySelectorAll('.edit-qa-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Get data from button attributes
                    const qaId = this.getAttribute('data-qa-id');
                    const question = this.getAttribute('data-question');
                    const answer = this.getAttribute('data-answer');
                    const status = this.getAttribute('data-status');

                    // Set values in the modal form
                    document.getElementById('editQaId').value = qaId;
                    document.getElementById('editQaQuestion').value = question;
                    document.getElementById('editQaAnswer').value = answer;
                    document.getElementById('editPublishStatus').checked = (status === 'Published');
                });
            });

            // Sidebar navigation
            var sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    sidebarItems.forEach(function(el) {
                        el.classList.remove('active');
                    });
                    item.classList.add('active');
                });
            });

            // Handle delete Q&A Modal
            document.querySelectorAll('[data-bs-target="#deleteConfirmModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const qaId = this.getAttribute('data-qa-id');
                    document.getElementById('deleteQaId').value = qaId;
                });
            });
        });
    </script>
    <?php
    unset($_SESSION['searchResults']);
    ?>
</body>

</html>