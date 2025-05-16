<?php
session_start();


if (isset($_SESSION['user_id']) && $_SESSION['user_Status'] == 'Active' && $_SESSION['user_role'] == 'Patient') {
    include "patient-profileimage.php";
    $_SESSION['profile_image'] = $profile_image;
}


include("database/db.php");
include("fetchservices.php");
include("fetchdoctors.php");
include("doctor/doctor_backend/update_appointment_status.php");
include("fetchQ&A.php");
include("fetchtestimonial.php");

function getInstitutionLocations($connection)
{
    $locations = [];


    $sql = "SELECT Institution_ID, Name, Address, Phone_Number, Email, Latitude, Longitude 
            FROM clinical_institution 
            WHERE Latitude IS NOT NULL AND Longitude IS NOT NULL";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $locations[] = [
                'id' => $row['Institution_ID'],
                'name' => $row['Name'],
                'address' => $row['Address'],
                'phone' => $row['Phone_Number'],
                'email' => $row['Email'],
                'lat' => $row['Latitude'],
                'lng' => $row['Longitude']
            ];
        }
    }

    return $locations;
}


$locationData = getInstitutionLocations($connection);


$locationsJson = json_encode($locationData);


$stmt = $connection->prepare("SELECT Name FROM user WHERE User_ID = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>LeukemiaVision - AI-Powered Leukemia Detection</title>
    <meta name="description"
        content="LeukemiaVision uses advanced AI technology to classify leukemia cancer from blood smear images, providing accurate and efficient diagnosis support for medical professionals.">
    <meta name="keywords"
        content="Leukemia detection, AI diagnosis, medical imaging, cancer classification, blood smear analysis">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        /* Override Bootstrap Primary Blue with Dark Blue */
.text-primary {
    color: #0d3b66 !important;
}
.bg-primary {
    background-color: #0d3b66 !important;
}
.btn-primary {
    background-color: #0d3b66 !important;
    border-color: #0d3b66 !important;
}
.btn-primary:hover {
    background-color: #092a4a !important;
    border-color: #092a4a !important;
}

        /* Styles for header profile image */
        .header-profile-container {
            display: flex;
            align-items: center;
        }

        .header-profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #007bff;
        }

        @media (max-width: 768px) {
            .header-profile-image {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }
        }

        .service-hidden {
            display: none;
        }



        .team-member {
            background-color: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 100%;
        }

        .team-member .pic {
            flex: 0 0 120px;
            margin-right: 20px;
        }

        .team-member .pic img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            height: 160px;
        }

        .team-member .stars {
            color: #ffc107;
        }

        .team-member .member-info {
            flex: 1;
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <?php if (!empty($locationData)) : ?>
                        <i class="bi bi-envelope d-flex align-items-center">
                            <a href="mailto:<?= htmlspecialchars($locationData[0]['email']) ?>">
                                <?= htmlspecialchars($locationData[0]['email']) ?>
                            </a>
                        </i>
                        <i class="bi bi-phone d-flex align-items-center ms-4">
                            <span><?= htmlspecialchars($locationData[0]['phone']) ?></span>
                        </i>
                    <?php else : ?>
                        <i class="bi bi-envelope d-flex align-items-center">
                            <a href="#">Email not available</a>
                        </i>
                        <i class="bi bi-phone d-flex align-items-center ms-4">
                            <span>Phone not available</span>
                        </i>
                    <?php endif; ?>

                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="#" class="twitter" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="facebook" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div><!-- End Top Bar -->
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">

                <div class="header-profile-container">
                    <?php if (!empty($profile_image)): ?>
                        <a href="patient/patient_frontend/editprofile.php">
                            <img src="<?php echo htmlspecialchars($_SESSION['profile_image']); ?>" alt="Patient Profile" class="header-profile-image" id="headerProfileImage">
                        </a>
                    <?php endif; ?>
                    <div class="profile-info">
                        <?php if (isset($_SESSION['user_id'])) {
                            if ($row = $result->fetch_assoc()) { ?>
                                <span class="fw-bold fs-3" style="color: var(--heading-color);">
                                    <?= $row['Name']; ?>
                                </span>

                            <?php  } ?>



                        <?php } else { ?>
                            <a href="index.php" class="logo d-flex align-items-center me-auto">
                                <h1 class="sitename">LeukemiaVision</h1>
                            </a>
                        <?php } ?>
                    </div>

                </div>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#doctors">Doctors</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Patient Portal</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="patient/patient_frontend/medications.php"> Medications</a></li>
                                <li><a href="patient/patient_frontend/patient_progress.php"> progress & Results</a></li>
                                <li><a href="patient/patient_frontend/appointment-history.php">Your Appointments </a></li>
                            </ul>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                <div class="d-flex align-items-center">
                    <a class="cta-btn btn-sm d-none d-sm-block me-1" href="patient/patient_frontend/services_option.php">Make an Appointment</a>

                    <?php
                    if (isset($_SESSION['user_id'])) { ?>
                        <a href="logout.php">
                            <button class="cta-btn btn-sm ms-1 border-0" type="button">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </a>
                    <?php } else { ?>
                        <a href="login.php">
                            <button class="cta-btn btn-sm ms-1 border-0" type="button">
                                <i class="bi bi-person-plus"></i> SignIn
                            </button>
                        </a>

                    <?php }
                    ?>



                </div>
            </div>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">
            <img src="assets/img/hero-bggg.png" alt="LeukemiaVision Hero Image">

            <!-- New navigation bar with profile and logout -->
            <div class="top-nav-container" style="position: absolute; top: 20px; width: 100%; z-index: 10;">
                <div class="container d-flex justify-content-between align-items-center">
                    <!-- Profile on the left -->
                    <div class="profile-area d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">



                    </div>


                </div>
            </div>

            <div class="container position-relative">
                <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                    <h2 style="color: var(--heading-color);">Welcome To LeukemiaVision</h2>
                    <p style="color:var(--heading-color);">AI-Powered Leukemia Detection and Diagnosis</p>
                </div><!-- End Welcome -->

                <div class="content row gy-4">
                    <div class="col-lg-6 d-flex align-items-stretch">
                        <div class="why-box" data-aos="zoom-out" data-aos-delay="200"
                            style="background-color: rgb(36, 77, 110);">
                            <h3>Why Choose LeukemiaVision?</h3>
                            <p>
                                LeukemiaVision utilizes cutting-edge AI technology to analyze blood smear images with
                                unprecedented accuracy. Our system helps medical professionals detect leukemia in its
                                early stages, improving patient outcomes and saving lives.
                            </p>
                            <div class="text-center">
                                <a href="#about" class="more-btn"><span>Learn More</span> <i
                                        class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Why Box -->


                </div>
            </div>
            </div>
            </div><!-- End Content-->

            </div>

        </section><!-- /Hero Section -->
        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container">
                <div class="row gy-4 gx-5 align-items-stretch">
                    <div class="col-lg-6 position-relative" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/img/about.jpg" class="img-fluid" alt="LeukemiaVision AI Technology">
                        <a href="https://youtu.be/9Mz84cwVmS0?si=xb9X9wJ7ygDrIZC2"
                            class="glightbox pulsating-play-btn"></a>
                    </div>
                    <div class="col-lg-6 content d-flex flex-column justify-content-center h-100" data-aos="fade-up"
                        data-aos-delay="100">
                        <h3>About LeukemiaVision</h3>
                        <p>
                            LeukemiaVision is revolutionizing leukemia detection by combining medical expertise with
                            artificial intelligence. Our platform allows healthcare providers to upload blood smear
                            images for rapid, accurate analysis, helping to identify leukemia cells with unprecedented
                            precision.
                        </p>
                        <ul>
                            <li>
                                <i class="fa-solid fa-vial-circle-check"></i>
                                <div>
                                    <h5>Advanced AI Algorithms</h5>
                                    <p>Our proprietary algorithms are trained on thousands of medical images for maximum
                                        accuracy</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-pump-medical"></i>
                                <div>
                                    <h5>Comprehensive Diagnostic Support</h5>
                                    <p>Get detailed reports with visualization of detected abnormalities</p>
                                </div>
                            </li>
                            <li>
                              
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->


        <!-- Services Section -->
        <section id="services" class="services section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Our Services</h2>
                <p>Comprehensive leukemia detection and treatment solutions</p>
            </div>

            <div class="container">
                <div class="row gy-4">
                    <?php
                    if ($result1->num_rows > 0) {


                        while ($row = $result1->fetch_assoc()) { ?>
                            <div class="col-lg-4 col-md-6 service-item-wrapper " data-aos="fade-up" data-aos-delay="">
                                <div class="service-item position-relative">
                                    <a href="#" class="stretched-link">
                                        <h3><?= $row["Name"] ?></h3>
                                    </a>
                                    <p><?= $row['Description'] ?></p>
                                </div>
                            </div>
                        <?php

                        }



                        ?>
                       <div class="text-center mt-4">
    <a href="services.php">
        <button class="btn" style="background-color: var(--accent-color); color: white; border: none;">Show All Services</button>
    </a>
</div>

                    <?php
                    }

                    ?>
                </div>
            </div>
        </section><!-- /Services Section -->

        <!-- Doctors Section -->
        <section id="doctors" class="doctors section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Doctors</h2>
                <p>Our team of experienced healthcare professionals dedicated to your care</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row g-3">
                    <?php
                    while ($row = $doctors_result->fetch_assoc()) { ?>
                        <div class="col-lg-6 doctor-card" data-aos="fade-up">
                            <div class="card shadow-sm mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <?php if (!empty($row['Profile_Picture'])): ?>
                                            <img src="<?= htmlspecialchars($row['Profile_Picture']) ?>" class="img-fluid rounded-start h-100 object-fit-cover" alt="<?= htmlspecialchars($row['Name']) ?>">
                                        <?php else: ?>
                                            <img src="assets/img/default_profile_image.png" class="img-fluid rounded-start h-100 object-fit-cover" alt="<?= htmlspecialchars($row['Name']) ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body py-2">
                                            <h5 class="card-title mb-0"><?= htmlspecialchars($row['Name']) ?></h5>
                                            <p class="card-text small text-muted"><?= htmlspecialchars($row['Specialization']) ?></p>
                                            <div class="small text-warning mb-0">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <i class="bi <?= ($i < $row['Rating']) ? 'bi-star-fill' : 'bi-star' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="text-center mt-3 mb-4">
                        <a href="doctors.php"><button id="toggleDoctors" class="btn btn-primary btn-sm" data-state="collapsed">View All Doctors</button></a>
                    </div>
                </div>
            </div>
        </section><!-- /Doctors Section -->


       
<!-- Faq Section -->
<section id="faq" class="faq section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Questions and Answers</h2>
        <p>Recent questions from our community</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-container">
                    <?php
                    if ($Q_A_result->num_rows > 0) {
                        while ($row = $Q_A_result->fetch_assoc()) {
                    ?>
                        <div class="faq-item">
                            <h3><?php echo htmlspecialchars($row['Question']); ?></h3>
                            <div class="faq-content">
                                <p><?php echo nl2br(htmlspecialchars($row['Answer'])); ?></p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                    <?php
                        }
                    } else {
                        // Display a message if no Q&A entries are found
                    ?>
                        <div class="text-center py-4">
                            <p>No recent questions available. Check back soon!</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div><!-- End Faq Column-->
        </div>
    </div>
</section><!-- /Faq Section -->

 <!-- Testimonials Section --> 
<section id="testimonials" class="testimonials section py-5 bg-light">
    <div class="container">
        <!-- Display any session messages -->
        <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <i class="bi <?php echo $_SESSION['message_type'] == 'success' ? 'bi-check-circle' : ($_SESSION['message_type'] == 'warning' ? 'bi-exclamation-triangle' : 'bi-info-circle'); ?>"></i>
            <?php 
            echo $_SESSION['message']; 
            // Clear the message after displaying
            unset($_SESSION['message']); 
            unset($_SESSION['message_type']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="row align-items-center">
            <div class="col-lg-5 info p-4 rounded shadow-sm bg-white" data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-primary fw-bold mb-3">What Our Patients Say</h2>
                <p class="lead">
                    Hear from our patients and medical partners about their experience with LeukemiaVision.
                </p>
                
                <!-- Add Share Experience Button -->
                <div class="mt-4">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                        <i class="bi bi-chat-quote me-2"></i> Share Your Experience
                    </button>
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper init-swiper shadow rounded">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "navigation": {
                                "nextEl": ".swiper-button-next",
                                "prevEl": ".swiper-button-prev"
                            }
                        }
                    </script>
                    <div class="swiper-wrapper">
                        <?php echo generateTestimonialsHTML($testimonials); ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addTestimonialModalLabel">
                    <i class="bi bi-chat-quote me-2"></i> Share Your Experience
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="testimonialForm" action="process_testimonial.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-4">
                        <label for="doctorSelect" class="form-label fw-bold">
                            <i class="bi bi-person-badge me-1"></i> Select Doctor
                        </label>
                        <select class="form-select form-select-lg" id="doctorSelect" name="doctor_id" required>
                            <option value="" selected disabled>Choose a doctor</option>
                            <?php
                            // Fetch doctors from the database
                            $doctorSql = "SELECT d.Doctor_ID, u.Name FROM doctor d 
                                         JOIN user u ON d.User_ID = u.User_ID 
                                         ORDER BY u.Name";
                            $doctorResult = $connection->query($doctorSql);
                            
                            if ($doctorResult && $doctorResult->num_rows > 0) {
                                while($doctor = $doctorResult->fetch_assoc()) {
                                    echo '<option value="' . $doctor['Doctor_ID'] . '">' . htmlspecialchars($doctor['Name']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please select a doctor.
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">
                            <i class="bi bi-star me-1"></i> Rate Your Experience
                        </label>
                        <div class="star-rating d-flex justify-content-center fs-2">
                            <input type="radio" id="star5" name="rating" value="5" required />
                            <label for="star5" title="5 stars"><i class="bi bi-star-fill text-warning"></i></label>
                            
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 stars"><i class="bi bi-star-fill text-warning"></i></label>
                            
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 stars"><i class="bi bi-star-fill text-warning"></i></label>
                            
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 stars"><i class="bi bi-star-fill text-warning"></i></label>
                            
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 star"><i class="bi bi-star-fill text-warning"></i></label>
                            
                            <div class="invalid-feedback d-block text-center" id="ratingFeedback"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="feedback" class="form-label fw-bold">
                            <i class="bi bi-chat-text me-1"></i> Your Feedback
                        </label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="5" required 
                                  placeholder="Share your experience with our services..."
                                  minlength="20" maxlength="500"></textarea>
                        <div class="form-text">
                            <span id="charCount">0</span>/500 characters (minimum 20)
                        </div>
                        <div class="invalid-feedback">
                            Please provide feedback (20-500 characters).
                        </div>
                    </div>

                    <?php if(!isset($_SESSION['user_id'])): ?>
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle fs-4 me-2"></i>
                        <div>You need to be logged in as a patient to submit a testimonial.</div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Close
                        </button>
                        <?php if(isset($_SESSION['user_id']) ): ?>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="bi bi-send me-1"></i> Submit Testimonial
                        </button>
                        <?php else: ?>
                        <a href="login.php" class="btn btn-primary rounded-pill">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login to Submit
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact Us</h2>
                <p>Get in touch with our team for inquiries or to schedule a consultation</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4 justify-content-center mb-5">
                    <!-- Contact Information Row -->
                    <div class="row">
                        <?php
                        // If we have location data, use the first one for the main contact info
                        if (!empty($locationData)) {
                            $mainLocation = $locationData[0];
                        ?>
                            <div class="col-md-4 text-center">
                                <div class="info-item d-flex align-items-center justify-content-center">
                                    <i class="bi bi-geo-alt flex-shrink-0 me-3"></i>
                                    <div>
                                        <h3>Location</h3>
                                        <p><?php echo htmlspecialchars($mainLocation['address']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="info-item d-flex align-items-center justify-content-center">
                                    <i class="bi bi-telephone flex-shrink-0 me-3"></i>
                                    <div>
                                        <h3>Call Us</h3>
                                        <p><?php echo htmlspecialchars($mainLocation['phone']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="info-item d-flex align-items-center justify-content-center">
                                    <i class="bi bi-envelope flex-shrink-0 me-3"></i>
                                    <div>
                                        <h3>Email Us</h3>
                                        <p><?php echo htmlspecialchars($mainLocation['email']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- Fallback static content if no data is available -->
                            <div class="col-md-4 text-center">
                                <div class="info-item d-flex align-items-center justify-content-center">
                                    <i class="bi bi-geo-alt flex-shrink-0 me-3"></i>
                                    <div>
                                        <h3>Location</h3>
                                        <p>123 Medical Drive, Suite 400, New York, NY 10001</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="info-item d-flex align-items-center justify-content-center">
                                    <i class="bi bi-telephone flex-shrink-0 me-3"></i>
                                    <div>
                                        <h3>Call Us</h3>
                                        <p>+1 800 123 4567</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="info-item d-flex align-items-center justify-content-center">
                                    <i class="bi bi-envelope flex-shrink-0 me-3"></i>
                                    <div>
                                        <h3>Email Us</h3>
                                        <p>info@leukemivision.com</p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="mb-5 mt-5" data-aos="fade-up" data-aos-delay="200">
                <div id="map" style="width: 100%; height: 270px;"></div>
            </div>


        </section>



    </main>

    <footer id="footer" class="footer light-background">
        <div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
            <button id="chat-toggle" style="background-color: #003366; color: white; border: none; border-radius: 50%; width: 60px; height: 60px; font-size: 24px; cursor: pointer;">💬</button>
            <div id="chat-container" style="display: none; width: 350px; height: 450px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); position: absolute; bottom: 70px; right: 0;">
                <iframe src="chatbot.php" style="width: 100%; height: 100%; border: none; border-radius: 10px;"></iframe>
            </div>
        </div>

        <script>
            document.getElementById('chat-toggle').addEventListener('click', function() {
                const chatContainer = document.getElementById('chat-container');
                chatContainer.style.display = chatContainer.style.display === 'none' ? 'block' : 'none';
            });
        </script>
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">

                        <span class="sitename">LeukemiaVision</span>
                    </a>
                    <div class="footer-contact pt-3">

                        <?php if (!empty($locationData)) : ?>

                            <p><?= htmlspecialchars($locationData[0]['address']) ?></p>
                            <p class="mt-3">
                                <strong>Phone:</strong>
                                <span><?= htmlspecialchars($locationData[0]['phone']) ?></span>
                            </p>
                            <p>
                                <strong>Email:</strong>
                                <span><?= htmlspecialchars($locationData[0]['email']) ?></span>
                            </p>
                        <?php else : ?>
                            <p class="mt-3"><strong>Phone:</strong> <span>Phone not available</span></p>
                            <p><strong>Email:</strong> <span>Email not available</span></p>
                        <?php endif; ?>
                    </div>

                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#about">About us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">AI Image Analysis</a></li>
                        <li><a href="#">Chemotherapy</a></li>
                        <li><a href="#">Radiation Therapy</a></li>
                        <li><a href="#">Targeted Therapy</a></li>
                        <li><a href="#">Consultation</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Patient Portal</a></li>
                        <li><a href="#">Clinical Trials</a></li>
                        <li><a href="#">Research Papers</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Connect</h4>
                    <ul>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Career Opportunities</a></li>
                        <li><a href="#">Media Kit</a></li>
                        <li><a href="#">Partnerships</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">LeukemiaVision</strong> <span>All Rights
                    Reserved</span></p>

        </div>
    </footer>

    <a href="#" id="scroll-top"
   class="scroll-top d-flex align-items-center justify-content-center position-fixed end-0 me-3"
   style="bottom: 90px;">
   <i class="bi bi-arrow-up-short fs-3"></i>
</a>



    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- JavaScript for Map -->
    <script>
        const locationData = <?php echo !empty($locationsJson) ? $locationsJson : '[]'; ?>;

        document.addEventListener('DOMContentLoaded', function() {
            // Create map with default view if no data
            const map = L.map('map').setView([40.710059, -74.006138], 14);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // If we have location data
            if (locationData && locationData.length > 0) {
                // Recenter map on first location
                map.setView([parseFloat(locationData[0].lat), parseFloat(locationData[0].lng)], 12);

                // Add markers for each location
                locationData.forEach(location => {
                    const marker = L.marker([parseFloat(location.lat), parseFloat(location.lng)])
                        .addTo(map)
                        .bindPopup(`
                        <div>
                            <h5>${location.name}</h5>
                            <p>${location.address}</p>
                            <p>Phone: ${location.phone}</p>
                            <p>Email: ${location.email}</p>
                        </div>
                    `);
                });
            } else {
                // Add default marker if no data
                L.marker([40.710059, -74.006138]).addTo(map)
                    .bindPopup("Our Location");
            }
        });
    </script>

</body>

</html>