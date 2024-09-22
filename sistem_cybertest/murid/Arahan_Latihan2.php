<!-- Set 2: Green Shade -->

<?PHP

# Retrieve (Header.php, Connection.php) from main folder
include ('Header_Murid.php');
include ('../Connection.php');

# Check for $_GET
if (empty($_GET))
{
	# If Data not found, Kill script
	die("<script>alert('Access Denied!');
	window.location.href='Pilih_Latihan2.php';</script>");
}

# Code to select Set_Soalan based on NoSet Soalan
$arahan_pilih_set		=		"SELECT* FROM set_soalan WHERE NoSet='".$_GET['NoSet']."' ";

# Execute command
$laksana				=		mysqli_query($Connection, $arahan_pilih_set);

# $data collects data
$data 					=		mysqli_fetch_array($laksana)
?>

<div class="w3-row">

	<!-- Show Instructions to Answer Quiz -->
	<div class="w3-half w3-container w3-card-4 w3-margin-top w3-margin-bottom w3-margin-right w3-theme-gradient-3">
		<h2 class="w3-center w3-text-teal" style="text-shadow:4px 4px 0 #555"><i class="fa fa-certificate" aria-hidden="true"></i><b> Instructions For The Exercise/Quiz </b><i class="fa fa-certificate" aria-hidden="true"></i></h2>
		<h3 class="w3-text-amber"><b> <?PHP echo $data['Topik']; ?> </b></h3>
		<h3 class="w3-text-amber"><b> Give this test your best shot! </b></h3>
		<hr>
		<h3 class="w3-text-black w3-margin-bottom"><b> May the odds be forever in your favour! </b></h3>
		<h4 class="w3-text-black"><b><i> <?PHP echo $data['Arahan']; ?> </i></b><h4>
		<a class='w3-center w3-button w3-btn w3-hover-black w3-border w3-border-black w3-round-large w3-xlarge' href='Jawab_Soalan2.php?NoSet=<?PHP echo $_GET['NoSet']; ?>&Masa=<?PHP echo $data['Masa']; ?>&Jenis=<?PHP echo $data['Jenis']; ?>'><b>LET'S BEGIN</b></a>
	</div>

	<!-- Educational Video -->
	<div class="w3-rest w3-container w3-margin-top w3-margin-bottom w3-card-4 w3-center w3-theme-gradient-3">
		<h2 class="w3-center w3-text-teal" style="text-shadow:4px 4px 0 #555"><i class="fa fa-film" aria-hidden="true"></i><b> C.S. Introductions </b></h2>
		<iframe class='w3-margin' width="560" height="315" src="https://www.youtube.com/embed/Tzl0ELY_TiM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
</div>

<?PHP include ('Footer_Murid.php'); ?>