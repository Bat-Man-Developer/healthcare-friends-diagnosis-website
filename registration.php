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

include("server/getregistration.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HealthCare Diagnosis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: linear-gradient(135deg, #F0F7FF 0%, #E8F0FE 100%);
        }

        .register-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #E2E8F0;
            border-radius: 10px;
            transition: border-color 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary);
        }

        .password-strength {
            height: 5px;
            background: #E2E8F0;
            border-radius: 5px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .form-button {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 201, 176, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .form-footer a {
            color: var(--primary);
            text-decoration: none;
        }

        .error-message {
            background: #FED7D7;
            color: #C53030;
            padding: 0.8rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: none;
        }

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .register-card {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body>
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

    <div class="register-container">
        <div class="register-card">
            <h2 style="text-align: center; margin-bottom: 2rem;">Create Account</h2>
            <div class="error-message" id="error-message"></div>
            <form id="register-form" action="registration.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="registrationfirstname">First Name</label>
                        <input type="text" id="firstName" name="flduserfirstname" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="registrationlastname">Last Name</label>
                        <input type="text" id="lastname" name="flduserlastname" class="form-input" required>
                    </div>
                </div>
                <div class="form-group  full-width">
                    <label for="registrationcountry">Country
                        <select class="form-control" id="registrationcountry" name="fldusercountry" size="1" value="" required>
                            <option value="">Select Country...</option>
                        </select>
                    </label>
                </div><br>
                <div class="form-group  full-width">
                    <label for="registrationzone">Province
                        <select class="form-control" id="registrationzone" name="flduserzone" size="1" value="" required>
                            <option value="">Select Province...</option>
                        </select>
                    </label>
                </div><br>
                <div class="form-group  full-width">
                    <label for="registrationcity">City
                        <select class="form-control" id="registrationcity" name="fldusercity" size="1" value="" required>
                            <option value="">Select City...</option>
                        </select>
                    </label>
                </div><br>
                <div class="form-group  full-width">
                    <label for="registrationlocalarea">Local Area
                        <input type="text" class="form-control" id="registrationlocalarea" name="flduserlocalarea" placeholder="Local Area"/>
                    </label>
                </div>
                <div class="form-group  full-width">
                    <label for="registrationstreetaddress">Street Address
                        <input type="text" class="form-control" id="registrationstreetaddress" name="flduserstreetaddress" placeholder="Street Address" required/>
                    </label>
                </div>
                <div class="form-group  full-width">
                    <label for="registrationpostalcode">Postal Code
                        <input type="number" class="form-control" id="registrationpostalcode" name="flduserpostalcode" placeholder="Postalcode" required/>
                    </label>
                </div>
                <div class="form-group  full-width">
                    <label for="registrationemail">Email
                        <input type="email" class="form-control" id="registrationemail" name="flduseremail" placeholder="Email" required/>
                    </label>
                </div>
                <div class="form-group  full-width">
                    <label for="registrationphonenumber">Phone Number
                        <input type="number" class="form-control" id="registrationphonenumber" name="flduserphonenumber" placeholder="Phone Number" required/>
                    </label>
                </div>
                <div class="form-group full-width">
                    <label for="registrationpassword">Password</label>
                    <input type="password" id="password" name="flduserpassword" class="form-input" required>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrength"></div>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="registrationconfirmpassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="flduserconfirmpassword" class="form-input" required>
                </div>
                <button type="submit" name="registrationBtn" class="form-button">Create Account</button>
                <div class="form-footer">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('register-form');
        const errorMessage = document.getElementById('error-message');
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');

        passwordInput.addEventListener('input', updatePasswordStrength);

        function updatePasswordStrength() {
            const password = passwordInput.value;
            let strength = 0;

            if (password.length >= 8) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^A-Za-z0-9]/)) strength += 25;

            passwordStrength.style.width = `${strength}%`;
            
            if (strength < 50) {
                passwordStrength.style.backgroundColor = '#FC8181';
            } else if (strength < 75) {
                passwordStrength.style.backgroundColor = '#F6E05E';
            } else {
                passwordStrength.style.backgroundColor = '#68D391';
            }
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                showError('Passwords do not match');
                return;
            }

            // Here you would typically submit the form
            form.submit();
        });

        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
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

    <script>
        const countries = [
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan",
            "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi",
            "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic",
            "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic",
            "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia",
            "Fiji", "Finland", "France",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana",
            "Haiti", "Honduras", "Hungary",
            "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Ivory Coast",
            "Jamaica", "Japan", "Jordan",
            "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan",
            "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg",
            "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar",
            "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway",
            "Oman",
            "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal",
            "Qatar",
            "Romania", "Russia", "Rwanda",
            "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria",
            "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu",
            "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan",
            "Vanuatu", "Vatican City", "Venezuela", "Vietnam",
            "Yemen",
            "Zambia", "Zimbabwe"
        ];

        const provinces = {
            "United States": ["California", "New York", "Texas", "Florida"],
            "Canada": ["Ontario", "Quebec", "British Columbia", "Alberta"],
            "United Kingdom": ["England", "Scotland", "Wales", "Northern Ireland"],
            "Germany": ["Bavaria", "North Rhine-Westphalia", "Baden-Württemberg", "Hesse"],
            "France": ["Île-de-France", "Auvergne-Rhône-Alpes", "Nouvelle-Aquitaine", "Occitanie"],
            "Japan": ["Tokyo", "Osaka", "Kanagawa", "Aichi"],
            "Australia": ["New South Wales", "Victoria", "Queensland", "Western Australia"],
            "Brazil": ["São Paulo", "Rio de Janeiro", "Minas Gerais", "Bahia"],
            "South Africa": [
                "Eastern Cape", "Free State", "Gauteng", "KwaZulu-Natal", "Limpopo",
                "Mpumalanga", "North West", "Northern Cape", "Western Cape"
            ],
            "India": ["Maharashtra", "Uttar Pradesh", "Tamil Nadu", "Karnataka"]
        };

        const cities = {
            "California": ["Los Angeles", "San Francisco", "San Diego"],
            "New York": ["New York City", "Buffalo", "Albany"],
            "Ontario": ["Toronto", "Ottawa", "Hamilton"],
            "Quebec": ["Montreal", "Quebec City", "Laval"],
            "England": ["London", "Manchester", "Birmingham"],
            "Scotland": ["Edinburgh", "Glasgow", "Aberdeen"],
            "Bavaria": ["Munich", "Nuremberg", "Augsburg"],
            "North Rhine-Westphalia": ["Cologne", "Düsseldorf", "Dortmund"],
            "Île-de-France": ["Paris", "Versailles", "Saint-Denis"],
            "Auvergne-Rhône-Alpes": ["Lyon", "Grenoble", "Saint-Étienne"],
            "Tokyo": ["Shinjuku", "Shibuya", "Chiyoda"],
            "Osaka": ["Osaka City", "Sakai", "Higashiosaka"],
            "New South Wales": ["Sydney", "Newcastle", "Wollongong"],
            "Victoria": ["Melbourne", "Geelong", "Ballarat"],
            "São Paulo": ["São Paulo City", "Campinas", "Guarulhos"],
            "Rio de Janeiro": ["Rio de Janeiro City", "Niterói", "São Gonçalo"],
            "Eastern Cape": ["Port Elizabeth", "East London", "Mthatha", "Uitenhage", "Queenstown", "King William's Town", "Grahamstown", "Graaff-Reinet", "Cradock", "Butterworth"],
            "Free State": ["Bloemfontein", "Welkom", "Bethlehem", "Kroonstad", "Parys", "Sasolburg", "Odendaalsrus", "Phuthaditjhaba", "Virginia", "Botshabelo"],
            "Gauteng": ["Johannesburg", "Pretoria", "Soweto", "Benoni", "Tembisa", "Boksburg", "Centurion", "Germiston", "Krugersdorp", "Vereeniging", "Springs", "Roodepoort", "Randburg"],
            "KwaZulu-Natal": ["Durban", "Pietermaritzburg", "Newcastle", "Richards Bay", "Ladysmith", "Port Shepstone", "Empangeni", "Vryheid", "Estcourt", "Ulundi"],
            "Limpopo": ["Polokwane", "Tzaneen", "Phalaborwa", "Mokopane", "Thohoyandou", "Louis Trichardt", "Musina", "Lebowakgomo", "Giyani", "Thabazimbi"],
            "Mpumalanga": ["Nelspruit", "Witbank", "Secunda", "Middelburg", "Ermelo", "Standerton", "Barberton", "Piet Retief", "Bethal", "Lydenburg"],
            "North West": ["Rustenburg", "Klerksdorp", "Potchefstroom", "Mahikeng", "Brits", "Lichtenburg", "Zeerust", "Wolmaransstad", "Vryburg", "Schweizer-Reneke"],
            "Northern Cape": ["Kimberley", "Upington", "Kuruman", "Springbok", "De Aar", "Calvinia", "Colesberg", "Port Nolloth", "Prieska", "Douglas"],
            "Western Cape": ["Cape Town", "Stellenbosch", "George", "Paarl", "Worcester", "Oudtshoorn", "Mossel Bay", "Hermanus", "Knysna", "Swellendam"],
            "Maharashtra": ["Mumbai", "Pune", "Nagpur"],
            "Uttar Pradesh": ["Lucknow", "Kanpur", "Agra"]
        };

        const countrySelect = document.getElementById('registrationcountry');
        const provinceSelect = document.getElementById('registrationzone');
        const citySelect = document.getElementById('registrationcity');

        // Populate countries
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country;
            option.textContent = country;
            countrySelect.appendChild(option);
        });

        // Event listener for country selection
        countrySelect.addEventListener('change', function() {
            provinceSelect.innerHTML = '<option value="">Select Province...</option>';
            citySelect.innerHTML = '<option value="">Select City...</option>';

            if (this.value && provinces[this.value]) {
            provinces[this.value].forEach(province => {
                const option = document.createElement('option');
                option.value = province;
                option.textContent = province;
                provinceSelect.appendChild(option);
            });
            }
        });

        // Event listener for province selection
        provinceSelect.addEventListener('change', function() {
            citySelect.innerHTML = '<option value="">Select City...</option>';
        
            if (this.value && cities[this.value]) {
            cities[this.value].forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
            }
        });
    </script>
</body>
</html>