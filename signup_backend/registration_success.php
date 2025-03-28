<?php
session_start();

// Check if user has completed verification
if (!isset($_SESSION['verification_success'])) {
    header("Location: registration.php");
    exit();
}

// Clear the success flag
unset($_SESSION['verification_success']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Registration Success - LeukemiaVision</title>
  <meta name="description" content="Registration successful for LeukemiaVision">
  <meta name="keywords" content="leukemiavision, registration, healthcare">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

  <style>
    body {
      background: url('../assets/img/signback.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    .overlay-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .blur-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }

    .success-card {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      padding: 3rem;
      width: 90%;
      max-width: 500px;
      text-align: center;
      position: relative;
      z-index: 1001;
      transform: translateY(0);
      animation: floatIn 0.8s ease-out;
    }

    @keyframes floatIn {
      0% {
        opacity: 0;
        transform: translateY(40px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .success-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100px;
      height: 100px;
      background-color: #e8f7ee;
      border-radius: 50%;
      margin-bottom: 1.5rem;
      animation: scaleIn 0.5s ease-out 0.3s forwards;
      transform: scale(0);
    }

    @keyframes scaleIn {
      0% {
        transform: scale(0);
      }
      70% {
        transform: scale(1.1);
      }
      100% {
        transform: scale(1);
      }
    }

    .success-icon i {
      font-size: 50px;
      color: #28a745;
    }

    .login-btn {
      background-color: #1977cc;
      border-color: #1977cc;
      padding: 0.75rem 2.5rem;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s ease;
      margin-top: 1.5rem;
      animation: fadeIn 0.8s ease-out 0.8s forwards;
      opacity: 0;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    .login-btn:hover {
      background-color: #166ab9;
      border-color: #166ab9;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(25, 119, 204, 0.4);
    }

    .confetti {
      position: absolute;
      width: 10px;
      height: 10px;
      background-color: #f2f2f2;
      opacity: 0;
    }

    h2 {
      color: #1977cc;
      margin-bottom: 1rem;
      font-weight: 700;
    }

    p {
      color: #555;
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
    }
  </style>
</head>

<body>
  <div class="overlay-container">
    <div class="blur-background"></div>
    <div class="success-card">
      <div class="success-icon">
        <i class="bi bi-check-lg"></i>
      </div>
      <h2>Registration Successful!</h2>
      <p>Your account has been verified and created successfully. You can now log in to access your account.</p>
      <a href="../login.php" class="btn btn-primary btn-lg login-btn">
        <i class="bi bi-box-arrow-in-right me-2"></i>Log in Now
      </a>
    </div>
  </div>

  <!-- Create confetti effect with JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      createConfetti();
    });

    function createConfetti() {
      const colors = ['#1977cc', '#28a745', '#ffc107', '#dc3545', '#6610f2'];
      const container = document.querySelector('.overlay-container');
      
      for (let i = 0; i < 100; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.top = -10 + 'px';
        confetti.style.width = Math.random() * 10 + 5 + 'px';
        confetti.style.height = Math.random() * 10 + 5 + 'px';
        confetti.style.opacity = Math.random();
        confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
        
        container.appendChild(confetti);
        
        // Animate each piece of confetti
        animateConfetti(confetti);
      }
    }

    function animateConfetti(confetti) {
      const duration = Math.random() * 3 + 2;
      const delay = Math.random();
      
      confetti.animate([
        { 
          transform: 'translate(0, 0) rotate(0deg)', 
          opacity: 1 
        },
        { 
          transform: 'translate(' + (Math.random() * 400 - 200) + 'px, ' + (window.innerHeight + 100) + 'px) rotate(' + (Math.random() * 720) + 'deg)',
          opacity: 0
        }
      ], {
        duration: duration * 1000,
        delay: delay * 1000,
        easing: 'cubic-bezier(0.25, 0.1, 0.25, 1)',
        fill: 'forwards'
      });
    }
  </script>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>