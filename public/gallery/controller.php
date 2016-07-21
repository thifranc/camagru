<?PHP

session_start();

if (isset($_GET['display']) && $_GET['display'] === 'img' && isset($_GET['id']))
{
	require_once("view_img.php");
}
else
{
	require_once("view_page.php");
}
