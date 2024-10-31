<?php defined('APP') or die('direct script access denied!'); ?>

<header class="header">
    <div class="logo-img">
        <img src="city logo.jpg" alt="Me"/>
    </div>  
    <nav class="navbar">
        <ul>
            <li><a href="homepage.php" >Home</a></li>  
            
                <?php
                // Check if user is logged in
                if (logged_in()) {
                    // Check user role
                    $user_role = $_SESSION['USER']['role'] ?? '';

                    // Display menu based on user role
                    if ($user_role == 'authority') {
                        // Display authority section
                        echo ' <li>
                        <a href="Authorities section.php">Authorities Section</a>
                        <ul class="dropdown">
                            <li><a href="#dashboard">Dashboard</a></li>
                            <li><a href="#communication-center">Communication Center</a></li>
                            <li><a href="#analytics-reports">Analytics and Reports</a></li>
                            <li><a href="#community-engagement">Community Engagement</a></li>
                            <li><a href="#document-repository">Document Repository</a></li>
                            <li><a href="#event-management">Event Management</a></li>
                        </ul>   
                    </li>';
                    } else {
                        // Display citizen section
                        echo ' <li>
                        <a href="Citizen section.php">Citizen Section</a>
                        <ul class="dropdown">
                            <li><a href="#community-forums">Community Forums</a></li>
                            <li><a href="#announcements-alerts">Announcements and Alerts</a></li>
                            <li><a href="#service-requests">Service Requests</a></li>      
                            <li><a href="#events-calendar">Events Calendar</a></li>
                            <li><a href="#interactive-maps">Interactive Maps</a></li>
                        </ul>
                    </li>';
                    }
                }
                ?> 
          
           
         
        
         
            <li><a href="About.php">About</a></li>
    <?php if(logged_in()): ?>
        <a href="#">
            <?php if(isset($_SESSION['USER']['image'])): ?>
                <img src="<?= get_image($_SESSION['USER']['image'])?>" class="class_10"  onclick="toggleMenu()">
            <?php else: ?>
                <img src="default_profile_picture.jpg" class="class_10" onclick="toggleMenu()">
            <?php endif; ?>
        </a>
		<div class="sub-menu-wrap" id="subMenu">

                    <div class="sub-menu">
                        <a href="profile.php" class="sub-menu-link">
                            <img src="no-profile-picture-15255.png">
                            <p>View Profile</p>
                            <span>></span>
                        </a>
    
                        <a href="#" class="sub-menu-link">
                            <img src="settings-5689.png">
                            <p>Settings & Privacy</p>
                            <span>></span>
                        </a>
    
                        <a href="#" class="sub-menu-link">
                            <img src="question-and-support-11830.png">
                            <p>Help & Support</p>
                            <span>></span>
                        </a>
    
                        <a href="#" class="sub-menu-link"> <!-- Assuming you have a logout script named logout.php -->
                            <img src="user-logout-5866.png" onclick="user.logout()">
                            <p onclick="user.logout()">Logout</p>
                            <span>></span>
                        </a>
                    </div>
                </div>
                
    <?php else: ?>
        <span style="cursor:pointer;" onclick="login.show()">Login</span>
    <?php endif; ?>
</div>
</header>
<script>
	
	var user = {

		logout: function(){

			let form = new FormData();
			form.append('data_type', 'logout');
			var ajax = new XMLHttpRequest();

			ajax.addEventListener('readystatechange',function(){

				if(ajax.readyState == 4)
				{
					if(ajax.status == 200){
						let obj = JSON.parse(ajax.responseText);
						alert(obj.message);

						window.location.href = "homepage.php";
					}else{
						alert("Please check your internet connection");
					}
				}
			});

			ajax.open('post','ajax.inc.php', true);
			ajax.send(form);
		}
	};
</script>


