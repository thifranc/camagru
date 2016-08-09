<?PHP

session_start();

function connect()
{
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=thug_cam', 'root', 'root');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return ($bdd);
	} catch (PDOException $e) {
		$error_msg = 'Connection failed: ' . $e->getMessage();
		die();
	}
}

function add_img($link)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('INSERT INTO img (user_id, link)
			VALUES (:user_id, :link)');
		$query->bindParam(':user_id', $_SESSION['log_id']);
		$query->bindParam(':link', $link);
		$query->execute();
	} catch (PDOException $e) {
		$error_msg = 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

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
$link = "../../private/img/" . uniqid() . ".png";

imagepng($camera, $link);
add_img($link);

imagedestroy($camera);
imagedestroy($glasses);
