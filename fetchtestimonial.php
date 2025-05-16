<?php
include("database/db.php");

function getTestimonials($connection, $limit = 6) {
    $testimonials = [];
    
    // SQL query to join feedback and patient tables to get all necessary information
    $sql = "SELECT f.Report_ID, f.Doctor_Rating, f.Doctor_Feedback, f.Date, f.Status, 
                   p.Patient_ID, p.Gender, p.profile_image, p.User_ID,
                   u.Name as Patient_Name,
                   d.Specialization as Doctor_Specialty
            FROM feedback f
         JOIN patient p ON f.Patient_ID = p.Patient_ID
             JOIN user u ON p.User_ID = u.User_ID
             JOIN doctor d ON f.Doctor_ID = d.Doctor_ID
            WHERE f.Status = 'Active'
            ORDER BY f.Date DESC
            LIMIT ?";
    
    // Prepare statement
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch data
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Process profile image path
            $profileImage = !empty($row['profile_image']) ? $row['profile_image'] : 'assets/img/testimonials/default-profile.jpg';
            
            // Format testimonial data
            $testimonial = [
                'id' => $row['Report_ID'],
                'name' => $row['Patient_Name'],
                'role' => ($row['Gender'] == 'Male' ? 'Leukemia Survivor' : 'Leukemia Survivor'),
                'rating' => $row['Doctor_Rating'],
                'feedback' => $row['Doctor_Feedback'],
                'image' => $profileImage,
                'date' => $row['Date']
            ];
            $testimonials[] = $testimonial;
        }
    }
    
    $stmt->close();
    return $testimonials;
}


function generateTestimonialsHTML($testimonials) {
    $html = '';
    
    foreach ($testimonials as $testimonial) {
        $stars = '';
        for ($i = 0; $i < $testimonial['rating']; $i++) {
            $stars .= '<i class="bi bi-star-fill"></i>';
        }
        
        $html .= '
        <div class="swiper-slide">
            <div class="testimonial-item">
                <div class="d-flex">
                
                    <img src="' . htmlspecialchars($testimonial['image']) . '" class="testimonial-img flex-shrink-0" alt="' . htmlspecialchars($testimonial['name']) . '">
                    <div>
                        <h3>' . htmlspecialchars($testimonial['name']) . '</h3>
                        <h4>' . htmlspecialchars($testimonial['role']) . '</h4>
                        <div class="stars">
                            ' . $stars . '
                        </div>
                    </div>
                </div>
                <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>' . htmlspecialchars($testimonial['feedback']) . '</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                </p>
            </div>
        </div>';
    }
    
    return $html;
}

// Get testimonials from database
$testimonials = getTestimonials($connection);

?>
