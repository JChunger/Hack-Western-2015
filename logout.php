<?PHP
session_start();
unset($_SESSION['username']);
unset($_SESSION['ID']);
unset($_SESSION['city']);
session_destroy();
header('location: login.php');
?>