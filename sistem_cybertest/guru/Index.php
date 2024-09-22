<?PHP

# Retrieve Header file
include ('Header_Guru.php');
?>

<div class="w3-row w3-container w3-table">

	<!-- Educational Video -->
	<div class="w3-half w3-container w3-margin w3-card-4 w3-center w3-theme-gradient">
		<div class="w3-margin">
			<h2 class="w3-center w3-text-amber" style="text-shadow: 4px 4px 0 #666"><i class="fa fa-microchip" aria-hidden="true"></i><b> FUTURE OF TECHNOLOGY </b><i class="fa fa-microchip" aria-hidden="true"></i></h2>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/5r4NzvO9Cg4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>

	<!-- Show Latest Exercise -->
	<div class="w3-rest w3-container w3-margin-bottom w3-margin-left">
		<td align="center" width="100%">
			<div class="w3-panel w3-black">
				<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Assessment List </b></i></h2>
			</div>
			<table width="100%" align="center" border="1" class="w3-2021-cerulean w3-text-black w3-hoverable" bordercolor='#000000'>
				<tr>
					<td class="w3-center w3-2020-navy-blazer"><h4 class="w3-large"><i class="fa fa-book" aria-hidden="true"><b> Examination Topics </b></i></h4></td>
					<td class="w3-center w3-2020-navy-blazer"><h4 class="w3-large"><i class="fa fa-empire" aria-hidden="true"><b> Scholar's Classroom </b></i></h4></td>
					<td class="w3-center w3-2020-navy-blazer"><h4 class="w3-large"><i class="fa fa-users" aria-hidden="true"><b> Assigned Teacher </b></i></h4></td>
				</tr>

				<?PHP

				# Find data (Guru, Kelas, Set_Soalan)
				$arahan_latihan="SELECT* FROM set_soalan, guru, kelas

				WHERE
							set_soalan.NoKP_Guru		=		guru.NoKP_Guru
				AND 		kelas.NoKP_Guru 			=		guru.NoKP_Guru

				ORDER BY    set_soalan.Tarikh ASC ";

				# Execute the above code
				$laksana_latihan=mysqli_query($Connection, $arahan_latihan);

				# Retain and Show Data
				while ($rekod=mysqli_fetch_array($laksana_latihan))
				{
					echo "
						<tr>
							<td class='w3-center'><b>".$rekod['Topik']."</b></td>
							<td class='w3-center'><b>".$rekod['Tingkatan']." ".$rekod['NamaKelas']."</b></td>
							<td class='w3-center'><b>".$rekod['NamaGuru']."</b></td>
						</tr>";
				}
				?>
			</table>
		</td>
	</div>
</div>

<?PHP include('Footer_Guru.php'); ?>