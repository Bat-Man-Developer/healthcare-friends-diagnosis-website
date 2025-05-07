<?php
include('connection.php');

// Set header to return JSON
header('Content-Type: application/json');

// Function to find matching condition based on symptoms
function findMatchingCondition($conn, $mainSymptom, $additionalSymptoms) {
    // Combine all symptoms into an array
    $allSymptoms = array_merge([$mainSymptom], $additionalSymptoms ?? []);
    
    // Get all conditions from database
    $stmt = $conn->prepare("SELECT * FROM conditions");
    $stmt->execute();
    $result = $stmt->get_result();
    $conditions = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    
    $bestMatch = null;
    $highestMatchScore = 0;
    
    foreach ($conditions as $condition) {
        // Convert stored symptoms string to array
        $conditionSymptoms = explode(',', $condition['fldconditionsymptoms']);
        $conditionSymptoms = array_map('trim', $conditionSymptoms);
        
        // Calculate match score
        $matchScore = 0;
        foreach ($allSymptoms as $symptom) {
            if (in_array(strtolower($symptom), array_map('strtolower', $conditionSymptoms))) {
                $matchScore++;
            }
        }
        
        // Update best match if this score is higher
        if ($matchScore > $highestMatchScore) {
            $highestMatchScore = $matchScore;
            $bestMatch = $condition;
        }
    }
    
    return $bestMatch;
}

// Calculate severity based on duration and number of symptoms
function calculateSeverity($duration, $symptomCount) {
    $durationMultiplier = [
        '1' => 0.8,  // Less than 24 hours
        '2' => 1.0,  // 1-3 days
        '3' => 1.2,  // 4-7 days
        '4' => 1.5   // More than a week
    ];
    
    $baseSeverity = 50;
    $severity = $baseSeverity * $durationMultiplier[$duration];
    $severity += ($symptomCount * 5);
    
    return min(100, max(0, $severity));
}

try {
    // Check if it's a POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed');
    }

    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Invalid input data');
    }

    // Validate required fields
    if (empty($data['mainSymptom']) || empty($data['duration'])) {
        throw new Exception('Missing required fields');
    }

    // Find matching condition
    $matchingCondition = findMatchingCondition(
        $conn,
        $data['mainSymptom'],
        $data['symptoms'] ?? []
    );
    
    if (!$matchingCondition) {
        // Return a default response if no condition is found
        echo json_encode([
            'condition' => 'Unknown Condition',
            'description' => 'Unable to determine a specific condition based on the provided symptoms.',
            'severity' => 30,
            'recommendations' => ['Consult with a healthcare professional for proper diagnosis']
        ]);
        exit;
    }
    
    // Calculate severity
    $severity = calculateSeverity(
        $data['duration'],
        count($data['symptoms'] ?? []) + 1
    );
    
    // Ensure recommendations is an array
    $recommendations = !empty($matchingCondition['fldconditionrecommendations']) 
        ? explode(',', $matchingCondition['fldconditionrecommendations'])
        : ['Consult with a healthcare professional'];
    
    $recommendations = array_map('trim', $recommendations);
    
    // Save diagnosis to database if user is logged in
    if (!empty($data['userId'])) {
        $stmt = $conn->prepare("
            INSERT INTO diagnosis 
            (flduserid, fldconditionid, flddiagnosisdate) 
            VALUES 
            (?, ?, NOW())
        ");
        
        if ($stmt) {
            $stmt->bind_param("ii", $data['userId'], $matchingCondition['fldconditionid']);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    // Return the result
    echo json_encode([
        'condition' => $matchingCondition['fldconditionname'] ?? 'Unknown',
        'description' => $matchingCondition['fldconditiondescription'] ?? 'No description available',
        'severity' => round($severity),
        'recommendations' => $recommendations
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}

// Close database connection
if (isset($conn)) {
    $conn->close();
}