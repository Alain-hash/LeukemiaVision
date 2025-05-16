<?php

include("../../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Patient_ID = $_POST['Patient_ID'];

    $stmt = $connection->prepare(
        "SELECT 
            user.Name AS Patient_Name, 
            patient.Birth_Date, 
            patient.Gender, 
            patient.Blood_Type, 
            patient.Weight, 
            patient.Allergies, 
            patient.Existing_Conditions, 
            medications.Med_Name, 
            medications.Dosage, 
            medications.Frequency, 
            medications.Start_Date, 
            medications.End_Date, 
            medications.Status
        FROM patient
        JOIN user ON user.User_ID = patient.User_ID
        LEFT JOIN medications ON medications.Patient_ID = patient.Patient_ID
        WHERE patient.Patient_ID = ?;"
    );

    $stmt->bind_param("i", $Patient_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    $patient_info = [];
    $active_prescriptions = [];
    $history_prescriptions = [];  // Corrected: Ensure this array is initialized

    while ($row = $result->fetch_assoc()) {
        if (empty($patient_info)) {
            $patient_info = $row;
        }

        if (!empty($row['Med_Name'])) {
            if ($row['Status'] === 'Active') {
                $active_prescriptions[] = $row;
            } else {
                $history_prescriptions[] = $row;  // Corrected: Properly storing historical data
            }
        }
    }

    if (empty($patient_info)) {
        echo '<div class="alert alert-warning mt-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                    <div>
                        <h4 class="alert-heading">No Patient Found</h4>
                        <p class="mb-0">We couldn\'t find any patient with ID: ' . $Patient_ID . '. Please verify the ID and try again.</p>
                    </div>
                </div>
              </div>';
        exit;
    }

    // Calculate age from birthdate
    $birthdate = new DateTime($patient_info['Birth_Date']);
    $today = new DateTime();
    $age = $birthdate->diff($today)->y;
    $formatted_birth_date = date('M d, Y', strtotime($patient_info['Birth_Date']));
?>

    <!-- Patient Information Card -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-person-badge me-2"></i>Patient Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mb-3"><?= htmlspecialchars($patient_info['Patient_Name']) ?> <span class="badge bg-secondary ms-2">ID: <?= $Patient_ID ?></span></h3>

                    <div class="patient-info-grid">
                        <div class="patient-info-item">
                            <div class="patient-info-label">Age</div>
                            <div class="patient-info-value"><?= $age ?> years</div>
                        </div>
                        <div class="patient-info-item">
                            <div class="patient-info-label">Birth Date</div>
                            <div class="patient-info-value"><?= htmlspecialchars($formatted_birth_date) ?></div>
                        </div>
                        <div class="patient-info-item">
                            <div class="patient-info-label">Gender</div>
                            <div class="patient-info-value"><?= htmlspecialchars($patient_info['Gender']) ?></div>
                        </div>
                        <div class="patient-info-item">
                            <div class="patient-info-label">Blood Type</div>
                            <div class="patient-info-value"><?= htmlspecialchars($patient_info['Blood_Type']) ?></div>
                        </div>
                        <div class="patient-info-item">
                            <div class="patient-info-label">Weight</div>
                            <div class="patient-info-value"><?= htmlspecialchars($patient_info['Weight']) ?> kg</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Medical Alerts</h5>
                            <div class="mb-3">
                                <h6 class="mb-2"><i class="bi bi-bandaid-fill text-danger me-1"></i>Allergies:</h6>
                                <?php if ($patient_info['Allergies'] == 'None'): ?>
                                    <p class="text-muted"><i>No known allergies</i></p>
                                <?php else: ?>
                                    <p><?= htmlspecialchars($patient_info['Allergies']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h6 class="mb-2"><i class="bi bi-heart-pulse-fill text-danger me-1"></i>Existing Conditions:</h6>
                                <?php if ($patient_info['Existing_Conditions'] == 'None'): ?>
                                    <p class="text-muted"><i>No existing conditions</i></p>
                                <?php else: ?>
                                    <p><?= htmlspecialchars($patient_info['Existing_Conditions']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <!-- Active Prescriptions Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-gradient-success text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-capsule fs-3 me-3"></i>
                    <h4 class="mb-0">Current Prescriptions</h4>
                </div>
                <span class="badge bg-white text-success fs-6"><?= count($active_prescriptions) ?> Active</span>
            </div>
        </div>
        <div class="card-body">
            <?php if (!empty($active_prescriptions)) : ?>
                <div class="row">
                    <?php foreach ($active_prescriptions as $prescription) :
                        $start_date = date('M d, Y', strtotime($prescription['Start_Date']));
                        $end_date = !empty($prescription['End_Date']) ? date('M d, Y', strtotime($prescription['End_Date'])) : 'Ongoing';
                        
                        // Calculate days left if end date exists
                        $days_left = '';
                        if ($end_date !== 'Ongoing') {
                            $today = new DateTime();
                            $end = new DateTime($prescription['End_Date']);
                            $diff = $today->diff($end);
                            $days_left = $diff->days;
                            $expired = $today > $end;
                        }
                    ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-success prescription-card">
                                <div class="card-header bg-success bg-opacity-10 border-success">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 text-success fw-bold"><?= htmlspecialchars($prescription['Med_Name']) ?></h5>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="prescription-details">
                                        <div class="row mb-2">
                                            <div class="col-5 text-muted">Dosage:</div>
                                            <div class="col-7 fw-medium"><?= htmlspecialchars($prescription['Dosage']) ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-5 text-muted">Frequency:</div>
                                            <div class="col-7 fw-medium"><?= htmlspecialchars($prescription['Frequency']) ?></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-5 text-muted">Started:</div>
                                            <div class="col-7"><?= $start_date ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5 text-muted">Ends:</div>
                                            <div class="col-7">
                                                <?php if ($end_date === 'Ongoing'): ?>
                                                    <span class="badge bg-info">Ongoing</span>
                                                <?php else: ?>
                                                    <?= $end_date ?>
                                                    <?php if (isset($days_left)): ?>
                                                        <?php if ($expired): ?>
                                                            <span class="badge bg-danger ms-1">Expired</span>
                                                        <?php elseif ($days_left <= 5): ?>
                                                            <span class="badge bg-warning ms-1"><?= $days_left ?> days left</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-secondary ms-1"><?= $days_left ?> days left</span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <button class="btn btn-sm btn-outline-success w-100" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="View medication details">
                                        <i class="bi bi-eye me-1"></i> View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-3">
                        <i class="bi bi-clipboard-x" style="font-size: 3rem; color: #6c757d;"></i>
                    </div>
                    <h5>No Active Prescriptions</h5>
                    <p class="text-muted">This patient doesn't have any active medications at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Prescription History Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-gradient-secondary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-clock-history fs-3 me-3"></i>
                    <h4 class="mb-0">Prescription History</h4>
                </div>
                <span class="badge bg-white text-secondary fs-6"><?= count($history_prescriptions) ?> Records</span>
            </div>
        </div>
        <div class="card-body">
            <?php if (!empty($history_prescriptions)) : ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Medication</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($history_prescriptions as $prescription) :
                                $start_date = date('M d, Y', strtotime($prescription['Start_Date']));
                                $end_date = date('M d, Y', strtotime($prescription['End_Date']));
                                
                                // Calculate treatment duration
                                $start = new DateTime($prescription['Start_Date']);
                                $end = new DateTime($prescription['End_Date']);
                                $duration = $start->diff($end);
                                $duration_text = '';
                                
                                if ($duration->y > 0) {
                                    $duration_text .= $duration->y . 'y ';
                                }
                                if ($duration->m > 0) {
                                    $duration_text .= $duration->m . 'm ';
                                }
                                $duration_text .= $duration->d . 'd';
                            ?>
                                <tr>
                                    <td class="fw-medium"><?= htmlspecialchars($prescription['Med_Name']) ?></td>
                                    <td><?= htmlspecialchars($prescription['Dosage']) ?></td>
                                    <td><?= htmlspecialchars($prescription['Frequency']) ?></td>
                                    <td><?= $start_date ?></td>
                                    <td><?= $end_date ?></td>
                                    <td>
                                        <?php if ($prescription['Status'] === 'Completed') { ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger">Discontinued</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $duration_text ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-3">
                        <i class="bi bi-hourglass" style="font-size: 3rem; color: #6c757d;"></i>
                    </div>
                    <h5>No Prescription History</h5>
                    <p class="text-muted">This patient doesn't have any historical medication records.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
   

<?php
} else {
    echo '<div class="alert alert-info mt-4">Please enter a Patient ID.</div>';
}
?>