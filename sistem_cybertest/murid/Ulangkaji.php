<?PHP

# Include Connection.php and Header_Murid.php
include ('Header_Murid.php');
include ('../Connection.php');

# Check for $_GET and $_POST
if (empty($_GET) and empty($_SESSION['NamaMurid']))
{
	# If Data not found, Kill script
	die("<script>alert('Access Denied!');
	window.location.href='Pilih_Latihan.php';</script>");
}

# Split $_GET
$pecahkanbaris =explode("|", $_GET['kumpul']);

# Gather Split Data
list($bil_betul, $bil_soalan, $peratus, $bil_jawapan) = $pecahkanbaris;

# Code to locate Jawapan_Pelajar based on NoKP_Murid & NoSet_Soalan
$arahan_carian="SELECT* FROM set_soalan, soalan, jawapan_murid, murid
WHERE 
		set_soalan.NoSet 		=		soalan.NoSet
AND 	soalan.NoSoalan 		= 		jawapan_murid.NoSoalan
AND 	murid.NoKP_Murid		=		jawapan_murid.NoKP_Murid
AND     murid.NoKP_Murid		=		'".$_SESSION['NoKP_Murid']."' 
AND     soalan.NoSet 			=		'".$_GET['NoSet']."' ";

# Execute Command
$laksana_carian=mysqli_query($Connection, $arahan_carian);

# Title: Ulangkaji, Score, Marks
?>

<div class=" w3-row w3-margin-top w3-margin-bottom">
	<div class="w3-quarter w3-container">

	</div>

	<div class="w3-container w3-half w3-card-4 w3-theme-gradient-4 w3-content">
		<?PHP
		echo "
		<h1 class='w3-center w3-text-deep-purple' style='text-shadow: 3px 3px #222'><i class='fa fa-pie-chart' aria-hidden='true'></i><b> Revision Segment </b><i class='fa fa-pie-chart' aria-hidden='true'></i></h1>
		<h4 class='w3-center w3-text-blue w3-xlarge'><b><i>Congratulations for completing the task!</i></b></h4>
		<div class='w3-text-blue'>
			<h5 class='w3-margin-top w3-large'><b>Scholar Name: ".$_SESSION['NamaMurid']."</b></h5>
			<h5 class='w3-large'><b>Subject Topic: ".$_GET['Topik']."</b></h5>
			<h5 class='w3-large'><b>Overall Score: ".$bil_betul." / ".$bil_soalan."</b></h5>
			<h5 class='w3-large'><b>Percentage: ".number_format($peratus,2)."%</b></h5>
		</div>
		<hr>";

		$bilangan=0;

		# Obtain collected data(Jawapan_Pelajar)
		while ($rekod=mysqli_fetch_array($laksana_carian))
		{
			# Check for Unanswered Questions
			if ($rekod['Jawapan']!="Tidak Jawab")
			{
				$nilai_jawapan=$rekod[$rekod['Jawapan']] ??"";
			}

			else
			{
				$nilai_jawapan="Not Answered";
			}

			# Show Question & Answer
			echo "
			<b class='w3-large'>Question No: ".++$bilangan."<br>
			".$rekod['Soalan']."</b><br>
			<img src='".$rekod['Gambar']."' class='w3-image w3-margin-top w3-margin-bottom' style='width: 20%'>

			<div class='w3-panel w3-black'>
				<h5 class='w3-text-green w3-large'><i class='fa fa-toggle-on' aria-hidden='true'></i><b>".' ', $rekod['Jawapan_A']."</b></h5>
				<h5 class='w3-text-red w3-large'><i class='fa fa-toggle-off' aria-hidden='true'></i><b>".' ', $rekod['Jawapan_B']."</b></h5>
				<h5 class='w3-text-red w3-large'><i class='fa fa-toggle-off' aria-hidden='true'></i><b>".' ', $rekod['Jawapan_C']."</b></h5>
				<h5 class='w3-text-red w3-large'><i class='fa fa-toggle-off' aria-hidden='true'></i><b>".' ', $rekod['Jawapan_D']."</b></h5>
			</div>

			<b class='w3-large'>Answer Sheet: ".$rekod['Jawapan_A']."<br>
			Scholar's Answer: ".$nilai_jawapan."<br>
			Status: ".$rekod['Catatan']."</b>
			<hr>";
		}
		?>

		<div class="w3-row">
			<div class="w3-margin-bottom"><b>
				<input class="w3-button w3-hover-black w3-border w3-border-black w3-round-large w3-large" type="submit" value="PRINT RESULTS" onclick="window.print()">
			</b></div>

			<?PHP mysqli_close($Connection); ?>
		</div>

		<h5><input class="w3-checkbox" type="checkbox" onclick="show()" id="button"><b> Hide Header </b></h5>
		<h5><input class="w3-checkbox" type="checkbox" onclick="show2()" id="button2"><b> Hide Footer </b></h5>

			<script>
				function show()
				{
					var x = document.getElementById("header");
					var y = document.getElementById("button")
					if (x.style.display === "none")
					{
					x.style.display = "block";
					y.innerHTML = "Hide";
					}

					else
					{
					x.style.display = "none";
					y.innerHTML = "Show";
					}
				}
			</script>

			<script>
				function show2()
				{
					var x2 = document.getElementById("footer");
					var y2 = document.getElementById("button2")
					if (x2.style.display === "none")
					{
					x2.style.display = "block";
					y2.innerHTML = "Hide";
					}

					else
					{
					x2.style.display = "none";
					y2.innerHTML = "Show";
					}
				}
			</script>
	</div>

	<div class="w3-quarter w3-container">
		
	</div>
</div>

<?PHP include('footer_murid.php'); ?>