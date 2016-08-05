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
<script>
   var glasses      = document.getElementById('glasses');
   var add_glasses  = document.getElementById('add_glasses');

  add_glasses.addEventListener('click', function(ev){
	var hidden=glasses.className;
	console.log(hidden);
	if (!hidden)
		glasses.className='hidden';
	else
		glasses.className='';
  }, false);
</script>
		<footer>footer</footer>
	</body>
</html>

<?PHP
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
		<img src="../../private/img/tmp_img.png">
		';
}
?>
