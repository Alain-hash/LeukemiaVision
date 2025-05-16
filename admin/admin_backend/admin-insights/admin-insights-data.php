<?php

include ("../../database/db.php");

// Initialize data array to store all chart data
$data = [
    'testResults' => [],
    'leukemiaTypes' => [],
    'monthlyTrends' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        'normalTests' => array_fill(0, 12, 0),
        'diagnosedTests' => array_fill(0, 12, 0),
        'leukemiaCases' => array_fill(0, 12, 0)
    ],
    'genderDistribution' => [],
    'ageDistribution' => [
        '0-18' => 0,
        '19-40' => 0,
        '41-60' => 0,
        '61+' => 0
    ],
    'ageGenderCorrelation' => [
        'labels' => ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71+'],
        'male' => array_fill(0, 8, 0),
        'female' => array_fill(0, 8, 0)
    ]
];

// 1. Test Results Distribution
$benign_query = "SELECT COUNT(*) as count FROM leukemia_test WHERE Test_Result='Benign'";
$pro_query = "SELECT COUNT(*) as count FROM leukemia_test WHERE Test_Result='Pro'";

$benign_result = $connection->query($benign_query);
$pro_result = $connection->query($pro_query);

if ($benign_result && $pro_result) {
    $benign_count = $benign_result->fetch_assoc()['count'];
    $pro_count = $pro_result->fetch_assoc()['count'];
    
    $data['testResults'] = [
        'normal' => (int)$benign_count,
        'diagnosed' => (int)$pro_count
    ];
}

// 2. Leukemia Types Distribution
$leukemia_types = [
    'Acute Lymphoblastic Leukemia (ALL)',
    'Acute Myeloid Leukemia (AML)',
    'Chronic Lymphocytic Leukemia (CLL)',
    'Chronic Myeloid Leukemia (CML)'
];

foreach ($leukemia_types as $type) {
    $query = "SELECT COUNT(*) as count FROM patient_diagnosis WHERE leukemia_type = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $count = $result->fetch_assoc()['count'];
        $data['leukemiaTypes'][$type] = (int)$count;
    } else {
        $data['leukemiaTypes'][$type] = 0;
    }
    
    $stmt->close();
}

// 3. Leukemia Tests Trend Over Time
// For normal tests (Benign)
$trend_normal_query = "SELECT MONTH(Test_Result_Date) as month, COUNT(*) AS count 
                      FROM leukemia_test 
                      WHERE Test_Result = 'Benign' AND YEAR(Test_Result_Date) = YEAR(CURRENT_DATE)
                      GROUP BY MONTH(Test_Result_Date)";

$trend_normal_result = $connection->query($trend_normal_query);

if ($trend_normal_result) {
    while ($row = $trend_normal_result->fetch_assoc()) {
        // Month values are 1-based (1=Jan, 2=Feb, etc.), so adjust array index
        $month_index = (int)$row['month'] - 1;
        if ($month_index >= 0 && $month_index < 12) {
            $data['monthlyTrends']['normalTests'][$month_index] = (int)$row['count'];
        }
    }
}

// For diagnosed tests (Pro)
$trend_diagnosed_query = "SELECT MONTH(Test_Result_Date) as month, COUNT(*) AS count 
                         FROM leukemia_test 
                         WHERE Test_Result = 'Pro' AND YEAR(Test_Result_Date) = YEAR(CURRENT_DATE)
                         GROUP BY MONTH(Test_Result_Date)";

$trend_diagnosed_result = $connection->query($trend_diagnosed_query);

if ($trend_diagnosed_result) {
    while ($row = $trend_diagnosed_result->fetch_assoc()) {
        $month_index = (int)$row['month'] - 1;
        if ($month_index >= 0 && $month_index < 12) {
            $data['monthlyTrends']['diagnosedTests'][$month_index] = (int)$row['count'];
            // For leukemia cases, we'll use the same as diagnosed tests for now
            $data['monthlyTrends']['leukemiaCases'][$month_index] = (int)$row['count'];
        }
    }
}

// 4. Leukemia Cases by Gender
$gender_female_query = "SELECT COUNT(*) as count FROM leukemia_test lt 
                       JOIN appointment a ON a.Appointment_ID=lt.Appointment_ID 
                       JOIN patient p ON a.Patient_ID=p.Patient_ID 
                       WHERE p.Gender = 'Female' AND lt.Test_Result = 'Pro'";

$gender_male_query = "SELECT COUNT(*) as count FROM leukemia_test lt 
                     JOIN appointment a ON a.Appointment_ID=lt.Appointment_ID 
                     JOIN patient p ON a.Patient_ID=p.Patient_ID 
                     WHERE p.Gender = 'Male' AND lt.Test_Result = 'Pro'";

$gender_female_result = $connection->query($gender_female_query);
$gender_male_result = $connection->query($gender_male_query);

if ($gender_female_result && $gender_male_result) {
    $female_count = $gender_female_result->fetch_assoc()['count'];
    $male_count = $gender_male_result->fetch_assoc()['count'];
    
    $data['genderDistribution'] = [
        'female' => (int)$female_count,
        'male' => (int)$male_count
    ];
}

// 5. Leukemia Cases by Age Group
// This query needs to be modified since Birth_Date needs to be converted to age
$age_query = "SELECT 
    CASE
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 18 THEN '0-18'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 40 THEN '19-40'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 60 THEN '41-60'
        ELSE '61+'
    END AS age_group,
    COUNT(*) as count
    FROM leukemia_test lt 
    JOIN appointment a ON a.Appointment_ID=lt.Appointment_ID 
    JOIN patient p ON a.Patient_ID=p.Patient_ID 
    WHERE lt.Test_Result = 'Pro' 
    GROUP BY age_group";

$age_result = $connection->query($age_query);

if ($age_result) {
    while ($row = $age_result->fetch_assoc()) {
        $age_group = $row['age_group'];
        $count = (int)$row['count'];
        $data['ageDistribution'][$age_group] = $count;
    }
}

// 6. Age and Gender Correlation
$age_gender_query = "SELECT 
    CASE
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 10 THEN '0-10'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 20 THEN '11-20'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 30 THEN '21-30'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 40 THEN '31-40'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 50 THEN '41-50'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 60 THEN '51-60'
        WHEN TIMESTAMPDIFF(YEAR, p.Birth_Date, CURRENT_DATE) <= 70 THEN '61-70'
        ELSE '71+'
    END AS age_group,
    p.Gender,
    COUNT(*) as count
    FROM leukemia_test lt 
    JOIN appointment a ON a.Appointment_ID=lt.Appointment_ID 
    JOIN patient p ON a.Patient_ID=p.Patient_ID 
    WHERE lt.Test_Result = 'Pro' 
    GROUP BY age_group, p.Gender";

$age_gender_result = $connection->query($age_gender_query);

if ($age_gender_result) {
    // Initialize the correlation arrays with zeros
    $age_groups = ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71+'];
    
    while ($row = $age_gender_result->fetch_assoc()) {
        $age_group = $row['age_group'];
        $gender = $row['Gender'];
        $count = (int)$row['count'];
        
        // Find the index of the age group
        $index = array_search($age_group, $age_groups);
        
        if ($index !== false) {
            if (strtolower($gender) == 'male') {
                $data['ageGenderCorrelation']['male'][$index] = $count;
            } else if (strtolower($gender) == 'female') {
                $data['ageGenderCorrelation']['female'][$index] = $count;
            }
        }
    }
}

// Close the database connection
$connection->close();

// Return the data as JSON if this is an AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Otherwise, this file will be included in the main page and the $data variable will be available
?>