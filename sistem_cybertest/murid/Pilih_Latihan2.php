<!-- Set 2: Green Shade -->

<?PHP

# Retrieve (Header.php, Guard_Murid.php, Connection.php)
include ('Header_Murid.php');
include ('Guard_Murid.php');
include ('../Connection.php');
?>

<?PHP 

# Function (Calculate Score) based on (NoSet Soalan)
function skor($NoSet, $bil_soalan)
{
	# Retrieve Connection.php from main folder
	include ('../Connection.php');

	# Code to obtain data from (Jawapan_Murid)
	$arahan_skor="SELECT* FROM set_soalan, soalan, jawapan_murid

	WHERE 
			set_soalan.NoSet 				=		soalan.NoSet
	AND		soalan.NoSoalan					=		jawapan_murid.NoSoalan
	AND		set_soalan.NoSet 				=		'$NoSet'
	AND		jawapan_murid.NoKP_Murid		=		'".$_SESSION['NoKP_Murid']."'

	ORDER BY Topik, Jenis ASC";

	# Execute Command
	$laksana_skor=mysqli_query($Connection, $arahan_skor);

	# Calculate Number of Answers
	$bil_jawapan=mysqli_num_rows($laksana_skor);
	$bil_betul=0;

	# $rekod obtain collected data
	while ($rekod=mysqli_fetch_array($laksana_skor))
	{
		# Calculate number of Correct Answers
		switch ($rekod['Catatan'])
		{
			case 'CORRECT'	:	$bil_betul++; break;
			default 		:	break;
		}
	}
	# Calculate Mark based on Correct Answers
	$peratus=($bil_betul/$bil_soalan)*100;

	# Show score and marks(%)
	echo" <td class='w3-center' style='vertical-align: middle;'><b> $bil_betul/$bil_soalan </b></td>
		  <td class='w3-center' style='vertical-align: middle;'><b>".number_format($peratus, 0)."%</b></td>";

  	$kumpul=$bil_betul."|".$bil_soalan."|".$peratus."|".$bil_jawapan;

  	# Return data ($bil_betul, $bil_soalan, $peratus, $bil_jawapan)
  	return $kumpul;
}
?>

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

			<a href="pilih_latihan.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='BLUE'>BLUE</a>
			<a href="pilih_latihan2.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='GREEN'>GREEN</a>
			<a href="pilih_latihan3.php" class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large" type='button' value='PURPLE'>PURPLE</a>
		</div>
	</div>
</div>

<!-- Title -->
<div class="w3-row w3-margin">
	<div class="w3-panel w3-black">
		<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Exercises & Final Evaluation </b></i></h2>
	</div>
</div>

<!-- Show data (Set_Soalan) -->
<div class="w3-row w3-margin">
	<div class="w3-container w3-margin-bottom w3-table">
		<td align="center" width="100%">
			<div class="w3-responsive">
				<table width="100%" align="center" border="1" id="besar"  class="w3-2021-green-ash w3-text-black" bordercolor='#000000'>
					<tr>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-tags" aria-hidden="true"><b> Numbering </b></i></td>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-book" aria-hidden="true"><b> Subject Topics </b></i></td>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-folder-open" aria-hidden="true"><b> Exercise/Quiz </b></i></td>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-calculator" aria-hidden="true"><b> Question Count </b></i></td>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-star" aria-hidden="true"><b> Overall Score </b></i></td>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-pie-chart" aria-hidden="true"><b> Percentage </b></i></td>
						<td class="w3-center w3-2020-ultramarine-green"><i class="fa fa-bullhorn" aria-hidden="true"><b> Operative Measures </b></i></td>
					</tr>

					<?PHP
					# Code to obtain Maklumat_Murid based on $_SESSION['NoKP_Murid']
					$arahan_cari="SELECT* FROM murid

					WHERE
							NoKP_Murid		=		'".$_SESSION['NoKP_Murid']."' ";

					# Execute command
					$laksana_cari=mysqli_query($Connection, $arahan_cari);

					# Obtain collected data
					$data_murid=mysqli_fetch_array($laksana_cari);

					# Code to locate data set_soalan
					$arahan_pilih_latihan="SELECT set_soalan.NoSet,
					COUNT(soalan.NoSoalan) AS bil_soalan, Topik, Jenis

					FROM set_soalan, soalan, guru, kelas 

					WHERE
								set_soalan.NoSet		=		soalan.NoSet
					AND			set_soalan.NoKP_Guru	=		guru.NoKP_Guru
					AND			kelas.NoKP_Guru			=		guru.NoKP_Guru
					AND			kelas.IDKelas			=		'".$data_murid['IDKelas']."'
					
					GROUP BY 	Topik";

					# Execute command
					$laksana=mysqli_query($Connection, $arahan_pilih_latihan);
					$i=0;

					# $data collects data
					while ($data=mysqli_fetch_array($laksana))
					{
						# Show collected data
						echo "<tr>
								<td class='w3-center' style='vertical-align: middle;'><b>".'No.',' ',++$i."</b></td>
								<td class='w3-center' align='center' style='vertical-align: middle;'><b>".$data['Topik']."</b></td>
								<td class='w3-center' align='center' style='vertical-align: middle;'><b>".$data['Jenis']."</b></td>
								<td class='w3-center' align='center' style='vertical-align: middle;'><b>".$data['bil_soalan'],' ','Questions'."</b></td> ";

								# Recall function(Skor)
								$kumpul=skor($data['NoSet'], $data['bil_soalan']);

								# Receive and Split (recalled data)
								$pecahkanbaris = explode("|", $kumpul);

								# Gather variables
								list($bil_betul, $bil_soalan, $peratus, $bil_jawapan) = $pecahkanbaris;

								# Calculate collected answers
								if ($bil_jawapan<=0)
								{
									# If $bil_jawapan <=0, students have not answered
									echo "<td><b><a class='w3-center w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-bar' href='Arahan_Latihan2.php?NoSet=".$data['NoSet']."'>BEGIN EXERCISE/QUIZ</a></b></td>";
								}

								else
								{
									# If Not, Students can only revise their answers
									echo "<td><b><a class='w3-center w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-bar' href='Ulangkaji.php?NoSet=".$data['NoSet']."&Topik=".$data['Topik']."&kumpul=".$kumpul."'>REVISE EXERCISE/QUIZ</a></b></td>";
								}
						echo "</tr>";
					}
					?>
				</table>
			</div>
		</td>
	</div>
</div>

<?PHP
# Retrieve Footer.php
include ('Footer_Murid.php');
?>