<?PHP

session_start();

require_once("model.php");

if (isset($_GET['display']) && $_GET['display'] === 'img' && isset($_GET['img_id']))
{
	$img = get_img($_GET['img_id']);
	$owner = get_owner($_GET['img_id']);
	$comment = get_comm($_GET['img_id']);
	require_once("view_img.php");
}
else
{
	$img_data = get_page($_GET['p'], 5);
	$sum_img = sum_img();
	//epurer img_data pour pas avoir de doublons, cf fetchAll retourne 2 index pour chaque elem
	require_once("view_page.php");
}
