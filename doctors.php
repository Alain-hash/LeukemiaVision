<?php
session_start();
include("database/db.php");


if (isset($_SESSION['user_id'])){ 
    include("patient-profileimage.php");
}






$stmt = $connection->prepare(
    "SELECT doctor.Doctor_ID, 
            doctor.Specialization,
            user.Name,
            doctor.Profile_Picture,
            doctor.Rating
     FROM doctor
     JOIN user ON user.User_ID = doctor.User_ID
     WHERE user.Status = 'Active'
     "
);

$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to store doctors
$doctors = array();
while ($doctor = $result->fetch_assoc()) {
    $doctors[] = $doctor;
}

if (isset($_SESSION['user_id']) && $_SESSION['user_Status'] == 'Active' && $_SESSION['user_role'] == 'Patient') {
    $_SESSION['profile_image'] = $profile_image;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Our Doctors - LeukemiaVision</title>
    <meta name="description"
        content="Meet our team of specialized doctors at LeukemiaVision who provide expert care in leukemia diagnosis and treatment.">
    <meta name="keywords"
        content="Leukemia specialists, oncologists, hematologists, cancer doctors, medical professionals">

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

    <style>
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

        /* Doctor card styles */
        .doctor-card {
            margin-bottom: 30px;
        }

        .doctor-profile {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .doctor-profile:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .doctor-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .doctor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .doctor-info {
            padding: 25px;
        }

        .doctor-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--heading-color);
        }

        .doctor-specialty {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .rating {
            color: #ffc107;
            margin-bottom: 10px;
        }

        .doctor-bio {
            margin-bottom: 20px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .appointment-btn {
            display: inline-block;
            padding: 8px 20px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .appointment-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* Review styles */
        .review-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .review {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .reviewer-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .reviewer-name {
            font-weight: 600;
            margin-bottom: 0;
        }

        .review-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .review-content {
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .all-reviews-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .all-reviews-btn:hover {
            text-decoration: underline;
        }

        /* Page header */
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.6)), url('assets/img/hero-bggg.png');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: white;
            text-align: center;
            margin-bottom: 60px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .page-header p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Parallax section */
        .parallax-section {
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.7)), url('assets/img/hero-bggg.png');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 80px 0;
            color: white;
            text-align: center;
            margin: 60px 0;
        }

        .parallax-content h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        .parallax-content p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        .appointment-cta {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .appointment-cta:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-profile-image {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }

            .page-header {
                padding: 60px 0;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .doctor-image {
                height: 200px;
            }
        }
    </style>
</head>

<body>

    <header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center">
                        <a href="mailto:contact@leukemivision.com">contact@leukemivision.com</a>
                    </i>
                    <i class="bi bi-phone d-flex align-items-center ms-4">
                        <span>+961 76 491 905</span>
                    </i>
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
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <span class="fw-bold fs-3" style="color: var(--heading-color);">
                                <?= $_SESSION['user_name'] ?>
                            </span>

                        <?php } else { ?>
                            <a href="index.php" class="logo d-flex align-items-center me-auto">
                                <h1 class="sitename">LeukemiaVision</h1>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="index.php#about">About</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="index.php#doctors" class="active">Doctors</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Patient Portal</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="patient/patient_frontend/medications.php"> Medications</a></li>
                                <li><a href="patient/patient_frontend/patient_progress.php"> Progress & Results</a></li>
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

    <main>
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <h1 data-aos="fade-up">Our Expert Medical Team</h1>
                <p data-aos="fade-up" data-aos-delay="100">Meet our dedicated team of specialists committed to providing the best care in leukemia diagnosis and treatment</p>
            </div>
        </section>

        <!-- Doctors List Section -->
        <section class="doctors-list">
            <div class="container">
                <div class="row">
                    <?php foreach ($doctors as $doctor): ?>
                        <div class="col-lg-4 col-md-6 doctor-card" data-aos="fade-up">
                            <div class="doctor-profile">
                                <div class="doctor-image">
                                    <?php if (!empty($doctor['Profile_Picture'])): ?>
                                        <img src="<?= htmlspecialchars($doctor['Profile_Picture']) ?>" alt="<?= htmlspecialchars($doctor['Name']) ?>">
                                    <?php else: ?>
                                        <img src="assets/img/default_profile_image.png" alt="<?= htmlspecialchars($doctor['Name']) ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="doctor-info">
                                    <h3 class="doctor-name"><?= htmlspecialchars($doctor['Name']) ?></h3>
                                    <p class="doctor-specialty"><?= htmlspecialchars($doctor['Specialization']) ?></p>
                                    <div class="rating">
                                        <?php 
                                        $rating = round($doctor['Rating']);
                                        for ($i = 0; $i < 5; $i++): ?>
                                            <i class="bi <?= ($i < $rating) ? 'bi-star-fill' : 'bi-star' ?>"></i>
                                        <?php endfor; ?>
                                        <span class="ms-2">(22 reviews)</span>
                                    </div>
                                    <p class="doctor-bio">Specialized in treating leukemia using the latest diagnostic technologies and therapeutic approaches. Committed to providing personalized care for every patient.</p>
                                    <a href="patient/patient_frontend/services_option.php" class="appointment-btn">Book Appointment</a>
                                    
                                    <!-- Static Reviews Section -->
                                    <div class="review-section">
                                        <h4>Patient Reviews</h4>
                                        <div class="review">
                                            <div class="review-header">
                                                <img src="assets/img/default_profile_image.png" alt="Patient" class="reviewer-image">
                                                <div>
                                                    <h5 class="reviewer-name">John Smith</h5>
                                                    <div class="rating">
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                    </div>
                                                    <p class="review-date">Apr 10, 2025</p>
                                                </div>
                                            </div>
                                            <p class="review-content">Exceptional care and attention to detail. The doctor took the time to thoroughly explain my diagnosis and treatment options.</p>
                                        </div>
                                        <div class="review">
                                            <div class="review-header">
                                                <img src="assets/img/default_profile_image.png" alt="Patient" class="reviewer-image">
                                                <div>
                                                    <h5 class="reviewer-name">Sarah Johnson</h5>
                                                    <div class="rating">
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star-fill" style="font-size: 0.8rem;"></i>
                                                        <i class="bi bi-star" style="font-size: 0.8rem;"></i>
                                                    </div>
                                                    <p class="review-date">Mar 28, 2025</p>
                                                </div>
                                            </div>
                                            <p class="review-content">Very knowledgeable and compassionate. Made me feel comfortable throughout my treatment journey.</p>
                                        </div>
                                        <a href="#" class="all-reviews-btn">See all 22 reviews</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Parallax CTA Section -->
        <section class="parallax-section">
            <div class="container">
                <div class="parallax-content" data-aos="fade-up">
                    <h2>Ready to Take Control of Your Health?</h2>
                    <p>Our team of experienced specialists is ready to provide you with personalized care using the latest AI-powered diagnostic technology.</p>
                    <a href="patient/patient_frontend/services_option.php" class="appointment-cta">Schedule an Appointment Today</a>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer light-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">LeukemiaVision</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>123 Medical Drive</p>
                        <p>New York, NY 10001</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 800 123 4567</span></p>
                        <p><strong>Email:</strong> <span>info@leukemivision.com</span></p>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#about">About us</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="#">Privacy policy</a></li>
                        <li><a href="#">Terms of service</a></li>
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
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">LeukemiaVision</strong> <span>All Rights Reserved</span></p>
        </div>
    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>