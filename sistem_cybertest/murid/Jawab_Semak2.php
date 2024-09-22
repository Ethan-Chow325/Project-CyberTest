<!-- Set 2: Green Shade -->

<?PHP

# Retrieve (Header.php, Connection.php) from main folder
include ('Header_Murid.php');
include ('../Connection.php');
?>

<?PHP
# Check for $_POST and $_GET
if (empty($_POST) and empty($_GET))
{
	# If Data not found, Kill script
	die("<script>alert('Access Denied!');
	window.location.href='Pilih_Latihan2.php';</script>");
}

# Code to obtain number of Question
$arahan_bil="SELECT* FROM soalan WHERE NoSet='".$_GET['NoSet']."'";

# Execute command
$laksana_bil=mysqli_query($Connection, $arahan_bil);

# $bil_soalan will obtain collected data
$bil_soalan=mysqli_num_rows($laksana_bil);

$betul=0;
$salah=0;
$bilangan=0;
?>

<div class='w3-row w3-center w3-margin'>

	<!-- Retrieve Butang_Saiz.php -->
	<div class='w3-third w3-margin w3-panel w3-2020-fired-brick'>
		<?PHP include('../Butang_Saiz.php'); ?>
	</div>
</div>

<!-- Quiz Results Section -->
<div class="w3-container">
	<?PHP
	echo "<div class='w3-center w3-panel w3-black'>
			<h2 class='w3-center w3-text-deep-orange w3-xxlarge' style='text-shadow: 3px 3px #555'><i class='fa fa-cogs' aria-hidden='true'></i><b> Scholar's Performance </b><i class='fa fa-cogs' aria-hidden='true'></i></h2>
		</div>";

	echo "
		<table border='1' width='100%' id='besar' class='w3-table w3-2021-green-ash w3-text-black'>
			<tr>
				<td class='w3-center w3-2020-ultramarine-green' style='width: 20%'><i class='fa fa-tags' aria-hidden='true'><b> Numbering </b></i></td>
				<td class='w3-center w3-2020-ultramarine-green' style='width: 80%'><i class='fa fa-file-text-o' aria-hidden='true'><b> Questions </b></i></td>
			</tr>";

	# Code to store Jawapan Murid
	$arahan_simpan="INSERT INTO jawapan_murid
	(NoSoalan, Jawapan, Catatan, NoKP_Murid)

	VALUES";

	# Obtain $_POST
	foreach ($_POST as $key => $value)
	{
		# Obtain NoSoalan
		$NoSoalan=ltrim($key, "s");

		# Split value of chosen Jawapan
		$pecahkanbaris = explode("|", $value);

		# Gather variables
		list($medan, $jawapan, $jawapan1, $jawapan2, $jawapan3, $jawapan4, $Soalan, $Jawapan_A, $Gambar) = $pecahkanbaris;

		# Determine whether the question contains images
		if ($Gambar!= " ")
		{
			$Gambar="<img src='".$Gambar."' class='w3-image w3-margin-top w3-margin-bottom' style='width: 20%'>";
		}

		# Check If there are unanswered question
		if ($jawapan!='tidak jawab')
		{
			$nilai_jawapan=$jawapan;
		}

		else
		{
			$nilai_jawapan='Not Answered';
		}

		# Calculate Correct and Wrong Answers
		switch($medan)
		{
			case 'Jawapan_A'	:		$betul++;break;
			case 'Jawapan_B'	:		$salah++;break;
			case 'Jawapan_C'	:		$salah++;break;
			case 'Jawapan_D'	:		$salah++;break;
			default 			:		$salah++;break;
		}

		# Gather color
		if ($jawapan==$Jawapan_A)
		{
			# If correct (BG Color = Green)
			$warna="bgcolor='green'";
			$catatan="CORRECT";
		}

		else if ($jawapan=='tidak jawab')
		{
			# Question Not Answered (BGColor = Yellow)
			$warna="bgcolor='yellow'";
			$catatan="INCORRECT";
			$medan='Tidak Jawab';
		}

		else
		{
			# Question Answered Incorrectly (BGColor = Red)
			$warna="bgcolor='red'";
			$catatan="INCORRECT";
		}

		# Show (Soalan, Jawapan_Murid, Jawapan_Sebenar)
		echo "<tr class='w3-2021-green-ash w3-text-black'>
		<td><b>"."Question No.", " ",++$bilangan."</b></td>
		<td><b>".$Soalan."<br>$Gambar
		<br>";
		for($k=1; $k<=4; $k++)
		{
			$jawapan_jawapan="jawapan".$k;
			if ($jawapan==$$jawapan_jawapan)
			{
				$tanda="checked='checked'";
			}
			
			else
			{
				$tanda="";
			}

			echo "<input type='checkbox' name='$NoSoalan' disabled='disabled' $tanda>
			<label>".$$jawapan_jawapan."</label><br>";
		}

		echo "</b></td>
			</tr>
			<tr>
				<td colspan='2' align='right' $warna><b>Scholar's Answer: </b> <b><i>$nilai_jawapan</i></b>  |  <b>Answer Sheet: </b> <b><i>$Jawapan_A</i></b></td>
			</tr>";

		# Code to store Jawapan_Pelajar
		$arahan_simpan=$arahan_simpan."('$NoSoalan', '$medan', '$catatan','".$_SESSION['NoKP_Murid']."'),";
	}

	# Delete symbol , at the end (Code to store Jawapan_Pelajar)
	$arahan_simpan=rtrim($arahan_simpan,",");

	# Execute command
	if (mysqli_query($Connection, $arahan_simpan))
	{
		# Data Storage (Successful). Show Pop-Up
		echo "<script>alert('Data have been collected.');</script>";
	}

	else
	{
		# Data Storage (Failed). Show Pop-Up
		echo "<script>alert('Data was not collected.');
		window.history.back();
		</script>";
	}

	# Show Total Score & Total Mark
	echo "<div class='w3-third w3-margin-bottom'>
			<div class='w3-container w3-panel w3-2021-rust'>
				<h3>Overall Score: $betul/$bil_soalan </h3>";
				$peratus=($betul/$bil_soalan)*100;
				echo "<h3 class='w3-margin-top w3-margin-bottom'>Percentage: ".number_format($peratus, 2)." %</h3>
			</div>
		</div>";
	?>
</div>