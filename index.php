<?php 
  session_start();

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
      .box {
            background-color: #fff;
            width: 300px;
            padding: 20px;
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
      <!-- <div class="Heading">
        <span style="color:#999;">Vehicle Navigation System</span>
      </div> -->
      <!-- <div class="search_bar">
        <input type="text" placeholder="Search" />
      </div> -->

      <div class="navbar_content">
    <!-- <button id="alertButton" class="blink-button">Alert</button> -->
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
          <!-- </li>
          <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-cloud-upload"></i>
              </span>
              <span class="navlink">Upload new</span>
            </a>
          </li>
        </ul> -->
        <ul class="menu_items">
        <div class="menu_title menu_setting"></div>
          <!-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-flag"></i>
              </span>
              <span class="navlink">Notice board</span>
            </a>
          </li> -->
          <!-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-medal"></i>
              </span>
              <span class="navlink">Award</span>
            </a>
          </li> -->
          <!-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-cog"></i>
              </span>
              <span class="navlink">Setting</span>
            </a>
          </li> -->
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
  <header style="padding-top: 193px; padding-left: 645px; color:#999">
    <h1>Welcome <?php echo $_SESSION['user_name']; ?></h1>
  </header>
  <div style="display: flex; justify-content: space-around; 
    padding-top: 40px;
    padding-left: 260px;">
    <div class="box">
      <!-- <h2>Service 1</h2> -->
      <h2>Real-time Vehicle Tracking using GPS</h2>
    </div>
    <div class="box">
      <!-- <h2>Service 2</h2> -->
      <h2>Accident Detection and Alarm Generation</h2>
    </div>
    <div class="box">
      <!-- <h2>Service 3</h2> -->
      <h2>User Friendly Interface</h2>
    </div>
  </div>
</div>
    <!-- JavaScript -->
    <script src="dashboard-js.js"></script>
    <script>
      // Function to start blinking the button
function startBlinking() {
  var button = document.getElementById("alertButton");
  button.classList.add("blink-button");
}

// Function to stop blinking the button
function stopBlinking() {
  var button = document.getElementById("alertButton");
  button.classList.remove("blink-button");
}

// Function to handle the response from the server
function handleResponse(response) {
  if (response.blink) {
    startBlinking();
  }
  
  // Add a click event listener to the button
  var alertButton = document.getElementById("alertButton");
  alertButton.addEventListener("click", redirectToAccidentDetailPage);
}

// Function to redirect to the AccidentDetail page
function redirectToAccidentDetailPage() {
  window.location.href = 'AccidentDetail.php';
}

// Simulating receiving an alert from the server
function simulateAlert() {
  // Make an AJAX request to the server to get the prediction result
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "predict.php", true);

  // Define the callback function for the AJAX request
  xhr.onload = function() {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      handleResponse(response);
    }
  };

  // Send the AJAX request
  xhr.send();
}

// Wait for the DOM content to load before simulating the alert
document.addEventListener("DOMContentLoaded", function() {
  simulateAlert();
});

    </script>
</body>
</html>

<?php 
}else {
   header("Location: login1.php");
}
 ?>