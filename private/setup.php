<?PHP

include 'database.php';

$bdd = new PDO('mysql:host=localhost;charset=utf8', $DB_USER, $DB_PASSWORD);

$bdd->exec('CREATE DATABASE '.$DB_DSN);
$bdd->exec('USE '.$DB_DSN);

$bdd->exec('CREATE TABLE user(
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(128) NOT NULL UNIQUE,
passwd VARCHAR(128) NOT NULL,
tmp_passwd VARCHAR(128) DEFAULT NULL,
mail VARCHAR(255) NOT NULL UNIQUE,
active BOOLEAN DEFAULT 0
)');

$bdd->exec('CREATE TABLE img(
img_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT(6) UNSIGNED NOT NULL,
link VARCHAR(255) NOT NULL
)');

$bdd->exec('CREATE TABLE likes(
img_id INT UNSIGNED NOT NULL,
user_id INT UNSIGNED NOT NULL
)');

$bdd->exec('CREATE TABLE comment(
img_id INT UNSIGNED NOT NULL,
user_id INT UNSIGNED NOT NULL,
date DATETIME NOT NULL PRIMARY KEY,
text VARCHAR(1024) NOT NULL
)');

$bdd->exec('
	ALTER TABLE comment ADD CONSTRAINT FOREIGN KEY ( img_id ) REFERENCES img ( img_id ) ON DELETE CASCADE;
	');
$bdd->exec('
	ALTER TABLE likes ADD CONSTRAINT FOREIGN KEY ( img_id ) REFERENCES img ( img_id ) ON DELETE CASCADE;
	');
$bdd->exec('
	ALTER TABLE likes ADD CONSTRAINT FOREIGN KEY ( user_id ) REFERENCES user ( user_id ) ON DELETE CASCADE;
	');
