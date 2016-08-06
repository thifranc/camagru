<?PHP


//click thug_me => if cam :
//						envoie canvas (+- = photo + pos lunettes)
//				   else	  :
//				   		envoie photo (tmp_img.png ou prise en canvas ? + pos lunettes)
//
//	ensuite en php on s'occupe de merger les deux photos :
//	donc attention a bien passer laphoto prise en canvas - cf blob ?
//



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
