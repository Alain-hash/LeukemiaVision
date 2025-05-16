<?php include "../patient_backend/service_option_fetching.php"; ?>
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
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../../assets/css/main.css" rel="stylesheet">

    <!-- Enhanced Custom CSS -->
    <style>
        
        :root {
          --primary-blue: #1977cc;
      --secondary-blue: #106eea;
      --light-blue: #e7f1fd;
      --dark-blue: var(--accent-color);
      --white: #ffffff;
      --light-gray: #f8f9fa;
      --medium-gray: #e9ecef;
      --text-color: #444444;
      --success-color: #28a745;
      --danger-color: #dc3545;
      --warning-color: #ffc107;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8faff;
            color: var(--text-color);
        }

        /* Styles for header profile image - preserved as requested */
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

        /* Enhanced Services Section Styling */
        #appointment-options {
            background: linear-gradient(135deg, #e7f1fd 0%, #f8faff 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        #appointment-options::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: var(--accent-color);
            z-index: 0;
        }

        #appointment-options::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background-color:var(--accent-color);
            z-index: 0;
        }

        .section-title {
            position: relative;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 40px;
            margin-bottom: 15px;
            text-transform: capitalize;
            letter-spacing: -0.5px;
        }

        .section-title p {
            font-size: 18px;
            color: #6c757d;
            max-width: 700px;
            margin: 0 auto;
        }

        .divider-custom {
            position: relative;
            height: 4px;
            width: 80px;
            margin: 20px auto;
            background: linear-gradient(90deg, rgba(16, 110, 234, 0.3) 0%, rgba(16, 110, 234, 1) 100%);
            border-radius: 2px;
        }

        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(16, 110, 234, 0.1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(16, 110, 234, 0.2);
        }

        .card-body {
            padding: 40px 30px;
            position: relative;
            z-index: 1;
        }

        .card-body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            height: 180px;
            width: 180px;
            background-color: rgba(16, 110, 234, 0.03);
            border-radius: 50%;
            transform: translate(40%, -40%);
            z-index: -1;
        }

        .icon-box {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            width: 90px !important;
            height: 90px !important;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(16, 110, 234, 0.3);
            transition: all 0.3s ease;
        }

        .card:hover .icon-box {
            transform: scale(1.1);
        }

        .card-title {
            color: var(--dark-blue);
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .badge {
            padding: 8px 16px;
            font-weight: 500;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
        }

        .list-group-item {
            background: transparent;
            border: none;
            padding: 12px 0;
            font-size: 16px;
            color: var(--text-color);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item i {
            color: var(--primary-blue);
            margin-right: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px var(--accent-color);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(16, 110, 234, 0.3);
        }

        

        /* Decorative elements */
        .decoration-circle {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
            opacity: 0.5;
        }

        .blob-1 {
            width: 300px;
            height: 300px;
            left: -150px;
            top: 20%;
            background: radial-gradient(circle, rgba(16, 110, 234, 0.05) 0%, rgba(16, 110, 234, 0) 70%);
        }

        .blob-2 {
            width: 400px;
            height: 400px;
            right: -200px;
            bottom: 10%;
            background: radial-gradient(circle, rgba(16, 110, 234, 0.07) 0%, rgba(16, 110, 234, 0) 70%);
        }
        /* Enhanced Service Cards Styling */
#appointment-options .card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px var(--accent-color);
}

#appointment-options .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px var(--accent-color);
}

#appointment-options .card-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    position: relative;
    overflow: hidden;
}

#appointment-options .card-header::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    z-index: 1;
}

#appointment-options .card-header::after {
    content: '';
    position: absolute;
    bottom: -30px;
    left: -30px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    z-index: 1;
}

#appointment-options .icon-box {
    position: relative;
    z-index: 2;
    background: rgba(255, 255, 255, 0.2);
    width: 80px !important;
    height: 80px !important;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 3px solid rgba(255, 255, 255, 0.3);
}

