<!-- Set 3: Purple Shade -->

<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');

# Check for $GET Data (File must be accessed with $GET Data)
if (empty($_GET))
{
	die("<script>alert('Access Denied.');
		window.location.href='Murid_Senarai.php';</script>");
}

if (!empty($_POST))
{
	# Obtain updated data via the form created
	$Nama			=		mysqli_real_escape_string($Connection, $_POST['Nama_Baru']);
	$NoKP			=		mysqli_real_escape_string($Connection, $_POST['NoKP_Baru']);
	$Katalaluan		=		mysqli_real_escape_string($Connection, $_POST['Katalaluan_Baru']);
	$IDKelas			=		$_POST['IDKelas'];

	#Check for the collected data
	if (empty($Nama) or empty($NoKP) or empty($Katalaluan) or empty($IDKelas))
	{
		# If data not found, kill script
		die("<script>alert('Missing Credentials!');
		window.history.back();</script>");
	}

	# NoKP Murid (Data Validation Process)
	if (strlen($NoKP)!=12 or !is_numeric($NoKP))
	{
		die("<script>alert('Invalid Identification Card Number');
		window.history.back();</script>");
	}

	# Code to update Data Murid
	$arahan_kemaskini="UPDATE murid SET

	NamaMurid			=		'$Nama',
	NoKP_Murid			=		'$NoKP',
	Katalaluan_Murid	=		'$Katalaluan',
	IDKelas				=		'$IDKelas'

	WHERE
	NoKP_Murid			=		'".$_GET['NoKP_Murid']."' ";

	if (mysqli_query($Connection, $arahan_kemaskini))
	{
		# Data Update (Successful)
		echo "<script>alert('Update Successful.');
		window.location.href='Murid_Senarai3.php';</script>";
	}

	else
	{
		# Data Update (Failed)
		echo "<script>alert('Update Failed.');
		window.location.href='Murid_Senarai3.php';</script>";
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

	<!-- Student List Section -->
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Present Scholar: Update Menu </b></i></h2>
	</div>

	<table width="100%" border="1" id="besar" class="w3-2018-crocus-petal w3-text-black w3-margin-bottom" bordercolor='#000000'>>
		<tr>
			<td class="w3-center w3-2020-magenta-purple" style="width: 20% vertical-align: middle;"><i class="fa fa-tags" aria-hidden="true"><b> Scholar's Name </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 20% vertical-align: middle;"><i class="fa fa-id-card-o" aria-hidden="true"><b> Identification Card Number </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 20% vertical-align: middle;"><i class="fa fa-key" aria-hidden="true"><b> Password </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 15% vertical-align: middle;"><i class="fa fa-empire" aria-hidden="true"><b> Assigned Classroom </b></i></td>
			<td class="w3-center w3-2020-magenta-purple" style="width: 25% vertical-align: middle;"><i class="fa fa-cog" aria-hidden="true"><b> Operative Measures </b></i></td>
		</tr>
		<tr>
			<!-- Registration for New Student -->
			<form action=" " method="POST">
				<td><b><input  class="w3-input"	type="text" 		name="Nama_Baru" 	    value="<?PHP echo $_GET['NamaMurid']; ?>"></b></td>
				<td><b><input 	class="w3-input"	type="text" 		name="NoKP_Baru"		value="<?PHP echo $_GET['NoKP_Murid']; ?>"></b></td>
				<td><b><input 	class="w3-input"	type="password" 	name="Katalaluan_Baru"	value="<?PHP echo $_GET['Katalaluan_Murid']; ?>"></b></td>
				<td><b>
					<select class="w3-select" name="IDKelas">
						<option value selected disabled>SELECT</option>

						<?PHP
						# Code to locate all data from Jadual Kelas
						$SQL="SELECT* FROM kelas ORDER BY Tingkatan, NamaKelas ASC";

						# Execute code to find data
						$laksana_arahan_cari=mysqli_query($Connection, $SQL);

						# $Rekod_Bilik retrieve data line by line
						while ($rekod_bilik=mysqli_fetch_array($laksana_arahan_cari))
						{
							# Show all data collected in <option> </option>
							echo "<option value=".$rekod_bilik['IDKelas'].">
							".$rekod_bilik['Tingkatan']." ".$rekod_bilik['NamaKelas']."</option>";
						}
						?>
					</select>
				</b></td>
				<td class='w3-center'><b><input class="w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium" type="submit" value="AUTHORIZE"></b></td>
			</form>
		</tr>

		<?PHP
		
		# SQL Code (Select data from the table)
		$arahan_cari_murid="SELECT* FROM murid, kelas
		WHERE
					murid.IDKelas		=		kelas.IDKelas

		ORDER BY 	kelas.Tingkatan, kelas.NamaKelas, murid.NamaMurid ASC";

		# Execute the SQL Code
		$laksana_cari_murid=mysqli_query($Connection, $arahan_cari_murid);

		# Collect all data found
		while ($data=mysqli_fetch_array($laksana_cari_murid))
		{
			# Gather data into Array
			$data_Murid=array(
				'NamaMurid'			=>		$data['NamaMurid'],
				'NoKP_Murid'		=>		$data['NoKP_Murid'],
				'Katalaluan_Murid'	=>		$data['Katalaluan_Murid']
			);

			# Show data (Line by Line)
			echo "<tr>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['NamaMurid']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['NoKP_Murid']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['Katalaluan_Murid']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>".$data['Tingkatan']." ".$data['NamaKelas']."</b></td>
					<td class='w3-center' style='vertical-align: middle;'><b>
						<div class='w3-center'>
							<a href='Murid_Kemaskini3.php?".http_build_query($data_Murid)."' class='w3-center w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-margin-right w3-medium'><b> UPDATE CREDENTIALS </b></a>

							<a href='padam.php?jadual=murid&medan=NoKP_Murid&kp=".$data['NoKP_Murid']."'onClick=\"return confirm('Confirmation: You are about to delete all data regarding the respective scholar.')\" class='w3-center w3-margin-top w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-medium'><b> DELETE CREDENTIALS </b></a>
						</div>
					</b></td>
				</tr>";
		}
		?>
	</table>
</div>

<?PHP include ('Footer_Guru.php'); ?>