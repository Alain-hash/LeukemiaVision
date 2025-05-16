<?php
include("../../../database/db.php");

// Query to get all feedback records
$sql = "SELECT 
    f.Report_ID, 
    f.Doctor_Rating, 
    f.Doctor_Feedback, 
    f.Date, 
    f.Patient_ID, 
    f.Doctor_ID,
    f.Status,
    u.Name AS patient_name,
    du.Name AS doctor_name
FROM 
    feedback f
    JOIN patient p ON f.Patient_ID = p.Patient_ID
    JOIN user u ON p.User_ID = u.User_ID
    LEFT JOIN doctor d ON f.Doctor_ID = d.Doctor_ID
    LEFT JOIN user du ON d.User_ID = du.User_ID
ORDER BY 
    f.Date DESC";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Rating</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        $statusBadge = $row['Status'] == 'Active' ? 
            '<span class="badge bg-success">Active</span>' : 
            '<span class="badge bg-secondary">Inactive</span>';
            
        echo '<tr>
                <td>' . $row['Report_ID'] . '</td>
                <td>' . htmlspecialchars($row['patient_name']) . '</td>
                <td>' . htmlspecialchars($row['doctor_name']) . '</td>
                <td>' . renderStars($row['Doctor_Rating']) . '</td>
                <td>' . formatDate($row['Date']) . '</td>
                <td>' . $statusBadge . '</td>
                <td>
                    <button class="btn btn-sm btn-outline-info view-btn" data-id="' . $row['Report_ID'] . '" data-bs-toggle="modal" data-bs-target="#viewTestimonialModal">
                        <i class="bi bi-eye"></i>
                    </button>';
                    
        // Add toggle status button - shows activation/deactivation icon based on current status
        if ($row['Status'] == 'Active') {
            echo '<button class="btn btn-sm btn-outline-warning toggle-status-btn ms-1" data-id="' . $row['Report_ID'] . '" data-current="Active" title="Deactivate">
                    <i class="bi bi-toggle-off"></i>
                  </button>';
        } else {
            echo '<button class="btn btn-sm btn-outline-success toggle-status-btn ms-1" data-id="' . $row['Report_ID'] . '" data-current="Inactive" title="Activate">
                    <i class="bi bi-toggle-on"></i>
                  </button>';
        }
                
        echo '</td>
            </tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<div class="alert alert-info">No testimonials found.</div>';
}

// Helper function to render stars
function renderStars($rating) {
    if (empty($rating)) return 'N/A';
    
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '<i class="bi bi-star-fill text-warning"></i>';
        } else {
            $stars .= '<i class="bi bi-star text-muted"></i>';
        }
    }
    return $stars;
}

// Helper function to format date
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d M Y', $timestamp);
}
?>