<html>
	<head>
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Img</header>

		<div class="wrapper">
			<article>
				<?PHP display_img($img, $owner);
					display_comment($comment);
					echo 'Likes = ' . $likes;
					if (isset($_SESSION['log_id']))
					{
						insert_comm($img);
						if ($liked === TRUE)
							echo '<a href=controller.php?action=unlike&display=img&img_id='.$_GET['img_id'].'>unlike</a>';
						else
							echo '<a href=controller.php?action=like&display=img&img_id='.$_GET['img_id'].'>like</a>';
						if ($_SESSION['log_id'] === $img['user_id'])
							echo '</br><a href=controller.php?action=remove&img_id='.$img['img_id'].'>Delete this image</a>';
					}
				?>
			</article>
			<aside>aside</aside>
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

<?PHP

require_once("model.php");

function display_img($img, $owner)
{
	echo '<img src='.$img['link'].'></br>';
	echo 'owner is : ' . $owner . PHP_EOL;
	//display_like();
}

function display_comment($comment)
{
	foreach($comment as $comm)
	{
		$login = get_login($comm['user_id']);
		echo '<div class=boxed id=' . $comm['user_id'] . '|' . $comm['date'] . '>
			' . $comm['text'] . '<strong> by ' . $login . ' at ' .$comm['date']. '
			</strong></div>';
	}
}

function insert_comm($img)
{
	echo '
		<form method="post" action="controller.php?action=add_comm&img_id='.$img['img_id'].'">
		<input type="text" name=text value="Write a comment...">
		<input type="submit" id="addComm">
		</form>';

}

?>
