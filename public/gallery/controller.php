<?PHP

session_start();

if (isset($_GET['display']) && $_GET['display'] === 'img')
	require_once("view_img.php");
else
	require_once("view_page.php");
