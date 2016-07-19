<?PHP
//	include_once('private/setup.php');

session_start();

if (!isset($_GET['page']))
{
	include_once('public/home.php');
}
else if (isset($_GET['page']) && $_GET['page'] === 'cam')
{
	include_once('public/cam.php');
}
else if (isset($_GET['page']) && $_GET['page'] === 'gallery')
{
	include_once('public/gallery.php');
}
