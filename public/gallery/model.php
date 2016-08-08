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

function delete_img($img_id)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('DELETE FROM img WHERE img_id=:img_id LIMIT 1');
		$query->bindParam(':img_id', $img_id);
		$query->execute();
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function get_img($img_id)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM img WHERE img_id=:img_id LIMIT 1');
		$query->bindParam(':img_id', $img_id);
		$query->execute();
		if ($query->rowCount() === 1)
			return ($query->fetch());
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function get_owner($img_id)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT login FROM img JOIN user ON img.user_id=user.user_id WHERE img_id=:img_id LIMIT 1');
		$query->bindParam(':img_id', $img_id);
		$query->execute();
		if ($query->rowCount() === 1)
			return ($query->fetch()['login']);
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function get_mail($login)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT mail FROM user WHERE login=:login LIMIT 1');
		$query->bindParam(':login', $login);
		$query->execute();
		if ($query->rowCount() === 1)
			return ($query->fetch()['mail']);
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function get_login($user_id)
{
	try {
		$bdd = connect(); // don't forget to order by date (+ recent au + vieux)
		$query = $bdd->prepare('SELECT login FROM user WHERE user_id=:user_id LIMIT 1');
		$query->bindParam(':user_id', $user_id);
		$query->execute();
		if ($query->rowCount() === 1)
			return ($query->fetch()['login']);
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function get_comm($img_id)
{
	try {
		$bdd = connect(); // don't forget to order by date (+ recent au + vieux)
		$query = $bdd->prepare('SELECT text, comment.user_id, date FROM comment JOIN user ON comment.user_id=user.user_id WHERE img_id=:img_id ORDER by date');
		$query->bindParam(':img_id', $img_id);
		$query->execute();
		return ($query->fetchAll());
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function add_comm($img_id, $text)
{
	try {
		$text = htmlentities($text);
		$bdd = connect();
		$query = $bdd->prepare('INSERT INTO comment (img_id, user_id, date, text)
			VALUES (:img_id, :user_id, NOW(), :text)');
		$query->bindParam(':img_id', $img_id);
		$query->bindParam(':user_id', $_SESSION['log_id']);
		$query->bindParam(':text', $text);
		$query->execute();
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function get_page($page_num, $elem_by_pg)
{
	try {
		$bdd = connect();
		$beg = $page_num * $elem_by_pg;
		$command = 'SELECT * FROM img LIMIT '.$beg.','.$elem_by_pg;
		$query = $bdd->prepare($command);
		$query->execute();
		return $query->fetchAll();
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function sum_img()
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT COUNT(*) as sum FROM img');
		$query->execute();
		return $query->fetch()['sum'];
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}
