<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthCare Diagnosis</title>
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

        .why-choose-us {
            padding: 5rem 1rem;
            background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 2rem 1rem;
        }

        .benefit-item {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .benefit-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }

        .benefit-item:hover {
            transform: translateY(-5px);
        }

        .benefit-item:hover::before {
            transform: scaleX(1);
        }

        .benefit-item h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .benefit-item p {
            color: var(--dark);
            line-height: 1.6;
        }

        /* Style for CTA section */
        .cta-section {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            padding: 4rem 1rem;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .cta-section p {
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .cta-section .btn-primary {
            background: white;
            color: var(--primary);
        }

        .cta-section .btn-primary:hover {
            background: var(--light);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
            
            .benefit-item {
                padding: 1.5rem;
            }
        }

        .footer {
            background: linear-gradient(135deg, #2D3748 0%, #1A202C 100%);
            color: #fff;
            padding: 4rem 1rem 1rem;
            position: relative;
            margin-top: 4rem;
            text-align: center;
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
            justify-items: center;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 300px;
        }

        .footer-section h3 {
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
            text-align: center;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
            transform: translateX(-50%);
        }

        .footer-section p {
            color: #A0AEC0;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
            text-align: center;
        }

        .footer-section p:hover {
            color: #fff;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
            width: 100%;
            text-align: center;
        }

        .footer-section ul li a {
            color: #A0AEC0;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 0;
            display: inline-block;
        }

        .footer-section ul li a::before {
            content: '→';
            position: absolute;
            left: -1.5rem;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--primary);
            transform: translateX(10px);
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
                max-width: 100%;
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
            .navbar{
                display: none;
            }

            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-particles" id="particles"></div>
    
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
                    <li><a href="register.php">Register</a></li>
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
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
    <main class="main-content">

    <section class="hero">

    <div class="hero-content">

    <h1>Welcome to HealthCare Diagnosis</h1>

    <p>Your trusted partner in understanding your health concerns</p>

    <?php if(!isset($_SESSION['loggedin'])): ?>

    <div class="hero-buttons">

    <a href="register.php" class="btn btn-primary">Get Started</a>

    <a href="login.php" class="btn btn-secondary">Login</a>

    </div>

    <?php else: ?>

    <a href="diagnosis.php" class="btn btn-primary">Start Diagnosis</a>

    <?php endif; ?>

    </div>

    </section>
    <section class="features">
        <div class="features-container">
            <h2 class="section-title">Our Services</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3>Symptom Analysis</h3>
                    <p>Advanced analysis of your symptoms using our comprehensive medical database.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Health Tracking</h3>
                    <p>Monitor your health patterns and maintain a personal health record.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Expert Guidance</h3>
                    <p>Get preliminary health insights based on your symptoms.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose-us">
        <div class="container">
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="feature-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Accurate Results</h3>
                    <p>Our diagnosis system is powered by advanced algorithms and up-to-date medical knowledge.</p>
                </div>
                <div class="benefit-item">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Easy to Use</h3>
                    <p>Simple and intuitive interface designed for users of all ages.</p>
                </div>
                <div class="benefit-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Privacy First</h3>
                    <p>Your health data is secure and protected with state-of-the-art encryption.</p>
                </div>
                <div class="benefit-item">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>24/7 Available</h3>
                    <p>Access our services anytime, anywhere, from any device.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2>Ready to Take Control of Your Health?</h2>
            <p>Join thousands of users who trust our platform for their health concerns.</p>
            <a href="register.php" class="btn btn-primary">Start Your Journey</a>
        </div>
    </section>
    </main>

    <!-- footer.php -->

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="diagnosis.php">Diagnosis</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@healthcare.com</p>
                <p>Phone: +27 (78) 123-4567</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 HealthCare Diagnosis. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size between 5 and 15 pixels
                const size = Math.random() * 10 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Animation
                particle.style.animation = `
                    float ${Math.random() * 10 + 5}s linear infinite,
                    fade ${Math.random() * 3 + 2}s ease-in-out infinite
                `;
                
                particlesContainer.appendChild(particle);
            }
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Initialize
        createParticles();

        // Add scroll animation for features
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });

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
</body>
</html>