<!-- Set 1: Blue Shade -->

<?PHP

# Retrieve (Header.php, Connection.php) from main folder
include ('Header_Murid.php');
include ('../Connection.php');

# Check for $_GET
if (empty($_GET))
{
	# If Data not found, Kill script
	die("<script>alert('Access Denied!');
	window.location.href='Pilih_Latihan.php';</script>");
}
?>

<div class="w3-row w3-center w3-margin">

	<!-- Retrieve Butang_Saiz.php -->
	<div class="w3-third w3-margin w3-panel w3-2020-fired-brick">
		<?PHP include('../Butang_Saiz.php'); ?>
	</div>

	<!-- Timer  -->
	<div class="w3-third w3-margin w3-panel w3-2020-fired-brick w3-right">
		<br>
		<div class="w3-margin-bottom w3-center">
			<div class="w3-xlarge w3-text-aqua" style="text-shadow: 3px 3px #555">
				<i class="fa fa-clock-o" aria-hidden="true"><b> QUIZ ENDS IN: </b></i>
			</div>

			<!-- Check $_GET [Jenis]==Kuiz -->
			<?PHP 
			if ($_GET ['Jenis']=="QUIZ")
			{
				# Retrieve Timer2.php
				include ('Timer2.php');

				# Timer Kuiz Function
				timer_kuiz($_GET['Masa']);
			}
			?>
		</div>
	</div>
</div>

<!-- Show Test Questions -->
<div class="w3-table w3-container">
	<div class="w3-center w3-panel w3-black">
		<h3 class="w3-center w3-text-deep-orange w3-xxlarge"  style="text-shadow: 3.5px 3.5px #555"><i class="fa fa-cogs" aria-hidden="true"></i><b> QUESTION & ANSWER SHEET </b><i class="fa fa-cogs" aria-hidden="true"></i></h3>
	</div>

	<form name="Soalan_Kuiz" action="Jawab_Semak.php?NoSet=<?PHP echo $_GET['NoSet']; ?>" method='POST'>
		<table border="1" width="100%" id="besar" class="w3-2021-cerulean w3-text-black" bordercolor='#000000'>
			<tr>
				<td class="w3-center w3-2020-navy-blazer" style="width: 10%"><i class="fa fa-tags" aria-hidden="true"><b> Numbering </b></i></td>
				<td class="w3-center w3-2020-navy-blazer" style="width: 80%"><i class="fa fa-file-text-o" aria-hidden="true"><b> Questions </b></i></td>
			</tr>

			<?PHP

			# Select Soalan based on NoSet and arranged randomly
			$arahan_pilih_soalan= "SELECT* FROM soalan WHERE NoSet='".$_GET['NoSet']."'
			ORDER BY rand()";

			# Execute code
			$laksana=mysqli_query($Connection, $arahan_pilih_soalan);
			$i=0;

			# $data collects data
			while ($data=mysqli_fetch_array($laksana))
			{
				# Show Question & Answer
				echo "<tr>
						<td style='vertical-align: middle;' class='w3-center'><b>".'No.',' ',++$i."</b></td>
						<td>";

				# Gather Field Name into Array
				$a = array('Jawapan_A', 'Jawapan_B', 'Jawapan_C', 'Jawapan_D');

				# Answer Arrangement is randomized
				shuffle($a);
				$xjawab='Tidak Jawab';

				# If Question contains Image, Gather image name
				if ($data['Gambar']!=" ")
				{
					$Gambar=$data['Gambar'];
				}

				else
				{
					$Gambar=" ";
				}

				?>

				<!-- Show Answers that has already been randomized -->
				<div class='w3-margin-left'><b>
					<?PHP echo $soalan=str_replace("'", " ", $data['Soalan']); ?>
				</b></div>

				<?PHP

				# Enter the values carefully
				# Medan, Jawapan, Jawapan1, Jawapan2, Jawapan3, Jawapan4, Soalan, Nilai Jawapan_A, Gambar
				echo "
					<img src='$Gambar' class='w3-image w3-margin' style='width: 20%'>
					<br>
					<input class='w3-radio w3-margin-left' type = 'radio' name = 's".$data['NoSoalan']."' value='".$a[0]."|".$data[$a[0]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['Jawapan_A']."|".$Gambar."'> <label>".$data[$a[0]]."</label><br>

					<input class='w3-radio w3-margin-left' type = 'radio' name = 's".$data['NoSoalan']."' value='".$a[1]."|".$data[$a[1]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['Jawapan_A']."|".$Gambar."'> <label>".$data[$a[1]]."</label><br>

					<input class='w3-radio w3-margin-left' type = 'radio' name = 's".$data['NoSoalan']."' value='".$a[2]."|".$data[$a[2]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['Jawapan_A']."|".$Gambar."'> <label>".$data[$a[2]]."</label><br>

					<input class='w3-radio w3-margin-left' type = 'radio' name = 's".$data['NoSoalan']."' value='".$a[3]."|".$data[$a[3]]."|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['Jawapan_A']."|".$Gambar."'> <label>".$data[$a[3]]."</label><br>

					<input class='w3-radio w3-margin-left' type = 'radio' name = 's".$data['NoSoalan']."' value='tidak jawab|tidak jawab|".$data[$a[0]]."|".$data[$a[1]]."|".$data[$a[2]]."|".$data[$a[3]]."|".$soalan."|".$data['Jawapan_A']."|".$Gambar."' checked style='visibility: hidden'>";

				echo "</td>
				</tr>";
			}
			?>
		</table>
		<br>
		<input class="w3-margin-bottom w3-button w3-white w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-xlarge" type="submit" value="CHECK ANSWERS">
	</form>
</div>

<?PHP include ('Footer_Murid.php'); ?>