#appointment-options .card:hover .icon-box {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 0.3);
}

#appointment-options .service-features {
    background-color: var(--light-blue);
    border-left: 4px solid var(--primary-blue);
}

#appointment-options .list-group-item {
    padding: 12px 0;
    font-size: 15px;
    color: var(--text-color);
    border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
}

#appointment-options .list-group-item:hover {
    padding-left: 5px;
    background-color: rgba(16, 110, 234, 0.03);
}

#appointment-options .list-group-item:last-child {
    border-bottom: none;
}

#appointment-options .list-group-item i {
    color: var(--primary-blue);
    margin-right: 10px;
}

#appointment-options .btn-primary {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    border: none;
    padding: 12px 30px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 15px var(--accent-color);
}

#appointment-options .btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(16, 110, 234, 0.3);
}

/* Animation enhancement */
.fade-in {
    opacity: 0;
    animation: fadeIn ease 1s forwards;
    animation-delay: 0.3s;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Badge styling */
.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* Why Choose Us section */
#appointment-options .info-icon {
    font-size: 48px;
    color: white;
    margin-bottom: 15px;
}
    </style>
</head>

<body class="index-page">

<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@leukemiavision.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 (800) 555-1234</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../../index.html" class="logo d-flex align-items-center me-auto">
          <h1 class="sitename">LeukemiaVision</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="index.html#about">About</a></li>
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#doctors">Doctors</a></li>
            <li class="dropdown"><a href="#" class="active"><span>Patient Portal</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                        <li><a href="medications.php"> Medications</a></li>
                        <li><a href="patient_progress.php"> progress</a></li>
                        <li><a href="appointment-history.php">Your Appointments </a></li>
                        <li><a href="test-results.php">Appointment Results</a></li>
                    </ul>
            </li>
            <li><a href="index.php#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <div class="d-flex align-items-center">
                  

                  
                          <a href="logout.php">
                            <button class="cta-btn btn-sm ms-5 border-0" type="button">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </a>
                   



                </div>
      </div>
    </div>
  </header>

<!-- Enhanced Appointment Options Section -->
<section id="appointment-options" class="py-5">
        <div class="container py-5">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <div class="section-title fade-in">
                        <h2 class="mb-3 animate__animated animate__fadeInDown">Our Specialized Services</h2>
                        <p class="lead text-muted animate__animated animate__fadeInUp animate__delay-1s">Delivering cutting-edge healthcare solutions for leukemia diagnosis and treatment</p>
                        <div class="divider-custom"></div>
                    </div>
                </div>
            </div>
            
         <!-- Replace the existing row of service cards with this improved version -->
