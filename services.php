<?php
include("database/db.php");

$stmt1 = $connection->prepare("
    SELECT 
           Name,
           Type,
           Availability,
           Description,
           Service_Duration,
           Fee
           
    FROM services
    
");

$stmt1->execute();
$result1 = $stmt1->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Our Services - LeukemiaVision</title>
    <meta name="description"
        content="Explore our comprehensive services at LeukemiaVision including AI-powered leukemia detection and advanced treatment options.">
    <meta name="keywords"
        content="Leukemia services, medical diagnosis, cancer treatment, blood analysis, healthcare services">

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

        /* Service card styles */
        .service-card {
            margin-bottom: 30px;
        }

        .service-profile {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .service-profile:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .service-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .service-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .service-info {
            padding: 25px;
        }

        .service-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--heading-color);
        }

        .service-type {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .service-availability {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .available {
            background-color: #28a745;
            color: white;
        }

        .unavailable {
            background-color: #6c757d;
            color: white;
        }

        .service-desc {
            margin-bottom: 20px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .service-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .service-meta-item {
            display: flex;
            align-items: center;
        }

        .service-meta-item i {
            margin-right: 8px;
            color: #007bff;
        }

        .book-btn {
            display: inline-block;
            padding: 8px 20px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .book-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
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

            .service-image {
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
                    <?php if(isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])): ?>
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
                        <li><a href="index.php#services" class="active">Services</a></li>
                        <li><a href="index.php#doctors">Doctors</a></li>
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
                <h1 data-aos="fade-up">Our Comprehensive Services</h1>
                <p data-aos="fade-up" data-aos-delay="100">Explore our range of specialized services designed to provide accurate diagnosis and effective treatment for leukemia patients</p>
            </div>
        </section>

        <!-- Services List Section -->
        <section class="services-list">
            <div class="container">
                <div class="row">
                    <?php if ($result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            $availabilityClass = ($row["Availability"] == "Available") ? "available" : "unavailable";
                            $icon = '';
                            // Set icon based on service type
                            switch($row["Type"]) {
                                case "Diagnostic":
                                    $icon = "bi-search";
                                    break;
                                case "Treatment":
                                    $icon = "bi-capsule";
                                    break;
                                case "Consultation":
                                    $icon = "bi-chat-square-text";
                                    break;
                                default:
                                    $icon = "bi-clipboard2-pulse";
                            }
                    ?>
                    <div class="col-lg-4 col-md-6 service-card" data-aos="fade-up">
                        <div class="service-profile">
                            <div class="service-image">
                             
                                <?php if ($row["Type"] == "Test"): ?>
                                    <img src="assets/img/Test.png" alt="Diagnostic Service">
                                <?php elseif ($row["Type"] == "Treatment"): ?>
                                    <img src="assets/img/Treatment.png" alt="Treatment Service">
                                <?php endif; ?>
                                   
                            </div>
                            <div class="service-info">
                                <h3 class="service-name">
                                    <i class="bi <?= $icon ?> me-2"></i>
                                    <?= htmlspecialchars($row["Name"]) ?>
                                </h3>
                                <p class="service-type"><?= htmlspecialchars($row["Type"]) ?></p>
                                <span class="service-availability <?= $availabilityClass ?>">
                                    <?= htmlspecialchars($row["Availability"]) ?>
                                </span>
                                <p class="service-desc"><?= htmlspecialchars($row["Description"]) ?></p>
                                
                                <div class="service-meta">
                                    <div class="service-meta-item">
                                        <i class="bi bi-clock"></i>
                                        <span><?= htmlspecialchars($row["Service_Duration"]) ?></span>
                                    </div>
                                    <div class="service-meta-item">
                                        <i class="bi bi-currency-dollar"></i>
                                        <span><?= htmlspecialchars($row["Fee"]) ?></span>
                                    </div>
                                </div>
                                
                                <?php if ($row["Availability"] == "Available" && isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'Patient') { ?>
                                    <a href="patient/patient_frontend/book_appointment.php?service=<?= urlencode($row["Name"]) ?>" class="book-btn">
                                        <i class="bi bi-calendar-check me-1"></i> Book Now
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo '<div class="col-12 text-center"><p>No services found</p></div>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- Parallax CTA Section -->
        <section class="parallax-section">
            <div class="container">
                <div class="parallax-content" data-aos="fade-up">
                    <h2>Ready to Access Our Services?</h2>
                    <p>Our team is ready to provide you with the best care using the latest medical technology and expertise in leukemia diagnosis and treatment.</p>
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
                        <li><a href="services.php">Services</a></li>
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