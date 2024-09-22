<?PHP

# Retrieve Header.php and Connection.php
include('Header.php');
include('Connection.php');

# Locate $POST in the form below
if (!empty($_POST)) 
{
	# Obtain $POST data
	$Nama			=		mysqli_real_escape_string($Connection, $_POST['Nama']);
	$NoKP			=		mysqli_real_escape_string($Connection, $_POST['NoKP']);
	$Katalaluan		=		mysqli_real_escape_string($Connection, $_POST['Katalaluan']);
	$IDKelas		=		$_POST['IDKelas'];

	# Verify the data entered
	if (empty($Nama) or empty($NoKP) or empty($Katalaluan) or empty($IDKelas)) 
	{
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	#Data Validation (I.C. Number)
	if (strlen($NoKP)!=12 or !is_numeric($NoKP))
	{
		die("<script>alert('Invalid indentification card number.');
		window.history.back();</script>");
	}

	# Code to archive the input data (Student)
	$arahan_simpan="INSERT INTO murid
	(NamaMurid, NoKP_Murid, Katalaluan_Murid, IDKelas)
	VALUES
	('$Nama', '$NoKP', '$Katalaluan', '$IDKelas')";

	# Run the code in the 'if' block
	if (mysqli_query($Connection, $arahan_simpan))
	{
		# Data stored Succesfully (Popup display)
		echo "<script>alert('Registration Successful.');
		window.location.href='index.php';</script>";
	}

	else
	{
		# Date stored Failed. (Popup display)
		echo "<script>alert('Registration Failed.');
		window.history.back();</script>";
	}
}
?>

<!-- Signup Form (New Students) -->
<div class="w3-row w3-margin">
	<div class="w3-third w3-container w3-card-4 w3-margin-right w3-margin-top w3-margin-bottom w3-theme-gradient-2">
		<h2 align="center" class="w3-text-aqua w3-margin-bottom" style="text-shadow: 5px 5px 0 #222"><i class="fa fa-info-circle" aria-hidden="true"><b> Scholar's Registration </b></i></h2>
		<form action=" " method="POST">
			<h4 class="w3-text-aqua"><i class="fa fa-address-book-o" aria-hidden="true"><b> Scholar's Name </i></h4>
			<input class="w3-input w3-large" type="text" 		name="Nama"></b><br>

			<h4 class="w3-text-aqua"><i class="fa fa-id-card-o" aria-hidden="true"><b> Scholar's Identification Card Number </i></h4>
			<input class="w3-input w3-large" type="text" 		name="NoKP"></b><br>

			<h4 class="w3-text-aqua"><i class="fa fa-key" aria-hidden="true"><b> Scholar's Password </i></h4>
			<input class="w3-input w3-large" type="password"		id="Katalaluan" name="Katalaluan"></b><br>

			<h4 class="w3-text-aqua"><i class="fa fa-empire" aria-hidden="true"><b> Scholar's Assigned Classroom </i></h4>
			<select class="w3-select w3-large" name="IDKelas">
				<option value selected disabled>Select</b></option>

				<?PHP
				# Retrieve data from Table 'Class'
				$sql="SELECT* FROM kelas";

				# Run code to search for data
				$laksana_arahan_cari = mysqli_query($Connection, $sql);

				# $rekod_bilik (Obtain data line by line)
				while ($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari))
				{
					# Show data from element <option> </option>
					echo "<option value =".$rekod_bilik['IDKelas'].">".$rekod_bilik['Tingkatan']."
					".$rekod_bilik['NamaKelas']."</option>";
				}
				?>
			</select>

			<h5><input class="w3-checkbox" type="checkbox" onclick="show()"><b> Show Password</b></h5>

			<script type="text/javascript">
		 		function show()
		 		{
		 			var checkboxes = document.getElementById('Katalaluan')
		 			
		 			if (checkboxes.type=='password')
		 			{
		 				checkboxes.type='text';	
		 			}

		 			else
		 			{
		 				checkboxes.type='password'
		 			}
		 		}
			</script>

			<h4><b><input class="w3-button w3-hover-black w3-border w3-border-black w3-round-large"	type="submit" 	value="REGISTER"></b></h4>
		</form>
	</div>

	<div class="w3-rest w3-container w3-margin">
		<div class="w3-bar w3-2021-inkwell">
			<button class="w3-bar-item w3-button w3-xlarge w3-text-deep-orange" onclick="openCity('Introduction to C. S')"><i class="fa fa-laptop" aria-hidden="true"><b> Introduction to C. S. </b></i></button>
			<button class="w3-bar-item w3-button w3-xlarge w3-text-deep-orange" onclick="openCity('Professions in C. S')"><i class="fa fa-briefcase" aria-hidden="true"><b> Professions in C. S. </b></i></button>
			<button class="w3-bar-item w3-button w3-xlarge w3-text-deep-orange" onclick="openCity('Criterion for C. S.')"><i class="fa fa-file-text" aria-hidden="true"><b> Criterions for C. S. </b></i></button>
		</div>

		<div id="Introduction to C. S" class="w3-container city w3-animate-opacity w3-2021-ultimate-gray">
			<h2 class="w3-center w3-text-black" style="text-shadow: 5px 5px 0 #777"><i class="fa fa-book" aria-hidden="true"></i><b> Introduction to Computer Science </b><i class="fa fa-book" aria-hidden="true"></i></h2>
			<h3 class="w3-text-black"><b>Machine Learning (ML):</b></h3>
			<h4 class="w3-text-pink"><b>The process of encoding a set of algorithms into a language executable by machines.</b></h4>
			<p class="w3-text-black">_______________________________________________________________________________________________</p>
			<h3 class="w3-text-black"><b>Examples of Programming Languages:</b></h3>
			<h4 class="w3-text-pink"><b>Python (Py) - Software and game development, data analysis and many more.</b></h4>
			<h4 class="w3-text-pink"><b>Javascript (JS) - Provides interactive elements to a webpage.</b></h4>
			<h4 class="w3-text-pink"><b>Cascading Style Sheets (CSS) - Gives the webpage a design flare.</b></h4>
			<h4 class="w3-text-pink"><b>HyperText Markup Language (HTML) - Creates a display for the webpage.</b></h4>
			<p class="w3-text-black">_______________________________________________________________________________________________</p>
			<h3 class="w3-text-black"><b>Development of Web Browsers or Applications:</b></h3>
			<h4 class="w3-text-pink"><b>Requires the combination of multiple programming languages.</b></h4>
			<h4 class="w3-text-pink"><b>HTML - Webpage Structure, Js - Webpage Interaction, CSS - Design</b></h4>
		</div>

		<div id="Professions in C. S" class="w3-container city w3-animate-opacity w3-2021-ultimate-gray" style="display: none">
			<h2 class="w3-center w3-text-black" style="text-shadow: 5px 5px 0 #777"><i class="fa fa-microchip" aria-hidden="true"></i><b> First - Rate Career Prospects </b><i class="fa fa-microchip" aria-hidden="true"></i></h2>
			<h3 class="w3-text-black"><b>Software and Game Development:</b></h3>
			<h4 class="w3-text-pink"><b>Develop programmed softwares to meet certain objectives.</b></h4>
			<h4 class="w3-text-pink"><b>Business objectives: Antivirus softwares, Payroll softwares and Database softwares</b></h4>
			<h4 class="w3-text-pink"><b>Potential Companies: Apple, Google, Microsoft, and Unity.</b></h4>
			<p class="w3-text-black">_______________________________________________________________________________________________</p>
			<h3 class="w3-text-black"><b>Information Assurance and Security:</b></h3>
			<h4 class="w3-text-pink"><b>Data Encryption, Endpoint and Threat Isolation, Cyber Defense (Firewall).</b></h4>
			<h4 class="w3-text-pink"><b>Potential Companies: Aerospace Firm, Medical Agencies and Military Operations.</b></h4>
			<p class="w3-text-black">_______________________________________________________________________________________________</p>
			<h3 class="w3-text-black"><b>Business Analytics:</b></h3>
			<h4 class="w3-text-pink"><b>Constructs data charts and graph in the company to boost sales and reputations.</b></h4>
			<h4 class="w3-text-pink"><b>Tier 4 Job. High in Demand.</b></h4>
		</div>

		<div id="Criterion for C. S." class="w3-container city w3-animate-opacity w3-2021-ultimate-gray" style="display: none">
			<h2 class="w3-center w3-text-black" style="text-shadow: 5px 5px 0 #777"><i class="fa fa-graduation-cap" aria-hidden="true"></i><b> Qualifications For Computer Science </b><i class="fa fa-graduation-cap" aria-hidden="true"></i></h2>
			<h3 class="w3-text-black"><b>Compulsory Course for Bachelor's Degree in Computer Science:</b></h3>
			<h4 class="w3-text-pink"><b>Computer Science, Further Mathematics, Applied Physics & Applied Chemistry.</b></h4>
			<p class="w3-text-black">_______________________________________________________________________________________________</p>
			<h3 class="w3-text-black"><b>Level of Proficiency in Computer Science:</b></h3>
			<h4 class="w3-text-pink"><b>Implementations of programming language and computation in real - life scenario.</b></h4>
			<h4 class="w3-text-pink"><b>Mastery in algorithms and data structures.</b></h4>
			<h4 class="w3-text-pink"><b>Computer Architecture (Eg: Logic Board, Processor, and Build - Up Composition)</b></h4>
			<p class="w3-text-black">_______________________________________________________________________________________________</p>
			<h3 class="w3-text-black"><b>Education Pathway:</b></h3>
			<h4 class="w3-text-pink"><b>SPM Certification --> Pre-U/Foundation --> Bachelor's Degree --> Job Employment.</b></h4>
			<h4 class="w3-text-pink"><b>Optional Level of Education: Bachelor's Masters in Field of Computing (2 Years).</b></h4>
			<h4 class="w3-text-pink"><b>Higher Rate of Acceptance in job interview.</b></h4>
		</div>

		<script>
			function openCity(cityName)
			{
				var i;
				var x = document.getElementsByClassName("city");
				for (i = 0; i < x.length; i++)
				{
					x[i].style.display = "none";  
				}
				document.getElementById(cityName).style.display = "block";  
			}
		</script>
	</div>
</div>

<?PHP
mysqli_close($Connection);
include ('Footer.php');
?>