<?PHP

//si retour de fetchAll vides -> test avec empty function

session_start();

require_once("model.php");

if (isset($_GET['display']) && $_GET['display'] === 'img' && isset($_GET['img_id']))
{
	$img = get_img($_GET['img_id']);
	$owner = get_owner($_GET['img_id']);
	$comment = get_comm($_GET['img_id']);
	require_once("view_img.php");
}
else if (isset($_SESSION['log_id']) && isset($_GET['action']) && isset($_GET['img_id']) && $_GET['action'] === 'add_comm' && !empty($_POST['text']))
{
	add_comm($_GET['img_id'], $_POST['text']);
	$header = 'Location: ../gallery/controller.php?display=img&img_id='.$_GET['img_id'];
	header ($header);
}
else
{
	$img_data = get_page($_GET['p'], 5);
	$sum_img = sum_img();
	require_once("view_page.php");
}
