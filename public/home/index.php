<?PHP

require_once('model.php');

//attetioin il faut distinguer les post login et passwd selon acion : register vs login
if ($_GET['action'])
{
	if (!isset($_SESSION['log_id']))
	{
		if ($_GET['action'] === 'register' && isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['mail']))
		{
			if ()//verif passwd and mail and correctly entred
				$registered = register($_POST['login'], $_POST['passwd'], $_POST['mail']);
			else
				echo 'could not register, check your mail and passwd';
			if $register === TRUE
				echo 'A confirmation mail has been sent to you';
			else
				echo 'mail or login already used, please choose another one';
		}
		if ($_GET['action'] === 'login' && isset($_POST['login']) && isset($_POST['passwd']))
		{
			$logged = login($_POST['login'], $_POST['passwd']);
			if ($logged === FALSE)
				echo 'ERROR in login';
			else
				$_SESSION['log_id'] = $logged;
		}
		if ($_GET['action'] === 'confirm' && isset($_GET['login']) && isset($_GET['link'])) 
			confirm($_GET['login'], $_GET['link']);
		if ($_GET['action'] === 'forgot' && isset($_POST['login']))
			forgot_passwd($_POST['login']);
		if ($_GET['action'] === 'reset' && isset($_GET['login']) && isset($_GET['uniq']))
			reset_passwd($_GET['login'], $_GET['uniq']);
	}
	if ($_SESSION['log_id'])
	{
		if ($_GET['action'] === 'update' && isset($_POST['login']) && isset($_POST['old_paswd']) && isset($_POST['new_paswd']))
		{
			$updated = update($_POST['login'], $_POST['old_paswd'], $_POST['new_paswd']);
			if ($updated === FALSE)
				echo 'Error in update';
			else
				echo 'Success';
		}
	}
}

require_once('view.php');
