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

//if user has already logged in then take user to account page
if(!isset($_SESSION['logged_in'])){
	header('location: login.php');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <!-- Add CSRF token meta -->
    <meta name="csrf-token" content="<?php echo htmlspecialchars(hash_hmac('sha256', session_id(), 'Blackkarmaholyspirit.01234?')); ?>">
    <title>HealthCare Friends</title>
    <link rel="icon" href="assets/images/FCS_Holdix_Logo.png" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" integrity="sha512-vJ3hR5OeYZ5dB6U5/3eBoTEfH9Nz+IQwFOk/7ixBHZY1T4cWlPOZ0QeYqziIFbUGA5g/Kjf/p9zrXr3D5K6JA==" crossorigin="anonymous"></script>
    <!-- Add SRI hashes for local scripts -->
    <script nonce="<?php echo htmlspecialchars(base64_encode(random_bytes(32))); ?>">
        // Add security measures for JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Sanitize all user inputs
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    this.value = DOMPurify.sanitize(this.value);
                });
            });

            // Add CSRF token to all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <style>
        :root {
            --primary: #4CC9B0;
            --secondary: #6C63FF;
            --light: #F0F7FF;
            --dark: #2D3748;
            --success: #48BB78;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 5%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 35px;
            height: 35px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6rem 1rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            opacity: 0.1;
            animation: pulse 15s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .hero-content {
            max-width: 800px;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleReveal 1s ease-out;
        }

        @keyframes titleReveal {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--dark);
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-out 0.5s both;
        }

        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 201, 176, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 201, 176, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }

        /*-------- website message error / success --------*/
        #webmessage_red {
            background-color: red;
            font-weight: bold;
            text-align: center;
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 2000;
            animation: slideIn 0.3s ease-out forwards, slideOut 0.3s ease-out forwards 5s;
        }

        #webmessage_green{
            background-color: green;
            font-weight: bold;
            text-align: center;
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 2000;
            animation: slideIn 0.3s ease-out forwards, slideOut 0.3s ease-out forwards 5s;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .features {
            padding: 5rem 1rem;
            background: white;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: var(--dark);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--light);
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .footer {
            background: linear-gradient(135deg, #2D3748 0%, #1A202C 100%);
            color: #fff;
            padding: 4rem 1rem 1rem;
            position: relative;
            margin-top: 4rem;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            padding-bottom: 2rem;
        }

        .footer-section h3 {
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
        }

        .footer-section p {
            color: #A0AEC0;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
        }

        .footer-section p:hover {
            color: #fff;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
        }

        .footer-section ul li a {
            color: #A0AEC0;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 1.5rem;
        }

        .footer-section ul li a::before {
            content: '→';
            position: absolute;
            left: 0;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--primary);
            padding-left: 1.8rem;
        }

        .footer-section ul li a:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
            margin-top: 2rem;
        }

        .footer-bottom p {
            color: #718096;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .footer {
                padding: 3rem 1rem 1rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-section {
                text-align: center;
            }

            .footer-section h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .footer-section ul li a {
                padding-left: 0;
            }

            .footer-section ul li a:hover {
                padding-left: 0.5rem;
            }
        }

        /* Add subtle animation for footer appearance */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-section {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .footer-section:nth-child(2) {
            animation-delay: 0.2s;
        }

        .footer-bottom {
            animation: fadeInUp 0.6s ease-out 0.4s forwards;
            opacity: 0;
        }

        /* mobile navigation */
        .hamburger-menu {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1002;
            background: white;
            border-radius: 50%;
            padding: 0.8rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .hamburger-menu {
                display: block;
            }
            
            .navbar {
                display: none;
            }
        }

        .hamburger-box {
            width: 30px;
            height: 24px;
            display: inline-block;
            position: relative;
        }

        .hamburger-inner {
            display: block;
            top: 50%;
            margin-top: -2px;
        }

        .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
            width: 30px;
            height: 2px;
            background-color: var(--primary);
            border-radius: 4px;
            position: absolute;
            transition-property: transform;
            transition-duration: 0.15s;
            transition-timing-function: ease;
        }

        .hamburger-inner::before, .hamburger-inner::after {
            content: "";
            display: block;
        }

        .hamburger-inner::before {
            top: -10px;
        }

        .hamburger-inner::after {
            bottom: -10px;
        }

        /* Spin animation */
        .hamburger-menu.active .hamburger-inner {
            transform: rotate(225deg);
            transition-delay: 0.12s;
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        .hamburger-menu.active .hamburger-inner::before {
            top: 0;
            opacity: 0;
            transition: top 0.1s ease-out, opacity 0.1s 0.12s ease-out;
        }

        .hamburger-menu.active .hamburger-inner::after {
            bottom: 0;
            transform: rotate(-90deg);
            transition: bottom 0.1s ease-out, transform 0.22s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        /* Mobile nav styles */
        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding-top: 5rem;
            z-index: 1001;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            display: block;
        }

        .mobile-nav.active {
            transform: translateX(0);
        }

        .mobile-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav ul li {
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.3s ease;
        }

        .mobile-nav.active ul li {
            opacity: 1;
            transform: translateX(0);
        }

        .mobile-nav.active ul li:nth-child(1) { transition-delay: 0.1s; }
        .mobile-nav.active ul li:nth-child(2) { transition-delay: 0.2s; }
        .mobile-nav.active ul li:nth-child(3) { transition-delay: 0.3s; }
        .mobile-nav.active ul li:nth-child(4) { transition-delay: 0.4s; }
        .mobile-nav.active ul li:nth-child(5) { transition-delay: 0.5s; }

        .mobile-nav ul li a {
            text-decoration: none;
            color: var(--dark);
            font-size: 1.2rem;
            display: block;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
        }

        .mobile-nav ul li a:hover {
            background: rgba(76, 201, 176, 0.1);
            color: var(--primary);
            padding-left: 2.5rem;
        }

        .mobile-nav-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .mobile-nav-close:hover {
            background: rgba(76, 201, 176, 0.1);
        }

        .mobile-nav-close span {
            font-size: 2rem;
            color: var(--primary);
            line-height: 1;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.2;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            background: white;
            padding: 2rem 1rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            width: 250px;
            transition: all 0.3s ease;
            overflow-y: auto;
            z-index: 100;
        }

        .main-content {
            flex: 1;
            padding: 2rem 1rem;
            background: #F7FAFC;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }

        @media (max-width: 500px) {
            .sidebar {
                width: 180px;
            }
            
            .nav-link {
                padding: 0.6rem 0.8rem;
                font-size: 0.9rem;
            }
            
            .user-info {
                padding-bottom: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .user-avatar {
                width: 60px;
                height: 60px;
                font-size: 1.2rem;
            }
        }

        @media (max-width: 400px) {
            .sidebar {
                width: 180px;
            }
            
            .nav-link {
                padding: 0.5rem 0.6rem;
                font-size: 0.85rem;
            }
            
            .user-info h3 {
                font-size: 1rem;
            }
            
            .user-info p {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 300px) {
            .sidebar {
                width: 180px;
            }
            
            .nav-link {
                padding: 0.4rem 0.5rem;
                font-size: 0.8rem;
            }
            
            .user-avatar {
                width: 50px;
                height: 50px;
                font-size: 1rem;
            }
        }

        @media (max-width: 250px) {
            .sidebar {
                width: 180px;
            }
            
            .nav-link {
                padding: 0.3rem 0.4rem;
                font-size: 0.75rem;
            }
            
            .user-info h3 {
                font-size: 0.9rem;
            }
            
            .user-info p {
                font-size: 0.7rem;
            }
        }

        /* Add toggle button for mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            left: 1rem;
            top: 1rem;
            z-index: 1001;
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 5px;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            .sidebar-toggle {
                display: block;
            }
        }

        .user-info {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: var(--primary);
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--primary);
            color: white;
        }

        .nav-link i {
            margin-right: 1rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            color: var(--dark);
            margin: 0;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary);
        }

        .chart-container {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .recent-activity {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #E2E8F0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .activity-details {
            flex: 1;
        }

        .activity-time {
            color: #718096;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-card {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .dashboard-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dashboard-card:nth-child(3) {
            animation-delay: 0.4s;
        }

        .dashboard-card:nth-child(4) {
            animation-delay: 0.6s;
        }
        .diagnosis-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(76, 201, 176, 0.1);
        }

        .symptoms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .symptom-checkbox {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .symptom-checkbox:hover {
            background: #F7FAFC;
        }

        .symptom-checkbox input[type="checkbox"] {
            margin-right: 0.5rem;
        }

        .submit-btn {
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #3BA697;
            transform: translateY(-2px);
        }

        .result-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            display: none;
        }

        .result-section.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        .severity-indicator {
            display: flex;
            align-items: center;
            margin: 1rem 0;
        }

        .severity-bar {
            flex: 1;
            height: 8px;
            background: #E2E8F0;
            border-radius: 4px;
            overflow: hidden;
            margin-right: 1rem;
        }

        .severity-fill {
            height: 100%;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .recommendation-list {
            list-style: none;
            padding: 0;
        }

        .recommendation-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid #E2E8F0;
        }

        .recommendation-item:last-child {
            border-bottom: none;
        }

        .recommendation-icon {
            width: 32px;
            height: 32px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle">☰</button>
    <nav class="navbar">
        <div class="nav-content">
            <a href="index.php" class="logo">
                <div class="logo-icon">H</div>
                HealthCare
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="diagnosis.php">Diagnosis</a></li>
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="registration.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    
    <button class="hamburger-menu" type="button">
        <div class="hamburger-box">
            <div class="hamburger-inner"></div>
        </div>
    </button>

    <div class="mobile-nav">
        <button class="mobile-nav-close">
            <span>&times;</span>
        </button>
        <ul style="text-align: center">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="diagnosis.php">Diagnosis</a></li>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="registration.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!--------- Website Message ------------>
    <?php if(isset($_GET['error'])){ ?>
        <p class="text-center" id="webmessage_red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
    <?php } ?>
    <?php if(isset($_GET['success'])){ ?>
        <p class="text-center" id="webmessage_green"><?php if(isset($_GET['success'])){ echo $_GET['success']; }?></p>
    <?php } ?>
	

    <div class="dashboard-container">
        <aside class="sidebar"><br><br><br>
            <div class="user-info">
                <div class="user-avatar">
                    JD
                </div>
                <h3>John Doe</h3>
                <p>Patient ID: #12345</p>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link active">
                            <i>📊</i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i>📋</i> Diagnosis History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i>📝</i> Health Records
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i>⚙️</i> Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard.php?logout=1" class="nav-link">
                            <i>🚪</i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main>
            <h2>New Medical Diagnosis Form</h2>
            
            <form id="diagnosisForm">
                <!-- Patient Information Section -->
                <section>
                    <h3>Patient Information</h3>
                    <div>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" required>
                        
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" required>
                        
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" required>
                        
                        <label for="gender">Gender</label>
                        <select id="gender" required>
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </section>

                <!-- Vital Signs Section -->
                <section>
                    <h3>Vital Signs</h3>
                    <div>
                        <label for="temperature">Temperature (°F)</label>
                        <input type="number" id="temperature" step="0.1">
                        
                        <label for="bloodPressure">Blood Pressure (mmHg)</label>
                        <input type="text" id="bloodPressure" placeholder="120/80">
                        
                        <label for="heartRate">Heart Rate (bpm)</label>
                        <input type="number" id="heartRate">
                        
                        <label for="respiratoryRate">Respiratory Rate (breaths/min)</label>
                        <input type="number" id="respiratoryRate">
                        
                        <label for="oxygenSaturation">Oxygen Saturation (%)</label>
                        <input type="number" id="oxygenSaturation">
                    </div>
                </section>

                <!-- Primary Complaint Section -->
                <section>
                    <h3>Primary Complaint</h3>
                    <div>
                        <label for="mainSymptom">Main Symptom</label>
                        <input type="text" id="mainSymptom" required>
                        
                        <label for="painLevel">Pain Level (0-10)</label>
                        <input type="range" id="painLevel" min="0" max="10">
                        
                        <label for="duration">Duration of Symptoms</label>
                        <select id="duration" required>
                            <option value="">Select duration</option>
                            <option value="hours">Less than 24 hours</option>
                            <option value="days1-3">1-3 days</option>
                            <option value="days4-7">4-7 days</option>
                            <option value="weeks1-2">1-2 weeks</option>
                            <option value="weeks2+">More than 2 weeks</option>
                            <option value="chronic">Chronic (months/years)</option>
                        </select>
                    </div>
                </section>

                <!-- Associated Symptoms Section -->
                <section>
                    <h3>Associated Symptoms</h3>
                    <div>
                        <h4>General</h4>
                        <label><input type="checkbox" name="symptoms" value="fever"> Fever</label>
                        <label><input type="checkbox" name="symptoms" value="chills"> Chills</label>
                        <label><input type="checkbox" name="symptoms" value="fatigue"> Fatigue</label>
                        <label><input type="checkbox" name="symptoms" value="weakness"> Weakness</label>
                        <label><input type="checkbox" name="symptoms" value="weightLoss"> Weight Loss</label>

                        <h4>Neurological</h4>
                        <label><input type="checkbox" name="symptoms" value="headache"> Headache</label>
                        <label><input type="checkbox" name="symptoms" value="dizziness"> Dizziness</label>
                        <label><input type="checkbox" name="symptoms" value="confusion"> Confusion</label>
                        <label><input type="checkbox" name="symptoms" value="syncope"> Fainting</label>

                        <h4>Respiratory</h4>
                        <label><input type="checkbox" name="symptoms" value="cough"> Cough</label>
                        <label><input type="checkbox" name="symptoms" value="sob"> Shortness of Breath</label>
                        <label><input type="checkbox" name="symptoms" value="wheezing"> Wheezing</label>

                        <h4>Gastrointestinal</h4>
                        <label><input type="checkbox" name="symptoms" value="nausea"> Nausea</label>
                        <label><input type="checkbox" name="symptoms" value="vomiting"> Vomiting</label>
                        <label><input type="checkbox" name="symptoms" value="diarrhea"> Diarrhea</label>
                        <label><input type="checkbox" name="symptoms" value="constipation"> Constipation</label>
                    </div>
                </section>

                <!-- Medical History Section -->
                <section>
                    <h3>Medical History</h3>
                    <div>
                        <label for="pastConditions">Past Medical Conditions</label>
                        <textarea id="pastConditions" rows="3"></textarea>

                        <label for="currentMedications">Current Medications</label>
                        <textarea id="currentMedications" rows="3"></textarea>

                        <label for="allergies">Allergies</label>
                        <textarea id="allergies" rows="2"></textarea>

                        <label for="familyHistory">Family History</label>
                        <textarea id="familyHistory" rows="3"></textarea>
                    </div>
                </section>

                <!-- Social History Section -->
                <section>
                    <h3>Social History</h3>
                    <div>
                        <label for="occupation">Occupation</label>
                        <input type="text" id="occupation">

                        <label for="smoking">Smoking Status</label>
                        <select id="smoking">
                            <option value="never">Never Smoker</option>
                            <option value="former">Former Smoker</option>
                            <option value="current">Current Smoker</option>
                        </select>

                        <label for="alcohol">Alcohol Consumption</label>
                        <select id="alcohol">
                            <option value="none">None</option>
                            <option value="occasional">Occasional</option>
                            <option value="moderate">Moderate</option>
                            <option value="heavy">Heavy</option>
                        </select>
                    </div>
                </section>

                <!-- Additional Information Section -->
                <section>
                    <h3>Additional Information</h3>
                    <div>
                        <label for="additionalNotes">Additional Notes or Concerns</label>
                        <textarea id="additionalNotes" rows="4"></textarea>
                    </div>
                </section>

                <button type="submit">Generate Diagnosis</button>
            </form>

            <div id="resultSection">
                <h3>Diagnosis Results</h3>
                <div id="diagnosisResult"></div>
                <div id="severityIndicator"></div>
                <h4>Recommendations</h4>
                <ul id="recommendationsList"></ul>
            </div>
        </main>

        <script>
            document.getElementById('diagnosisForm').addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = {
                    patientInfo: {
                        firstName: document.getElementById('firstName').value,
                        lastName: document.getElementById('lastName').value,
                        dob: document.getElementById('dob').value,
                        gender: document.getElementById('gender').value
                    },
                    vitalSigns: {
                        temperature: document.getElementById('temperature').value,
                        bloodPressure: document.getElementById('bloodPressure').value,
                        heartRate: document.getElementById('heartRate').value,
                        respiratoryRate: document.getElementById('respiratoryRate').value,
                        oxygenSaturation: document.getElementById('oxygenSaturation').value
                    },
                    mainSymptom: document.getElementById('mainSymptom').value,
                    painLevel: document.getElementById('painLevel').value,
                    duration: document.getElementById('duration').value,
                    symptoms: Array.from(document.querySelectorAll('input[name="symptoms"]:checked'))
                        .map(cb => cb.value),
                    medicalHistory: {
                        pastConditions: document.getElementById('pastConditions').value,
                        currentMedications: document.getElementById('currentMedications').value,
                        allergies: document.getElementById('allergies').value,
                        familyHistory: document.getElementById('familyHistory').value
                    },
                    socialHistory: {
                        occupation: document.getElementById('occupation').value,
                        smoking: document.getElementById('smoking').value,
                        alcohol: document.getElementById('alcohol').value
                    },
                    additionalNotes: document.getElementById('additionalNotes').value
                };

                try {
                    const response = await fetch('server/getdiagnosis.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();
                    displayResults(result);
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while processing your diagnosis: ' + error.message);
                }
            });

            function displayResults(result) {
                document.getElementById('resultSection').style.display = 'block';
                document.getElementById('diagnosisResult').innerHTML = `
                    <p><strong>Possible Condition:</strong> ${result.condition || 'Unknown'}</p>
                    <p>${result.description || 'No description available'}</p>
                `;

                document.getElementById('recommendationsList').innerHTML = 
                    (result.recommendations || ['No recommendations available'])
                        .map(rec => `<li>${rec}</li>`)
                        .join('');
            }

            // mobile navigation
            const mobileNavToggle = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav');
            const mobileNavClose = document.querySelector('.mobile-nav-close');

            mobileNavToggle.addEventListener('click', () => {
                mobileNavToggle.classList.toggle('active');
                mobileNav.classList.toggle('active');
                document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
            });

            // Close mobile nav with close button
            if (mobileNavClose) {
                mobileNavClose.addEventListener('click', () => {
                    mobileNavToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }

            // Close mobile nav when clicking a link
            document.querySelectorAll('.mobile-nav a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileNavToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                });
            });

            // Close mobile nav when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileNav.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                    mobileNavToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        </script>
    </div>
</body>
</html>