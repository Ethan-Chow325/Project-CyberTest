<!-- Set 1: Blue Shade -->

<?PHP

# Retrieve Header_Guru.php
include ('Header_Guru.php');
?>

<div class=" w3-row w3-margin" id="upperbody">
	<div class="w3-card-4 w3-half w3-container w3-margin-right w3-theme-gradient-6">

		<!-- Data Analysis -->
		<div class="w3-center">
			<h2 class="w3-center w3-margin-bottom w3-text-amber" style="text-shadow: 4px 4px #444"><i class="fa fa-bar-chart" aria-hidden="true"></i><b> Scholar's Performance Evaluation </b><i class="fa fa-bar-chart" aria-hidden="true"></i></h2>
		</div>

		<!-- Form to select kelas & set_soalan -->
		<form action="" method="POST">
			
			<!-- Class List of the Current Teacher -->
			<div class="w3-margin">
				<h4 class="w3-text-amber"><i class="fa fa-empire" aria-hidden="true"><b> Scholar's Classroom </i></h4>
				<select class="w3-select w3-large" name="IDKelas">
					<option value selected disabled>SELECT</option>

					<?PHP
					if ($_SESSION['Tahap']=='ADMIN')
					{
						# If the current Teacher is ADMIN
						# Code to locate every class
						$SQL="SELECT* FROM kelas, guru

						WHERE
								kelas.NoKP_Guru		=		guru.NoKP_Guru

						ORDER BY Tingkatan, NamaKelas ASC";
					}

					else
					{
						# If the current Teacher is GURU
						# Code to locate the designated teacher's class
						$SQL="SELECT* FROM kelas, guru

						WHERE
								kelas.NoKP_Guru		=		guru.NoKP_Guru
						AND		kelas.NoKP_Guru		=		'".$_SESSION['NoKP_Guru']."'

						ORDER BY Tingkatan, NamaKelas ASC";
					}

					# Execute command
					$laksana_arahan_cari=mysqli_query($Connection, $SQL);

					# SHow data Line by Line
					while ($rekod=mysqli_fetch_array($laksana_arahan_cari))
					{
						# Show data in <option> </option>
						echo "<option value=".$rekod['IDKelas'].">
							 ".$rekod['Tingkatan']." ".$rekod['NamaKelas']."</option>";
					}
					?>
				</select>
				<br>
			</div>

			<!-- Show Set_Soalan (Entered by Teacher) -->
			<div class="w3-margin">
				<h4 class="w3-text-amber"><i class="fa fa-book" aria-hidden="true"><b> Exercise/Quiz Set </i></h4>
				<select class="w3-select w3-large" name="NoSet">
					<option value selected disabled>SELECT</option>

					<?PHP
					if ($_SESSION['Tahap']=='ADMIN')
					{
						# If Status=ADMIN
						# Code to show all Set_Soalan
						$SQL2='SELECT* FROM set_soalan, guru

						WHERE
								set_soalan.NoKP_Guru		=		guru.NoKP_Guru

						ORDER BY Topik ASC';
					}

					else
					{
						# If Status!=ADMIN
						# Code to show Set_Soalan (Created by the specified teacher only)
						$SQL2="SELECT* FROM set_soalan, guru

						WHERE
								set_soalan.NoKP_Guru		=		guru.NoKP_Guru
						AND		set_soalan.NoKP_Guru		=		'".$_SESSION['NoKP_Guru']."'

						ORDER BY Topik ASC";
					}

					# Execute command
					$laksana_arahan_cari2=mysqli_query($Connection, $SQL2);

					# SHow data Line by Line
					while ($rekod2=mysqli_fetch_array($laksana_arahan_cari2))
					{
						# Show data in <option> </option>
						echo "<option value=".$rekod2['NoSet'].">
							 ".$rekod2['Topik']."</option>";
					}
					?>
				</select>
				<br>
				<h4><b><input class="w3-margin-top w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large" type="submit" value="PUBLISH ANALYSIS"></b></h4>
			</div>
		</form>
	</div>

	<!-- Tayangan Video tentang Cara Pengajaraan Guru -->
	<div class="w3-rest w3-container w3-margin-bottom w3-card-4 w3-center w3-theme-gradient-6">
		<h2 class="w3-center w3-text-amber" style="text-shadow: 4px 4px #444"><i class="fa fa-film" aria-hidden="true"></i><b> Teaching Methods </b><i class="fa fa-film" aria-hidden="true"></i></h2>
		<iframe class='w3-margin' width="560" height="315" src="https://www.youtube.com/embed/lnQzxlxOR7Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
