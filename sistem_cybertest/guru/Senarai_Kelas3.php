<!-- Set 3: Purple Shade -->

<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');

# Add New Data Section
# Check for $_POST
if (!empty($_POST))
{
	# Obtain $_POST
	$NamaKelas		=		mysqli_real_escape_string($Connection, $_POST['NamaKelas']);
	$Tingkatan		=		mysqli_real_escape_string($Connection, $_POST['Tingkatan']);
	$NoKP_Guru		=		$_POST['NoKP_Guru'];

	#Check for collected data
	if (empty($NamaKelas) or empty($NoKP_Guru) or empty($Tingkatan))
	{
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	# Code to insert data into kelas
	$arahan_simpan="INSERT INTO kelas
	(Tingkatan, NamaKelas, NoKP_Guru)

	VALUES
	('$Tingkatan', '$NamaKelas', '$NoKP_Guru')";

	# Execute command
	if (mysqli_query($Connection, $arahan_simpan))
	{
		# Data stored (SUCCESSFULLY)
		echo "<script>alert('Registration Successful.');
		window.location.href = 'Senarai_Kelas3.php';</script>";
	}

	else
	{
		# Data stored (FAILED)
		echo "<script>alert('Registration Failed.');
		window.location.href = 'Senarai_Kelas3.php';</script>";
	}
}

# Update Teacher Data Section
# Check for $_GET
if (!empty($_GET))
{
	# Obtain $_GET
	$IDKelas		=		$_GET['IDKelas'];
	$NoKP_Guru		=		$_GET['NoKP_Guru_Baru'];

	# Check for collected data
	if (empty($IDKelas) or empty($NoKP_Guru))
	{
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	# Code to update Teacher Data
	$arahan_kemaskini="UPDATE kelas SET
	NoKP_Guru='$NoKP_Guru'

	WHERE
	IDKelas='$IDKelas' ";

	# Execute command
	if(mysqli_query($Connection, $arahan_kemaskini))
	{
		# Update Successful
		echo "<script>alert('Update Successful.');
		window.location.href = 'Senarai_Kelas3.php';</script>";
	}

	else
	{
		# Update Failed
		echo "<script>alert('Update Failed.');
		window.location.href = 'Senarai_Kelas3.php';</script>";
	}
}
?>

<div class="w3-container w3-table">
	<div class="w3-row w3-center w3-margin">

		<!-- Retrieve Butang_Saiz.php -->
		<div class="w3-third w3-margin w3-panel w3-2020-fired-brick">
			<?PHP include('../Butang_Saiz.php'); ?>
		</div>

		<!-- Button (Alter Table Color) -->
		<div class="w3-third w3-margin w3-panel w3-2020-fired-brick w3-right">
			<br>
			<div class="w3-margin-bottom w3-center">
				<div class="w3-xlarge w3-text-aqua" style="text-shadow: 3px 3px #555">
					<i class="fa fa-exclamation-triangle" aria-hidden="true"><b> Color Alterations: </b></i>
				</div>

				<a href="senarai_kelas.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='BLUE'>BLUE</a>
				<a href="senarai_kelas2.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='GREEN'>GREEN</a>
				<a href="senarai_kelas3.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='PURPLE'>PURPLE</a>
			</div>
		</div>
	</div>

	<!-- Class & Teacher List Section -->
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Classrooms & Assigned Teachers </b></i></h2>
	</div>

	<table width="100%" align="center" border="1" id="besar" class="w3-2018-crocus-petal w3-text-black w3-margin-bottom" bordercolor='#000000'>
		<tr>
			<td class="w3-center w3-2020-magenta-purple" style="width: 20% vertical-align: middle;"><i class="fa fa-tags" aria-hidden="true"><b> Classroom </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 20% vertical-align: middle;"><i class="fa fa-empire" aria-hidden="true"><b> Classroom Name </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 20% vertical-align: middle;"><i class="fa fa-briefcase" aria-hidden="true"><b> Assigned Teacher </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 15% vertical-align: middle;"><i class="fa fa-id-card-o" aria-hidden="true"><b> Newly Assigned Teacher </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 25% vertical-align: middle;"><i class="fa fa-cog" aria-hidden="true"><b> Operative Measures </b></i></td>
		</tr>

		<!-- Transfer Class Form -->
		<tr>
			<form name="Tambah_Kelas" action="" method="POST">
				<td><b><input 	class="w3-input"	 style="vertical-align: middle;" 	type="text" 	name="Tingkatan"></b></td>
				<td><b><input 	class="w3-input" 	 style="vertical-align: middle;" 	type="text" 	name="NamaKelas"></b></td>
				<td><b>
					<select class="w3-select" name="NoKP_Guru">
						<option value selected disabled>SELECT</option>

						<?PHP
						# Code to locate all data from Jadual Guru
						$SQL="SELECT* FROM guru ORDER BY NamaGuru ASC";

						# Execute code to find data
						$laksana_arahan_cari=mysqli_query($Connection, $SQL);

						# $Rekod_Guru retrieve data line by line
						while ($rekod_guru=mysqli_fetch_array($laksana_arahan_cari))
						{
							# Show all data collected in <option> </option>
							echo "<option value=".$rekod_guru['NoKP_Guru'].">".$rekod_guru['NamaGuru']."</option>";
						}
						?>
					</select>
				</b></td>
				<td><b> </b></td>
				<td class='w3-center'><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

		<?PHP

		# Locate matching data from Jadual (Kelas & Guru)
		$arahan_cari_kelas="SELECT* FROM kelas, guru

		WHERE
		kelas.NoKP_Guru		=		guru.NoKP_Guru

		ORDER BY Tingkatan, NamaKelas ASC";

		# Execute the Code
		$laksana_cari_kelas=mysqli_query($Connection, $arahan_cari_kelas);

		# Collect all data found
		while ($data=mysqli_fetch_array($laksana_cari_kelas))
		{
			# Show data (Line by Line)
			echo "<tr>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['Tingkatan']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['NamaKelas']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['NamaGuru']."</b></td>
					<td style='vertical-align: middle;'><b>
						<form action='' method='GET'>
							<input  type='hidden' name='IDKelas' value='".$data['IDKelas']."'>
							<select class='w3-select' style='vertical-align: middle;' name='NoKP_Guru_Baru'>
								<option value selected disabled>SELECT</option>";

								$SQL2="SELECT* FROM guru ORDER BY NamaGuru ASC";

								# Execute code to find data
								$laksana_arahan_cari2=mysqli_query($Connection, $SQL2);

								# $Rekod_Bilik retrieve data line by line
								while ($rekod_guru2=mysqli_fetch_array($laksana_arahan_cari2))
								{
									# Show all data collected in <option> </option>
									echo "<option value=".$rekod_guru2['NoKP_Guru'].">".$rekod_guru2['NamaGuru']."</option>";
								}

							echo "</select></td>
							<td class='w3-center' style='vertical-align: middle;'><b>
								<div class='w3-center'>
									<input class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-margin-right w3-medium' type='submit' value='UPDATE CREDENTIALS'><b></b>

									<button onclick=\"location.href='padam.php?jadual=kelas&medan=IDKelas&kp=".$data['IDKelas']."'\"  class='w3-center w3-margin-top w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium' type='button'><b> DELETE CREDENTIALS </b></button>
								</div>
							</b></td>
				</tr>
			</form>";		
		}
		?>
	</table>
</div>

<?PHP include ('Footer_Guru.php'); ?>