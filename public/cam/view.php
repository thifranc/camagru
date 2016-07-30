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
				<button id="add_glasses">Glasses</button>
				<div id="draw" style="position:relative;">
				<img id="glasses" src="glasses.png" style="position:absolute">
				<?PHP
					if ($_GET['cam'] === 'on')
						display_cam();
					else if ($_GET['cam'] === 'off')
						display_img();
				?>
				</div>
			</article>
			<aside>
			</aside>
		</div>
		<footer>footer</footer>
	</body>
</html>

<?PHP
function display_cam()
{
	echo '
				<video id="video"></video>
				<canvas id="canvas"></canvas>
				<img id="photo" class="hidden">
				<button id="startbutton">Prendre une photo</button>
				<script src="webcam.js"></script>
		';
}

function display_img()
{
	echo '
		<img src="../../private/img/tmp_img.png">
		';
}
?>
