<?php
$input_files = [
  'uploads/Vehicle1_prediction_data.csv',
  'uploads/Vehicle2_prediction_data.csv',
  'uploads/Vehicle3_prediction_data.csv'
]; // Replace with the actual file paths for each vehicle

$predictions = [];

foreach ($input_files as $file_path) {
    // Call the Python script and pass the input file path
    $command = "python prediction.py $file_path";
    $output = shell_exec($command);
    
    // Process the output and append the predictions to the array
    $prediction = json_decode($output);
    $predictions[] = $prediction;
}

// Define the vehicle locations
$vehicle_locations = ['Vehicle1.csv', 'Vehicle2.csv', 'Vehicle3.csv']; // Replace with the actual vehicle locations

$response = [];

foreach ($predictions as $index => $prediction) {
    $location = $vehicle_locations[$index];
    $response[$location] = $prediction;
}

// Check if there is an accident prediction
$blink = false;
foreach ($response as $prediction) {
    if ($prediction === 1) {
        $blink = true;
        break;
    }
}

$response['blink'] = $blink;

header('Content-Type: application/json');
echo json_encode($response);
?>
