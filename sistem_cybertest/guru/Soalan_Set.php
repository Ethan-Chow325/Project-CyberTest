<!-- Set 1: Blue Shade -->

<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');

# Data Set_Soalan Baru
if (!empty($_POST))
{
	# Obtain $_POST Data
	$Topik		=		mysqli_real_escape_string($Connection, $_POST['Topik']);
	$Arahan		=		mysqli_real_escape_string($Connection, $_POST['Arahan']);
	$Jenis		=		$_POST['Jenis'];
	$Tarikh		=		$_POST['Tarikh'];

	# Quiz Time Limit
	if ($Jenis == 'EXERCISE')
		$Masa	=	"NULL";

	else
		$Masa	=	mysqli_real_escape_string($Connection, $_POST['Masa']);

	# Check for collected data
	if (empty($Topik) or empty($Arahan) or empty($Jenis) or empty($Tarikh) or empty($Masa))
	{
		# If Data not found, Kill script
		die("<script>alert('Missing Credentials!');
		window.location.href='Soalan_Set.php';</script>");
	}

	# Code to store data (Set_Soalan Baru)
	$arahan_simpan="INSERT INTO set_soalan
	(Topik, Arahan, Jenis, Tarikh, Masa, NoKP_Guru)

	VALUES
	('$Topik', '$Arahan', '$Jenis', '$Tarikh', '$Masa', '".$_SESSION['NoKP_Guru']."')";

	# Execute Command
	if (mysqli_query($Connection, $arahan_simpan))
	{
		# Data Storage (Successful)
		echo "<script>alert('Registration Successful.');
		window.location.href='Soalan_Set.php';</script>";
	}

	else
	{
		# Data Storage (Failed)
		echo "<script>alert('Registration Failed.');
		window.location.href='Soalan_Set.php';</script>";
	}
}
?>

<div class="w3-container w3-table">
	<div class="w3-row w3-center w3-margin">

		<!-- Retrieve Butang_Saiz.php -->
		<div class="w3-third w3-margin w3-panel w3-2020-fired-brick">
			<?PHP include('../Butang_Saiz.php'); ?>
		</div>

		<!--  Colorblind Users -->
		<div class="w3-third w3-panel w3-2020-fired-brick w3-right w3-margin-right">
			<br>
			<div class="w3-margin-bottom w3-center">
				<div class="w3-xlarge w3-text-aqua" style="text-shadow: 3px 3px #555">
					<i class="fa fa-exclamation-triangle" aria-hidden="true"><b> Red-Green Colorblind? </b></i>
				</div>

				<a href="Soalan_Set_C.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='YES, I AM'>YES, I AM</a>
				<a href="Soalan_Set.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value="NO, I'M NOT">NO, I'M NOT</a>
			</div>
		</div>
	</div>

	<!-- List Set_Soalan Section -->
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 2px 2px #555"><i class="fa fa-list" aria-hidden="true"><b> Exercises & Pop Quiz </b></i></h2>
	</div>

	<table width="100%" border="1" id="besar" class="w3-2021-cerulean w3-text-black w3-centered w3-margin-bottom" bordercolor='#000000'>
		<tr>
			<td class="w3-center w3-2020-navy-blazer" style="width: 20%"><i class="fa fa-book" aria-hidden="true"><b> Subject Topics </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 20%"><i class="fa fa-envelope-open" aria-hidden="true"><b> Instructions </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 20%"><i class="fa fa-folder-open" aria-hidden="true"><b> Exercise/Quiz  </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-calendar" aria-hidden="true"><b> Due Date </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 10%"><i class="fa fa-clock-o" aria-hidden="true"><b> Time Allocated </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-cog" aria-hidden="true"><b> Operative Measures </b></i></td>
		</tr>
		<tr>

			<!-- Registration For Set_Soalan Baru -->
			<form action=" " method="POST">
				<td><b><textarea 	class="w3-input" name="Topik" 	rows="4"	cols="25"></textarea></b></td>
				<td><b><textarea 	class="w3-input" name="Arahan" 	rows="4"	cols="25"></textarea></b></td>
				<td style="vertical-align: middle;"><b>
					<select class="w3-select" name="Jenis"><b>
						<option value selected disabled>SELECT</option>
						<option value="QUIZ">QUIZ</option>
						<option value="EXERCISE">EXERCISE</option>
					</select>
				</b></td>
				<td style="vertical-align: middle;"><b><input class="w3-input" type="date" 	name="Tarikh"></b></td>
				<td style="vertical-align: middle;"><b><input class="w3-input" type="number" 	name="Masa"	placeholder="In Minutes"></b></td>
				<td class='w3-center' style="vertical-align: middle;"><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

		<?PHP
		# Code to select data from Set_Soalan Table
		$arahan_set	= "SELECT* FROM set_soalan ORDER BY Jenis, NoSet, Tarikh ASC";

		# Execute Command
		$laksana_set=mysqli_query($Connection, $arahan_set);

		# Collect all data found
		while ($data=mysqli_fetch_array($laksana_set))
		{
			# Gather data into Array
			$data_get=array(
				'NoSet'			=>		$data['NoSet'],
				'Topik'			=>		$data['Topik'],
				'Arahan'		=>		$data['Arahan'],
				'Jenis'			=>		$data['Jenis'],
				'Tarikh'		=>		$data['Tarikh'],
				'Masa'			=>		$data['Masa'],
				'NoKP_Guru'		=>		$data['NoKP_Guru']
			);

			# Show data (Line by Line)
			echo "<tr>
					<td style='vertical-align: middle;'><b>".$data['Topik']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Arahan']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Jenis']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Tarikh']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Masa']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>
						<div class='w3-container w3-center'>
							
							<a href = 'Soalan_Daftar.php?NoSet=".$data['NoSet']."&Topik=".$data['Topik']."' class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> QUESTION SET-UP </a>

							<a href='Soalan_SetKemaskini.php?".http_build_query($data_get)."' class='w3-center w3-margin-top w3-margin-bottom w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> UPDATE CREDENTIALS </a>

							<a href='padam.php?jadual=set_soalan&medan=NoSet&kp=".$data['NoSet']."'onClick=\"return confirm('Confirmation: Continuing will completely erase the selected question set.')\" class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'>DELETE CREDENTIALS </a>
						</div>
					</b></td>	
				</tr>";
		}
		?>
	</table>
</div>

<?PHP include ('Footer_Guru.php'); ?>