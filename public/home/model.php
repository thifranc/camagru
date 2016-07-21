<?PHP

include '/nfs/2015/t/thifranc/http/MyWebSite/private/database.php';

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

function register($login, $passwd, $mail)
{
	try {
		$bdd = connect();
		$passwd = hash('whirlpool', $passwd);
		$query = $bdd->prepare('INSERT INTO user(login, passwd, mail)
			VALUES (:login, :passwd, :mail)');
		$query->bindParam(':login', $login);
		$query->bindParam(':passwd', $passwd);
		$query->bindParam(':mail', $mail);
		$query->execute();
		mail($mail, 'Confirm register', 'Click on this link to complete your registration : localhost:8080/public/home/controller.php?action=confirm&login='. $login.'&link='. substr($passwd, 0, 20) . PHP_EOL);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function login($login, $passwd)
{
	try {
		$bdd = connect();
		$passwd = hash('whirlpool', $passwd);
		$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND passwd=:passwd AND active = 1 LIMIT 1');
		$query->bindParam(':login', $login);
		$query->bindParam(':passwd', $passwd);
		$query->execute();
		if ($query->rowCount() === 1)
			return ($query->fetch()['user_id']);
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function confirm($login, $link)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM user WHERE login=:login LIMIT 1');
		$query->bindParam(':login', $login);
		$query->execute();
		$result = $query->fetch();
		if (strncmp($link, $result['passwd'], 20) == 0)
		{
			$query = $bdd->prepare('UPDATE user SET active=1 WHERE user_id=:user_id');
			$query->bindParam(':user_id', $result['user_id']);
			$query->execute();
		}
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function update($login, $old_passwd, $new_passwd)
{
	if (strlen($new_passwd) < 8)
		return FALSE;
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND passwd=:old_passwd AND active=1 LIMIT 1');
		$query->bindParam(':login', $login);
		$query->bindParam(':old_passwd', hash('whirlpool', $old_passwd));
		$query->execute();
		$result = $query->fetch();
		if ($result !== FALSE)
		{
			$query = $bdd->prepare('UPDATE user SET passwd=:new_passwd WHERE user_id=:user_id');
			$query->bindParam(':new_passwd', hash('whirlpool', $new_passwd));
			$query->bindParam(':user_id', $result['user_id']);
			$query->execute();
		}
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function forgot_passwd($login)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND active=1 LIMIT 1');
		$query->bindParam(':login', $login);
		$query->execute();
		$result = $query->fetch();
		print_r($result);
		if ($result !== FALSE)
		{
			$unique = uniqid();
			$query = $bdd->prepare('UPDATE user SET tmp_passwd=:unique WHERE user_id=:user_id');
			$query->bindParam(':unique', $unique);
			$query->bindParam(':user_id', $result['user_id']);
			$query->execute();
			mail($result['mail'], 'Reset your password', 'Hi ! Click on this link to reset your password ! : localhost:8080/public/home/controller.php?action=reset&login='.$login.'&uniq='.$unique . PHP_EOL);
		}
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function reset_passwd($login, $unique_id)
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND tmp_passwd=:unique_id AND active=1 LIMIT 1');
		$query->bindParam(':login', $login);
		$query->bindParam(':unique_id', $unique_id);
		$query->execute();
		$result = $query->fetch();
		if ($result !== FALSE)
		{
			$query = $bdd->prepare('UPDATE user SET tmp_passwd=NULL,passwd=:hash_passwd WHERE user_id=:user_id');
			$query->bindParam(':hash_passwd', hash('whirlpool', $unique_id));
			$query->bindParam(':user_id', $result['user_id']);
			$query->execute();
			mail($result['mail'], 'Your new password', 'Hi ! You have successfully reseted your password ! Your new password is now '. $unique_id . PHP_EOL);
		}
		else
			return FALSE;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}
