/* Custom Message Alert Styling */
.alert-custom {
    border: none;
    border-left: 4px solid #3366cc;
    background-color: #f8f9fa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-radius: 8px;
    margin-bottom: 25px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.alert-custom:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 4px;
    background: linear-gradient(to bottom, #3366cc, #5c85d6);
}

.message-container {
    display: flex;
    align-items: center;
    padding: 15px;
}

.message-icon {
    font-size: 24px;
    color: #3366cc;
    margin-right: 15px;
    flex-shrink: 0;
}

.message-content {
    flex-grow: 1;
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    color: #333;
    line-height: 1.5;
    padding-right: 20px;
}

.alert-custom .btn-close {
    opacity: 0.7;
    transition: all 0.2s ease;
}

.alert-custom .btn-close:hover {
    opacity: 1;
}

/* Animation effect */
@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-custom {
    animation: fadeInSlide 0.4s ease-out forwards;
}




<?php
    if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
        echo '<div class="alert alert-custom fade show" role="alert">
            <div class="message-container">
                <i class="bi bi-info-circle-fill message-icon"></i>
                <div class="message-content">' . $message . '</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>';
    }
    ?>