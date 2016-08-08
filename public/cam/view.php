<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Img</header>
		<div class="wrapper">
			<article style="position:relative">
				<button id="add_glasses">Glasses</button>
			<div id="display_glasses">
				<button id="down">Down</button>
				<button id="left">Left</button>
				<button id="right">right</button>
				<button id="up">up</button>
				<button id="grow">grow</button>
				<button id="reduce">reduce</button>
			</div>
				<div id="draw" style="position:relative;">
				<img id="glasses" src="glasses.png" style="position:absolute; top:0; left:0; width:80px">
				<?PHP
					if ($_GET['cam'] === 'on')
						display_cam();
					else if ($_GET['cam'] === 'off')
						display_img();
				?>
				</div>
			</article>
			<aside>
				<?PHP
					$last_img = last_img();
					foreach ($last_img as $img)
						echo '<div><img src=' . $img['link'] . '></div>';
				?>
			</aside>
		</div>
		<script src="glasses.js"></script>
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

<?PHP

function last_img()
{
	try {
		$bdd = connect();
		$query = $bdd->prepare('SELECT link FROM img ORDER BY img_id DESC LIMIT 5');
		$query->execute();
		return ($query->fetchAll());
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		return FALSE;
	}
}

function display_cam()
{
	echo '
		<video id="video">
		<canvas id="canvas"></canvas>
		</video>
		<button id="startbutton">Picture</button>
		<script src="webcam.js"></script>
		';
}

function display_img()
{
	echo '
		<img src="tmp_img.png">
		<button id="startbutton">Picture</button>
		<script src="upload.js"></script>
		';
}
?>
