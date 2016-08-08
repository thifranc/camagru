<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
				<a href="controller.php?cam=on">get_cam</a>
				<div id="upload">
					<form method="post" action="controller.php?cam=off" enctype="multipart/form-data">
					<input type="file" name="upload">Upload</input></br>
					<input type="submit" value="submit">
					</form>
				</div>
			</article>
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
