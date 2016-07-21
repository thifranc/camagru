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

function get_img($img_id)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM img WHERE id=:id LIMIT 1');
		$query->bindParam(':id', $img_id);
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
	//do join sql table user and img
}

function get_page($page_num, $elem_by_pg)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM img LIMIT :beg, :length');
		$query->bindParam(':beg', $page_num * $elem_by_pg);
		$query->bindParam(':length', $elem_by_pg);
		$query->execute(); 					//be sure that can't return empty set
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
