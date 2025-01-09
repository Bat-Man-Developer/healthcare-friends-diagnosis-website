<!-- index.php -->
<?php
session_start();
include 'server/config.php';
include 'layouts/header.php';
?>

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
                    <h3>Accurate Results</h3>
                    <p>Our diagnosis system is powered by advanced algorithms and up-to-date medical knowledge.</p>
                </div>
                <div class="benefit-item">
                    <h3>Easy to Use</h3>
                    <p>Simple and intuitive interface designed for users of all ages.</p>
                </div>
                <div class="benefit-item">
                    <h3>Privacy First</h3>
                    <p>Your health data is secure and protected with state-of-the-art encryption.</p>
                </div>
                <div class="benefit-item">
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

<?php include 'layouts/footer.php'; ?>