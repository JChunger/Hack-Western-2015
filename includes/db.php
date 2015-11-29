<?PHP
define('DB_HOST', 'localhost');
define('DB_NAME', 'hwestern');
define('DB_USERNAME', 'root');
$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME);
?>
