<?PHP
define('DB_HOST', 'localhost');
define('DB_NAME', 'hwestern');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'S/JlTyq0iR/7IKOYZd49knY+7hs9O23gdRvZjiHOlNY');
$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
?>