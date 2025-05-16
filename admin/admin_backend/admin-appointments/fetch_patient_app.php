<?php 
// Include database connection
include("../../../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];

    // Prepare the SQL statement
    $stmt = $connection->prepare(
        "SELECT 
            u.Name AS User_Name,
            u.User_ID,
            s.Name AS Service_Name,
            a.App_Time
        FROM user u
        JOIN patient p ON p.User_ID = u.User_ID
        JOIN appointment a ON a.Patient_ID = p.Patient_ID
        JOIN services s ON a.Service_ID = s.Service_ID
        WHERE a.Doctor_ID = ? AND a.App_Date = ?;"
    );
    
    // Bind parameters and execute the statement
    $stmt->bind_param("is", $doctor_id, $appointment_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are results
    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<thead>
                <tr>
                    <th>Patient</th>
                    <th>Appointment Time</th>
                    <th>Service</th>
                </tr>
              </thead>';
        echo '<tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar bg-light text-primary me-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                          <i class="bi bi-person"></i>
                        </div>
                        <div>
                          <div class="fw-bold">' . htmlspecialchars($row['User_Name']) . '</div>
                          <div class="small text-muted">ID: ' . htmlspecialchars($row['User_ID']) . '</div>
                        </div>
                      </div>
                    </td>
                    <td>' . htmlspecialchars($row['App_Time']) . '</td>
                    <td>' . htmlspecialchars($row['Service_Name']) . '</td>
                  </tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<div class='alert alert-warning'>No appointments found for this doctor on this date.</div>";
    }

    // Close resources
    $stmt->close();
    $connection->close();
}
?>
