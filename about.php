<!-- about.php -->
<?php
session_start();
include 'server/config.php';
include 'layouts/header.php';
?>

<main class="main-content">
    <section class="about-hero">
        <div class="container">
            <h1>About HealthCare Diagnosis</h1>
            <p class="subtitle">Empowering individuals with reliable health information</p>
        </div>
    </section>

    <section class="our-story">
        <div class="container">
            <div class="story-content">
                <div class="story-text">
                    <h2>Our Story</h2>
                    <p>Founded in 2024, HealthCare Diagnosis was created with a simple yet powerful mission: to make preliminary health information accessible to everyone. We understand the anxiety that comes with health concerns, and we're here to provide initial guidance while encouraging appropriate medical consultation.</p>
                    <p>Our team of healthcare professionals and technology experts work together to maintain and update our system, ensuring you receive the most relevant and accurate information possible.</p>
                </div>
                <div class="story-image">
                    <div class="image-placeholder"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-mission">
        <div class="container">
            <h2>Our Mission</h2>
            <div class="mission-grid">
                <div class="mission-card">
                    <h3>Accessibility</h3>
                    <p>Making health information accessible to everyone, anywhere, at any time.</p>
                </div>
                <div class="mission-card">
                    <h3>Education</h3>
                    <p>Empowering users with knowledge about their health and well-being.</p>
                </div>
                <div class="mission-card">
                    <h3>Innovation</h3>
                    <p>Continuously improving our system with the latest medical research and technology.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2>Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image"></div>
                    <h3>Dr. Sarah Johnson</h3>
                    <p>Medical Director</p>
                </div>
                <div class="team-member">
                    <div class="member-image"></div>
                    <h3>Dr. Michael Chen</h3>
                    <p>Chief Medical Officer</p>
                </div>
                <div class="team-member">
                    <div class="member-image"></div>
                    <h3>Emma Thompson</h3>
                    <p>Technical Lead</p>
                </div>
            </div>
        </div>
    </section>

    <section class="values-section">
        <div class="container">
            <h2>Our Values</h2>
            <div class="values-grid">
                <div class="value-item">
                    <h3>Accuracy</h3>
                    <p>We prioritize providing accurate and up-to-date health information.</p>
                </div>
                <div class="value-item">
                    <h3>Privacy</h3>
                    <p>Your health data privacy and security are our top priorities.</p>
                </div>
                <div class="value-item">
                    <h3>Transparency</h3>
                    <p>We believe in being clear about what our system can and cannot do.</p>
                </div>
                <div class="value-item">
                    <h3>Support</h3>
                    <p>We're committed to supporting our users throughout their health journey.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <h2>Get in Touch</h2>
            <div class="contact-info">
                <div class="contact-item">
                    <h3>Email</h3>
                    <p>contact@healthcarediagnosis.com</p>
                </div>
                <div class="contact-item">
                    <h3>Phone</h3>
                    <p>(555) 123-4567</p>
                </div>
                <div class="contact-item">
                    <h3>Address</h3>
                    <p>123 Healthcare Avenue<br>Medical District<br>New York, NY 10001</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'layouts/footer.php'; ?>