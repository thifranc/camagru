<html>
	<head>
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header>
			<div style="text-align:left;"><a href="../home/controller.php">HOME</a></div>
			<div style="text-align:center;"><a href="../cam/controller.php">CAM</a></div>
			<div style="text-align:right;"><a href="../gallery/controller.php">GALLERY</a></div>
		</header>

		<div class="wrapper">
			<article>
				<?PHP
					if (!isset($_SESSION['log_id']))
					{
						display_register();
						display_login();
						display_forgot();
					}
					else
					{
						display_update();
						echo '<a href=../cam/controller.php>Go be a thug</a>';
					}
					if (!empty($msg))
						echo $msg;
				?>
			
			</article>
		</div>

		<footer>
			<?PHP
				if (isset($_SESSION['log_id']))
				{
					echo '<form method="post" action="controller.php?action=logout">';
					echo '<input type="submit" name="logout" value="Logout">';
					echo '</form>';
				}
			?>
		</footer>
	</body>
</html>

<?PHP

function display_register()
{
	echo ('Register
		<form method="post" action="controller.php?action=register">
			Login : <input type="text" name="login"></br>
			Password : <input type="password" name="passwd"></br>
			Mail : <input type="text" name="mail"></br>
			Info : Login: only letters or digits </br>Passowrd : at least 8 characters, one upper, one lower and one digit</br>
			<input type="submit" name="OK" value="OK">
		</form>
		');
}

function display_login()
{
	echo ('Log in
		<form method="post" action="controller.php?action=login">
			Login : <input type="text" name="log_login">
			Password : <input type="password" name="log_passwd">
			<input type="submit" name="OK" value="OK">
		</form>
		');
}

function display_forgot()
{
	echo ('Forgot your password ?
		<form method="post" action="controller.php?action=forgot">
			Login : <input type="text" name="forgot_login">
			<input type="submit" name="OK" value="OK">
		</form>
		');
}

function display_update()
{
	echo ('Change your password ?
		<form method="post" action="controller.php?action=update">
			Login : <input type="text" name="login">
			Old password : <input type="password" name="old_passwd">
			New password : <input type="password" name="new_passwd">
			<input type="submit" name="OK" value="OK">
		</form>
		');
}

?>
