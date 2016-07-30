<?PHP

session_start();

require_once("model.php");

if (!isset($_SESSION['log_id']))
	header ("Location: ../home/controller.php");
else if (isset($_SESSION['log_id']) && !isset($_GET['cam']))
{
	require_once('choose.php');
}
else
{
	if (isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name']))
	{
		//reduce or strech before moving or after
		move_uploaded_file($_FILES['upload']['tmp_name'], "../../private/img/tmp_img.png");
	}
	require_once("view.php");
}
