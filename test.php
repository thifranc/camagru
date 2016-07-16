<?PHP
	
$bdd = new PDO('mysql:host=localhost;dbname=db_test;charset=utf8', 'thifranc', '7[Xa=t}h');
$bdd->exec('CREATE TABLE user (
id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(8) NOT NULL,
passwd VARCHAR(8) NOT NULL,
mail VARCHAR(30) NOT NULL)');
