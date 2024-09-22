<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');

# Store data Set_Soalan Baru Section
# Check for $_POST
if (!empty($_POST))
{
	# Obtain $_POST
	$Soalan			=		mysqli_real_escape_string($Connection, $_POST['Soalan']);
	$Jawapan_A		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_A']);
	$Jawapan_B		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_B']);
	$Jawapan_C		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_C']);
	$Jawapan_D		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_D']);

	# Check if soalan have images
	if ($_FILES['Gambar']['size'] != 0)
	{
		# Upload Images
		$timestamp				=		date("Y-m-dhisA");
		$saiz_fail				=		$_FILES['Gambar']['size'];
		$nama_fail				=		basename($_FILES['Gambar']['name']);
		$jenis_gambar			=		pathinfo($nama_fail, PATHINFO_EXTENSION);
		$lokasi					=		$_FILES['Gambar']['tmp_name'];
		$nama_baru_gambar		=		"../images/".$timestamp.".".$jenis_gambar;
		move_uploaded_file($lokasi, $nama_baru_gambar);

		# Code to store soalan + image
		$arahan_simpan="INSERT INTO soalan
		(NoSet, Soalan, Gambar, Jawapan_A, Jawapan_B, Jawapan_C, Jawapan_D)

		VALUES
		('".$_GET['NoSet']."', '$Soalan', '$nama_baru_gambar', '$Jawapan_A', '$Jawapan_B', '$Jawapan_C', '$Jawapan_D')";
	}

	else
	{
		# Code to store soalan
		$arahan_simpan="INSERT INTO soalan
		(NoSet, Soalan, Gambar, Jawapan_A, Jawapan_B, Jawapan_C, Jawapan_D)

		VALUES
		('".$_GET['NoSet']."', '$Soalan', ' ', '$Jawapan_A', '$Jawapan_B', '$Jawapan_C', '$Jawapan_D')";
	}

	#Check for collected data
	if (empty($Soalan) or empty($Jawapan_A) or empty($Jawapan_B) or empty($Jawapan_C) or empty($Jawapan_D))
	{
		# If Data not found, Kill script
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	# Execute command $arahan_simpan
	if (mysqli_query($Connection, $arahan_simpan))
	{
		# Data Storage (Successful)
		echo "<script>alert('Registration Successful.');
		window.location.href='Soalan_Daftar.php?NoSet=".$_GET['NoSet']."&Topik=".$_GET['Topik']."';
		</script>";
	}

	else
	{
		# Data Storage (Failed)
		echo "<script>alert('Registration Failed.');
		window.location.href='Soalan_Daftar.php?NoSet=".$_GET['NoSet']."&Topik=".$_GET['Topik']."';
		</script>";
	}
}
?>

<div class="w3-container w3-table">
	<div class="w3-row w3-center w3-margin">

		<!-- Retrieve Butang_Saiz.php -->
		<div class="w3-third w3-margin w3-panel w3-2020-fired-brick">
			<?PHP include('../Butang_Saiz.php'); ?>
		</div>
	</div>

	<!-- Registered Soalan Section -->
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 2px 2px #555"><i class="fa fa-list" aria-hidden="true"><b> Exercises & Pop Quiz: Questions Set-Up Menu </b></i></h2>
	</div>
	<table width="100%" border="1" id="besar" class="w3-2021-cerulean w3-text-black w3-centered w3-margin-bottom" bordercolor='#000000'>
		<tr>
			<td class="w3-center w3-2020-navy-blazer" style="width: 13%"><i class="fa fa-file" aria-hidden="true"></i><b> Questions </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 18%"><i class="fa fa-file-image-o" aria-hidden="true"></i><b> Images </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 14%"><i class="fa fa-toggle-on w3-text-green" aria-hidden="true"></i><b> Answer A </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 14%"><i class="fa fa-toggle-off w3-text-red" aria-hidden="true"></i><b> Answer B </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 14%"><i class="fa fa-toggle-off w3-text-red" aria-hidden="true"></i><b> Answer C </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 14%"><i class="fa fa-toggle-off w3-text-red" aria-hidden="true"></i><b> Answer D </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 13%"><i class="fa fa-cog" aria-hidden="true"></i><b> Operative Measures </b></td>
		</tr>

		<!-- Set_Soalan Baru Form -->
		<tr>
			<form action="" method="POST" enctype="multipart/form-data">
				<td><b><textarea class="w3-input" name="Soalan" rows="4" cols="25"></textarea></b></td>
				<td style="vertical-align: middle;"><b><input class="w3-input w3-card-4 w3-hover-black" type="file" name="Gambar"></b></td>
				<td bgcolor="green"><b><textarea class="w3-input" name="Jawapan_A" rows="4" cols="25"></textarea></b></td>
				<td bgcolor="red"><b><textarea class="w3-input" name="Jawapan_B" rows="4" cols="25"></textarea></b></td>
				<td bgcolor="red"><b><textarea class="w3-input" name="Jawapan_C" rows="4" cols="25"></textarea></b></td>
				<td bgcolor="red"><b><textarea class="w3-input" name="Jawapan_D" rows="4" cols="25"></textarea></b></td>
				<td class='w3-center' style="vertical-align: middle;"><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

		<?PHP

		# Locate Soalan based on Set_Soalan
		$arahan_soalan = "SELECT* FROM soalan

		WHERE NoSet = '".$_GET['NoSet']."'

		ORDER BY NoSoalan ASC";

		# Execute command
		$laksana_soalan=mysqli_query($Connection, $arahan_soalan);

		#$data collects data
		while ($data=mysqli_fetch_array($laksana_soalan))
		{
			# Gather data into Array $data_get
			$data_get=array(
				'NoSet'			=>		$data['NoSet'],
				'NoSoalan'		=>		$data['NoSoalan'],
				'Topik'			=>		$_GET['Topik'],
				'Soalan'		=>		$data['Soalan'],
				'Jawapan_A'		=>		$data['Jawapan_A'],
				'Jawapan_B'		=>		$data['Jawapan_B'],
				'Jawapan_C'		=>		$data['Jawapan_C'],
				'Jawapan_D'		=>		$data['Jawapan_D']
			);

			# Show data (Line by Line)
			echo "<tr>
					<td style='vertical-align: middle;'><b>".$data['Soalan']."</b></td>
					<td style='vertical-align: middle;'><b><img src='".$data['Gambar']."' style='width: 50%'></b></td>
					<td style='vertical-align: middle;'><b>".$data['Jawapan_A']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Jawapan_B']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Jawapan_C']."</b></td>
					<td style='vertical-align: middle;'><b>".$data['Jawapan_D']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>
							<a href='Soalan_Kemaskini.php?".http_build_query($data_get)."' class='w3-center w3-margin-bottom w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> UPDATE CREDENTIALS </a>
							<a href='padam.php?jadual=soalan&medan=NoSoalan&kp=".$data['NoSoalan']."'onClick=\"return confirm('Confirmation: Continuing will completely erase the selected question.')\" class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> DELETE CREDENTIALS </a>
					</b></td>
				</tr>";
		}
		?>
	</table>
</div>

<?PHP include ('Footer_Guru.php'); ?>