<?PHP

# Check for data in $_SESSION[NamaMurid]
if (empty($_SESSION['NamaMurid']))
{
	# If $_SESSION does not contain value.
	# Show Pop-Up and open Index.php in main folder
	die("<script>alert('Access Denied!');
		window.location.href='../Index.php';</script>");
}
?>