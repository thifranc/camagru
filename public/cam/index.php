<?PHP

session_start();

require_once("model.php");

if (!isset($_SESSION['log_id']))
	header ("Location: ../home/controller.php");

else if (isset($_SESSION['log_id']) && !isset($_FILES['upload']) && !isset($_GET['cam']))
{
	require_once('choose.php');
}
else
{
	if (isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name']))
	{
		$file = $_FILES['upload'];
		upload_tmp($file);
		require_once("view.php");
	}
	else
		require_once("view.php");
}
