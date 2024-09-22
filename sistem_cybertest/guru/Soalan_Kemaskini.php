<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');

# Updated Files Section
# Check for $GET Data
if (empty($_GET))
{
	die("<script>alert('Access Denied!');
		window.location.href='Soalan_Daftar.php?NoSet=".$_GET['NoSet']."&Topik=".$_GET['Topik']."';</script>");
}

#Check for $POST Data
if (!empty($_POST))
{
	# Obtain $POST Data
	$Soalan			=		mysqli_real_escape_string($Connection, $_POST['Soalan']);
	$Jawapan_A		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_A']);
	$Jawapan_B		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_B']);
	$Jawapan_C		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_C']);
	$Jawapan_D		=		mysqli_real_escape_string($Connection, $_POST['Jawapan_D']);

	# Check for collected Data
	if (empty($Soalan) or empty($Jawapan_A) or empty($Jawapan_B) or empty($Jawapan_C) or empty($Jawapan_D))
	{
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	# Code to update Soalan & Jawapan
	$arahan_kemaskini="UPDATE soalan
	SET
	Soalan			=		'".$_POST['Soalan']."',
	Jawapan_A		=		'".$_POST['Jawapan_A']."',
	Jawapan_B		=		'".$_POST['Jawapan_B']."',
	Jawapan_C		=		'".$_POST['Jawapan_C']."',
	Jawapan_D 		=		'".$_POST['Jawapan_D']."'

	WHERE
	NoSoalan		=		'".$_GET['NoSoalan']."' ";

	# Execute command
	if (mysqli_query($Connection, $arahan_kemaskini))
	{
		# Data Update (Successful)
		echo "<script>alert('Update Successful.');
		window.location.href='Soalan_Daftar.php?NoSet=".$_GET['NoSet']."&Topik=".$_GET['Topik']."';</script>";
	}

	else
	{
		# Data Update (Failed)
		echo "<script>alert('Update Failed.');
		window.location.href='Soalan_Daftar.php?NoSet=".$_GET['NoSet']."&Topik=".$_GET['Topik']."';</script>";
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
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 2px 2px #555"><i class="fa fa-list" aria-hidden="true"><b> Exercise & Pop Quiz: Questions Update Menu </b></i></h2>
	</div>

	<table width="100%" border="1" id="besar" class="w3-2021-cerulean w3-text-black w3-centered w3-margin-bottom" bordercolor='#000000'>
		<tr>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-file" aria-hidden="true"></i><b> Questions </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-toggle-on w3-text-green" aria-hidden="true"></i><b> Answer A </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-toggle-off w3-text-red" aria-hidden="true"></i><b> Answer B </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-toggle-off w3-text-red" aria-hidden="true"></i><b> Answer C </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-toggle-off w3-text-red" aria-hidden="true"></i><b> Answer D </b></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 13%"><i class="fa fa-cog" aria-hidden="true"></i><b> Operative Measures </b></td>
		</tr>

		<!-- Set_Soalan Baru Form -->
		<tr>
			<form action="" method="POST">
				<td><b><textarea class="w3-input" name="Soalan" rows="4" cols="25">
					<?PHP echo $_GET['Soalan']; ?>
				</textarea></b></td>

				<td bgcolor="green"><b><textarea class="w3-input" name="Jawapan_A" rows="4" cols="25">
					<?PHP echo $_GET['Jawapan_A']; ?>
				</textarea></b></td>

				<td bgcolor="red"><b><textarea class="w3-input" name="Jawapan_B" rows="4" cols="25">
					<?PHP echo $_GET['Jawapan_B']; ?>
				</textarea></b></td>

				<td bgcolor="red"><b><textarea class="w3-input" name="Jawapan_C" rows="4" cols="25">
					<?PHP echo $_GET['Jawapan_C']; ?>
				</textarea></b></td>

				<td bgcolor="red"><b><textarea class="w3-input" name="Jawapan_D" rows="4" cols="25">
					<?PHP echo $_GET['Jawapan_D']; ?>
				</textarea></b></td>

				<td class='w3-center' style="vertical-align: middle;"><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

		<?PHP
		# Code to locate Soalan (related to chosen Set_Soalan)
		$arahan_soalan = "SELECT* FROM soalan

		WHERE NoSet = '".$_GET['NoSet']."'

		ORDER BY Soalan, Gambar ASC";

		# Execute command
		$laksana_soalan=mysqli_query($Connection, $arahan_soalan);

		# $data collects data
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