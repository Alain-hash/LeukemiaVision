<?php
include("../../../database/db.php");

$patientId = isset($_POST['user_id']) ? $_POST['user_id'] : '';

if ($patientId) {
    // Get all appointments for the patient
    $sqlAppointments = "SELECT 
        appointment.appointment_ID,
        appointment.App_Date,
        services.Name as Service_Name
        FROM appointment
        JOIN services ON services.Service_ID = appointment.Service_ID
        JOIN patient ON patient.Patient_ID = appointment.Patient_ID
        JOIN user ON user.User_ID = patient.User_ID
        WHERE user.User_ID = ?
        ORDER BY appointment.App_Date DESC";
    
    $stmtAppointments = $connection->prepare($sqlAppointments);
    $stmtAppointments->bind_param("i", $patientId);
    $stmtAppointments->execute();
    $resultAppointments = $stmtAppointments->get_result();
    
    // Display table of appointments
    if ($resultAppointments->num_rows > 0) {
        ?>
        
        <!-- Patient Diagnosis Info Table -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Patient Diagnosis Overview</h5>
            </div>
            <div class="card-body">
                <?php
                // Get diagnosis info
                $sqlDiagnosis = "SELECT 
                    diagnosis_date, 
                    leukemia_type, 
                    current_stage, 
                    current_status, 
                    previous_stage, 
                    wbc_status, 
                    current_cycle, 
                    total_cycles, 
                    next_cycle_date
                FROM patient_diagnosis
                JOIN patient ON patient.Patient_ID = patient_diagnosis.patient_id
                JOIN user ON user.User_ID = patient.User_ID  
                WHERE user.User_ID = ?";
                
                $stmtDiagnosis = $connection->prepare($sqlDiagnosis);
                $stmtDiagnosis->bind_param("i", $patientId);
                $stmtDiagnosis->execute();
                $resultDiagnosis = $stmtDiagnosis->get_result();
                $diagnosisInfo = $resultDiagnosis->fetch_assoc();
                
                if ($diagnosisInfo) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="40%">Parameter</th>
                                <th width="60%">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Diagnosis Date</strong></td>
                                <td><?= date('M d, Y', strtotime($diagnosisInfo['diagnosis_date'])) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Leukemia Type</strong></td>
                                <td><?= $diagnosisInfo['leukemia_type'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Current Stage</strong></td>
                                <td>
                                    <?= $diagnosisInfo['current_stage'] ?> 
                                    <?php if($diagnosisInfo['previous_stage']): ?>
                                    <span class="badge <?= ($diagnosisInfo['current_stage'] < $diagnosisInfo['previous_stage']) ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ($diagnosisInfo['current_stage'] < $diagnosisInfo['previous_stage']) ? 'Improved' : 'Progressed' ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Current Status</strong></td>
                                <td><?= $diagnosisInfo['current_status'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>WBC Status</strong></td>
                                <td><?= $diagnosisInfo['wbc_status'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Treatment Cycle</strong></td>
                                <td><?= $diagnosisInfo['current_cycle'] ?> of <?= $diagnosisInfo['total_cycles'] ?></td>
                            </tr>
                            <tr>
                                <td><strong>Next Cycle Date</strong></td>
                                <td><?= date('M d, Y', strtotime($diagnosisInfo['next_cycle_date'])) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                    <div class="alert alert-warning">No diagnosis information found for this patient.</div>
                <?php } ?>
            </div>
        </div>
        
        <!-- Appointments Table -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5>All Appointments History</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Service</th>
                                <th>Test Results</th>
                                <th>Blood Counts</th>
                                <th>Treatment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($appointment = $resultAppointments->fetch_assoc()): ?>
                                <tr>
                                    <td><?= date('M d, Y', strtotime($appointment['App_Date'])) ?></td>
                                    <td><?= $appointment['Service_Name'] ?></td>
                                    <td>
                                        <?php
                                        // Get leukemia test info for this appointment
                                        $sqlTest = "SELECT 
                                            Test_Result,
                                            Test_Result_Date
                                            FROM leukemia_test
                                            WHERE Appointment_ID = ?";
                                        
                                        $stmtTest = $connection->prepare($sqlTest);
                                        $stmtTest->bind_param("i", $appointment['appointment_ID']);
                                        $stmtTest->execute();
                                        $resultTest = $stmtTest->get_result();
                                        $testInfo = $resultTest->fetch_assoc();
                                        
                                        if ($testInfo) {
                                            echo "<strong>Result:</strong> " . $testInfo['Test_Result'] . "<br>";
                                            echo "<strong>Date:</strong> " . date('M d, Y', strtotime($testInfo['Test_Result_Date']));
                                        } else {
                                            echo "No test results";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Get blood counts for this appointment
                                        $sqlBlood = "SELECT 
                                            WBC_Count,
                                            Blast_Cells_Percentage,
                                            Hemoglobin,
                                            Platelets
                                            FROM leukemia_test
                                            WHERE Appointment_ID = ?";
                                        
                                        $stmtBlood = $connection->prepare($sqlBlood);
                                        $stmtBlood->bind_param("i", $appointment['appointment_ID']);
                                        $stmtBlood->execute();
                                        $resultBlood = $stmtBlood->get_result();
                                        $bloodInfo = $resultBlood->fetch_assoc();
                                        
                                        if ($bloodInfo) {
                                            echo "<strong>WBC:</strong> " . $bloodInfo['WBC_Count'] . "<br>";
                                            echo "<strong>HGB:</strong> " . $bloodInfo['Hemoglobin'] . " g/dL<br>";
                                            echo "<strong>PLT:</strong> " . $bloodInfo['Platelets'] . "<br>";
                                            echo "<strong>Blast %:</strong> " . $bloodInfo['Blast_Cells_Percentage'] . "%";
                                        } else {
                                            echo "No blood counts";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Get treatment info for this appointment
                                        $sqlTreatment = "SELECT 
                                            Treatment_Name,
                                            Treatment_Start_Date,
                                            Treatment_End_Date,
                                            Treatment_Progression,
                                            Treatment_Cycles,
                                            Treatment_Outcome
                                            FROM treatment
                                            WHERE Appointment_ID = ?";
                                        
                                        $stmtTreatment = $connection->prepare($sqlTreatment);
                                        $stmtTreatment->bind_param("i", $appointment['appointment_ID']);
                                        $stmtTreatment->execute();
                                        $resultTreatment = $stmtTreatment->get_result();
                                        $treatmentInfo = $resultTreatment->fetch_assoc();
                                        
                                        if ($treatmentInfo) {
                                            echo "<strong>Name:</strong> " . $treatmentInfo['Treatment_Name'] . "<br>";
                                            echo "<strong>Status:</strong> " . $treatmentInfo['Treatment_Progression'] . "<br>";
                                            echo "<strong>Cycles:</strong> " . $treatmentInfo['Treatment_Cycles'] . "<br>";
                                            if ($treatmentInfo['Treatment_Outcome']) {
                                                echo "<strong>Outcome:</strong> " . $treatmentInfo['Treatment_Outcome'];
                                            }
                                        } else {
                                            echo "No treatment data";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Blood Count Charts -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Blood Count Trends</div>
                    <div class="card-body">
                        <canvas id="bloodCountChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Blast Cells Percentage</div>
                    <div class="card-body">
                        <canvas id="blastCellChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Chart data preparation
        $sqlChartData = "SELECT 
            Test_Result_Date, 
            WBC_Count, 
            Hemoglobin, 
            Platelets, 
            Blast_Cells_Percentage 
            FROM leukemia_test 
            JOIN appointment ON appointment.Appointment_ID=leukemia_test.Appointment_ID
            JOIN patient ON patient.Patient_ID=appointment.Patient_ID
            JOIN user ON user.User_ID=patient.User_ID
            WHERE user.User_ID = ?
            ORDER BY Test_Result_Date ASC 
            LIMIT 10";
        
        $stmtChartData = $connection->prepare($sqlChartData);
        $stmtChartData->bind_param("i", $patientId);
        $stmtChartData->execute();
        $resultChartData = $stmtChartData->get_result();
        
        // Initialize arrays for chart data
        $bloodCountLabels = [];
        $wbcData = [];
        $hgbData = [];
        $pltData = [];
        $blastCellLabels = [];
        $blastCellData = [];
        
        // Process chart data
        while ($row = $resultChartData->fetch_assoc()) {
            $testDate = date('M d', strtotime($row['Test_Result_Date']));
            
            // For blood count chart
            $bloodCountLabels[] = $testDate;
            $wbcData[] = $row['WBC_Count'];
            $hgbData[] = $row['Hemoglobin'];
            $pltData[] = $row['Platelets'];
            
            // For blast cell chart
            $blastCellLabels[] = $testDate;
            $blastCellData[] = $row['Blast_Cells_Percentage'];
        }
        ?>

        <script>
        // Blood Count Chart
        const bloodCtx = document.getElementById('bloodCountChart').getContext('2d');
        const bloodChart = new Chart(bloodCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($bloodCountLabels) ?>,
                datasets: [{
                    label: 'WBC',
                    data: <?= json_encode($wbcData) ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false,
                    tension: 0.1
                }, {
                    label: 'Hemoglobin',
                    data: <?= json_encode($hgbData) ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false,
                    tension: 0.1
                }, {
                    label: 'Platelets',
                    data: <?= json_encode($pltData) ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });

        // Blast Cell Chart
        const blastCtx = document.getElementById('blastCellChart').getContext('2d');
        const blastChart = new Chart(blastCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($blastCellLabels) ?>,
                datasets: [{
                    label: 'Blast Cells %',
                    data: <?= json_encode($blastCellData) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
        </script>
        <?php
    } else {
        echo '<div class="alert alert-warning">No appointments found for this patient.</div>';
    }
} else {
    echo '<div class="alert alert-warning">No patient selected or found.</div>';
}

$connection->close();
?>