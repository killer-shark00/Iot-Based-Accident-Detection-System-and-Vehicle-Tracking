<?php
session_start();
$csvFile = $_GET['vehicleCsv'];
$speedFile = $_GET['speedCsv'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime location tracker</title>
    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            position: relative;
        }
        #map {
            width: 100%;
            height: 400px;
            /* z-index: 9999; */
        }
        .home-button {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: -999;
            padding: 10px 20px;
            background-color: #E1A04E;
            border-radius: 5px;
            cursor: pointer;
        }
        .home-button:hover {
            background-color: #E9F89C;
        }
        .home-button i {
            vertical-align: middle;
        }
        .speed-indicator {
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: -9999;
            width: 50px;
            height: 50px;
            background-color: #2196f3;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }
        .time-box {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: -9999;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <div class="home-button" onclick="goToHomePage()">
        <i class="bx bx-home"></i> Home
    </div>
    <div class="speed-indicator" id="speedIndicator"></div>
    <div class="time-box" id="timeBox">
        <div><strong>Start Time:</strong> <span id="startTime"></span></div>
        <div><strong>Current Time:</strong> <span id="currTime"></span></div>
        <div><strong>Distance Covered:</strong> <span id="distanceCovered">0</span> km</div>
        <div><strong>Fuel Cost:</strong> <span id="fuelCost">0</span> Ruppees</div>
    </div>

    <!-- leaflet js  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        // Map initialization
        var map = L.map('map').setView([-25.316496, -52.32188], 7, 12.09);
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        osm.addTo(map);
        var i = 1;
        var marker, circle;
        var polyline = L.polyline([], { color: 'blue' }).addTo(map);
        var distanceCovered = 0;
        var speedValue=0;
        var startDateTime;
        
        var mileage = 15; // Mileage in km/l
        var fuelCost = 100; // Cost of fuel in Ruppess per liter

        function trackVehicle(csvFile, speedCsvFile) {
            if (!navigator.geolocation) {
                console.log("Your browser doesn't support the geolocation feature!");
            } else {
                $.ajax({
                    url: csvFile,
                    dataType: 'text',
                    success: function (data) {
                        var lines = data.split('\n');
                        var firstLine = lines[1];
                        // console.log(firstLine);

                        if (firstLine) {
                            var firstValues = firstLine.split(',');
                            var startDate = firstValues[3];
                            var startTime = firstValues[4];
                            startDateTime = (startDate + ' ' + startTime);
                            // console.log(startDateTime);
                            // updateTimeBox(startDateTime);
                        }
                    }
                });

                setInterval(() => {
                    $.ajax({
                        url: csvFile,
                        dataType: 'text',
                        success: function (data) {
                            updateLocation(data, i++);
                        }
                    });
                }, 50);

                setInterval(() => {
                    $.ajax({
                        url: speedCsvFile,
                        dataType: 'text',
                        success: function (speedData) {
                            var speedLines = speedData.split('\n');
                            speedValue = parseFloat(speedLines[i]);
                            if (!isNaN(speedValue)) {
                                updateSpeedIndicator(speedValue);
                            } else {
                                updateSpeedIndicator(0);
                            }
                        }
                    });
                }, 50);
            }

        function updateLocation(data, i) {
            var lines = data.split('\n');
            var lastLine = lines[i];

            if (lastLine) {
                var values = lastLine.split(',');
                var lat = parseFloat(values[0]);
                var long = parseFloat(values[1]);
                var accuracy = parseFloat(values[2]);
                var dateParts = values[3];
                var timeParts = values[4];

                if (marker) {
                    map.removeLayer(marker);
                    var distance = calculateDistance(marker.getLatLng().lat, marker.getLatLng().lng, lat, long);
                    distanceCovered += distance;
                }
                if (circle) {
                    map.removeLayer(circle);
                }

                marker = L.marker([lat, long]);
                circle = L.circle([lat, long], { radius: accuracy });
                var featureGroup = L.featureGroup([marker, circle]).addTo(map);
                map.fitBounds(featureGroup.getBounds());

                var latlng = L.latLng(lat, long);
                polyline.addLatLng(latlng);

                
                dateTime=(dateParts + ' ' + timeParts);
                console.log(dateTime);
                
                // updateCurrTimeBox(dateTime);
                
                // Update the distance covered in the HTML
                var distanceCoveredElement = document.getElementById('distanceCovered');
                distanceCoveredElement.textContent = distanceCovered.toFixed(2);

                // Calculate fuel cost
                var fuelCostElement = document.getElementById('fuelCost');
                var fuelUsed = distanceCovered / mileage;
                var costOfFuelUsed = fuelUsed * fuelCost;
                fuelCostElement.textContent = costOfFuelUsed.toFixed(2);
            
                console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
                window.parent.postMessage({
                    type: 'vehicleDetails',
                    latitude: lat,
                    longitude: long,
                    speed: speedValue,
                    startTime: startDateTime,
                    CurrTime: dateTime,
                    distanceCovered: distanceCoveredElement.textContent,
                    fuelCost: fuelCostElement.textContent
                }, '*');
            }
        }

        }

        function updateSpeedIndicator(speed) {
            var speedElement = document.getElementById('speedIndicator');
            speedElement.textContent = speed.toFixed(1);
        }

        function goToHomePage() {
            // Redirect to the home page
            window.location.href = 'Tracker-page.php'; // Replace with the actual home page URL
        }

        function calculateDistance(lat1, lng1, lat2, lng2) {
            var earthRadius = 6371; // Earth's radius in kilometers

            var lat1Rad = degToRad(lat1);
            var lat2Rad = degToRad(lat2);
            var latDiffRad = degToRad(lat2 - lat1);
            var lngDiffRad = degToRad(lng2 - lng1);

            var a = Math.sin(latDiffRad / 2) * Math.sin(latDiffRad / 2) +
                Math.cos(lat1Rad) * Math.cos(lat2Rad) *
                Math.sin(lngDiffRad / 2) * Math.sin(lngDiffRad / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            var distance = earthRadius * c;
            return distance;
        }

        function degToRad(degrees) {
            return degrees * (Math.PI / 180);
        }

        trackVehicle('<?php echo $csvFile; ?>', '<?php echo $speedFile; ?>');
    </script>
</html>
<?php
?>