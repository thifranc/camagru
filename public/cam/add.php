<?PHP
print_r($_POST);
move_uploaded_file($_FILES['pictures']['tmp_name'], "../../private/img/camera.png");
$camera = imagecreatefrompng("../../private/img/camera.png");
$glasses = imagecreatefrompng("glasses.png");

imagealphablending($camera, true);
imagesavealpha($camera, true);

$ret = imagecopyresampled($camera, $glasses, $_POST['left'], $_POST['top'], 0, 0, $_POST['width'], $_POST['height'], 2000, 2000);
if ($ret == false)
	echo 'failed';
else
	echo 'success';
imagepng($camera, "../../private/img/camera.png");
imagedestroy($camera);
imagedestroy($glasses);
