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
	$bdd = connect();
	$passwd = hash('whirlpool', $passwd);
	$query = $bdd->prepare('INSERT INTO user(login, passwd, mail)
		VALUES (:login, :passwd, :mail)');
	$query->bindParam(':login', $login);
	$query->bindParam(':passwd', $passwd);
	$query->bindParam(':mail', $mail);
	$query->execute();
	mail($mail, 'Confirm register', 'Click on this link to complete your registration : localhost:8080/public/home/index.php?action=confirm&login='. $login.'&link='. substr($passwd, 0, 20) . PHP_EOL);
}

function login($login, $passwd)
{
	$passwd = hash('whirlpool', $passwd);
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND passwd=:passwd AND active = 1 LIMIT 1');
	$query->bindParam(':login', $login);
	$query->bindParam(':passwd', $passwd);
	$query->execute();
	if ($query->rowCount() === 1)
		return ($query->fetch()['id']);
	else
		return FALSE;
}

function confirm($login, $link)
{
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login LIMIT 1');
	$query->bindParam(':login', $login);
	$query->execute();
	$result = $query->fetch();
	if (strncmp($link, $result['passwd'], 20) == 0)
	{
		$query = $bdd->prepare('UPDATE user SET active=1 WHERE id=:id');
		$query->bindParam(':id', $result['id']);
		$query->execute();
	}
	else
		return FALSE;
}

function update($login, $old_passwd, $new_passwd)
{
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND passwd=:old_passwd LIMIT 1');
	$query->bindParam(':login', $login);
	$query->bindParam(':passwd', $old_passwd);
	$query->execute();
	$result = $query->fetch();
	if ($result !== FALSE)
	{
		$query = $bdd->prepare('UPDATE user SET passwd=:new_passwd WHERE id=:id');
		$query->bindParam(':new_passwd', $new_passwd);
		$query->bindParam(':id', $result['id']);
		$query->execute();
	}
	else
		return FALSE;
}

function forgot_passwd($login)
{
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login LIMIT 1');
	$query->bindParam(':login', $login);
	$query->execute();
	$result = $query->fetch();
	if ($result !== FALSE)
	{
		$query = $bdd->prepare('UPDATE user SET passwd=:unique WHERE id=:id');
		$unique = uniqid();
		$query->bindParam(':passwd', $unique);
		$query->bindParam(':id', $result['id']);
		mail($result['mail'], 'Reset your password', 'Hi ! Click on this link to reset your password ! : localhost:8080/public/home/index.php?action=reset&login='.$result['login'].'&uniq='.$unique . PHP_EOL);
	}
	else
		return FALSE;
}

function reset_passwd($login, $unique_id)
{
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND passwd=:unique_id LIMIT 1');
	$query->bindParam(':login', $login);
	$query->bindParam(':unique_id', $unique_id);
	$query->execute();
	$result = $query->fetch();
	if ($result !== FALSE)
	{
		$query = $bdd->prepare('UPDATE user SET passwd=:unique_id WHERE id=:id');
		$query->bindParam(':unique_id', $unique_id);
		$query->bindParam(':id', $result['id']);
		$query->execute();
		mail($result['mail'], 'Your new password', 'Hi ! You have successfully reseted your password ! Your new password is now '. $unique_id . PHP_EOL);
	}
	else
		return FALSE;
}