</div>

<div class="w3-container">
	<?PHP

	# Show List (Student, Marks, Total Score)
	# Check for $_POST (Tingkatan & Topik Latihan) submitted through the above form
	if (!empty($_POST))
	{
		# Obtain $_POST
		$IDKelas		=		$_POST['IDKelas'];
		$NoSet			=		$_POST['NoSet'];

		# Obtain NamaKelas based on the submitted IDKelas
		# Code to locate all Kelas data based on the selected IDKelas
		$arahan_kelas="SELECT* FROM kelas WHERE IDKelas='$IDKelas' ";

		# Execute command
		$laksana_kelas 		=		mysqli_query($Connection, $arahan_kelas);

		# Data1 variable obtain collected data
		$data1 				=		mysqli_fetch_array($laksana_kelas);

		# Gather combined data (Tingkatan + NamaKelas)
		$NamaKelas			=		$data1['Tingkatan'].' '.$data1['NamaKelas'];

		# Obtain Nama Topik Set_Latihan based on NoSet selected
		# Locate all data based on NoSet selected
		$arahan_topik="SELECT* FROM set_soalan WHERE NoSet='$NoSet'";

		# Execute command
		$laksana_topik 		=		mysqli_query($Connection, $arahan_topik);

		# Data1 variable obtain collected data
		$data2 				=		mysqli_fetch_array($laksana_topik);

		# Gather combined data (Tingkatan + NamaKelas)
		$NamaTopik			=		$data2['Topik'];

		# SQL Code to select students based on IDKelas selected
		$arahan_pilih="SELECT* FROM murid, kelas

		WHERE 			murid.IDKelas		=		kelas.IDKelas
		AND 			murid.IDKelas		=		'$IDKelas'

		ORDER BY 		murid.NamaMurid ASC";

		# Execute command
		$laksana_pilih		=		mysqli_query($Connection, $arahan_pilih);

		# If number of rekod >=1
		if (mysqli_num_rows($laksana_pilih)>=1)
		{
			# Show data (NamaKelas & Topik)
			echo "	<div class='w3-container w3-table'>
						<div class='w3-row w3-center w3-margin' id='buttons'>
							<div class='w3-third w3-margin w3-panel w3-2020-fired-brick'>";
								include('../Butang_Saiz.php');
					echo"	</div>

							<div class='w3-third w3-margin w3-panel w3-2020-fired-brick w3-right'>
								<br>
								<div class='w3-margin-bottom w3-center'>
									<div class='w3-xlarge w3-text-aqua' style='text-shadow: 3px 3px #555'>
										<i class='fa fa-exclamation-triangle' aria-hidden='true'><b> Color Alterations: </b></i>
									</div>

									<a href='Analisis.php' class='w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large' type='button' value='BLUE'>BLUE</a>
									<a href='Analisis2.php' class='w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large' type='button' value='GREEN'>GREEN</a>
									<a href='Analisis3.php' class='w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large' type='button' value='PURPLE'>PURPLE</a>
								</div>
							</div>
						</div>

						<div class='w3-panel w3-black'>
							<h2 align='center' class='w3-text-deep-orange' style='text-shadow: 3px 3px #555'><i class='fa fa-list' aria-hidden='true'><b> Scholar's Performance Analysis </b></i></h2>
						</div>

						<div class='w3-third w3-margin-bottom'>
							<div class='w3-container w3-panel w3-2021-rust'>
								<h4><i class='fa fa-empire' aria-hidden='true'></i><b> Classroom: $NamaKelas </b></h4>
								<h4 class='w3-margin-top w3-margin-bottom'><i class='fa fa-book' aria-hidden='true'></i><b> Subject Topic: $NamaTopik </b></h4>
								<button onclick='window.print()' class='w3-margin-bottom w3-button w3-block w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-large'>PRINT RESULTS</button>

								<h5><input class='w3-checkbox' type='checkbox' onclick='show()' id='button'><b> Hide Header </b></h5>
								<h5><input class='w3-checkbox' type='checkbox' onclick='show2()' id='button2'><b> Hide Footer </b></h5>
								<h5><input class='w3-checkbox' type='checkbox' onclick='show3()' id='button3'><b> Hide Upper Body </b></h5>
								<h5><input class='w3-checkbox' type='checkbox' onclick='show4()' id='button4'><b> Hide Buttons </b></h5>

								<script>
									function show()
									{
										var x = document.getElementById('header');
										var y = document.getElementById('button')
										if (x.style.display === 'none')
										{
										x.style.display = 'block';
										y.innerHTML = 'Hide';
										}

										else
										{
										x.style.display = 'none';
										y.innerHTML = 'Show';
										}
									}
								</script>

								<script>
									function show2()
									{
										var x2 = document.getElementById('footer');
										var y2 = document.getElementById('button2')
										if (x2.style.display ==='none')
										{
										x2.style.display = 'block';
										y2.innerHTML = 'Hide';
										}

										else
										{
										x2.style.display = 'none';
										y2.innerHTML = 'Show';
										}
									}
								</script>

								<script>
									function show3()
									{
										var x3 = document.getElementById('upperbody');
										var y3 = document.getElementById('button3')
										if (x3.style.display ==='none')
										{
										x3.style.display = 'block';
										y3.innerHTML = 'Hide';
										}

										else
										{
										x3.style.display = 'none';
										y3.innerHTML = 'Show';
										}
									}
								</script>

								<script>
									function show4()
									{
										var x4 = document.getElementById('buttons');
										var y4 = document.getElementById('button4')
										if (x4.style.display ==='none')
										{
										x4.style.display = 'block';
										y4.innerHTML = 'Hide';
										}

										else
										{
										x4.style.display = 'none';
										y4.innerHTML = 'Show';
										}
									}
								</script>
							</div>
						</div>

						<table width='100%' border='1' id='besar' class='w3-2021-cerulean w3-text-black w3-centered w3-margin-bottom' bordercolor='#000000'>
							<tr>
								<td class='w3-2020-navy-blazer'><i class='fa fa-tags' aria-hidden='true'></i><b> Scholar's Name </b></td>
								<td class='w3-2020-navy-blazer'><i class='fa fa-id-card' aria-hidden='true'></i><b> Identification Card Number </b></td>
								<td class='w3-2020-navy-blazer'><i class='fa fa-star' aria-hidden='true'></i><b> Overall Score </b></td>
								<td class='w3-2020-navy-blazer'><i class='fa fa-pie-chart' aria-hidden='true'></i><b> Percentage </b></td>
							</tr>";
							}

							else
							{
								echo "<div class='w3-quarter w3-container'>
										
									</div>


									<div class='w3-half w3-margin-bottom w3-center'>
										<div class='w3-container w3-panel w3-2019-eclipse'>
											<h3><i class='fa fa-exclamation-circle' aria-hidden='true'></i><b> This classroom does not have any data on the selected subject. </b></h3>
										</div>
									</div>

									<div class='w3-quarter w3-container'>
										
									</div>";
							}

							# Function Skor ($NoSet, $NoKP_Murid)
							function skor($NoSet, $NoKP_Murid)
							{
								# Retrieve Connection.php from main folder
								include ('../Connection.php');

								# Code to obtain data Jawapan (Murid) based on Set_Soalan & NoKP_Murid
								$arahan_skor="SELECT* FROM jawapan_murid, set_soalan, soalan

								WHERE 			
												set_soalan.NoSet			=		soalan.NoSet
								AND 			jawapan_murid.NoSoalan		=		soalan.NoSoalan
								AND 			jawapan_murid.NoKP_Murid	=		'$NoKP_Murid'
								AND 			set_soalan.NoSet			=		'$NoSet'	";

								#Execute command
								$laksana_skor		=		mysqli_query($Connection, $arahan_skor);

								# Obtain collected data
								$bil_jawapan		=		mysqli_num_rows($laksana_skor);
								$bil_betul = 0;

								# If $bil_jawapan >= 1
								if ($bil_jawapan>=1)
								{
									# Rekod variable obtain collected data
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
									$markah=$bil_betul/$bil_jawapan*100;

									# Show Total Score and Mark (%)
									echo "<td><b>".$bil_betul."/".$bil_jawapan."</b></td>
										  <td><b>".number_format($markah,0)."%</b></td>";
								}

								else
								{
									echo 	"<td> </td> 
										  	<td>N/A</td>";
								}
							}

							# Obtain collected data
							while ($data=mysqli_fetch_array($laksana_pilih))
							{
								# Show data Line By Line
								echo "<tr>
										<td>".$data['NamaMurid']."</td>
										<td>".$data['NoKP_Murid']."</td>";

										# Recall Function (Skor) with data (NoSet_Soalan & NoKP_Murid)
										skor($NoSet, $data['NoKP_Murid']);
								echo "</tr>";
							}
				echo"	</table>
					</div>";			
	}
	?>				
</div>

<?PHP 
mysqli_close($Connection); 
include('footer_guru.php');
?>