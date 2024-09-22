<!-- Set 2: Green Shade -->

<?PHP

# Retrieve Header_Guru.php
include ('header_guru.php');

# Check $_POST for data (Teacher's Registration Process)
if (!empty($_POST))
{
	# Obtain data from form entered by ADMIN
	$Nama			=		mysqli_real_escape_string($Connection, $_POST['Nama_Baru']);
	$NoKP			=		mysqli_real_escape_string($Connection, $_POST['NoKP_Baru']);
	$Katalaluan		=		mysqli_real_escape_string($Connection, $_POST['Katalaluan_Baru']);
	$Tahap			=		$_POST['Tahap'];

	# Check for the collected Data
	if (empty($Nama) or empty($NoKP) or empty($Katalaluan) or empty($Tahap))
	{
		# If data not found, kill script
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	# NoKP Guru (Data Validation Process)
	if (strlen($NoKP)!=12 or !is_numeric($NoKP))
	{
		die("<script>alert('Invalid Identification Card Number.');
		window.history.back();</script>");
	}

	# Code to store data Guru
	$arahan_simpan="INSERT INTO guru
	(NamaGuru, NoKP_Guru, Katalaluan_Guru, Tahap)

	VALUES
	('$Nama', '$NoKP', '$Katalaluan', '$Tahap')";

	# Code to store Data Guru into the table
	if (mysqli_query($Connection, $arahan_simpan))
	{
		# Data Storage (Successful)
		echo "<script>alert('Registration Successful.');
		window.location.href='Guru_Senarai2.php';</script>";
	}
	
	else
	{
		# Data Storage (Failed)
		echo "<script>alert('Registration Failed.');
		window.location.href='Guru_Senarai2.php';</script>";
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

				<a href="guru_senarai.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='BLUE'>BLUE</a>
				<a href="guru_senarai2.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='GREEN'>GREEN</a>
				<a href="guru_senarai3.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='PURPLE'>PURPLE</a>
			</div>
		</div>
	</div>

	<!-- Teacher List Section -->
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Present Teachers & Administrators </b></i></h2>
	</div>
	
	<table width="100%" align="center" border="1" id="besar" class="w3-2021-green-ash w3-text-black w3-margin-bottom" bordercolor='#000000'>
		<tr>
			<td class="w3-center w3-2020-ultramarine-green" style="width: 20% vertical-align: middle;"><i class="fa fa-tags" aria-hidden="true"><b> User's Name </b></i></td>
			<td class="w3-center w3-2020-ultramarine-green" style="width: 20% vertical-align: middle;"><i class="fa fa-id-card-o" aria-hidden="true"><b> Identification Card Number </b></i></td>
			<td class="w3-center w3-2020-ultramarine-green" style="width: 20% vertical-align: middle;"><i class="fa fa-key" aria-hidden="true"><b> Password </b></i></td>
			<td class="w3-center w3-2020-ultramarine-green" style="width: 15% vertical-align: middle;"><i class="fa fa-id-badge" aria-hidden="true"><b> Employment Status </b></i></td>
			<td class="w3-center w3-2020-ultramarine-green" style="width: 25% vertical-align: middle;"><i class="fa fa-cog" aria-hidden="true"><b> Operative Measures </b></i></td>
		</tr>
		<tr>
			<!-- Registration For New Teacher-->
			<form action=" " method="POST">
				<td><b><input 	class="w3-input"	type="text" 		name="Nama_Baru"></b></td>
				<td><b><input 	class="w3-input"	type="text" 		name="NoKP_Baru"></b></td>
				<td><b><input 	class="w3-input"	type="password" 	name="Katalaluan_Baru"></b></td>
				<td><b>
					<select class="w3-select"	name="Tahap">
						<option value selected disabled>SELECT</option>
						<option value="ADMIN">ADMIN</option>
						<option value="TEACHER">TEACHER</option>
					</select>
				</b></td>
				<td class="w3-center"><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

	<?PHP

	# SQL Code (Select data from the table)
	$arahan_cari_guru= "SELECT* FROM guru ORDER BY Tahap, NamaGuru ASC";

	# Execute the SQL Code
	$laksana_cari_guru=mysqli_query($Connection, $arahan_cari_guru);

	# Collect all data found
	while ($data=mysqli_fetch_array($laksana_cari_guru))
	{
		# Gather data into Array
		$data_guru=array(
			'NamaGuru'			=>		$data['NamaGuru'],
			'NoKP_Guru'			=>		$data['NoKP_Guru'],
			'Katalaluan_Guru'	=>		$data['Katalaluan_Guru'],
			'Tahap'				=>		$data['Tahap']
		);

		# Show data (Line by Line)
		echo "<tr>
				<td class='w3-center' style='vertical-align: middle;'><b>".$data['NamaGuru']."</b></td>
				<td class='w3-center' style='vertical-align: middle;'><b>".$data['NoKP_Guru']."</b></td>
				<td class='w3-center' style='vertical-align: middle;'><b>".$data['Katalaluan_Guru']."</b></td>
				<td class='w3-center' style='vertical-align: middle;'><b>".$data['Tahap']."</b></td>
				<td class='w3-center' style='vertical-align: middle;'><b>
					<div class='w3-center'>
						<a href='Guru_Kemaskini2.php?".http_build_query($data_guru)."' class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-margin-right w3-medium'><b> UPDATE CREDENTIALS </b></a>

						<a href='padam.php?jadual=guru&medan=NoKP_Guru&kp=".$data['NoKP_Guru']."'onClick=\"return confirm('Confirmation: You are about to delete all data regarding the respective teacher.')\" class='w3-center w3-margin-top w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'><b> DELETE CREDENTIALS </b></a>
					</div>
				</b></td>
			</tr>";
	}
	?>
	</table>
</div>

<?PHP include('footer_guru.php'); ?>