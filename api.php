<?php
set_time_limit(0);
ignore_user_abort(true);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

class Model
{
    private $pythonExePath = "c:/Users/user/AppData/Local/Programs/Python/Python312/python.exe";
    private $scriptPath = "c:/Xampp/htdocs/healthcare-friends-diagnosis-website/ai_model.py";

    private function executeCommand($input)
    {
        $output = null;
        
        // Keep executing until we get a valid response
        while($output === null) {
            // Save input to JSON file
            $jsonData = json_encode(['input' => $input]);
            $jsonFile = 'ai_memory.json';
            file_put_contents($jsonFile, $jsonData);

            $escapedPythonScript = escapeshellarg($this->scriptPath);
            $escapedInput = escapeshellarg($input);
            $fullCommand = sprintf('%s %s %s', 
                escapeshellarg($this->pythonExePath),
                $escapedPythonScript,
                $escapedInput
            );
            
            $output = shell_exec($fullCommand);

            // Delete JSON file after getting response
            if (file_exists($jsonFile)) {
                unlink($jsonFile);
            }

            if ($output === null) {
                sleep(1); // Wait before retrying
            }
        }

        return trim($output);
    }

    public function getModel($input)
    {
        return $this->executeCommand($input);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['input'])) {
        try {
            $model = new Model();
            $input = $data['input'];
            $response = $model->getModel($input);
            
            if ($response === null) {
                throw new Exception('Python script execution failed');
            }
            
            echo json_encode([
                'status' => 'success',
                'response' => $response
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'No input provided'
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed'
    ]);
}