<?PHP

//test a faire : print_r un empty set returned by la db

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
		$query = $bdd->prepare('SELECT login FROM img JOIN user ON img.user_id WHERE img_id=:img_id LIMIT 1');
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
		$query = $bdd->prepare('SELECT text, img.user_id, date FROM img JOIN comment ON img.img_id WHERE img.img_id=:img_id');
		$query->bindParam(':img_id', $img_id);
		$query->execute();
		return ($query->fetchAll());
	} catch (PDOException $e) {
		echo 'niktarass Connection failed: ' . $e->getMessage();
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
