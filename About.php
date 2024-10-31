<?php
require 'config.inc.php';
require('functions.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>About</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="about.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
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

    
    <section class="about" id="about">
        <div class="about-img">
           <img src="fourth city.jpg" alt="flamingos"> 
        </div>

        <div class="about-content">
            <h2 class="heading">About Us</h2><br/>
            <h3><span>Nakuru City</span></h3>
            <div class="content-wrapper">
            <p id="initial-content">Nakuru is the fourth-largest urban center proper in Kenya after Nairobi, Mombasa, and Kisumu in that order. However, Nakuru‘s metro urban area is the third largest in Kenya after Nairobi and Mombasa. It is the capital of Nakuru County and former capital of the Rift Valley Province as well as home Flamingo Radio which is the largest neo-urban Radio in the metropolis. Its urban and rural population is 570,674 inhabitants according to the 2019 census. It is the largest urban center in the Rift Valley with Eldoret in Uasin Gishu following closely behind. Nakuru lies about 1,850 m above sea level.</p>
            <div class="content" id="more-content">
                <p>The history of Nakuru can perhaps be traced to the prehistoric period due to the archaeological discoveries located about 8 km from the Central Business District at the Hyrax Hill reserve. Nakuru is Kenya’s 4th largest urban centre with a population of 570,674. (The modern town, as with many others in Kenya, derives its name from the ‘Maasai’ speaking people of Kenya.) Nakuru was established by the British as part of the White highlands during the colonial era and it has continued growing into a cosmopolitan city. It received township status in 1904 and became a municipality in 1952.</p>
                <p>The history of Kenya as a country is closely intertwined with that of Nakuru as a town and a district that is now a county. The first and second presidents of Kenya (Jomo Kenyatta, and Daniel Arap Moi) maintained their semi-official residences within the city. The city for a long time has been a hotbed of Kenyan politics and it was home to a variety of colourful politicians including the late Kariuki Chotara, Kihika Kimani and the late Mirugi Kariuki and Koigi Wamwere.</p>
                <p>In 2006, the then MP, Mirugi Kariuki was killed in a plane crash in Marsabit on his way to a peace meeting. The crash also killed five other members of parliament. The ensuing by-election was contested and won by his son, William Kariuki Mirugi of the Narc-Kenya party. At the age of 27, Hon. William Kariuki Mirugi became one of the youngest members of parliament to represent Nakuru Town Constituency. He was however defeated by Lee Kinyanjui during the 2007 general elections beating his close rival Pastor Mike Brawan.</p>
                <p>On 3 June 2021, Nakuru was officially endorsed for city status after the Kenyan Senate voted for its elevation from a Municipality. Nakuru municipality was conferred the city status on 1/12/2021 by H.E the President of Republic of Kenya. On 6th November 2021, Nakuru City was designated as a UNESCO Creative City under Craft and folk arts category.</p>
            </div>            
            <a href="#" class="read-more-btn">Read more</a>
            </div> 
        </div>
    </section> <br><br>
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
     
     <script>
    document.getElementById('read-more-btn').addEventListener('click', function(){
        const moreContent = document.getElementById('more-content');
        if (moreContent.style.display === 'none' || moreContent.style.display === '') {
            moreContent.style.display = 'block';
            this.innerHTML = 'Read Less';
        } else {
            moreContent.style.display = 'none';
            this.innerHTML = 'Read More';
        }
        });
     </script>
</body>
</html>