<div class="row g-4 justify-content-center">
    <!-- Leukemia Test Card -->
    <div class="col-md-6 col-lg-5">
        <div class="card h-100 animate__animated" data-animation="fadeInLeft">
            <div class="card-header bg-primary text-white text-center py-4 border-0">
                <div class="icon-box mx-auto mb-3">
                    <i class="bi bi-clipboard2-pulse fs-1"></i>
                </div>
                <h3 class="fw-bold mb-1">Leukemia Test</h3>
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">Available Now</span>
            </div>
            <div class="card-body p-4">
                <p class="card-text mb-4">Our advanced leukemia testing services employ cutting-edge AI technology to help diagnose and monitor the disease by detecting abnormal blood cells with exceptional accuracy.</p>
                
                <div class="service-features p-3 bg-light rounded-3 mb-4">
                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2"><i class="bi bi-check2-circle me-2"></i>Available Tests</h5>
                    <ul class="list-group list-group-flush">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <li class="list-group-item d-flex align-items-center bg-transparent">
                                <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                <span><?= htmlspecialchars($row['Name']); ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 p-4">
                <div class="d-grid">
                    <a href="leukemia-appointment.php" class="btn btn-primary btn-lg rounded-pill fw-semibold py-3">
                        <i class="bi bi-calendar-check me-2"></i>Schedule Test Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Treatment Therapies Card -->
    <div class="col-md-6 col-lg-5">
        <div class="card h-100 animate__animated" data-animation="fadeInRight">
            <div class="card-header bg-primary text-white text-center py-4 border-0">
                <div class="icon-box mx-auto mb-3">
                    <i class="bi bi-droplet-half fs-1"></i>
                </div>
                <h3 class="fw-bold mb-1">Treatment Therapies</h3>
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">Available Now</span>
            </div>
            <div class="card-body p-4">
                <p class="card-text mb-4">Our personalized leukemia therapies utilize the latest medical advancements to target and eliminate cancerous blood cells while preserving healthy ones.</p>
                
                <div class="service-features p-3 bg-light rounded-3 mb-4">
                    <h5 class="fw-bold mb-3 text-primary border-bottom pb-2"><i class="bi bi-check2-circle me-2"></i>Available Therapies</h5>
                    <ul class="list-group list-group-flush">
                        <?php while ($row = $result2->fetch_assoc()) { ?>
                            <li class="list-group-item d-flex align-items-center bg-transparent">
                                <i class="bi bi-check-circle-fill text-primary me-3"></i>
                                <span><?= htmlspecialchars($row['Name']); ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 p-4">
                <div class="d-grid">
                    <a href="treatment-reservation.php" class="btn btn-primary btn-lg rounded-pill fw-semibold py-3">
                        <i class="bi bi-calendar-check me-2"></i>Schedule Treatment Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Additional Info Section -->
            <div class="row mt-5 pt-4">
                <div class="col-lg-10 mx-auto">
                    <div class="card border-0 shadow-sm bg-white animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-md-3 bg-primary text-white p-4 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <i class="bi bi-info-circle fs-1 mb-2"></i>
                                        <h5 class="fw-bold">Why Choose Us</h5>
                                    </div>
                                </div>
                                <div class="col-md-9 p-4 p-xl-5">
                                    <h5 class="fw-bold mb-3 text-primary">LeukemiaVision Excellence</h5>
                                    <p class="mb-0">Our facility combines cutting-edge AI technology with expert medical care to provide the most accurate diagnosis and effective treatment options for leukemia patients. Our team of specialists is committed to delivering personalized care with compassion and precision.</p>
                                    <div class="d-flex flex-wrap gap-3 mt-4">
                                        <span class="badge bg-light text-primary px-3 py-2 fs-6"><i class="bi bi-star-fill me-2"></i>Expert Team</span>
                                        <span class="badge bg-light text-primary px-3 py-2 fs-6"><i class="bi bi-graph-up me-2"></i>High Success Rate</span>
                                        <span class="badge bg-light text-primary px-3 py-2 fs-6"><i class="bi bi-shield-check me-2"></i>Advanced Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Appointment Options Section -->

    <footer id="footer" class="footer light-background">

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-4 col-md-6 footer-about">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="sitename">Medilab</span>
      </a>
      <div class="footer-contact pt-3">
        <p>A108 Adam Street</p>
        <p>New York, NY 535022</p>
        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
        <p><strong>Email:</strong> <span>info@example.com</span></p>
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
        <li><a href="#">About us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Terms of service</a></li>
        <li><a href="#">Privacy policy</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Our Services</h4>
      <ul>
        <li><a href="#">Web Design</a></li>
        <li><a href="#">Web Development</a></li>
        <li><a href="#">Product Management</a></li>
        <li><a href="#">Marketing</a></li>
        <li><a href="#">Graphic Design</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Hic solutasetp</h4>
      <ul>
        <li><a href="#">Molestiae accusamus iure</a></li>
        <li><a href="#">Excepturi dignissimos</a></li>
        <li><a href="#">Suscipit distinctio</a></li>
        <li><a href="#">Dilecta</a></li>
        <li><a href="#">Sit quas consectetur</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Nobis illum</h4>
      <ul>
        <li><a href="#">Ipsam</a></li>
        <li><a href="#">Laudantium dolorum</a></li>
        <li><a href="#">Dinera</a></li>
        <li><a href="#">Trodelas</a></li>
        <li><a href="#">Flexo</a></li>
      </ul>
    </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
  <div class="credits">
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
  </div>
</div>

</footer>

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Animation Script -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations with GSAP for smoother transitions
    
    // Helper function to check if element is in viewport
    const isInViewport = (element, offset = 0) => {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * (1 - offset) &&
            rect.bottom >= 0
        );
    };
    
    // Initialize elements that should animate on scroll
    const initAnimations = () => {
        // Get all elements with animation class
        const animElements = document.querySelectorAll('[data-animate]');
        
        animElements.forEach(element => {
            // Add initial state - invisible but taking up space
            element.style.opacity = "0";
            element.style.transform = "translateY(20px)";
            element.style.transition = "opacity 0.8s cubic-bezier(0.5, 0, 0, 1), transform 0.8s cubic-bezier(0.5, 0, 0, 1)";
        });
        
        // First check on page load
        checkAnimations();
    };
    
    // Check which elements should be animated
    const checkAnimations = () => {
        const animElements = document.querySelectorAll('[data-animate]');
        
        animElements.forEach(element => {
            if (isInViewport(element, 0.2) && !element.classList.contains('animated')) {
                // Get animation type if specified
                const animType = element.getAttribute('data-animate') || 'fade';
                const delay = parseFloat(element.getAttribute('data-delay') || 0);
                
                // Add animated class to prevent re-animation
                element.classList.add('animated');
                
                // Set timeout for staggered animations
                setTimeout(() => {
                    // Remove initial state
                    element.style.opacity = "1";
                    element.style.transform = "translateY(0)";
                    
                    // Apply specific animation style based on data attribute
                    if (animType === 'slide-left') {
                        element.style.transform = "translateX(0)";
                    } else if (animType === 'slide-right') {
                        element.style.transform = "translateX(0)";
                    } else if (animType === 'zoom') {
                        element.style.transform = "scale(1)";
                    }
                }, delay * 1000);
            }
        });
    };
    
    // Initialize different animation types
    const initCardAnimations = () => {
        // Cards with slide animation
        const slideCards = document.querySelectorAll('.card[data-animate="slide"]');
        slideCards.forEach((card, index) => {
            card.style.opacity = "0";
            card.style.transform = "translateX(-30px)";
            card.style.transition = "all 0.9s cubic-bezier(0.25, 1, 0.5, 1)";
            card.setAttribute('data-delay', 0.1 * index); // Stagger effect
        });
        
        // Fade animations for section titles
        const titles = document.querySelectorAll('.section-title');
        titles.forEach(title => {
            title.setAttribute('data-animate', 'fade');
            title.style.transitionDuration = "1.2s";
        });
    };
    
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
            once: true,
            mirror: false,
            offset: 100
        });
    } else {
        // If AOS is not available, use our custom animation system
        initAnimations();
        initCardAnimations();
        
        // Optimize scroll listener with requestAnimationFrame
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    checkAnimations();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }
    
    // Handle animations on resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            checkAnimations();
        }, 250);
    }, { passive: true });
    
    // Special animation for hero section if it exists
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.style.opacity = "0";
        heroSection.style.transition = "opacity 1.5s ease-out";
        
        // Show hero section immediately with a subtle fade-in
        setTimeout(() => {
            heroSection.style.opacity = "1";
        }, 100);
    }
    
    // Add animation to navigation items
    const navItems = document.querySelectorAll('nav .nav-item');
    navItems.forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform = "translateY(-10px)";
        item.style.transition = "all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1)";
        
        // Staggered animation for nav items
        setTimeout(() => {
            item.style.opacity = "1";
            item.style.transform = "translateY(0)";
        }, 100 + (index * 100));
    });
});
    </script>
</body>
</html>