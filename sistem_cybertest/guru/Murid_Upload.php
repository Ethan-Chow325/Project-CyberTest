<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');
?>

<!-- Form to upload data file -->
<div class=" w3-row w3-margin">
	<div class="w3-card-4 w3-half w3-container w3-theme-gradient-5">
		<h2 class="w3-center w3-text-deep-orange" style="text-shadow: 4px 4px #555"><i class="fa fa-database" aria-hidden="true"></i><b> Scholar Database Import Menu </b><i class="fa fa-database" aria-hidden="true"></i></h2>
		<form action="" method="POST" action="upload.php" enctype="multipart/form-data">
			<h4 class="w3-margin-top w3-text-amber"><b>Select the database file to be imported (.csv Files Only): </b></h4>
			<b><input class='w3-large w3-margin-top w3-text-white' type="file" name="file" /required></b><br>
			<button class="w3-center w3-margin-bottom w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type="submit" name="btn-upload"><b>IMPORT DATABASE</b></button><br>
		</form>

		<!-- Data Table -->
		<table width="100%" border='1' class="w3-2020-ash w3-text-black w3-margin-bottom" bordercolor='#000000'>
			<tr>
				<td class="w3-container w3-margin">
					<div class="w3-margin-top w3-text-cyan">
						<h4><b>You are required to use the preset template to upload the database. This is for mass upload only. You can download the template (.csv) from the link below: </b></h4>
					</div>

					<a class='w3-center w3-margin-bottom w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large' href="datamurid.csv"><b> SCHOLAR DATABASE TEMPLATE </b></a>
				</td>
			</tr>
		</table>
	</div>

	<div class="w3-half w3-container">
		<div class="w3-card-4 w3-container w3-theme-gradient-5">
			<h2 class="w3-center w3-text-deep-orange" style="text-shadow: 4px 4px #555"><i class="fa fa-database" aria-hidden="true"></i><b> Database Reference Section </b><i class="fa fa-database" aria-hidden="true"></i></h2>
			<img src="../images/Contoh Template.jpg" class="w3-image w3-margin-top w3-margin-bottom w3-container" style="width: 100%">
		</div>
	</div>
</div>

<?PHP

# Check for Data
if (isset($_POST['btn-upload']))
{
	$namafailsementara=$_FILES["file"]["tmp_name"];

	# File Name
	$namafail=$_FILES['file']['name'];

	# File Type
	$jenisfail=pathinfo($namafail, PATHINFO_EXTENSION);

	# Verify File Type & File Size
	if ($_FILES['file']['size'] > 0 AND $jenisfail=='csv')
	{
		# Open file
		$failupload = fopen($namafailsementara, "r");

		# Gather data counter
		$counter=1;
		$bil_berjaya=0;
		$jum_data=0;

		# Acquire Data from the uploaded files
        while (($data = fgetcsv($failupload, 10000, ",")) !== FALSE)
        {
        	# Obtain data from every cell (From .csv File)
        	$Nama 			=		mysqli_real_escape_string($Connection, $data[0]);
        	$NoKP 			=		mysqli_real_escape_string($Connection, $data[1]);
        	$Katalaluan 	=		mysqli_real_escape_string($Connection, $data[2]);
        	$IDKelas		=		mysqli_real_escape_string($Connection, $data[3]);

        	if ($counter > 1)
        	{
        		# Code to store data (Murid)
        		$arahan_simpan = "INSERT INTO murid
        		(NamaMurid, NOKP_Murid, Katalaluan_Murid, IDKelas)

        		VALUES
        		('$Nama','$NoKP', '$Katalaluan', '$IDKelas')";

        		# Execute code to store data
        		if (mysqli_query($Connection, $arahan_simpan))
        		{
        			# Amount of Data (Successfully Stored)
        			$bil_berjaya++;
        		}
        	}

        	$jum_data++;
        	$counter++;
        }
        fclose($failupload);
	}

	else
	{
		echo "<script>alert('Invalid File Format. Only Use .csv Files.'); </script>";
	}

	# Show data counter (Successfully Uploaded)
	if ($bil_berjaya > 0)
	{
		echo "<script>alert('Data Imported Successfully. $bil_berjaya Students Was Imported.');
		window.location.href = 'Murid_Senarai.php';</script>";
	}

	else
	{
		echo "<script>alert('Data Import Failed');
		window.location.href = 'Murid_Upload.php';</script>";
	}
}

?>
<?PHP include ('Footer_Guru.php'); ?>