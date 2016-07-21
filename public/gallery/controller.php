<?PHP

session_start();

require_once("model.php");

if (isset($_GET['display']) && $_GET['display'] === 'img' && isset($_GET['img_id']))
{
	$img = get_img($_GET['img_id']);
	require_once("view_img.php");
}
else
{
	require_once("view_page.php");
}
