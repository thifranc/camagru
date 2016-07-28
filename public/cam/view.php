<html>
	<head>
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Img</header>
		<div class="wrapper">
			<article>
				<div id="webcam">
					<video id="video"></video>
					<canvas id="canvas"></canvas>
					<img id="glasses" src="glasses.png">
					<img id="photo" class="hidden">
					<button id="add_glasses">Glasses</button>
					<button id="startbutton">Prendre une photo</button>
				</div>
				<div id="upload">
					<form method="post" action="index.php" enctype="multipart/form-data">
					<input type="file" name="upload">Upload</input></br>
					<input type="submit" value="submit">
					</form>
				</div>
			</article>
			<aside>
			</aside>
		</div>
		<script src="webcam.js"></script>
		<footer>footer</footer>
	</body>
</html>
