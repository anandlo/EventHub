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
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
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

    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-9 post-content" data-aos="fade-up">
            <?php 
              //Fetch the number of the event using querystring and store it into varName
              $varName = $_GET['number'];
              $varGroupName = $_GET['target'];
              $db_hostname = 'localhost';  
              $db_username = 'root';  //your username
              $db_password = 'root'; //your password
              $db_database = 'whats_happening';
  
              // Establish connection
              $conn = mysqli_connect ($db_hostname, $db_username, $db_password, $db_database);
              if (!$conn) {
                  die("Connection failed!".mysqli_connect_error());
              } 
  
              //Query that selects all rows from the events table
              $events = "SELECT * FROM events";
              $result = mysqli_query($conn, $events);
  
              // Check if query was successful
              if (!$result) {
                  die("Query failed!".mysqli_error($conn));
              }

              //Loop through each row in the events table
              while ($row = $result->fetch_assoc()) {
                //Storing the values of columns in a row into different variables
                $eventID = $row["EventID"];
                $eventTypeID = $row["EventTypeID"];
                $groupID = $row["GroupID"];
                $eventDate = $row["EventDate"];
                $submitDate = $row["SubmitDate"];
                $eventTitle = $row["EventTitle"];
                $eventImage = $row["EventImage"];
                $eventDesc = $row["EventDesc"];

                //Formating the date to a certain format to display it on the page
                $dateTime = date_create($eventDate);//[2]
                $formattedDateTime = date_format($dateTime, 'D d M, Y \T\i\m\e\: h:i A');//[3]

                $event_Type = '';

                //Query to select all rows from the eventtype table
                $eventType = "SELECT * FROM eventtype" ;

                // Check if query was successful
                $resultEventType = mysqli_query($conn, $eventType);
                if (!$resultEventType) {
                  die("Query failed!".mysqli_error($conn));
                }
                
                //Loop through each row in the eventtype table
                while($row1 = $resultEventType->fetch_assoc())
                {
                  $event_Type_ID = $row1["EventTypeID"];

                  /*
                    Fetch the event type when event type id in eventtype
                    table matches the one with events table
                  */
                  if($event_Type_ID === $eventTypeID)
                  {
                    $event_Type = $row1["EventType"];
                  }
                }
                
                //Loop through each row in the groups table
                $groups_query = "SELECT * FROM groups";
                $groupResult = mysqli_query($conn, $groups_query);

                // Check if query was successful
                if (!$groupResult) {
                    die("Query failed!".mysqli_error($conn));
                }

                $groupName = '';
                $groupContact = '';
                $groupEmail = '';
                
                //Loop through each row in the groups table
                while ($row2 = $groupResult->fetch_assoc()) {
                  //Store column values into variables
                  $groupsID = $row2["GroupID"];

                  /*
                    Fetch the group name, contact and email when group id in group
                    table matches the one with events table
                  */
                  if($groupID === $groupsID)
                  {
                    $groupName = $row2["GroupName"];
                    $groupContact = $row2["ContactName"];
                    $groupEmail = $row2["ContactEmail"];
                    break;
                  }
                }
                
                //Check which event was clicked and display its data accordingly by using event id from events table
                if($varName === $eventID) {
                    //Get the first character of the description and store it into substring1
                    $substring1 = substr($eventDesc,0,1);

                    //Get the all characters of the description except the first character
                    $substring2 = substr($eventDesc,1,strlen($eventDesc));

                    //Display the information using HEREDOC
                    $finalView = <<<HTML
                    <div class="single-post">
                      <div class="post-meta"><span class="date">$event_Type</span> <span class="mx-1">&bullet;</span> <span>Date: $formattedDateTime</span></div>
                      <br>
                      <h1 class="mb-5">$eventTitle</h1>
                      <h3>Organizer: $groupName</h3>
                      <h5>(Contact $groupContact at $groupEmail for more info)</h5>
                      <br>
                      <p><span class="firstcharacter">$substring1</span>$substring2</p>
                      <div class="photo"><img src= "$eventImage" alt="" class="img-fluid"></div>
                    </div>
                    HTML;
                    echo $finalView;
                    break; // Exit the loop after finding the matching event
                }
              }
              
              //Closing the connection
              $conn->close();
            ?>

            <!-- ======= Single Post Content ======= -->
            

            <!-- ======= Comments ======= -->
            <div class="comments">
              <h5 class="comment-title py-4">2 Comments</h5>
              <div class="comment d-flex mb-4">
                <div class="flex-shrink-0">
                  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="assets/img/person-5.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex align-items-baseline">
                    <h6 class="me-2">Jordan Singer</h6>
                    <span class="text-muted">2d</span>
                  </div>
                  <div class="comment-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam eligendi repellendus excepturi quibusdam nobis esse accusantium.
                  </div>

                  <div class="comment-replies bg-light p-3 mt-3 rounded">
                    <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                    <div class="reply d-flex mb-4">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                          <img class="avatar-img" src="assets/img/person-4.jpg" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline">
                          <h6 class="mb-0 me-2">Brandon Smith</h6>
                          <span class="text-muted">2d</span>
                        </div>
                        <div class="reply-body">
                          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        </div>
                      </div>
                    </div>
                    <div class="reply d-flex">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                          <img class="avatar-img" src="assets/img/person-3.jpg" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline">
                          <h6 class="mb-0 me-2">James Parsons</h6>
                          <span class="text-muted">1d</span>
                        </div>
                        <div class="reply-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="comment d-flex">
                <div class="flex-shrink-0">
                  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="assets/img/person-2.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="flex-shrink-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex">
                    <h6 class="me-2">Santiago Roberts</h6>
                    <span class="text-muted">4d</span>
                  </div>
                  <div class="comment-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto laborum in corrupti dolorum, quas delectus nobis porro accusantium molestias sequi.
                  </div>
                </div>
              </div>
            </div><!-- End Comments -->

            <!-- ======= Comments Form ======= -->
            <div class="row justify-content-center mt-5">

              <div class="col-lg-12">
                <h5 class="comment-title">Leave a Comment</h5>
                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="comment-name">Name</label>
                    <input type="text" class="form-control" id="comment-name" placeholder="Enter your name">
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="comment-email">Email</label>
                    <input type="text" class="form-control" id="comment-email" placeholder="Enter your email">
                  </div>
                  <div class="col-12 mb-3">
                    <label for="comment-message">Message</label>

                    <textarea class="form-control" id="comment-message" placeholder="Enter your name" cols="30" rows="10"></textarea>
                  </div>
                  <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Post comment">
                  </div>
                </div>
              </div>
            </div><!-- End Comments Form -->

          </div>
          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
            <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <!--Changed the sidebar column slider name to Upcoming and Latest Added-->
                  <button class="nav-link active" id="pills-Upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-Upcoming" type="button" role="tab" aria-controls="pills-Upcoming" aria-selected="true">Upcoming</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-Latest Added-tab" data-bs-toggle="pill" data-bs-target="#pills-Latest Added" type="button" role="tab" aria-controls="pills-Latest Added" aria-selected="false">Latest Added</button>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">

                <!-- Upcoming -->
                <div class="tab-pane fade show active" id="pills-Upcoming" role="tabpanel" aria-labelledby="pills-Upcoming-tab">
                <?php
                  require_once 'serverlogin.php';
      
                  //Establish connection
                  $conn = mysqli_connect ($db_hostname, $db_username, $db_password, $db_database);
                  if (!$conn) {
                    die("Connection failed!".mysqli_connect_error());
                  } 
      
                  //Query that selects all rows from the events table
                  $events = "SELECT * FROM events ORDER BY EventDate";
                  $result = mysqli_query($conn, $events);
      
                  //Check if query runned successfully
                  if (!$result) {
                      die("Query failed!".mysqli_error($conn));
                  }
    
                  //Loop through each row in the events table
                  while ($row = $result->fetch_assoc()) {
                    //Storing the values of columns in a row into different variables
                    $eventID = $row["EventID"];
                    $eventTypeID = $row["EventTypeID"];
                    $groupID = $row["GroupID"];
                    $eventDate = $row["EventDate"];
                    $submitDate = $row["SubmitDate"];
                    $eventTitle = $row["EventTitle"];
                    $eventImage = $row["EventImage"];
                    $eventDesc = $row["EventDesc"];
                    $currentDateTime = date('Y-m-d H:i:s');

    
                    //Formating the date to a certain format to display it on the page
                    $dateTime = date_create($eventDate);//[2]
                    $formattedDateTime = date_format($dateTime, 'd-M-y');//[3]
    
                    $event_Type = '';
    
                    //Query to select all rows from the eventtype table
                    $eventType = "SELECT * FROM eventtype" ;
    
                    $resultEventType = mysqli_query($conn, $eventType);
                    if (!$resultEventType) {
                      die("Query failed!".mysqli_error($conn));
                    }
    
                    //Loop through each row in the eventtype table
                    while($row1 = $resultEventType->fetch_assoc())
                    {
                      $event_Type_ID = $row1["EventTypeID"];
    
                      /*
                        Fetch the event type when event type id in eventtype
                        table matches the one with events table
                      */
                      if($event_Type_ID === $eventTypeID)
                      {
                        $event_Type = $row1["EventType"];
                      }
    
                    }
    
                    //Loop through each row in the groups table
                    $groups_query = "SELECT * FROM groups";
                    $groupResult = mysqli_query($conn, $groups_query);
    
                    //Check if query runned successfully
                    if (!$groupResult) {
                        die("Query failed!".mysqli_error($conn));
                    }
    
                    $groupName = '';

                    //Loop through each row in the groups table
                    while ($row2 = $groupResult->fetch_assoc()) {
                      // Store column values into variables
                      $groupsID = $row2["GroupID"];
    
                      /*
                        Fetch the group name when group id in group
                        table matches the one with events table
                      */
                      if($groupID === $groupsID)
                      {
                        $groupName = $row2["GroupName"];
                        break;
                      }
    
                    }
                    
                    if($eventDate>=$currentDateTime)
                    {
                      //Display the information of the event
                      echo <<<HTML
                      <div class="post-entry-1 border-bottom">
                          <div class="post-meta"><span class="date">$event_Type</span> <span class="mx-1">&bullet;</span> <span>$formattedDateTime</span></div>
                          <h2 class="mb-2"><a href="single-post.php?number=$eventID">$eventTitle</a></h2>
                          <span class="author mb-3 d-block">$groupName</span>
                      </div>
                      HTML;
                    }
                  }
                ?>   
                </div> <!-- End Upcoming -->

                <!-- Latest Added -->
                <div class="tab-pane fade show active" id="pills-Latest Added" role="tabpanel" aria-labelledby="pills-Latest Added-tab">
                  <?php
                    $varName = $_GET['number'];
                    $varGroupName = $_GET['target'];
                    require_once 'serverlogin.php';
        
                    //Establish connection
                    $conn = mysqli_connect ($db_hostname, $db_username, $db_password, $db_database);
                    if (!$conn) {
                      die("Connection failed!".mysqli_connect_error());
                    } 
        
                    //Query that selects all rows from the events table
                    $events = "SELECT * FROM events ORDER BY SubmitDate DESC";
                    $result = mysqli_query($conn, $events);
        
                    //Check if query runned successfully
                    if (!$result) {
                        die("Query failed!".mysqli_error($conn));
                    }
      
                    //Loop through each row in the events table
                    while ($row = $result->fetch_assoc()) {
                      //Storing the values of columns in a row into different variables
                      $eventID = $row["EventID"];
                      $eventTypeID = $row["EventTypeID"];
                      $groupID = $row["GroupID"];
                      $eventDate = $row["EventDate"];
                      $submitDate = $row["SubmitDate"];
                      $eventTitle = $row["EventTitle"];
                      $eventImage = $row["EventImage"];
                      $eventDesc = $row["EventDesc"];
      
                      //Formating the date to a certain format to display it on the page
                      $dateTime = date_create($eventDate);//[2]
                      $formattedDateTime = date_format($dateTime, 'd-M-y');//[3]
      
                      $event_Type = '';
      
                      //Query to select all rows from the eventtype table
                      $eventType = "SELECT * FROM eventtype" ;
      
                      $resultEventType = mysqli_query($conn, $eventType);
                      if (!$resultEventType) {
                        die("Query failed!".mysqli_error($conn));
                      }
      
                      //Loop through each row in the eventtype table
                      while($row1 = $resultEventType->fetch_assoc())
                      {
                        $event_Type_ID = $row1["EventTypeID"];
      
                        /*
                          Fetch the event type when event type id in eventtype
                          table matches the one with events table
                        */
                        if($event_Type_ID === $eventTypeID)
                        {
                          $event_Type = $row1["EventType"];
                        }
      
                      }
      
                      //Loop through each row in the groups table
                      $groups_query = "SELECT * FROM groups";
                      $groupResult = mysqli_query($conn, $groups_query);
      
                      //Check if query runned successfully
                      if (!$groupResult) {
                          die("Query failed!".mysqli_error($conn));
                      }
      
                      $groupName = '';
      
                      //Loop through each row in the groups table
                      while ($row2 = $groupResult->fetch_assoc()) {
                        // Store column values into variables
                        $groupsID = $row2["GroupID"];
      
                        /*
                          Fetch the group name, contact and email when group id in group
                          table matches the one with events table
                        */
                        if($groupID === $groupsID)
                        {
                          $groupName = $row2["GroupName"];
                          break;
                        }
      
                      }
      
                      //Displaying the information of all events in descending order
                      echo <<<HTML
                      <div class="post-entry-1 border-bottom">
                        <div class="post-meta"><span class="date">$event_Type</span> <span class="mx-1">&bullet;</span> <span>$formattedDateTime</span></div>
                        <h2 class="mb-2"><a href="single-post.php?number=$eventID">$eventTitle</a></h2>
                        <span class="author mb-3 d-block">$groupName</span>
                      </div>
                      HTML;
                    }

                  ?>
                </div> <!-- End Latest Added -->

              </div>

              <div class="aside-block">
                <!--Changed the name from video to Events and removed a photo under the text Events-->
                <h3 class="aside-title">Events</h3>
                <ul class="aside-links list-unstyled">
                  <!--Changed the name of the events-->
                  <li><a href="events.php?target="><i class="bi bi-chevron-right"></i> All Events</a></li>
                  <li><a href="events.php?target=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
                  <li><a href="events.php?target=Art%2BCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
                  <li><a href="events.php?target=Sports"><i class="bi bi-chevron-right"></i> Sports</a></li>
                  <li><a href="events.php?target=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
                  <li><a href="events.php?target=Fund%20Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
                </ul>
              </div><!-- End Categories -->

              <div class="aside-block">
                <h3 class="aside-title">Tags</h3>
                <ul class="aside-tags list-unstyled">
                  <li><a href="events.php?target="><i class="bi bi-chevron-right"></i> All Events</a></li>
                  <li><a href="events.php?target=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
                  <li><a href="events.php?target=Art%2BCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
                  <li><a href="events.php?target=Sports"><i class="bi bi-chevron-right"></i> Sport</a></li>
                  <li><a href="events.php?target=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
                  <li><a href="events.php?target=Fund%20Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
                </ul>
              </div><!-- End Tags -->
            </div>
          </div>
        </div>
      </div>
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
              <li><a href="post.php"><i class="bi bi-chevron-right"></i> Post Event</a></li>
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
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<!--
References:

[1] "ZenBlog - Bootstrap Blog Template", <i>BOOTSTRAPMADE</i> [Online].
    Available: https://bootstrapmade.com/zenblog-bootstrap-blog-template/ [Accessed: Feb. 03, 2024]
    
[2]	"PHP date_create() Function", W3SCHOOLS [Online]. Available:
    https://www.w3schools.com/php/func_date_date_create.asp [Accessed: Mar. 10, 2024]

[3]	"PHP date_format() Function", W3SCHOOLS [Online]. Available:
    https://www.w3schools.com/php/func_date_date_format.asp [Accessed: Mar. 10, 2024]

[4]	"PHP strtotime() Function", W3SCHOOLS [Online]. Available:
    https://www.w3schools.com/php/func_date_strtotime.asp [Accessed: Mar. 10, 2024]

[5]	"PHP date() Function", W3SCHOOLS [Online]. Available:
    https://www.w3schools.com/php/func_date_date.asp [Accessed: Mar. 10, 2024]
-->