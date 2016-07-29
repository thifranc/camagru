<?PHP

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

function upload_tmp($file)
{
	try {
		$bdd = connect();
		$path = uniqid() . ".png";
		$query = $bdd->prepare('INSERT INTO img (user_id, link) VALUES( :user_id, :link )');
		$query->bindParam(':user_id', $_SESSION['log_id']);
		$query->bindParam(':link', $path);
		$query->execute();
		move_uploaded_file($file['tmp_name'], $path);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}
