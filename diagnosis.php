<!-- diagnosis.php -->
<?php
session_start();
include 'server/config.php';

// Check if user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Get conditions from database
$sql = "SELECT * FROM conditions";
$conditions = mysqli_query($conn, $sql);

include 'layouts/header.php';
?>

<main class="main-content">
    <div class="diagnosis-container">
        <h1>Health Diagnosis</h1>
        
        <div class="diagnosis-form-container">
            <form id="diagnosisForm" method="POST" action="process_diagnosis.php">
                <div class="symptoms-section">
                    <h2>Select Your Symptoms</h2>
                    <div class="symptoms-grid">
                        <div class="symptom-category">
                            <h3>General Symptoms</h3>
                            <div class="symptom-items">
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="fever">
                                    Fever
                                </label>
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="fatigue">
                                    Fatigue
                                </label>
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="headache">
                                    Headache
                                </label>
                                <!-- Add more symptoms -->
                            </div>
                        </div>

                        <div class="symptom-category">
                            <h3>Respiratory Symptoms</h3>
                            <div class="symptom-items">
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="cough">
                                    Cough
                                </label>
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="shortness_of_breath">
                                    Shortness of Breath
                                </label>
                                <!-- Add more symptoms -->
                            </div>
                        </div>

                        <div class="symptom-category">
                            <h3>Digestive Symptoms</h3>
                            <div class="symptom-items">
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="nausea">
                                    Nausea
                                </label>
                                <label class="symptom-checkbox">
                                    <input type="checkbox" name="symptoms[]" value="abdominal_pain">
                                    Abdominal Pain
                                </label>
                                <!-- Add more symptoms -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="additional-info">
                    <h2>Additional Information</h2>
                    <div class="form-group">
                        <label>How long have you been experiencing these symptoms?</label>
                        <select name="duration" required>
                            <option value="">Select duration</option>
                            <option value="1-3 days">1-3 days</option>
                            <option value="4-7 days">4-7 days</option>
                            <option value="1-2 weeks">1-2 weeks</option>
                            <option value="More than 2 weeks">More than 2 weeks</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Severity of symptoms:</label>
                        <select name="severity" required>
                            <option value="">Select severity</option>
                            <option value="Mild">Mild</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Severe">Severe</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional notes:</label>
                        <textarea name="notes" rows="4" placeholder="Enter any additional information about your symptoms"></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Get Diagnosis</button>
                    <button type="reset" class="btn btn-secondary">Clear Form</button>
                </div>
            </form>
        </div>
    </div>
</main>

<div id="diagnosisModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Diagnosis Results</h2>
        <div id="diagnosisResults"></div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>