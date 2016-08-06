<?PHP
print_r($_POST);
if ($_POST['type'] === 'camera')
	$camera = imagecreatefrompng($_FILES['pictures']['tmp_name']);
else
	$camera = imagecreatefrompng('tmp_img.png');
$glasses = imagecreatefrompng("glasses.png");

imagealphablending($camera, true);
imagesavealpha($camera, true);

$ret = imagecopyresampled($camera, $glasses, $_POST['left'], $_POST['top'], 0, 0, $_POST['width'] * 1.0, $_POST['height'] * 1.8, 2000, 2000);
if ($ret == false)
	echo 'failed';
else
	echo 'success';
imagepng($camera, "../../private/img/camera.png");
imagedestroy($camera);
imagedestroy($glasses);
