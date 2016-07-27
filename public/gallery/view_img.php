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
					echo 'owner is : ' . $owner . PHP_EOL;
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

require_once("model.php");

function display_comment($comment)
{
	foreach($comment as $comm)
	{
		$login = get_login($comm['user_id']);
		echo '<div class=boxed id=' . $comm['user_id'] . '|' . $comm['date'] . '>
			' . $comm['text'] . '<strong> by ' . $login . '
			</strong></div>';
	}
	//see comment in view_page.php on removing img
}

?>
