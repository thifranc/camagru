<?PHP
print_r($_POST);
move_uploaded_file($_FILES['pictures']['tmp_name'], "../../private/img/camera.png");
$main_photo = imagecreatefrompng("../../private/img/camera.png");
$sub_photo = imagecreatefrompng("glasses.png");

$ret = imagecopymerge($main_photo, $sub_photo, 0, 0, 500, 500, 1000, 1000, 100);
if ($ret == false)
	echo 'failed';
else
	echo 'success';
imagepng($main_photo, "../../private/img/camera.png");
imagedestroy($main_photo);
imagedestroy($sub_photo);
