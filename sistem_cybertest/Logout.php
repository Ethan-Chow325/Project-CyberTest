<?PHP

# session_start Command
session_start();

# Delete session variables data
session_unset();

# End session
session_destroy();

# Open Index.php
echo "<script>window.location.href='Index.php';</script>";
?>