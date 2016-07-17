<?PHP

include 'database.php';

$bdd = new PDO('mysql:host=localhost;charset=utf8', $DB_USER, $DB_PASSWORD);

$bdd->exec('CREATE DATABASE '.$DB_DSN);
$bdd->exec('USE '.$DB_DSN);

$bdd->exec('CREATE TABLE user(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(128) NOT NULL,
passwd VARCHAR(128) NOT NULL,
mail VARCHAR(255) NOT NULL
)');
$bdd->exec('CREATE TABLE img(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) UNSIGNED NOT NULL,
link VARCHAR(255) NOT NULL,
likes INT(6)
)');
$bdd->exec('CREATE TABLE liked(
img_id INT UNSIGNED NOT NULL,
user_id INT UNSIGNED NOT NULL,
liked BOOLEAN DEFAULT 0
)');
$bdd->exec('CREATE TABLE comment(
img_id INT UNSIGNED NOT NULL,
user_id INT UNSIGNED NOT NULL,
date DATETIME NOT NULL PRIMARY KEY,
text VARCHAR(1024) NOT NULL
)');
