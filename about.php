<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - HealthCare Diagnosis</title>
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
        .about-hero {
            background: linear-gradient(135deg, #F0F7FF 0%, #E8F0FE 100%);
            padding: 8rem 2rem 4rem;
            text-align: center;
        }

        .about-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .mission-vision {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 4rem 2rem;
            background: white;
        }

        .mission-card, .vision-card {
            padding: 2rem;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .mission-card:hover, .vision-card:hover {
            transform: translateY(-5px);
        }

        .team-section {
            padding: 4rem 2rem;
            background: var(--light);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .team-member {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .member-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--primary);
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .stats-section {
            padding: 4rem 2rem;
            background: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 4rem auto;
            padding: 2rem;
        }

        .timeline-item {
            padding: 2rem;
            margin: 2rem 0;
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.6s ease;
        }

        .timeline-item.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 50%;
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
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
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <section class="about-hero">
        <div class="about-content">
            <h1>About HealthCare Diagnosis</h1>
            <p>Pioneering the future of accessible healthcare diagnostics</p>
        </div>
    </section>

    <section class="mission-vision">
        <div class="mission-card">
            <h2>Our Mission</h2>
            <p>To provide accessible, accurate, and timely health diagnostics to everyone, everywhere.</p>
        </div>
        <div class="vision-card">
            <h2>Our Vision</h2>
            <p>To revolutionize healthcare accessibility through innovative technology and compassionate service.</p>
        </div>
    </section>

    <section class="team-section">
        <div class="about-content">
            <h2 class="section-title">Our Leadership Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">Dr</div>
                    <h3>Dr. Sarah Johnson</h3>
                    <p>Chief Medical Officer</p>
                </div>
                <div class="team-member">
                    <div class="member-image">T</div>
                    <h3>Tom Anderson</h3>
                    <p>Technical Director</p>
                </div>
                <div class="team-member">
                    <div class="member-image">E</div>
                    <h3>Emma Williams</h3>
                    <p>Head of Research</p>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="about-content">
            <h2 class="section-title">Our Impact</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number" data-target="100000">0</div>
                    <p>Users Helped</p>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="95">0</div>
                    <p>Accuracy Rate (%)</p>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="50">0</div>
                    <p>Medical Experts</p>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline">
        <h2 class="section-title">Our Journey</h2>
        <div class="timeline-item">
            <h3>2020</h3>
            <p>Founded with a vision to revolutionize healthcare diagnostics</p>
        </div>
        <div class="timeline-item">
            <h3>2022</h3>
            <p>Launched AI-powered diagnostic system</p>
        </div>
        <div class="timeline-item">
            <h3>2024</h3>
            <p>Expanded services globally</p>
        </div>
    </section>

        <!-- footer.php -->

        <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@healthcare.com</p>
                <p>Phone: (555) 123-4567</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="diagnosis.php">Diagnosis</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 HealthCare Diagnosis. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Animate stats counter
        function animateCounter(element) {
            const target = parseInt(element.dataset.target);
            const duration = 2000;
            const steps = 50;
            const stepValue = target / steps;
            let current = 0;

            const timer = setInterval(() => {
                current += stepValue;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, duration / steps);
        }

        // Intersection Observer for timeline items
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-item').forEach(item => {
            observer.observe(item);
        });

        // Start counter animation when stats are in view
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    document.querySelectorAll('.stat-number').forEach(stat => {
                        animateCounter(stat);
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        statsObserver.observe(document.querySelector('.stats-grid'));
    </script>
</body>
</html>