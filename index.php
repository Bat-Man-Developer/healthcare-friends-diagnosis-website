<?php
// Start session with enhanced security
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Strict');
session_start();

// Regenerate session ID periodically to prevent session fixation
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
} else if (time() - $_SESSION['created'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}

// Set security headers
header("Content-Security-Policy: default-src 'self' https://use.fontawesome.com https://stackpath.bootstrapcdn.com https://cdnjs.cloudflare.com; script-src 'self' https://cdnjs.cloudflare.com 'unsafe-inline'; style-src 'self' https://use.fontawesome.com https://stackpath.bootstrapcdn.com 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' https://use.fontawesome.com https://stackpath.bootstrapcdn.com");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
//header("Permissions-Policy: geolocation=(), microphone=(), camera=()");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #4CC9B0 0%, #6C63FF 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        .loader-container {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .circle-loader {
            width: 150px;
            height: 150px;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-left-color: white;
            border-radius: 50%;
            display: inline-block;
            animation: rotate 1s linear infinite;
            position: relative;
            margin-bottom: 20px;
        }

        .loading-text {
            color: white;
            font-size: 24px;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .progress-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            margin-top: 10px;
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 3s infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }

        .icon-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 40px;
            animation: iconPulse 1s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.2); }
        }

        .progress-bar {
            width: 200px;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0%;
            background: white;
            animation: progress 5s linear forwards;
        }

        @keyframes progress {
            0% { width: 0%; }
            100% { width: 100%; }
        }

    </style>
</head>
<body>
    <div class="particles" id="particles"></div>
    
    <div class="loader-container">
        <div class="circle-loader">
            <div class="icon-container">
                <i class="fas fa-heartbeat"></i>
            </div>
        </div>
        <div class="loading-text">Loading</div>
        <div class="progress-bar"></div>
        <div class="progress-text">Please wait while we redirect you...</div>
    </div>

    <script>
        // Create floating particles
        const particlesContainer = document.getElementById('particles');
        for(let i = 0; i < 30; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 2 + 's';
            particlesContainer.appendChild(particle);
        }

        // Redirect after 5 seconds
        setTimeout(() => {
            window.location.href = 'home.php';
        }, 5000);

        // Add dots to loading text
        const loadingText = document.querySelector('.loading-text');
        let dots = 0;
        setInterval(() => {
            dots = (dots + 1) % 4;
            loadingText.textContent = 'Loading' + '.'.repeat(dots);
        }, 500);
    </script>
</body>
</html>