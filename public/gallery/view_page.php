<html>
	<head>
		<link rel="stylesheet" type="text/css" href="view.css">
		<title>Camagru</title>
	</head>
	<body>
		<header style="text-align:center;">Gallery</header>

		<div class="wrapper">
			<article>
				<?PHP
					display_page_img($img_data);
					display_page_number($sum_img, 5);
				?>
			</article>
			<aside>aside</aside>
		</div> <!-- /wrapper -->

		<footer>footer</footer>
	</body>
</html>


<?PHP

//pour remove page : onclick : if SESSION(log_id) == imgclicked['user_id'] => then js remove 
//les img seront ds des div, avec chacune une id correspondante a img_id (donc unique) donc removable facilement en js

	function display_page_img($img_data)
	{
		//attention il faut pas de doublons, la on est parti pour en avoir cf fetchAll return
		foreach ($img_data as $img)
		{
			echo '<a href="controller.php?display=img&img_id='.$img['img_id'].'"><img src='.$img['link'].'></a>';
		}
	}

	function display_page_number($sum_img, $elem_by_pg)
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
