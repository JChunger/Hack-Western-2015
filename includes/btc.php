<?PHP
require_once("main.php");
$real_secret = '32biwegui23jb3klmas';
$secret = $_GET['secret'];
$userid = $_GET['userid'];
$btcPaid = $_GET['value'];
$transaction_hash = $_GET['transaction_hash'];


if ($secret == $real_secret) {
	$depin = $odb -> prepare("INSERT INTO `deposites` VALUES(NULL, :tid, :amount, :uid)");
    $depin ->
	
	echo "*ok*";
//} else {
//	die();
//}
} else { 
    die();
    
}
?>