<?PHP
if (isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE)
	echo ('take a pic');
else
	echo ('ERROR, not logged');
