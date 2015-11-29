<?PHP
define('DB_HOST', 'localhost');
define('DB_NAME', 'hwestern');
define('DB_USERNAME', 'root');
//define('DB_PASSWORD', 'NOT PASSWORD');
$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
?>