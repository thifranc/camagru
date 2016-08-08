<?PHP

session_start();

require_once("model.php");

if (isset($_GET['display']) && $_GET['display'] === 'img' && isset($_GET['img_id']))
{
	if (isset($_SESSION['log_id']))
	{
		$liked = liked($_GET['img_id'], $_SESSION['log_id']);
		if ($_GET['action'] === 'like' && $liked === FALSE)
		{
			like($_GET['img_id'], $_SESSION['log_id']);
			$liked = TRUE;
		}
		else if ($_GET['action'] === 'unlike' && $liked === TRUE)
		{
			unlike($_GET['img_id'], $_SESSION['log_id']);
			$liked = FALSE;
		}
	}
	$likes = get_likes($_GET['img_id']);
	$img = get_img($_GET['img_id']);
	$owner = get_owner($_GET['img_id']);
	if (empty($img) || empty($owner))
		header ('Location: ../gallery/controller.php');
	$comment = get_comm($_GET['img_id']);
	require_once("view_img.php");
}
else if (isset($_SESSION['log_id']) && isset($_GET['action']) && isset($_GET['img_id']) && $_GET['action'] === 'add_comm' && !empty($_POST['text']))
{
	add_comm($_GET['img_id'], $_POST['text']);
	$owner = get_owner($_GET['img_id']);
	mail(get_mail($owner), 'Comment added', 'Hi ! A comment has been added on one of your photo');
	$header = 'Location: ../gallery/controller.php?display=img&img_id='.$_GET['img_id'];
	header ($header);
}
else if (isset($_SESSION['log_id']) && isset($_GET['action']) && isset($_GET['img_id']) && $_GET['action'] === 'remove')
{
	delete_img($_GET['img_id']);
	header ('Location: ../gallery/controller.php');
}
else
{
	$elem_by_pg = 5;
	$img_data = get_page($_GET['p'], $elem_by_pg);
	$sum_img = sum_img();
	$nb_page = ceil($sum_img / $elem_by_pg);
	if ($_GET['p'] > $nb_page)
		header ('Location: ../gallery/controller.php');
	require_once("view_page.php");
}
