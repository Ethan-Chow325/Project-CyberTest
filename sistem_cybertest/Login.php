<?PHP

# Session Start Function
session_start();

# Check data (NoKP, Katalaluan, Jenis)
if(empty($_POST['NoKP']) or empty($_POST['Katalaluan']) or empty($_POST['Jenis']))
{
	# Kill script if no data found
	die("<script>alert('Missing Credentials!');
	window.location.href='index.php';</script>");
}

# User: Murid (Set Variable)
if ($_POST['Jenis']=='murid') 
{
	$Jadual		=		"murid";
	$Medan_1	=		"NoKP_Murid";
	$Medan_2	=		"Katalaluan_Murid";
	$Medan_3	=		"NamaMurid";
	$Lokasi 	=		"murid/pilih_latihan.php";
}

# User: Guru (Set Variable)
else if($_POST['Jenis']=='guru')
{
	$Jadual		=		"guru";
	$Medan_1	=		"NoKP_Guru";
	$Medan_2	=		"Katalaluan_Guru";
	$Medan_3	=		"NamaGuru";
	$Lokasi 	=		"guru/index.php";
}

# Retrieve Connection file
include('Connection.php');

# $POST data
$NoKP 			=		mysqli_real_escape_string($Connection, $_POST['NoKP']);
$Katalaluan 	=		mysqli_real_escape_string($Connection, $_POST['Katalaluan']);

# SQL Instruction (Data Comparison)
$arahan_login	=	"SELECT* FROM $Jadual
WHERE
		$Medan_1	=	'$NoKP'
AND		$Medan_2	=	'$Katalaluan'
LIMIT 1";

# Login Code
$laksana_login 		=		mysqli_query($Connection, $arahan_login);

# If Matching Data Found
if(mysqli_num_rows($laksana_login)==1)
{
	# Login Succesful
	$Data 					=		mysqli_fetch_array($laksana_login);
	$_SESSION[$Medan_3]		=		$Data[$Medan_3];
	$_SESSION[$Medan_1]		=		$Data[$Medan_1];
	echo "<script>window.location.href='$Lokasi';</script>";
}

else
{
	# Login Failed
	echo "<script>alert('Login Failed');
	window.history.back();</script>";
}

# Close Connection (System and Database)
mysqli_close($Connection);
?>