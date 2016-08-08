<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Img</header>
		<div class="wrapper">
			<article>
				<a href="controller.php?cam=on">get_cam</a>
				<div id="upload">
					<form method="post" action="controller.php?cam=off" enctype="multipart/form-data">
					<input type="file" name="upload">Upload</input></br>
					<input type="submit" value="submit">
					</form>
				</div>
			</article>
			<aside>
			</aside>
		</div>
		<footer>
			<?PHP
				if (isset($_SESSION['log_id']))
				{
					echo '<form method="post" action="../home/controller.php?action=logout">';
					echo '<input type="submit" name="logout" value="Logout">';
					echo '</form>';
				}
			?>
		</footer>
	</body>
</html>
