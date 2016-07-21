<?PHP

session_start();

if (isset($_SESSION['log_id']))
{
//	$_SESSION = array();
}

require_once('model.php');

//pour communiquer les retours de fonctions a la view, set des $var > return error, puis view les interpretera

if (isset($_GET['action']))
{
	print_r($_POST);
	if (!isset($_SESSION['log_id']))
	{
		if ($_GET['action'] === 'register'
			&& isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['mail']))
		{
			if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && strlen($_POST['passwd']) >= 8)
			{
				$registered = register($_POST['login'], $_POST['passwd'], $_POST['mail']);
				if ($registered === FALSE)
					echo 'mail or login already used, please choose another one';
				else
					echo 'A confirmation mail has been sent to you';
			}
			else
				echo 'could not register, check your mail and passwd';
		}

		if ($_GET['action'] === 'login'
			&& isset($_POST['log_login']) && isset($_POST['log_passwd']))
		{
			$logged = login($_POST['log_login'], $_POST['log_passwd']);
			if ($logged === FALSE)
				echo 'ERROR in login';
			else
				$_SESSION['log_id'] = $logged;
		}

		if ($_GET['action'] === 'confirm'
			&& isset($_GET['login']) && isset($_GET['link'])) 
		{
			$confirmed = confirm($_GET['login'], $_GET['link']);
			if ($confirmed === FALSE)
				echo 'The confirmation failed';
			else
				echo 'You created your account and confirmed it ! Congratulations !';
		}

		if ($_GET['action'] === 'forgot'
			&& isset($_POST['forgot_login']))
		{
			$forgot = forgot_passwd($_POST['forgot_login']);
			if ($forgot === FALSE)
				echo 'The login is not correct';
			else
				echo 'An email has been sent to you to reset your password';
		}

		if ($_GET['action'] === 'reset'
			&& isset($_GET['login']) && isset($_GET['uniq']))
		{
			$reset = reset_passwd($_GET['login'], $_GET['uniq']);
			if ($reset === FALSE)
				echo 'The password could not be reseted';
			else
				echo 'An email with your new password has been sent';
		}
	}
	else
	{
		print_r($_GET);
		print_r($_POST);
		if ($_GET['action'] === 'update' && isset($_POST['login']) && isset($_POST['old_passwd']) && isset($_POST['new_passwd']))
		{
			$updated = update($_POST['login'], $_POST['old_passwd'], $_POST['new_passwd']);
			if ($updated === FALSE)
				echo 'Password could not be changed';
			else
				echo 'Password changed with succes !';
		}
	}
}

require_once('view.php');
