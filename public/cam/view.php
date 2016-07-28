<html>
	<head>
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Img</header>
		<div class="wrapper">
			<article>
		<video id="video"></video>
		<canvas id="canvas"></canvas>
		<img style="display:none;" id="photo" alt="photo">
		<button id="glasses">Glasses</button>
		<button id="smoke">Smoke</button>
		<button id="startbutton">Prendre une photo</button>
		<form method="post" action="index.php" enctype="multipart/form-data">
			<input type="file" name="upload">Choose a file to upload</input>
			<input type="submit" value="submit">
		</form>
			</article>
			<aside>aside</aside>
		</div>
		<script src="webcam.js"></script>
		<footer>footer</footer>
	</body>
</html>
