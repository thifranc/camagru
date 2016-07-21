<?PHP
session_start();
if (isset($_SESSION['log_id']))
	echo ('take a pic');
else
	echo ('ERROR, not logged');
