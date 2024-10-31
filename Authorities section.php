<?php
require 'config.inc.php';
require('functions.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define number of records per page
$recordsPerPage = 5;

// Determine the current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure the page is at least 1
$offset = ($page - 1) * $recordsPerPage;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Authorities section</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="authorities.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="calendar.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <style>
        .service-request-image {
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
        }
    </style>
</head>
<body>
    <style>
        @keyframes appear {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .hide {
            display: none;
        }
    </style>

    <?php include('header.inc.php') ?>

    <div class="main-content">
        <div class="section">
            <h2 class="section-title">Dashboard</h2>
            <div class="subsection">
                <h3 class="subsection-title">Overview of Ongoing Service Requests and Feedback</h3>
                <div class="subsection-content">
                    <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    // Make a MySQLi database connection
                    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    // Check if the connection was successful
                    if ($conn->connect_error) {
                        die("Could not connect to database: " . $conn->connect_error);
                    }

                    // Fetch total number of service requests
                    $sqlTotalServiceRequests = "SELECT COUNT(*) AS total FROM service_requests";
                    $resultTotalServiceRequests = $conn->query($sqlTotalServiceRequests);
                    $totalServiceRequests = $resultTotalServiceRequests->fetch_assoc()['total'];

                    // Fetch service requests for the current page
                    $sqlServiceRequests = "SELECT * FROM service_requests LIMIT $offset, $recordsPerPage";
                    $resultServiceRequests = $conn->query($sqlServiceRequests);

                    // Fetch total number of feedback entries
                    $sqlTotalFeedback = "SELECT COUNT(*) AS total FROM feedback";
                    $resultTotalFeedback = $conn->query($sqlTotalFeedback);
                    $totalFeedback = $resultTotalFeedback->fetch_assoc()['total'];

                    // Fetch feedback entries for the current page
                    $sqlFeedback = "SELECT * FROM feedback LIMIT $offset, $recordsPerPage";
                    $resultFeedback = $conn->query($sqlFeedback);

                    // Display service requests
                    echo "<h2>Service Requests</h2>";
                    if ($resultServiceRequests->num_rows > 0) {
                        while ($row = $resultServiceRequests->fetch_assoc()) {
                            echo "<div>";
                            echo "<h3>" . $row['title'] . "</h3>";
                            echo "<p>Date: " . $row['date'] . "</p>";
                            echo "<p>Location: " . $row['location'] . "</p>";
                            echo "<p>Description: " . $row['description'] . "</p>";
                            echo "<img src='" . $row['image'] . "' alt='Service Request Image' class='service-request-image'>";
                            echo "<p>Username: " . (isset($_SESSION['USER']['username']) ? $_SESSION['USER']['username'] : 'Unknown') . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "No service requests found";
                    }

                    // Display feedback
                    echo "<h2>Feedback</h2>";
                    if ($resultFeedback->num_rows > 0) {
                        while ($row = $resultFeedback->fetch_assoc()) {
                            echo "<div>";
                            echo "<p><strong>Feedback Type:</strong> " . $row['feedback_type'] . "</p>";
                            echo "<p><strong>Comments:</strong> " . $row['comments'] . "</p>";
                            echo "<p><strong>Submitted At:</strong> " . $row['created_at'] . "</p>";
                            echo "<p>Username: " . (isset($_SESSION['USER']['username']) ? $_SESSION['USER']['username'] : 'Unknown') . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "No feedback found";
                    }

                    // Calculate total number of pages
                    $totalPagesServiceRequests = ceil($totalServiceRequests / $recordsPerPage);
                    $totalPagesFeedback = ceil($totalFeedback / $recordsPerPage);

                    // Close the database connection
                    $conn->close();
                    ?>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                        <?php endif; ?>

                        <?php if ($page < max($totalPagesServiceRequests, $totalPagesFeedback)): ?>
                            <a href="?page=<?php echo $page + 1; ?>">Next</a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

        
    <section class="class_1" id="community-forums" >
		
		<div class="class_11" >
			<?php include('success.alert.inc.php') ?>
			<?php include('fail.alert.inc.php') ?>
			<h1 class="class_41"  >
				Posts
			</h1>

			<?php if(logged_in()):?>
				<form onsubmit="mypost.submit(event)" method="post" class="class_42" >
					<div class="class_43" >
						<textarea placeholder="Whats on your mind?" name="post" class="js-post-input class_44" ></textarea>
					</div>
					<div class="class_45" >
						<button class="class_46"  >
							Post
						</button>
					</div>
				</form>
			<?php else:?>
				<div class="class_13" >
					<i class="bi bi-info-circle-fill class_14">
					</i>
					<div onclick="login.show()" class="class_15" style="cursor:pointer;text-align: center;"  >
						You're not logged in <br>Click here to login and post
					</div>
				</div>
			<?php endif;?>

			<section class="js-posts">
				<div style="padding:10px;text-align:center;">Loading posts....</div>
			</section>
 
			<div class="class_37" style="display: flex;justify-content: space-between;" >
				<button onclick="mypost.prev_page()" class="class_54"  >
					Prev page
				</button>
				<div class="js-page-number">Page 1</div>
				<button onclick="mypost.next_page()" class="class_39"  >
					Next page
				</button>

			</div>
 
		</div>
		<br><br>
		<?php include('signup.inc.php') ?>
		<?php include('login.inc.php') ?>
		<?php include('post.edit.inc.php') ?>
	</section>
	
	<!--post card template-->
	<div class="js-post-card hide class_42" style="animation: appear 3s ease;" >
		<a href="#" class="js-profile-link class_45" >
			<img src="assets/images/user.jpg" class="js-image class_47" >
			<h2 class="js-username class_48" style="font-size:16px" >
				Jane Name
			</h2>
		</a>
		<div class="class_49" >
			<h4 class="js-date class_41"  >
				3rd Jan 23 14:35 pm
			</h4>
			<div class="js-post class_15"  >
				is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets c
			</div>
			<div class="class_51" >
				<i class="bi bi-chat-left-dots class_52">
				</i>
				<div class="js-comment-link class_53" style="color:blue;cursor: pointer;"  >
					Comments
				</div>
			</div>
 
		</div>
	</div>
      
        <section id="announcements-alerts" class="announcements-alerts">
        <h1>LATEST NEWS AND ANNOUNCEMENTS</h1>
        <div class="container" id="newsContainer"></div>
        <div id="pagination"></div>
    
        <!-- Add section for receiving announcements and setting preferences for alerts -->
    </section>

    
    <section id="events-calendar" class="events-section">
        <h2>Events Calendar</h2>
        <div class="container">
            <div class="left">
              <div class="calendar">
                <div class="month">
                  <i class="fas fa-angle-left prev"></i>
                  <div class="date">december 2015</div>
                  <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                  <div>Sun</div>
                  <div>Mon</div>
                  <div>Tue</div>
                  <div>Wed</div>
                  <div>Thu</div>
                  <div>Fri</div>
                  <div>Sat</div>
                </div>
                <div class="days"></div>
                <div class="goto-today">
                  <div class="goto">
                    <input type="text" placeholder="mm/yyyy" class="date-input" />
                    <button class="goto-btn">Go</button>
                  </div>
                  <button class="today-btn">Today</button>
                </div>
              </div>
            </div>
            <div class="right">
              <div class="today-date">
                <div class="event-day">wed</div>
                <div class="event-date">12th december 2022</div>
              </div>
              <div class="events"></div>
              <div class="add-event-wrapper">
                <div class="add-event-header">
                  <div class="title">Add Event</div>
                  <i class="fas fa-times close"></i>
                </div>
                <div class="add-event-body">
                  <div class="add-event-input">
                    <input type="text" placeholder="Event Name" class="event-name" />
                  </div>
                  <div class="add-event-input">
                    <input
                      type="text"
                      placeholder="Event Time From"
                      class="event-time-from"
                    />
                  </div>
                  <div class="add-event-input">
                    <input
                      type="text"
                      placeholder="Event Time To"
                      class="event-time-to"
                    />
                  </div>
                </div>
                <div class="add-event-footer">
                  <button class="add-event-btn">Add Event</button>
                </div>
              </div>
            </div>
            <button class="add-event">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        <!-- Add calendar highlighting community events, town hall meetings, and workshops -->
        <!-- Include RSVP and reminders for upcoming events -->
    </section>


    </div>
    
    <footer class="footer">
        <div class="footer-text">
            <p>copyright &copy; 2023 by r.k.l_jared | All rights reserved.</p>
        </div>
        <div class="social-media">
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-facebook'></i></a>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class='bx bx-up-arrow-alt'></i></a>
        </div>
    </footer>
    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>

<script src="calendar.js"></script> 
 <script src="news.js"></script>

 <script src="./assets/js/mypost.js?v3"></script>
</body>
</html>
