<?php
// Function to perform reverse geocoding for a given latitude and longitude
function reverseGeocode($latitude, $longitude) {
    $apiUrl = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat={$latitude}&lon={$longitude}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
    
    if ($data && isset($data['address'])) {
        $address = $data['display_name'];
        return $address;
    } else {
        return "Location not found";
    }
}

// Read the CSV file
$csvFile = "Vehicle2.csv"; // Replace with the path to your CSV file
$handle = fopen($csvFile, "r");

if ($handle !== false) {
    // Skip the header row if it exists
    fgetcsv($handle);

    // Iterate over each line in the CSV file
    while (($data = fgetcsv($handle)) !== false) {
        $latitude = $data[0]; // Assuming latitude is in the first column
        $longitude = $data[1]; // Assuming longitude is in the second column
        
        // Perform reverse geocoding for the coordinates
        $address = reverseGeocode($latitude, $longitude);
        
        echo "Latitude: $latitude, Longitude: $longitude, Address: $address" . "<br>";
    }

    fclose($handle);
} else {
    echo "Failed to open the CSV file.";
}
?>
