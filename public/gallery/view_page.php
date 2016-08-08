<html>
	<head>
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
				<div>
				<?PHP
					display_page_img($img_data);
				?>
				</div>
				<div style="text-align:right;">
				<?PHP
					display_page_number($sum_img, $elem_by_pg, $nb_page);
				?>
				</div>
			</article>
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

<?PHP

	function display_page_img($img_data)
	{
		foreach ($img_data as $img)
		{
			echo '<a href="controller.php?display=img&img_id='.$img['img_id'].'"><img src='. $img['link'] .'></a>';
		}
	}

	function display_page_number($sum_img, $elem_by_pg, $nb_page)
	{
		$nb_page = ceil($sum_img / $elem_by_pg);
		$i = 0;
		while ($i < $nb_page)
		{
			echo '<a href="controller.php?display=page&p='.$i.'"> '.$i. ' </a>';
			$i++;
		}
	}

?>
