<?php
require 'config.inc.php';
require('functions.php');
// Start session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Nakuru city community platform</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

    <style>
    

    .contact-container {
    display: flex;
    align-items: center; /* Vertically align items in the center */
    justify-content: space-between; /* Space between the elements */
    padding: 20px;
    margin: 0 auto; /* Center the container horizontally */
    max-width: 1200px; /* Adjust as needed for your design */
   }
    .contact-header {
        background-color: black;
        margin-right: 10px;
        padding: 20px 0 10px 0;    }
    .logo {
        width: 400px; /* Adjust as per the actual logo size */
        margin-bottom: 1px;
        height: auto;
    }
    .contacts {
        padding: 20px;
        margin-left: 4px;
    }
    h1, h2, h3 {
        margin: 0 0 10px 0;
    }
    p {
        margin: 0 0 20px 0;
        padding-left: 30px;
        line-height: 1.6;
    }  
    .contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px; /* Add space between contact items */
    }

    .contact-item i {
        margin-right: 10px; /* Space between icon and text */
        font-size: 24px; /* Adjust icon size as needed */
    }

    .contact-item p {
        margin: 0;
        padding-left: 0; /* Reset padding if previously set */
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


    <section class="home">
        <div class="home-content">
            <h1>WELCOME TO NAKURU CITY'S COMMUNITY PLATFORM</h1><br>
            <h3>City of unlimited opportunities</h3>
            <p>“We have the farmers, we have the climate, we have the demand at the right price and the willing support of my administration. We want to take our county forward into more manufacturing”</p>

            <p>H.E Governor Susan Kihika</p>
            <div class="btn-box">
                <a href="#">Get started</a>
    
            </div>
        </div>
        <div class="home-img">
            <img src="naks city.jpeg" alt="Me"/>
        </div>
        <?php include('signup.inc.php') ?>
		<?php include('login.inc.php') ?>
		<?php include('post.edit.inc.php') ?>
       
       
        
                   
    </section>
    <div class="contact-container">     
    <div class="contact-header">
    <img src="nakurucity.png" alt="Nakuru County Logo" class="logo"> <!-- Replace with actual image path -->
    
    </div>

    <div class="contacts">
   <h2>Official Contacts</h2>
   <div class="contact-item">
       <i class='bx bx-phone' style='color:#0871e4'></i>
       <p>(051) 2214142<br>(051) 2216379<br>(051) 2261380</p>
   </div>
   <h3>Fire Emergencies</h3>
   <div class="contact-item">
       <i class='bx bx-phone' style='color:#0871e4'></i>
       <p>Nakuru Fire - 02022411440<br>Molo Fire - 0202400203<br>Naivasha Fire - 0202423088</p>
   </div>
   <div class="contact-item">
       <i class='bx bxs-envelope' style='color:#0871e4' ></i>
       <p>Email: info@nakuru.go.ke</p>
   </div>
    </div>
</div>

    <footer class="footer">
        <div class="footer-text">
            <p>copyright &copy; 2023 by r.k.l_jared | All rights reserved.</p>
        </div>
        <div class="social-media">
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-twitter' ></i></a>
            <a href="#"><i class='bx bxl-facebook' ></i></a>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class='bx bx-up-arrow-alt'></i></a>
        </div>          
       </footer>
       <script>
        let subMenu = document.getElementById("subMenu");
    
        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }
    </script>

    
</body>
</html>