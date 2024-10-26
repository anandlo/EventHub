<?php
  require_once 'serverlogin.php';

  //Establish database connection
  $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //Check if the form is submitted and the method is POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Fetching the information from the form
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $communityGroup = $_POST['communityGroup'];
    $typeOfGroup = $_POST['typeOfGroup'];
    $contactName = $_POST['contactName'];
    $contactEmail = $_POST['contactEmail'];
    $groupImage = $_POST['groupImage'];
    $finalLocation = '';
    $informationofGroup = $_POST['informationofGroup'];
    $checkForJpg = substr($groupImage, -4);
    if ($checkForJpg === ".jpg") {
        $finalLocation =  "files/images/events/" . $groupImage;
    } else {
        $groupImage .= ".jpg";
        $finalLocation =  "files/images/events/" . $groupImage;
    }
    //Prepare statement for checking if username exists
    $queryCheckUsername = "SELECT Username FROM login WHERE Username = ?";
    $stmtCheckUsername = $conn->prepare($queryCheckUsername);
    $stmtCheckUsername->bind_param("s", $username);

    //Check if username already exists
    $stmtCheckUsername->execute();

    //Store the result from the executed statement
    $stmtCheckUsername->store_result();

    //Get the number of rows returned by the query
    $numRows = $stmtCheckUsername->num_rows;


    //Check password using regex expressions
    $error_Msg = "";
    if (strlen($password) < 7) {
      $error_Msg .= "The password must be at least 7 characters. <br>";
    }

    if (!preg_match('/[^A-Za-z0-9_\-]+/', $password)) {
      $error_Msg .= "The password must contain only letters and numbers (no special characters allowed). <br>";
    }

    if (!preg_match('/[A-Z]+/', $password)) {
      $error_Msg .= "The password must contain at least one uppercase letter (e.g., Capital A). <br>";
    }

    if (!preg_match('/[0-9]+/', $password)) {
      $error_Msg .= "The password must contain at least one number. <br>";
    }

    //Username already exists
    if ($numRows > 0) {
      $display = '<p>Username already exists. Please choose a different Username</p>';
    } 
    
    else 
    {            
      if (empty($error_Msg)) 
      {
        $pass = password_hash ($password, PASSWORD_DEFAULT);

        //Prepare statement for inserting a new group
        $queryInsertGroup = "INSERT INTO groups (GroupName, GroupImage, GroupType, GroupDesc, ContactName, ContactEmail) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsertGroup = $conn->prepare($queryInsertGroup);
        $stmtInsertGroup->bind_param("ssssss", $communityGroup, $finalLocation, $typeOfGroup, $informationofGroup, $contactName, $contactEmail);

        //Execute the prepared statement to insert a new group
        $stmtInsertGroup->execute();

        //Get the newly inserted group's ID
        $newGroupID = $stmtInsertGroup->insert_id;

        //Prepare statement for inserting a new login entry
        $queryInsertLogin = "INSERT INTO login (GroupID, Username, Password) VALUES (?, ?, ?)";
        $stmtInsertLogin = $conn->prepare($queryInsertLogin);
        $stmtInsertLogin->bind_param("iss", $newGroupID, $username, $pass);

        //Execute the prepared statement to insert a new login entry
        $stmtInsertLogin->execute();

        //Get the newly inserted login's ID
        $newAccountID = $stmtInsertLogin->insert_id;

        //Setting the session variables
        session_start();
        $_SESSION['login'] = TRUE;
        $_SESSION['GroupID'] = $newGroupID;
        $_SESSION['AccountID'] = $newAccountID;

        //Redirect to post.php after creating the account
        header("Location: post.php");
        exit();
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>What's Happening</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/ [1].
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>What's Happening</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <!-- changed some links-->
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href="events.php?target="><span>Events</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <!-- changed the dropdown-->
            <ul>
              <li><a href="events.php?target=">All Events</a></li>
              <li><a href="events.php?target=Music">Music</a></li>
              <li class="dropdown"><a href="events.php?target=Art%2BCulture"><span>Art+Culture</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="events.php?target=Sports">Sports</a></li>
              <li><a href="events.php?target=Food">Food</a></li>
              <li><a href="events.php?target=Fund%20Raiser">Fund Raiser</a></li>
            </ul>
          </li>
          <li><a href="groups.php">Community Groups</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="post.php">Post Event</a></li>
          <li class="dropdown"><a href="login.php"><span>Login</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <!--Changed the text from Contact to Login-->
            <h1 class="page-title">Create Account</h1>
          </div>
        </div>
        <!--Removed the row from here-->

        <div class="form mt-5">
          <form action="createAccount.php" method="post" role="form" class="php-email-form">
            <b>Tell us about your group:</b>
            <div class="form-group">
              <input type="text" class="form-control" name="communityGroup" id="communityGroup" placeholder="Your Community Group" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="typeOfGroup" id="typeOfGroup" placeholder="What type of group are you?" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="contactName" id="contactName" placeholder="Provide a Contact Name for your group" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="contactEmail" id="contactEmail" placeholder="Provide a Contact Email for your group" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="groupImage" id="groupImage" placeholder="Group Image" required>
            </div>
            <div class="form-group">
              <textarea type="text" class="form-control" name="informationofGroup" id="informationofGroup" placeholder="Tell us about your group" required></textarea>
            </div>
            <br>
            <b>Create an Account:</b>
            <div class="form-group">
              <input type="Your Username" class="form-control" name="Username" id="Username" placeholder="Create a Username" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="Password" id="Password" placeholder="Create a Password" required>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <!--Changed the name of the button to Login from Swnd Message-->
            <div class="text-center"><button type="submit" style="background-color: green; color: white;">Submit</button></div>
          </form>
        </div><!-- End Contact Form -->

      </div>

      <!-- Display feedback message -->
      <?php 
        if (isset($display) || !empty($error_Msg)) {
          $output = <<<HTML
          <div style="text-align: center;">
            $display
            $error_Msg
          </div>  
          HTML;
          echo($output);
        }
      ?>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
  
        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About What's Happening</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.php" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3>
            <ul class="footer-links list-unstyled">
              <!--Changed the links-->
              <li><a href="index.php"><i class="bi bi-chevron-right"></i> Home</a></li>
              <li><a href="events.php?target="><i class="bi bi-chevron-right"></i> Events</a></li>
              <li><a href="groups.php"><i class="bi bi-chevron-right"></i> Community Groups</a></li>
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> About</a></li>
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> Post Event</a></li>
              <li><a href="login.php"><i class="bi bi-chevron-right"></i> Login</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Events</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="events.php?target="><i class="bi bi-chevron-right"></i> All Events</a></li>
              <li><a href="events.php?target=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
              <li><a href="events.php?target=Art%2BCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
              <li><a href="events.php?target=Sports"><i class="bi bi-chevron-right"></i> Sports</a></li>
              <li><a href="events.php?target=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
              <li><a href="events.php?target=Fund%20Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  
    <div class="footer-legal">
      <div class="container">
  
        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>
  
            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ [1].-->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
  
          </div>
  
          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
  
          </div>
  
        </div>
  
      </div>
    </div>
  
  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<!--
References:

[1] "ZenBlog - Bootstrap Blog Template", <i>BOOTSTRAPMADE</i> [Online].
    Available: https://bootstrapmade.com/zenblog-bootstrap-blog-template/ [Accessed: Feb. 03, 2024]
-->