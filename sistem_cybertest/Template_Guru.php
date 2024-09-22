<?PHP

# Use of Session_Start
session_start();

# Retrieve Guard_Guru.php
include('Guard_Guru.php');

# Retrieve Connection.php
include('../Connection.php');

# Check for data in $_SESSION ['Tahap']
if (empty($_SESSION['Tahap']))
{
	# Determine the user's status (Teacher / Administrator)
	$arahan_semak_tahap="SELECT* FROM guru WHERE
	NoKP_Guru	=	'".$_SESSION['NoKP_Guru']."'
	LIMIT 1";
	
	$laksana_semak_tahap=mysqli_query($Connection, $arahan_semak_tahap);
	$data=mysqli_fetch_array($laksana_semak_tahap);
	$_SESSION['Tahap'] = $data['Tahap'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sistem CyberTest</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="../style/w3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- Highway Colors (Internet Enabled) -->
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-highway.css">

		<!-- Highway Colors (Internet Disabled) -->
		<link rel="stylesheet" href="../style/Highway Color.css">

		<!-- Food Colors (Internet Enabled) -->
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-food.css">

		<!-- Food Colors (Internet Disabled) -->
		<link rel="stylesheet" href="../style/Food Color.css">

		<!-- Fashion Colors (2017 - 2021) Internet Enabled -->
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2017.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2018.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2019.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2020.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">

		<!-- Fashion Colors (2017 - 2021) Internet Disabled -->
		<link rel="stylesheet" href="../style/Fashion Color/w3-colors-2017.css">
		<link rel="stylesheet" href="../style/Fashion Color/w3-colors-2018.css">
		<link rel="stylesheet" href="../style/Fashion Color/w3-colors-2019.css">
		<link rel="stylesheet" href="../style/Fashion Color/w3-colors-2020.css">
		<link rel="stylesheet" href="../style/Fashion Color/w3-colors-2021.css">

		<!-- Gradient Color Scheme (Internet Enabled) -->
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-brown.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-cyan.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-dark-grey.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-deep-orange.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-deep-purple.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-grey.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-khaki.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-green.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-lime.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-orange.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-pink.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-purple.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-yellow.css">

		<!-- Gradient Color Scheme (Internet Disabled) -->
		<link rel="stylesheet" href="../style/Color Scheme/Amber.css">
		<link rel="stylesheet" href="../style/Color Scheme/Black.css">
		<link rel="stylesheet" href="../style/Color Scheme/Blue.css">
		<link rel="stylesheet" href="../style/Color Scheme/Blue_Grey.css">
		<link rel="stylesheet" href="../style/Color Scheme/Brown.css">
		<link rel="stylesheet" href="../style/Color Scheme/Cyan.css">
		<link rel="stylesheet" href="../style/Color Scheme/Dark_Grey.css">
		<link rel="stylesheet" href="../style/Color Scheme/Deep_Orange.css">
		<link rel="stylesheet" href="../style/Color Scheme/Deep_Purple.css">
		<link rel="stylesheet" href="../style/Color Scheme/Green.css">
		<link rel="stylesheet" href="../style/Color Scheme/Grey.css">
		<link rel="stylesheet" href="../style/Color Scheme/Indigo.css">
		<link rel="stylesheet" href="../style/Color Scheme/Khaki.css">
		<link rel="stylesheet" href="../style/Color Scheme/Light_Blue.css">
		<link rel="stylesheet" href="../style/Color Scheme/Light_Green.css">
		<link rel="stylesheet" href="../style/Color Scheme/Lime.css">
		<link rel="stylesheet" href="../style/Color Scheme/Orange.css">
		<link rel="stylesheet" href="../style/Color Scheme/Pink.css">
		<link rel="stylesheet" href="../style/Color Scheme/Purple.css">
		<link rel="stylesheet" href="../style/Color Scheme/Red.css">
		<link rel="stylesheet" href="../style/Color Scheme/Teal.css">
		<link rel="stylesheet" href="../style/Color Scheme/Yellow.css">

		<!-- Font 1 -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
		<style>
			.w3-lobster
			{
			  font-family: "Lobster", Sans-serif;
			}
		</style>

		<!-- Font 2 -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
		<style>
			.w3-lobster
			{
			  font-family: "Lobster", serif;
			}
		</style>

		<!-- Font 3 -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
		<style>
			.w3-allerta
			{
			  font-family: "Allerta Stencil", Sans-serif;
			}
		</style>

		<!-- Font 4 -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
		<style>
			.w3-sofia
			{
			  font-family: Sofia, cursive;
			}
		</style>

		<!-- Font 5 -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
		<style>
			.w3-tangerine
			{
			  font-family: "Tangerine", serif;
			}
		</style>

		<!-- Gradient 1 (Nightfall) -->
		<style>
			.w3-theme-gradient
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #410370 25%, #cc06cc 75%)
			}
			.w3-theme-gradient
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #410370 25%, #cc06cc 75%)
			}
			.w3-theme-gradient
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #410370 25%, #cc06cc 75%)
			}
			.w3-theme-gradient
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #410370 25%, #cc06cc 75%)
			}
			.w3-theme-gradient
			{
			  color: #000 !important;
			  background: linear-gradient(top, #410370 25%, #cc06cc 75%)
			}
		</style>

		<!-- Gradient 2 (Sunset) -->
		<style>
			.w3-theme-gradient-2
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #c21c0a 25%, #ed9015 75%)
			}
			.w3-theme-gradient-2
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #c21c0a 25%, #ed9015 75%)
			}
			.w3-theme-gradient-2
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #c21c0a 25%, #ed9015 75%)
			}
			.w3-theme-gradient-2
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #c21c0a 25%, #ed9015 75%)
			}
			.w3-theme-gradient-2
			{
			  color: #000 !important;
			  background: linear-gradient(top, #c21c0a 25%, #ed9015 75%)
			}
		</style>

		<!-- Gradient 3 (Peach) -->
		<style>
			.w3-theme-gradient-3
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #de6262 25%, #ffb88c 75%)
			}
			.w3-theme-gradient-3
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #de6262 25%, #ffb88c 75%)
			}
			.w3-theme-gradient-3
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #de6262 25%, #ffb88c 75%)
			}
			.w3-theme-gradient-3
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #de6262 25%, #ffb88c 75%)
			}
			.w3-theme-gradient-3
			{
			  color: #000 !important;
			  background: linear-gradient(top, #de6262 25%, #ffb88c 75%)
			}
		</style>

		<!-- Gradient 4 (Bloody Mary) -->
		<style>
			.w3-theme-gradient-4
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #ff512f 25%, #dd2476 75%)
			}
			.w3-theme-gradient-4
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #ff512f 25%, #dd2476 75%)
			}
			.w3-theme-gradient-4
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #ff512f 25%, #dd2476 75%)
			}
			.w3-theme-gradient-4
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #ff512f 25%, #dd2476 75%)
			}
			.w3-theme-gradient-4
			{
			  color: #000 !important;
			  background: linear-gradient(top, #ff512f 25%, #dd2476 75%)
			}
		</style>

		<!-- Gradient 5 (Dream) -->
		<style>
			.w3-theme-gradient-5
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #4568dc 25%, #b06ab3 75%)
			}
			.w3-theme-gradient-5
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #4568dc 25%, #b06ab3 75%)
			}
			.w3-theme-gradient-5
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #4568dc 25%, #b06ab3 75%)
			}
			.w3-theme-gradient-5
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #4568dc 25%, #b06ab3 75%)
			}
			.w3-theme-gradient-5
			{
			  color: #000 !important;
			  background: linear-gradient(top, #4568dc 25%, #b06ab3 75%)
			}
		</style>

		<!-- Gradient 6 (Frost) -->
		<style>
			.w3-theme-gradient-6
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #000428 25%, #004e92 75%)
			}
			.w3-theme-gradient-6
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #000428 25%, #004e92 75%)
			}
			.w3-theme-gradient-6
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #000428 25%, #004e92 75%)
			}
			.w3-theme-gradient-6
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #000428 25%, #004e92 75%)
			}
			.w3-theme-gradient-6
			{
			  color: #000 !important;
			  background: linear-gradient(top, #000428 25%, #004e92 75%)
			}
		</style>

		<!-- Gradient 7 (Instagram) -->
		<style>
			.w3-theme-gradient-7
			{
			  color: #000 !important;
			  background:-webkit-radial-gradient(circle at -30% -107%, #F58529 0%, #FEDA77 5%, #DD2A7B 45%,#8134AF 60%, #515BD4 10%)
			}
			.w3-theme-gradient-7
			{
			  color: #000 !important;
			  background:-moz-radial-gradient(circle at 30% 107%, #F58529 0%, #FEDA77 5%, #DD2A7B 45%, #8134AF 60%, #515BD4 90%)
			}
			.w3-theme-gradient-7
			{
			  color: #000 !important;
			  background:-o-radial-gradient(circle at 30% 107%, #F58529 0%, #FEDA77 5%, #DD2A7B 45%, #8134AF 60%, #515BD4 90%)
			}
			.w3-theme-gradient-7
			{
			  color: #000 !important;
			  background:-ms-radial-gradient(circle at 30% 107%, #F58529 0%, #FEDA77 5%, #DD2A7B 45%, #8134AF 60%, #515BD4 90%)
			}
			.w3-theme-gradient-7
			{
			  color: #000 !important;
			  background: radial-gradient(circle at 30% 107%, #F58529 0%, #FEDA77 5%, #DD2A7B 45%, #8134AF 60%, #515BD4 90%)
			}
		</style>

		<!-- Gradient 8 (Deep Gray) -->
		<style>
			.w3-theme-gradient-8
			{
			  color: #000 !important;
			  background:-webkit-linear-gradient(top, #bdc3c7 25%, #2c3e50 75%)
			}
			.w3-theme-gradient-8
			{
			  color: #000 !important;
			  background:-moz-linear-gradient(top, #bdc3c7 25%, #2c3e50 75%)
			}
			.w3-theme-gradient-8
			{
			  color: #000 !important;
			  background:-o-linear-gradient(top, #bdc3c7 25%, #2c3e50 75%)
			}
			.w3-theme-gradient-8
			{
			  color: #000 !important;
			  background:-ms-linear-gradient(top, #bdc3c7 25%, #2c3e50 75%)
			}
			.w3-theme-gradient-8
			{
			  color: #000 !important;
			  background: linear-gradient(top, #bdc3c7 25%, #2c3e50 75%)
			}
		</style>

		<!-- Manual Slideshow -->
		<style>
			.mySongs {display:none;}
		</style>
	</head>
	<body background="../images/BG.jpg">

		<!-- Title -->
		<div class="w3-container w3-blue-gray">

			<!-- Status Bar -->
			<div class="w3-top-right">
				<div class="w3-padding-small w3-right w3-large">
				    <i class="fa fa-volume-up" aria-hidden="true"></i>
				    <i class="fa fa-wifi" aria-hidden="true"></i>
				    <i class="fa fa-battery-2" aria-hidden="true"></i>
				    03:25
				</div>
			</div>

			<br>
			<div class="w3-center">
				<h1 class="w3-xxxlarge font-effect-shadow-multiple w3-text-black"><i class="fa fa-podcast" aria-hidden="true"><b> CyberTest Quiz Network: Administrator's Menu</b></i></h1>
				<h3 class="w3-lobster"><i>World's Leading Technology in Online Education</i></h3>
			</div>
		</div>

		<!-- Menu Bar -->
		<div class="w3-bar w3-black w3-center w3-allerta">
			<b>
				<div class="w3-dropdown-hover w3-black w3-xlarge">
				  <button class="w3-button"><i class="fa fa-handshake-o" aria-hidden="true"> User Settings </i></button>
				  <div class="w3-dropdown-content w3-bar-block">
				    <a href="index.php" class="w3-bar-item w3-button w3-xlarge"><i class="fa fa-home" aria-hidden="true"> Central Hub </i></a>
					<a href="../logout.php" class="w3-bar-item w3-button w3-xlarge"><i class="fa fa-sign-out" aria-hidden="true"> Logout Menu </i></a>
				  </div>
				</div>

				<!-- Administrators Access Only -->
				<?PHP if($_SESSION['Tahap'] == 'ADMIN'){ ?>
				<a href="guru_senarai.php" class="w3-bar-item w3-button w3-xlarge"><i class="fa fa-id-card-o" aria-hidden="true"> Teacher Management </i></a>
				<div class="w3-dropdown-hover w3-xlarge">
				  <button class="w3-button"><i class="fa fa-graduation-cap" aria-hidden="true"> Scholar Management </i></button>
				  <div class="w3-dropdown-content w3-bar-block">
				    <a href="murid_senarai.php" class="w3-bar-item w3-button"><i class="fa fa-th-list" aria-hidden="true"> Scholar List </i></a>
				    <a href="murid_upload.php" class="w3-bar-item w3-button"><i class="fa fa-upload" aria-hidden="true"> Database Import Menu </i></a>
				    <a href="senarai_kelas.php" class="w3-bar-item w3-button w3-xlarge"><i class="fa fa-map-marker" aria-hidden="true"> Classroom List </i></a>
				  </div>
				</div>
				<?PHP } ?>

				<div class="w3-dropdown-hover w3-xlarge">
				  <button class="w3-button"><i class="fa fa-desktop" aria-hidden="true"> Assessments Menu </i></button>
				  <div class="w3-dropdown-content w3-bar-block">
				    <a href="soalan_set.php" class="w3-bar-item w3-button"><i class="fa fa-th-list" aria-hidden="true"> Examination List </i></a>
				    <a href="analisis.php" class="w3-bar-item w3-button"><i class="fa fa-file-text-o" aria-hidden="true"> Achievement Analysis </i></a>
				  </div>
				</div>
				<div class="w3-bar-item w3-xlarge w3-right">
					<i class="fa fa-user-secret" aria-hidden="true"> <?PHP echo "Admin/Teacher:"." ".$_SESSION['NamaGuru']; ?> </i>
				</div>
	 		</b>
	 	</div>

	 	<!-- Advertisement (Upper Section) -->
		<div class="w3-container">
			<div class="w3-content w3-margin-top w3-margin-bottom" style="width: 55%">
				<img class="mySlides w3-animate-right w3-image" src="../images/Banner_1.jpg" >
				<img class="mySlides w3-animate-right w3-image" src="../images/Banner_2.jpg" >
				<img class="mySlides w3-animate-right w3-image" src="../images/Banner_3.jpg" >
				<img class="mySlides w3-animate-right w3-image" src="../images/Banner_4.jpg" >
				<img class="mySlides w3-animate-right w3-image" src="../images/Banner_5.jpg" >
				<img class="mySlides w3-animate-right w3-image" src="../images/Banner_6.jpg" >
			</div>
		</div>

		<script>
			var myIndex = 0;
			carousel();

			function carousel()
			{
				var i;
				var x = document.getElementsByClassName("mySlides");

				for (i = 0; i < x.length; i++)
				{
					x[i].style.display = "none";  
				}

				myIndex++;
				if (myIndex > x.length) {myIndex = 1}    
				x[myIndex-1].style.display = "block";  
				setTimeout(carousel, 3000); // Change image every 3 seconds
			}
		</script>

		<div class="w3-row">
		  	<div class="w3-third w3-container">
		   
		  	</div>
		  
		  	<!-- Music Player -->
			<div class="w3-third w3-container w3-center w3-theme-gradient-8">
			  	<div class="w3-content w3-display-container">

			  		<!-- Music 1: Alone Pt. ll -->
					<figure class="w3-margin mySongs w3-animate-opacity">
						<figcaption class='w3-xlarge w3-text-deep-purple'><i class="fa fa-music" aria-hidden="true"></i><b> Alone Pt. ll </b><i class="fa fa-music" aria-hidden="true"></i></figcaption><br>
						<audio
						    controls
						    src="../style/Alone Pt. ll.mp3">
						        Your browser does not support the
						        <code>audio</code> element.
						</audio>
					</figure>

			  		<!-- Music 2: As If It's Your Last -->
					<figure class="w3-margin mySongs w3-animate-opacity">
						<figcaption class='w3-xlarge w3-text-deep-purple'><i class="fa fa-music" aria-hidden="true"></i><b> As If It's Your Last </b><i class="fa fa-music" aria-hidden="true"></i></figcaption><br>
						<audio
						    controls
						    src="../style/As If It's Last.mp3">
						        Your browser does not support the
						        <code>audio</code> element.
						</audio>
					</figure>

					<!-- Music 3: Dancing With A Stranger -->
					<figure class="w3-margin mySongs w3-animate-opacity">
						<figcaption class='w3-xlarge w3-text-deep-purple'><i class="fa fa-music" aria-hidden="true"></i><b> Dancing With A Stranger </b><i class="fa fa-music" aria-hidden="true"></i></figcaption><br>
						<audio
						    controls
						    src="../style/Dancing With A Stranger.mp3">
						        Your browser does not support the
						        <code>audio</code> element.
						</audio>
					</figure>

			  		<!-- Music 4: Drowning Sorrows -->
					<figure class="w3-margin mySongs w3-animate-opacity">
						<figcaption class='w3-xlarge w3-text-deep-purple'><i class="fa fa-music" aria-hidden="true"></i><b> Drowning Sorrows </b><i class="fa fa-music" aria-hidden="true"></i></figcaption><br>
						<audio
						    controls
						    src="../style/Drowning Sorrows.mp3">
						        Your browser does not support the
						        <code>audio</code> element.
						</audio>
					</figure>

					<!-- Music 5: Leave The Door Open -->
					<figure class="w3-margin mySongs w3-animate-opacity">
						<figcaption class='w3-xlarge w3-text-deep-purple'><i class="fa fa-music" aria-hidden="true"></i><b> Leave The Door Open </b><i class="fa fa-music" aria-hidden="true"></i></figcaption><br>
						<audio
						    controls
						    src="../style/Leave The Door Open.mp3">
						        Your browser does not support the
						        <code>audio</code> element.
						</audio>
					</figure>

					<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
					<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
				</div>

				<script>
					var slideIndex = 1;
					showDivs(slideIndex);

					function plusDivs(n)
					{
						showDivs(slideIndex += n);
					}

					function showDivs(n)
					{
						var i;
						var x = document.getElementsByClassName("mySongs");
						if (n > x.length) {slideIndex = 1}
						if (n < 1) {slideIndex = x.length}
						for (i = 0; i < x.length; i++)
						{
							x[i].style.display = "none";  
						}

						x[slideIndex-1].style.display = "block";  
					}
				</script>
		  	</div>

		  	<div class="w3-third w3-container">
		    
		  	</div>
		</div>

	 	<!-- Contents Menu -->
		<div class="w3-container w3-animate-zoom">
			<h1>Bahagian Isi Kandungan</h1>
				</div>

		<!-- Advertisement (Lower Section) -->
		<div class="w3-row w3-center w3-margin">
		  <div class="w3-container w3-third">
		  	<div class="w3-container w3-sand w3-card-4">
				<img src="../images/Footer_1.jpg" class="w3-image w3-margin" style="width:50%">
				<p><b>Technology is an invisible bridge that unites people.</b></p>
		  	</div>
		  </div>

		  <div class="w3-container w3-third">
		  	<div class="w3-container w3-sand w3-card-4">
		  		<img src="../images/Footer_2.jpg" class="w3-image w3-margin" style="width:50%">
		  		<p><b>Technology is a useful servant but a dangerous master.</b></p>
		  	</div>
		  </div>

		  <div class="w3-container w3-third">
		  	<div class="w3-container w3-sand w3-card-4">
		  		<img src="../images/Footer_3.jpg" class="w3-image w3-margin" style="width:50%">
		  		<p><b>Every programmer is an author in the cyberspace.</b></p>
		  	</div>
		  </div>
		</div>

		<!-- Hyperlink to Social Media -->
		<div class="w3-row">
			<div class="w3-third w3-container">
				
			</div>

			<div class="w3-third w3-center">
				<div class="w3-panel w3-white">
					<h3 class="w3-center w3-text-indigo"><i class="w3-xxlarge fa fa-mobile" aria-hidden="true"></i><b> CONTACT ME: </b></h3>					
					<!-- Instagram -->
					<a href="https://www.instagram.com/ethanchow_0325/" target="_blank" title="Instagram Page"><i class="w3-margin-top w3-margin-right w3-panel w3-theme-gradient-7 w3-round-large w3-jumbo fa fa-instagram" aria-hidden="true"></i></a>

					<!-- Facebook -->
					<a href="https://www.facebook.com/ethan.chow.56" target="_blank" title="Facebook Page"><i class="w3-margin-top w3-panel w3-text-blue w3-jumbo fa fa-facebook-official" aria-hidden="true"></i></a>

					<!-- Telegram -->
					<a href="https://t.me/ethanchow_0325" target="_blank" title="Telegram Page"><i class="w3-margin-top w3-panel w3-text-blue w3-jumbo fa fa-telegram" aria-hidden="true"></i></a>
				</div>
			</div>

			<div class="w3-third w3-container">
				
			</div>
		</div>

		<!-- Footer -->
		<div class="w3-container w3-blue-gray">		
			<h1 class="w3-center w3-xxxlarge font-effect-shadow-multiple w3-text-black"><i class="fa fa-apple" aria-hidden="true"><b> Copyright <i class="fa fa-copyright" aria-hidden="true"><b> 2021 </b></i>: Ethan Chow Garren </b></i></h1>
			<h3 class="w3-center w3-lobster"><i>Disclaimer: Any personal information leaked or misused does not concern the copyright holder.</i></h3>
		</div>
	</body>
</html>