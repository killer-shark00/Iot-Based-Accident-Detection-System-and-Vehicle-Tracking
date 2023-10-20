<?php 
session_start();
$csvFile = $_GET['vehicleCsv'];
$speedFile = $_GET['speedCsv'];

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>VNS</title>
    <link rel="stylesheet" href="Dashboard-style.css" />
    <style>
        iframe {
            position: fixed;
            right: 60px;
            top: 106px;
            border: none;
            z-index:999 ; 
        }
        .box-container {
            position: absolute;
            top: 167px;
            left: 379px;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px;
            font-size: 14px;
            z-index: 999; /* Adjust the z-index if necessary */
        }

        .box-container h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .box-container p {
            margin-top: 0;
            margin-bottom: 5px;
        }
        .track-box{
            position: absolute;
            top: 419px;
            left: 396px;
        }
        .track-button{
            background-color: #94a9c0;
            color: 9999;
            border: none;
            /* border-radius: 4px; */
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<!-- navbar -->
<nav class="navbar">
    <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <img src="img/logo.jpg" alt=""></i>VAAS
    </div>
    <div class="Heading">
        <span style="color:#999;">Vehicle Tracking and Accident Detection System</span>
    </div>

    <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <img src="img/profile.jpg" alt="" class="profile" />
    </div>
</nav>

<!-- sidebar -->
<nav class="sidebar">
    <div class="menu_content">
        <ul class="menu_items">
            <div class="menu_title menu_dahsboard"></div>
            <!-- start -->
            <li class="item">
                <a href="index.php" class="nav_link submenu_item">
                    <span class="navlink_icon">
                        <i class="bx bx-home-alt"></i>
                    </span>
                    <span class="navlink" >Home</span>
                </a>
            </li>
            <!-- end -->

            <!-- start -->
            <li class="item">
                <a href="Tracker-page.php" class="nav_link submenu_item">
                    <span class="navlink_icon">
                        <i class="bx bxs-car"></i>
                    </span>

                    <span class="navlink">Vehicle Tracking</span>
                </a>
            </li>
            <!-- end -->
        </ul>

        <ul class="menu_items">
            <div class="menu_title menu_editor"></div>
            <!-- Start -->
            <!-- <li class="item">
                <a href="#" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bx bxs-car-garage"></i>
                    </span>
                    <span class="navlink">Add Vehicle</span>
                </a>
            </li> -->
            <!-- End -->

            <li class="item">
                <a href="#" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bx bxs-car-crash"></i>
                    </span>
                    <span class="navlink">Accident Details</span>
                </a>
        <ul class="menu_items">
            <div class="menu_title menu_setting"></div>

            <li class="item">
                <a href="logout.php" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bx bx-layer"></i>
                    </span>
                    <span class="navlink">Logout</span>
                </a>
            </li>
        </ul>

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
            <div class="bottom expand_sidebar">
                <span> Expand</span>
                <i class='bx bx-log-in' ></i>
            </div>
            <div class="bottom collapse_sidebar">
                <span> Collapse</span>
                <i class='bx bx-log-out'></i>
            </div>
        </div>
    </div>
</nav>
<!-- <div> -->
<div class="box-container">
    <h2>Vehicle Details</h2>
    <p><strong>Latitude:</strong> <span id="latitude">-</span></p>
    <p><strong>Longitude:</strong> <span id="longitude">-</span></p>
    <p><strong>Speed:</strong> <span id="speed">-</span></p>
    <p><strong>Start Time:</strong> <span id="startTime">-</span></p>
    <p><strong>Current Time:</strong> <span id="CurrTime">-</span></p>
    <p><strong>Distance Covered:</strong> <span id="distanceCovered">-</span> km</p>
    <p><strong>Cost:</strong><span id="fuelCost">-</span></p>
</div>
<div class="track-box">
    <h2>Historical Paths</h2>
    <button class="track-button"  onclick="redirectToTrackingPage('Vehicle1.csv','speed1.csv')">  Route 1  </button>
    <button class="track-button" onclick="redirectToTrackingPage('Vehicle2_new.csv','speed2.csv')">  Route 2  </button>
    <button class="track-button" onclick="redirectToTrackingPage('Vehicle3.csv','speed3.csv')">  Route 3   </button>
</div>
<iframe id="trackFrame" width="400" height="400"></iframe>

<script>
  // Get the speedCsv and vehicleCsv values from the PHP variables
  var speedCsv = '<?php echo $speedFile; ?>';
  var vehicleCsv = '<?php echo $csvFile; ?>';

  // Construct the URL with the speedCsv and vehicleCsv as query parameters
  var url = 'Track.php?speedCsv=' + encodeURIComponent(speedCsv) + '&vehicleCsv=' + encodeURIComponent(vehicleCsv);

  // Set the src attribute of the iframe
  document.getElementById('trackFrame').src = url;
</script>
<script>
     // Function to update the vehicle details in the box container
     function updateVehicleDetails(latitude, longitude, speed, startTime, CurrTime, distanceCovered,fuelCost) {
        document.getElementById('latitude').textContent = latitude;
        document.getElementById('longitude').textContent = longitude;
        document.getElementById('speed').textContent = speed;
        document.getElementById('startTime').textContent = startTime;
        document.getElementById('CurrTime').textContent = CurrTime;
        document.getElementById('distanceCovered').textContent = distanceCovered;
        document.getElementById('fuelCost').textContent = fuelCost;
    }

</script>
<script>
// Listen for messages from the iframe containing the vehicle details
  window.addEventListener('message', function(event) {
    if (event.data.type === 'vehicleDetails') {
      var latitude = event.data.latitude;
      var longitude = event.data.longitude;
      var speed = event.data.speed;
      var startTime = event.data.startTime;
      var CurrTime = event.data.CurrTime;
      var distanceCovered = event.data.distanceCovered;
      var fuelCost = event.data.fuelCost;
        
      // Update the vehicle details in the box container
      updateVehicleDetails(latitude, longitude, speed, startTime, CurrTime, distanceCovered,fuelCost);
    }
  });
</script>
<script>
      function redirectToTrackingPage(vehicleCsvFile, speedCsvFile) {
        window.location.href = "main_track.php?vehicleCsv=" + vehicleCsvFile+ "&speedCsv=" + speedCsvFile;
      }
</script>
<!-- JavaScript -->
<script src="dashboard-js.js"></script>
</body>
</html>

<?php 
}else {
header("Location: login1.php");
}
?>
