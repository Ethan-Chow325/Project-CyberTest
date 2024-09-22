<?PHP

# Coding file for connection.php
# Nama Host. Local Host (Default)
$Host = "localhost";

# SQL Username. Root(Default)
$Username = "root";

# SQL Password
$Password = "";

# Database Names
$Database_Name = 'sistem_cybertest';

#Connection Point between Database & System
$Connection = mysqli_connect($Host, $Username, $Password, $Database_Name);

# Connection Test
if (!$Connection)
{
	die("Connection Failed");
}

else
{
	# echo "Connection Successful";
}
?>