<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .error-card {
            max-width: 600px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .error-header {
            background: linear-gradient(135deg, #dc3545 0%, #f34f5e 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .lock-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(0.95);
                opacity: 0.7;
            }
            50% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(0.95);
                opacity: 0.7;
            }
        }
        .countdown {
            font-size: 2rem;
            font-weight: bold;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container error-container">
        <div class="card error-card">
            <div class="error-header">
                <i class="fas fa-lock lock-icon pulse"></i>
                <h1 class="display-5 fw-bold">Unauthorized Access</h1>
                <p class="lead mb-0">Your access has been denied</p>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Access Denied:</strong> Your account might have been deactivated by an administrator, or you don't have permission to access this page.
                </div>
                
                <p class="text-center">You will be redirected in <span id="countdown" class="countdown">5</span> seconds.</p>
                
                <!-- Updated button section using only Bootstrap classes -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="index.php" class="btn btn-primary btn-lg shadow">
                        <i class="fas fa-home me-2"></i>Go to Homepage
                    </a>
                    <a href="login.php" class="btn btn-danger btn-lg shadow">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            </div>
            <div class="card-footer text-center py-3 text-muted">
                <small>If you believe this is an error, please contact the system administrator.</small>
            </div>
        </div>
    </div>

    <!-- Minimal JavaScript for countdown and redirect -->
    <script>
        // Countdown timer
        let seconds = 7;
        const countdownElement = document.getElementById('countdown');
        
        const countdownInterval = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdownInterval);
               
                window.location.href = 'login.php';
            }
        }, 1000);
    </script>
</body>
</html>