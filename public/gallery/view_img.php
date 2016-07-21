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
					
				?>
			</article>
			<aside>aside</aside>
		</div>

		<footer>footer</footer>
	</body>
</html>

<?PHP
	function display_page_number($sum_img, $elem_by_pg)
	{
		$nb_page = ceil($sum_img / $elem_by_pg);
		$i = 0;
		while ($i < $nb_page)
		{
			echo '<a href="controller.php?display=page&p="'.$i.'> '.$i. ' </a>';
			$i++;
		}
	}
?>
