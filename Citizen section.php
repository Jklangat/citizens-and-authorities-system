<?php
require 'config.inc.php';
require('functions.php');

	$page = $_GET['page'] ?? 1;
	$page = (int)$page;

	if($page < 1)
		$page = 1;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $USER = $_SESSION['USER'];
    // Handle service request form submission
    if (isset($_POST['title'], $_POST['date'], $_POST['location'], $_POST['description'])) {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $location = $_POST['location'];
        $description = $_POST['description'];

        // Upload image
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
        }
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;

            // Insert data into service_requests table
            $sql = "INSERT INTO service_requests (USER, title, date, location, description, image, created_at) VALUES ('" . $_SESSION['USER']['username'] . "', '$title', '$date', '$location', '$description', '$imagePath', NOW())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Service request submitted successfully');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to move uploaded file');</script>";
        }
    }

    // Handle feedback form submission
    if (isset($_POST['feedback_type'], $_POST['comments'])) {
        $feedbackType = $_POST['feedback_type'];
        $comments = $_POST['comments'];

        // Insert data into feedback table
        // Insert data into feedback table

        $sql = "INSERT INTO feedback (USER, feedback_type, comments, created_at) VALUES ('" . $_SESSION['USER']['username'] . "', '$feedbackType', '$comments', NOW())";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Feedback submitted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Do not close the connection here
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Citizen section</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="about.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="calendar.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <style>
      .service-container,
      .feedback-container {
          width: calc(50% - 40px); /* Adjust width as per your requirement */
          height: auto;
          margin: 20px;
          padding: 20px;
          background-color: black;
          border-radius: 8px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          display: inline-block; /* Display side by side */
          vertical-align: top; /* Align containers from the top */
          box-sizing: border-box;
      }
      
      /* Adjust the width and other styles as needed */
      .service-container h2,
      .feedback-container h2 {
          text-align: center;
          margin-bottom: 20px;
          font-size: 24px;
      }
      
      /* Add other styles for common elements if needed */
      label {
          font-weight: bold;
          font-size: 12px;
      }
      
      input[type="text"],
      input[type="date"],
      textarea,
      select {
          width: 100%;
          padding: 10px;
          margin-bottom: 20px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
      }
      
      textarea {
          height: 100px;
      }
      
      input[type="file"] {
          margin-top: 10px;
          margin-bottom: 10px;
      }
      
      input[type="submit"] {
          background-color: aqua;
          color: #fff;
          padding: 12px 15px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-size: 16px;
          font-weight: bold;
          display: block;
          margin: 0 auto; /* Center the button */
      }
      
      input[type="submit"]:hover {
          background-color: aqua;
      }
      
      /* Additional styles for the feedback container */
      .feedback-container {
          background-color: black;
          width: calc(50% - 40px); /* Adjust width as per your requirement */
          margin-left: 10px;
          height: 75%;
      }
      
      .feedback-container h2 {
          font-size: 24px;
          color: #fff;
      }
      
      .feedback-container .small {
          font-size: 16px;
          color: #fff;
          margin-bottom: 10px;
      }
      
      .feedback-container label {
          display: block;
          margin-bottom: 10px;
          font-weight: bold;
          font-size: 14px;
      }
      
      .feedback-container .form-check {
          margin-right: 20px;
      }
      
      .feedback-container textarea {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          resize: vertical; /* Allowing vertical resizing */
      }

  </style>
    
</head>

<body>
<style>
		
		@keyframes appear{
			0%{
				opacity: 0;
			}
			100%{
				opacity: 1;
			}
		}

		.hide{
			display:none;
		}

	</style>

<?php include('header.inc.php') ?>
    
<div class="main-content">
    

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


    
    <section id="service-requests" class="service-request-form">
      <div class="service-container">
        <h2>Service Request Form</h2>
        <form id="serviceRequestForm" action="" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
    
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
    
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
    
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image"><br><br>

            <input type="hidden" name="USER" value="<?php echo isset($_SESSION['USER']['username']) ? $_SESSION['USER']['username'] : ''; ?>">


    
            <input type="submit" value="Submit">
        </form>
      </div>

    
    <div class="feedback-container">
      <h2>Feedback</h2>
      <div class="mb-4 small">
          Please provide your feedback in the form below. We would love to hear your thoughts, suggestions, concerns, or problems with anything so we can improve!
      </div>
      <form name="feedback_form" id="feedback_form" action="" method="post">
          <label>Feedback Type:</label>
          <div class="mb-3 d-flex flex-row py-1">
              <div class="form-check mr-3">
                  <input class="form-check-input" type="radio" id="comment" name="feedback_type" value="comments">
                  <label class="form-check-label" for="comment">
                      Comments
                  </label>
              </div>
  
              <div class="form-check mx-3">
                  <input class="form-check-input" type="radio" id="suggestions" name="feedback_type" value="suggestions">
                  <label class="form-check-label" for="suggestions">
                      Suggestions
                  </label>
              </div>
  
              <div class="form-check mx-3">
                  <input class="form-check-input" type="radio" name="feedback_type" id="other" value="other">
                  <label class="form-check-label" for="other">
                      Other
                  </label>
              </div>
          </div>
          <div class="mb-4">
              <label class="form-label" for="feedback-description">Describe Your Feedback:</label>
              <textarea class="form-control" required rows="6" name="comments" id="feedback-description"></textarea>
          </div>

          <input type="hidden" name="USER" value="<?php echo isset($_SESSION['USER']['username']) ? $_SESSION['USER']['username'] : ''; ?>">


          <input type="submit" value="Submit">
      </form>
  </div>
  
            

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

    <section id="interactive-maps" class="map-section">
        <h2>Interactive location Map</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255344.5020194802!2d35.91404366157855!3d-0.3154671808609436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18298d90cf610bef%3A0xf2f21833bc7cc21a!2sNakuru!5e0!3m2!1sen!2ske!4v1711174374877!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
        <!-- Add maps displaying key locations, services, and ongoing projects -->
        <!-- Include functionality for reporting and tracking issues on the map -->
    </section>

</div>
    <div class="footer">
        <div class="footer-text">
            <p>copyright &copy; 2023 by r.k.l_jared | All rights reserved.</p>
        </div>
        <div class="social-media">
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-twitter' ></i></a>
            <a href="#"><i class='bx bxl-facebook' ></i></a>
        </div>
        <div class="footer-iconTop">
            <a href="#community-forums"><i class='bx bx-up-arrow-alt'></i></a>
        </div>          
    </div>
 <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
 </script> 
 <script src="calendar.js"></script> 
 <script src="news.js"></script>  
 <script src="login.js"></script>  
</body>
<script>
	var page_number = <?=$page?>;
	var home_page = true;

</script>
<script src="./assets/js/mypost.js?v3"></script>
</html>