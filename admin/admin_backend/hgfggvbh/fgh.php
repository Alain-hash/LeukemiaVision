 <script>
           $(document).ready(function () {
    $.ajax({
        url: '../admin_backend/user-management/doctor_display.php', // The PHP script that fetches data
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            let tableBody = $('#doctorsTableBody');
            tableBody.empty(); // Clear existing data
            
            response.forEach(function (doctor) {
                let statusBadge = doctor.Status === 'Active' 
                    ? '<span class="badge bg-success">Active</span>' 
                    : '<span class="badge bg-danger">Inactive</span>';

                let row = `<tr>
                    <td>${doctor.Name}</td>
                    <td>${doctor.Email}</td>
                    <td>${doctor.Specialty}</td>
                    <td>${doctor.created_at}</td>
                    <td>${statusBadge}</td>
                    <td>
                        <button class="btn btn-info btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>`;

                tableBody.append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching doctors:", error);
        }
    });
});
</script><script>
           $(document).ready(function () {
    $.ajax({
        url: '../admin_backend/user-management/doctor_display.php', // The PHP script that fetches data
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            let tableBody = $('#doctorsTableBody');
            tableBody.empty(); // Clear existing data
            
            response.forEach(function (doctor) {
                let statusBadge = doctor.Status === 'Active' 
                    ? '<span class="badge bg-success">Active</span>' 
                    : '<span class="badge bg-danger">Inactive</span>';

                let row = `<tr>
                    <td>${doctor.Name}</td>
                    <td>${doctor.Email}</td>
                    <td>${doctor.Specialty}</td>
                    <td>${doctor.created_at}</td>
                    <td>${statusBadge}</td>
                    <td>
                        <button class="btn btn-info btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>`;

                tableBody.append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching doctors:", error);
        }
    });
});
</script>