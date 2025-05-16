<?php
include("../../../database/db.php");

$sql = "SELECT * FROM services";
$result = $connection->query($sql);

echo '<table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Duration</th>
                <th>Service Name</th>
                <th>Category</th>
                <th>Fee ($)</th>
                <th>Status</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Service_Duration']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Type']}</td>
                    <td>{$row['Fee']}</td>
                    <td>{$row['Availability']}</td>
                    <td>{$row['Description']}</td>
                    <td>
                        <div class='btn-group btn-group-sm' role='group'>
                            <button class='btn btn-primary edit-service' data-bs-toggle='modal' data-bs-target='#editServiceModal' data-id='{$row['Service_ID']}'><i class='bi bi-pencil'></i></button>
                            <button class='btn btn-danger delete-service' data-bs-toggle='modal' data-bs-target='#deleteServiceModal' data-id='{$row['Service_ID']}'><i class='bi bi-trash'></i></button>
                        </div>
                    </td>
                  </tr>";
        }
        
echo '  </tbody>
      </table>';

$connection->close();
?>
