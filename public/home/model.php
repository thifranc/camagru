<?PHP

function register($login, $passwd, $mail)
{
	$passwd = hash('whirpool', $passwd);
	$query = $bdd->prepare('INSERT INTO user(login, passwd, mail)
							VALUES (:login, :passwd, :mail)');
	$query->bindParam(':login', $login);
	$query->bindParam(':passwd', $passwd);
	$query->bindParam(':mail', $mail);
	$query->execute();
}

function login($login, $passwd)
{
	$passwd = hash('whirpool', $passwd);
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login AND passwd=:passwd AND active = 1 LIMIT 1');
	$query->bindParam(':login', $login);
	$query->bindParam(':passwd', $passwd);
	$query->execute();
	if ($query->rowCount() === 1)
		return ($query->fetch()['id']);
	else
		return FALSE;
}

function confirm($login, $passwd_cutted)
{
	$query = $bdd->prepare('SELECT * FROM user WHERE login=:login LIMIT 1');
	$query->bindParam(':login', $login);
	$query->execute();
	$result = $query->fetch();
	if (strncmp($passwd_cutted, $result['passwd'], 20) == 0)

}
