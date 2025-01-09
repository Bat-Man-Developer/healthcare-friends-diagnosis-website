<!-- dashboard.php -->
<?php
session_start();
include 'server/config.php';

// Check if user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Get user's diagnosis history
$user_id = $_SESSION["id"];
$sql = "SELECT d.*, c.name as condition_name 
        FROM diagnoses d 
        JOIN conditions c ON d.condition_id = c.id 
        WHERE d.user_id = ? 
        ORDER BY d.diagnosis_date DESC";

if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

include 'layouts/header.php';
?>

<main class="main-content">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["email"]); ?></h1>
            <a href="diagnosis.php" class="btn btn-primary">New Diagnosis</a>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card summary-card">
                <h2>Health Summary</h2>
                <div class="summary-stats">
                    <div class="stat-item">
                        <span class="stat-number"><?php echo mysqli_num_rows($result); ?></span>
                        <span class="stat-label">Total Diagnoses</span>
                    </div>
                    <!-- Add more summary stats -->
                </div>
            </div>

            <div class="dashboard-card">
                <h2>Recent Diagnoses</h2>
                <div class="diagnosis-history">
                    <?php 
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){ ?>
                            <div class="diagnosis-item">
                                <div class="diagnosis-info">
                                    <h3><?php echo htmlspecialchars($row["condition_name"]); ?></h3>
                                    <p class="diagnosis-date">
                                        <?php echo date("F d, Y", strtotime($row["diagnosis_date"])); ?>
                                    </p>
                                </div>
                                <a href="view_diagnosis.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-secondary btn-sm">View Details</a>
                            </div>
                        <?php }
                    } else { ?>
                        <p class="no-data">No diagnosis history available.</p>
                    <?php } ?>
                </div>
            </div>

            <div class="dashboard-card">
                <h2>Health Tips</h2>
                <div class="health-tips">
                    <div class="tip-item">
                        <h3>Stay Hydrated</h3>
                        <p>Drink at least 8 glasses of water daily.</p>
                    </div>
                    <div class="tip-item">
                        <h3>Regular Exercise</h3>
                        <p>Aim for 30 minutes of physical activity daily.</p>
                    </div>
                    <div class="tip-item">
                        <h3>Balanced Diet</h3>
                        <p>Include fruits and vegetables in every meal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'layouts/footer.php'; ?>