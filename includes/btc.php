<?PHP
require_once("main.php");
$real_secret = '32biwegui23jb3klmas';
$secret = $_GET['secret'];
$userid = $_GET['userid'];
$btcPaid = $_GET['value'];
$transaction_hash = $_GET['transaction_hash'];


if ($secret == $real_secret) {
	$depin = $odb -> prepare("INSERT INTO `deposites` VALUES(NULL, :tid, :amount, :uid, UNIX_TIMESTAMP())");
    $depin -> execute(array(":tid" => $transaction_hash, ":amount" => $btcPaid, ":uid" => $userid));
	
    $meow = $odb -> query("SELECT `balance` FROM `users` WHERE ID = $userid");
    $meow = $meow -> fetchColumn(0);
    $newb = $meow+$btcPaid;
    
    $killt = $odb -> prepare("UPDATE `users` SET `balance` = :illin WHERE ID = :id ");
    $killt -> execute(array(":illin" => $newb, ":id" => $userid));
    
	echo "*ok*";
//} else {
//	die();
//},
} else { 
    die();
    
}
?>