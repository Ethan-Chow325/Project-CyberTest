<!-- Set 1: Blue Shade -->

<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');

# Store data Set_Soalan Baru Section
# Check for $_POST
if (!empty($_POST))
{
	# Obtain $_POST
	$Topik			=		mysqli_real_escape_string($Connection, $_POST['Topik']);
	$Arahan			=		mysqli_real_escape_string($Connection, $_POST['Arahan']);
	$Jenis			=		$_POST['Jenis'];
	$Tarikh			=		$_POST['Tarikh'];

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
		window.location.href='Soalan_Set.php;</script>");
	}

	# Code to Update data Set_Soalan Baru
	$arahan_kemaskini="UPDATE set_soalan SET
	Topik		=		'$Topik',
	Arahan		=		'$Arahan',
	Jenis		=		'$Jenis',
	Tarikh		=		'$Tarikh',
	Masa 		=		'$Masa'

	WHERE
	NoSet		=		'".$_GET['NoSet']."' ";

	if (mysqli_query($Connection, $arahan_kemaskini))
	{
		# Data Update (Successful)
		echo "<script>alert('Update Successful.');
		window.location.href='Soalan_Set.php';</script>";
	}

	else
	{
		# Data Update (Failed)
		echo "<script>alert('Update Failed.');
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
	</div>

	<!-- Set_Soalan List Section -->
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Exercises & Pop Quiz: Update Menu</b></i></h2>
	</div>

	<table width="100%" border="1" id="besar" class="w3-2021-cerulean w3-text-black w3-centered w3-margin-bottom" bordercolor='#000000'>
		<tr>
			<td class="w3-center w3-2020-navy-blazer" style="width: 20%"><i class="fa fa-book" aria-hidden="true"><b> Subject Topics</b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 20%"><i class="fa fa-envelope-open" aria-hidden="true"><b> Instructions </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 20%"><i class="fa fa-folder-open" aria-hidden="true"><b> Exercise/Quiz  </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 12%"><i class="fa fa-calendar" aria-hidden="true"><b> Due Date </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 13%"><i class="fa fa-clock-o" aria-hidden="true"><b> Time Allocated </b></i></td>
			<td class="w3-center w3-2020-navy-blazer" style="width: 15%"><i class="fa fa-cog" aria-hidden="true"><b> Operative Measures </b></i></td>
		</tr>

		<!-- Set_Soalan Baru Form -->
		<tr>
			<form action="" method="POST">
				<td><b>
					<textarea class="w3-input" name="Topik" rows="4" cols="25">
						<?PHP echo $_GET['Topik']; ?>
					</textarea>
				</b></td>
				<td><b>
					<textarea class="w3-input" name="Arahan" rows="4" cols="25">
						<?PHP echo $_GET['Arahan']; ?>
					</textarea>
				</b></td>
				<td style="vertical-align: middle;"><b>
					<div class="w3-margin">
						<select class="w3-select" name="Jenis">
							<option value disabled="<?PHP echo $_GET['Jenis']; ?>">
								<?PHP echo $_GET['Jenis']; ?>
							</option>
							<option value="EXERCISE">EXERCISE</option>
							<option value="QUIZ">QUIZ</option>
						</select>
					</div>
				</b></td>
				<td style="vertical-align: middle;"><b><input class="w3-input" type="date" name="Tarikh" 	value="<?PHP echo $_GET['Tarikh']; ?>"></b></td>
				<td style="vertical-align: middle;"><b><input class="w3-input" type="text" name="Masa"		value="<?PHP echo $_GET['Masa']; ?>"></b></td>
				<td class='w3-center' style="vertical-align: middle;"><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

		<?PHP
		# Code to select data from set_soalan
		$arahan_set = "SELECT* FROM set_soalan ORDER BY NoSet DESC";

		# Execute command
		$laksana_set = mysqli_query($Connection, $arahan_set);

		# $data collects data
		while ($data=mysqli_fetch_array($laksana_set))
		{
			# Gather data into Array $data_get
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
							<a href='Soalan_Daftar.php?NoSet=".$data['NoSet']."&Topik=".$data['Topik']."' class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> QUESTIONS SET-UP </a>

							<a href='Soalan_SetKemaskini.php?".http_build_query($data_get)."' class='w3-center w3-margin-top w3-margin-bottom w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> UPDATE CREDENTIALS </a>

							<a href='padam.php?jadual=set_soalan&medan=NoSet&kp=".$data['NoSet']."'onClick=\"return confirm('Confirmation: Continuing will completely erase the selected question set.')\" class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'> DELETE CREDENTIALS </a>
						</div>
					</b></td>
				</tr>";
		}
		?>

	</table>
</div>

<?PHP include ('Footer_Guru.php'); ?>