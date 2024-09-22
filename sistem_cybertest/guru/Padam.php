<?PHP

#Session_Start Command
session_start();

# Check for $GET Data
if (!empty($_GET))
{
	# Retrieve Connection.php from main folder
	include ('../Connection.php');

	# Obtain sent data
	$Jadual		=		$_GET['jadual'];
	$Medan		=		$_GET['medan'];
	$kp			=		$_GET['kp'];

	# Code to Erase Data from table
	$arahan_padam="DELETE FROM $Jadual WHERE $Medan='$kp'";

	# Execute command
	if (mysqli_query($Connection, $arahan_padam))
	{
		# Data Deletion Process (Successful)
		echo "<script>alert('Data Deleted Successfully.');
		window.history.back();</script>";
	}

	else
	{
		# Data Deletion Process (Failed)
		echo "<script>alert('Data Not Deleted.');
		window.history.back();</script>";
	}
}

else
{
	die("<script>alert('Access Denied!');
		window.history.back();</script>");
}
?>