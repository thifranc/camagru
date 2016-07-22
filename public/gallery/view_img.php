<html>
	<head>
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Img</header>

		<div class="wrapper">
			<article>
				<?PHP
					echo '<img src='.$img['link'].'>';
					echo 'owner is' . $owner . PHP_EOL;
					//display_like();
					display_comment($comment);
				?>
			</article>
			<aside>aside</aside>
		</div>

		<footer>footer</footer>
	</body>
</html>

<?PHP

function display_comment($comment)
{
	//see comment in view_page.php on removing img
}

?>
