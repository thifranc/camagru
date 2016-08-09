<?PHP

require_once("model.php");
session_start();

if (!isset($_SESSION['log_id']))
	header ("Location: ../home/controller.php");
else if (isset($_SESSION['log_id']) && !isset($_GET['cam']))
{
	require_once('choose.php');
}
else
{
	if (isset($_GET['cam']) && $_GET['cam'] === 'off' && empty($_FILES['upload']['name']))
			return (require_once('choose.php'));
	if (isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name']))
	{
		if(@imagecreatefrompng($_FILES['upload']['tmp_name']) === FALSE)
			return (require_once('choose.php'));
		$filename = $_FILES['upload']['tmp_name'];
		list($width, $height) = getimagesize($filename);
		$thumb = imagecreatetruecolor(300, 150);
		$source = imagecreatefrompng($filename);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, 300, 150, $width, $height);
		imagepng($thumb, 'tmp_img.png');
		imagedestroy($thumb);
	}
	require_once("view.php");
}
