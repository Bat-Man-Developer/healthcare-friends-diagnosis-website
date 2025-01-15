<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis - HealthCare Diagnosis</title>
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

        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background: white;
            padding: 2rem;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            width: 250px;
            transition: transform 0.3s ease;
        }

        .main-content {
            padding: 2rem;
            background: #F7FAFC;
            margin-left: 250px;
            width: 100%;
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
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

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
    <div class="dashboard-container">
        <aside class="sidebar">
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
                        <a href="#" class="nav-link active">
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
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <h2 class="section-title">New Diagnosis</h2>
            
            <form class="diagnosis-form" id="diagnosisForm">
                <div class="form-group">
                    <label for="mainSymptom">Main Symptom</label>
                    <input type="text" id="mainSymptom" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Additional Symptoms</label>
                    <div class="symptoms-grid">
                        <label class="symptom-checkbox">
                            <input type="checkbox" name="symptoms" value="fever"> Fever
                        </label>
                        <label class="symptom-checkbox">
                            <input type="checkbox" name="symptoms" value="cough"> Cough
                        </label>
                        <label class="symptom-checkbox">
                            <input type="checkbox" name="symptoms" value="fatigue"> Fatigue
                        </label>
                        <label class="symptom-checkbox">
                            <input type="checkbox" name="symptoms" value="headache"> Headache
                        </label>
                        <label class="symptom-checkbox">
                            <input type="checkbox" name="symptoms" value="nausea"> Nausea
                        </label>
                        <label class="symptom-checkbox">
                            <input type="checkbox" name="symptoms" value="dizziness"> Dizziness
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="duration">Duration of Symptoms</label>
                    <select id="duration" class="form-control" required>
                        <option value="">Select duration</option>
                        <option value="1">Less than 24 hours</option>
                        <option value="2">1-3 days</option>
                        <option value="3">4-7 days</option>
                        <option value="4">More than a week</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Additional Details</label>
                    <textarea id="description" class="form-control" rows="4"></textarea>
                </div>

                <button type="submit" class="submit-btn">Get Diagnosis</button>
            </form>

            <div class="result-section" id="resultSection">
                <h3>Diagnosis Results</h3>
                <div class="severity-indicator">
                    <div class="severity-bar">
                        <div class="severity-fill" id="severityFill"></div>
                    </div>
                    <span id="severityText">Moderate</span>
                </div>

                <div id="diagnosisResult"></div>

                <h4>Recommendations</h4>
                <ul class="recommendation-list" id="recommendationsList">
                    <!-- Recommendations will be populated here -->
                </ul>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('diagnosisForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                mainSymptom: document.getElementById('mainSymptom').value,
                symptoms: Array.from(document.querySelectorAll('input[name="symptoms"]:checked'))
                    .map(cb => cb.value),
                duration: document.getElementById('duration').value,
                description: document.getElementById('description').value
            };

            try {
                const response = await fetch('/api/diagnose', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();
                
                // Show results
                const resultSection = document.getElementById('resultSection');
                resultSection.classList.add('active');

                // Update severity indicator
                const severityFill = document.getElementById('severityFill');
                const severityText = document.getElementById('severityText');
                severityFill.style.width = `${result.severity}%`;
                severityText.textContent = getSeverityText(result.severity);

                // Update diagnosis result
                document.getElementById('diagnosisResult').innerHTML = `
                    <p><strong>Possible Condition:</strong> ${result.condition}</p>
                    <p>${result.description}</p>
                `;

                // Update recommendations
                const recommendationsList = document.getElementById('recommendationsList');
                recommendationsList.innerHTML = result.recommendations.map(rec => `
                    <li class="recommendation-item">
                        <div class="recommendation-icon">💡</div>
                        <div>${rec}</div>
                    </li>
                `).join('');

            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while processing your diagnosis');
            }
        });

        function getSeverityText(severity) {
            if (severity < 30) return 'Mild';
            if (severity < 60) return 'Moderate';
            return 'Severe';
        }
    </script>
</body>
</html>