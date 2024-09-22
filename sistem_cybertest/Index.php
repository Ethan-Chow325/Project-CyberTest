<?PHP

# Retrieve Header.php
include ('Header.php');
?>

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">

<!-- Login GUI -->
<div class="w3-row w3-margin w3-table">
	<div class="w3-third w3-container w3-card-4 w3-margin-right w3-margin-bottom w3-margin-top w3-theme-gradient">
		<h2 align="center" class="w3-text-amber w3-xxlarge w3-margin-bottom" style="text-shadow:4px 4px 0 #666"><i class="fa fa-info-circle" aria-hidden="true"><b> Login Credentials </b></i></h2>
		<form action="login.php" method='POST'>
			<h4><div class="w3-text-amber w3-large"><i class="fa fa-id-card-o" aria-hidden="true"><b> Identification Card Number </b></i></div></h4>	
			<b><input class="w3-input w3-text-black w3-large" 	type="text" 	id="NoKP" name="NoKP"		placeholder="040503010203"></b><br>

			<h4><div class="w3-text-amber w3-large"><i class="fa fa-key" aria-hidden="true"><b> Password </b></i></h4>
			<b><input class="w3-input w3-text-black w3-large"		type="password" 	id="Katalaluan" name="Katalaluan"></b>

			<h5><input class="w3-checkbox" type="checkbox" onclick="show()"><b> Show Password</b></h5>

			<script type="text/javascript">
		 		function show()
		 		{
		 			var checkboxes = document.getElementById('Katalaluan')
		 			
		 			if (checkboxes.type=='password')
		 			{
		 				checkboxes.type='text';	
		 			}

		 			else
		 			{
		 				checkboxes.type='password'
		 			}
		 		}
			</script>

			<div class="w3-row">
				<div class="w3-half">
					<h4><input class="w3-radio"		type="radio"		name="Jenis"	value="murid" checked><b> Scholar </b></h4>
				</div>

				<div class="w3-half">
					<h4><input class="w3-radio"		type="radio" 		name="Jenis" 	value="guru"><b> Administrators </b></h4>
				</div>
			</div>
			<h4><b><button class="w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large" type="submit"> LOGIN </button>
			</b></h4>
		</form>
  	</div>

	<!-- Class & Teachers List -->
	<div class="w3-rest w3-container w3-margin-right">
		<td align="center" width="100%">
			<div class="w3-panel w3-black">
				<h2 align="center" class="w3-text-deep-orange" style="text-shadow: 3px 3px #555"><i class="fa fa-list" aria-hidden="true"><b> Scholar's Assignments Chart </b></i></h2>
			</div>

			<table width="100%" align="center" border = "1" class="w3-2021-cerulean w3-text-black w3-hoverable" bordercolor='#000000'>
				<tr>
					<td class="w3-center w3-2020-navy-blazer"><h4 class="w3-large"><i class="fa fa-book" aria-hidden="true"><b> Assignment Topics </b></i></h4></td>
					<td class="w3-center w3-2020-navy-blazer"><h4 class="w3-large"><i class="fa fa-empire" aria-hidden="true"><b> Scholar's Classroom ID </b></i></h4></td>
					<td class="w3-center w3-2020-navy-blazer"><h4 class="w3-large"><i class="fa fa-users" aria-hidden="true"><b> Assigned Teacher </b></i></h4></td>
				</tr>

				<?PHP
				# Retrieve Connection.php
				include('Connection.php');

				# SQL Intructions to locate the Latest Questions
				$arahan_latihan="SELECT* FROM set_soalan, guru, kelas
				
				WHERE
							set_soalan.NoKP_Guru	=	guru.NoKP_Guru
				AND			kelas.NoKP_Guru			= 	guru.NoKP_Guru

				ORDER BY 	kelas.Tingkatan, kelas.NamaKelas, set_soalan.Topik ASC ";

				# Execution of the above command
				$laksana_latihan=mysqli_query($Connection, $arahan_latihan);

				# Show the Question List, Class and Teachers involved
				while ($rekod=mysqli_fetch_array($laksana_latihan)) 
				{
					echo "
					<tr>
						<td class='w3-center'><b>".$rekod['Topik']."</b></td>
						<td class='w3-center'><b>".$rekod['Tingkatan']." ".$rekod['NamaKelas']."</b></td>
						<td class='w3-center'><b>".$rekod['NamaGuru']."</b></td>
					</tr>";
				}
				mysqli_close($Connection);
				?>
			</table>
		</td>
	</div>
</div>

<?PHP
# Retrieve Footer.php
include ('Footer.php');
?>