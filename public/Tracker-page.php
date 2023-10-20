<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>VNS</title>
    <link rel="stylesheet" href="Tracker-age.css" />
    <style>
      body {
        /* background: url('img/new.jpg') no-repeat center center fixed ; */
        background-size: cover;
        display: flex;
        justify-content: center;
        align-content: center;
        min-height: 5vh;
        /* background-position: center;
        padding-top: 254px;
        text-align: center; */
      }
      header h1 {
        font-size: 48px;
        color: #999;
        margin-bottom: 20px;
      }

      header button {
        font-size: 24px;
        padding: 10px 20px;
        background-color: var(--blue-color);
        color: var(--white-color);
        border: none;
        border-radius: 8px;
        cursor: pointer;
      }
      .data-table {
          width: 100%;
          /* max-width: 800px; */
          margin: 0 auto; 
          border-collapse: collapse;
          font-size: 14px;
        }

        .data-table th,
        .data-table td {
          padding: 15px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }

        .data-table th {
          background-color: #f2f2f2;
        }

        .data-table tbody tr:hover {
          background-color: #f9f9f9;
          color: #000;
        }

        .data-table tbody tr:nth-child(even) {
          background-color: #f2f2f2;
        }
        .data-table tbody tr:nth-child(odd) {
          color: #B0B5B6;
        }
        .track-button {
          padding: 5px 10px;
          background-color: #007bff;
          color: #fff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }
        .track-button:hover {
          background-color: #0056b3;
        }
        .vehicle-image {
          width: 147px;
          height: 94px;
        }
        .blink-button {
          background-color: green;
          color: white;
          padding: 8px 16px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          animation: blink 1s infinite;
        }

      @keyframes blink {
          0% { background-color: green; }
          50% { background-color: red; }
          100% { background-color: green; }
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
        <span style="color: black;">Vehicle Accident Alert System</span>
      </div>

      <div class="navbar_content">
        <!-- <button id="alertButton" class="blink-button" onclick="ToAccidentdetailpage()" >Alert</button> -->
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <!-- <i class='bx bx-bell' ></i> -->
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
              <span class="navlink">Home</span>
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
              <!-- Do something about this -->
              <!-- <i class="bx bx-chevron-right arrow-left"></i> -->
            </a>

            <!-- <ul class="menu_items submenu">
              <a href="Tracker-page.php" class="nav_link sublink" >Vehicle 1</a>
              <a href="Tracker-page.php" class="nav_link sublink" >Vehicle 2</a>
              <a href="Tracker-page.php" class="nav_link sublink" >Vehicle 3</a>
            </ul> -->
          </li>
          <!-- end -->
        </ul>

        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          <!-- Start -->
          <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-car-garage"></i>
              </span>
              <span class="navlink">Add Vehicle</span>
            </a>
          </li>
          <!-- End -->

          <li class="item">
            <!-- <a href="AccidentDetail.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-car-crash"></i>
              </span>
              <span class="navlink">Accident Details</span>
            </a> -->
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
    <div>
      <header style="text-align: center;">
        <!-- <h1 style="padding-top: 200px;" >Vehicle Tracking</h1> -->
        <!-- <button style="margin: 20px auto; display: block; padding: 10px 20px; font-size: 16px;" onclick="redirectToTrackingPage()">Track</button> -->
      </header>

      <div class="table-container" style="display: flex; justify-content: flex-start; padding-top: 113px;padding-left:76px">
    <table class="data-table">
      <thead>
        <tr>
          <th>Serial No</th>
          <th>Vehicle Name</th>
          <th>     </th>
          <th>Km Travelled</th>
          <th>Chasis No</th>
          <th>Action</th>
          <th>Accident Alert</th>
        </tr>
      </thead>
      <tbody>
        <!-- Insert dynamic data here -->
        <tr>
          <td>1</td>
          <td>Vehicle 1</td><td><img src="img/Vehicle1.jpg" alt="Vehicle 1 Image" class="vehicle-image" /></td>
          <td>567</td>
          <td>JH4TB2H26CC000987</td>
          <td><button class="track-button" onclick="redirectToTrackingPage('Vehicle1.csv','speed1.csv')">Track</button></td>
          <td><button id="alertButton1" class="blink-button">Alert</button></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Vehicle 2</td>
          <td><img src="img/Vehicle2.jpg" alt="Vehicle 1 Image" class="vehicle-image" /></td>
          <td>890</td>
          <td>1G1RA6E43BU234561</td>
          <td><button class="track-button" onclick="redirectToTrackingPage('Vehicle2_new.csv','speed2.csv')">Track</button></td>
          <td><button id="alertButton2" class="blink-button">Alert</button></td>
        </tr>
        <tr>
          <td>3</td>
          <td>Vehicle 3</td>
          <td><img src="img/Vehicle3.jpg" alt="Vehicle 1 Image" class="vehicle-image" /></td>
          <td>345</td>
          <td>WVWZZZ1KZDM564320</td>
          <td><button class="track-button" onclick="redirectToTrackingPage('Vehicle3.csv','speed3.csv')">Track</button></td>
          <td><button id="alertButton3" class="blink-button">Alert</button></td>
        </tr>
      </tbody>
    </table>
  </div>
    </div>

    <!-- JavaScript -->
    <script src="dashboard-js.js"></script>
    <script>
      function redirectToTrackingPage(vehicleCsvFile, speedCsvFile) {
        window.location.href = "main_track.php?vehicleCsv=" + vehicleCsvFile+ "&speedCsv=" + speedCsvFile;
      }
    </script>
    <script>
      // Function to start blinking the button
        function startBlinking(buttonId) {
          var button = document.getElementById(buttonId);
          button.classList.add("blink-button");
        }

        // Function to stop blinking the button
        function stopBlinking(buttonId) {
          var button = document.getElementById(buttonId);
          button.classList.remove("blink-button");
        }

        // Function to handle the response from the server
        function handleResponse(response, buttonId) {
          if (response.blink) {
            startBlinking(buttonId);
          }
          
          // Add a click event listener to the button
          var alertButton = document.getElementById(buttonId);
          alertButton.addEventListener("click", redirectToAccidentDetailPage);
        }

        // Function to redirect to the AccidentDetail page
        function redirectToAccidentDetailPage() {
          window.location.href = 'AccidentDetail.php';
        }

        // Simulating receiving an alert from the server
        function simulateAlert(vehicleCsvFile, buttonId) {
          // Make an AJAX request to the server to get the prediction result
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "predict.php?vehicleCsv=" + vehicleCsvFile, true);

          // Define the callback function for the AJAX request
          xhr.onload = function() {
            if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              handleResponse(response, buttonId);
            }
          };

          // Send the AJAX request
          xhr.send();
        }

        // Wait for the DOM content to load before simulating the alerts
        document.addEventListener("DOMContentLoaded", function() {
          simulateAlert('uploads/Vehicle1_prediction_data.csv', 'alertButton1');
          simulateAlert('uploads/Vehicle2_prediction_data.csv', 'alertButton2');
          simulateAlert('uploads/Vehicle3_prediction_data.csv', 'alertButton3');
        });
    </script>
  </body>
</html>

<?php
?>
