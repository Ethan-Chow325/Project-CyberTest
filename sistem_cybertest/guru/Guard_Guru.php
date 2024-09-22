<?PHP

# Check for data in $_SESSION Variable
if (empty($_SESSION['NamaGuru']))
{
	# Kills System and Runs Index.php
	die("<script>alert('Access Denied. Invalid ID.');
		window.location.href='../Index.php';</script>");
}
?>