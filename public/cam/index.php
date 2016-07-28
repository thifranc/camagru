<?PHP

session_start();

function connect()
{
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=thug_cam', 'root', 'root');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return ($bdd);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		die();
	}
}

if (isset($_SESSION['log_id']))
{
	if (isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name']))
	{
		if (!file_exists("../../private/img/"))
			mkdir("../../private/img");
		try {
			$bdd = connect();
			$path = "../../private/img/" . uniqid() . ".png";
			$query = $bdd->prepare('INSERT INTO img (user_id, link) VALUES( :user_id, :link )');
			$query->bindParam(':user_id', $_SESSION['log_id']);
			$query->bindParam(':link', $path);
			$query->execute();
			move_uploaded_file($_FILES['upload']['tmp_name'], $path);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
			return FALSE;
		}
	}
	require_once("view.php");
}
else
	header ("Location: ../home/controller.php");
