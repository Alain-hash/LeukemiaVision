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
    $history_prescriptions = [];  

    while ($row = $result->fetch_assoc()) {
        if (empty($patient_info)) {
            $patient_info = $row;
        }

        if (!empty($row['Med_Name'])) {
            if ($row['Status'] === 'Active') {
                $active_prescriptions[] = $row;
            } else {
                $history_prescriptions[] = $row;  
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

  
    $birthdate = new DateTime($patient_info['Birth_Date']);
    $today = new DateTime();
    $age = $birthdate->diff($today)->y;
    $formatted_birth_date = date('M d, Y', strtotime($patient_info['Birth_Date']));
?>

    <!-- Patient Information Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-gradient-primary text-primary py-3">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-badge fs-3 me-3"></i>
                <h4 class="mb-0">Patient Information</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-3">
                        <div class="patient-avatar me-3">
                            <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1"><?= htmlspecialchars($patient_info['Patient_Name']) ?></h3>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">ID: <?= $Patient_ID ?></span>
                                <span class="text-muted"><?= $age ?> years old</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card p-3 rounded bg-light">
                                <div class="text-primary mb-1"><i class="bi bi-calendar-date me-2"></i>Birth Date</div>
                                <div class="fs-5 fw-medium"><?= htmlspecialchars($formatted_birth_date) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card p-3 rounded bg-light">
                                <div class="text-primary mb-1"><i class="bi bi-gender-ambiguous me-2"></i>Gender</div>
                                <div class="fs-5 fw-medium"><?= htmlspecialchars($patient_info['Gender']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card p-3 rounded bg-light">
                                <div class="text-primary mb-1"><i class="bi bi-droplet-fill me-2"></i>Blood Type</div>
                                <div class="fs-5 fw-medium"><?= htmlspecialchars($patient_info['Blood_Type']) ?></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="info-card p-3 rounded bg-light">
                                <div class="text-primary mb-1"><i class="bi bi-speedometer2 me-2"></i>Weight</div>
                                <div class="fs-5 fw-medium"><?= htmlspecialchars($patient_info['Weight']) ?> kg</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-warning">
                        <div class="card-header bg-warning bg-opacity-25 border-warning">
                            <h5 class="card-title mb-0"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Medical Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="text-danger d-flex align-items-center mb-2">
                                    <i class="bi bi-bandaid-fill me-2"></i>Allergies
                                </h6>
                                <?php if ($patient_info['Allergies'] == 'None'): ?>
                                    <p class="text-muted"><i>No known allergies</i></p>
                                <?php else: ?>
                                    <p class="alert alert-danger py-2"><?= htmlspecialchars($patient_info['Allergies']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h6 class="text-danger d-flex align-items-center mb-2">
                                    <i class="bi bi-heart-pulse-fill me-2"></i>Existing Conditions
                                </h6>
                                <?php if ($patient_info['Existing_Conditions'] == 'None'): ?>
                                    <p class="text-muted"><i>No existing conditions</i></p>
                                <?php else: ?>
                                    <p class="alert alert-danger py-2"><?= htmlspecialchars($patient_info['Existing_Conditions']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- Active Prescriptions Section -->
 <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="bi bi-capsule me-2"></i>Current Prescriptions</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($active_prescriptions)) : ?>
                <div class="row">
                    <?php foreach ($active_prescriptions as $prescription) :
                        $start_date = date('M d, Y', strtotime($prescription['Start_Date']));
                        $end_date = !empty($prescription['End_Date']) ? date('M d, Y', strtotime($prescription['End_Date'])) : 'Ongoing';
                    ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="prescription-card active-prescription">
                                <div class="prescription-header">
                                    <h5 class="prescription-name"><?= htmlspecialchars($prescription['Med_Name']) ?></h5>
                                    <span class="badge bg-success"><?= htmlspecialchars($prescription['Status']) ?></span>
                                </div>
                                <div class="prescription-body">
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Dosage:</div>
                                        <div class="prescription-detail-value"><?= htmlspecialchars($prescription['Dosage']) ?></div>
                                    </div>
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Frequency:</div>
                                        <div class="prescription-detail-value"><?= htmlspecialchars($prescription['Frequency']) ?></div>
                                    </div>
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Started:</div>
                                        <div class="prescription-detail-value"><?= $start_date ?></div>
                                    </div>
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Ends:</div>
                                        <div class="prescription-detail-value"><?= $end_date ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-clipboard-x"></i>
                    </div>
                    <h5>No Active Prescriptions</h5>
                    <p class="text-muted">This patient doesn't have any active medications at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Prescription History Section -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0"><i class="bi bi-clock-history me-2"></i>Prescription History</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($history_prescriptions)) : ?>
                <div class="row">
                    <?php foreach ($history_prescriptions as $prescription) :
                        $start_date = date('M d, Y', strtotime($prescription['Start_Date']));
                        $end_date = date('M d, Y', strtotime($prescription['End_Date']));
                    ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="prescription-card inactive-prescription">
                                <div class="prescription-header">
                                    <h5 class="prescription-name"><?= htmlspecialchars($prescription['Med_Name']) ?></h5>
                                    <?php if ($prescription['Status'] === 'Completed') { ?>
                                        <span class="badge bg-success">Completed</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger">Discontinued</span>
                                    <?php } ?>
                                </div>
                                <div class="prescription-body">
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Dosage:</div>
                                        <div class="prescription-detail-value"><?= htmlspecialchars($prescription['Dosage']) ?></div>
                                    </div>
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Frequency:</div>
                                        <div class="prescription-detail-value"><?= htmlspecialchars($prescription['Frequency']) ?></div>
                                    </div>
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Started:</div>
                                        <div class="prescription-detail-value"><?= $start_date ?></div>
                                    </div>
                                    <div class="prescription-detail">
                                        <div class="prescription-detail-label">Ended:</div>
                                        <div class="prescription-detail-value"><?= $end_date ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-hourglass"></i>
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