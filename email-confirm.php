<?php
	require_once 'includes/db.php';
	
	$key = htmlspecialchars($_GET["key"]);
	$email = htmlspecialchars($_GET["email"]);
	$uid = htmlspecialchars($_GET["uid"]);

	$resultQuery = $odb -> prepare("SELECT `key1` FROM `users` WHERE ID = :id");
	$resultQuery -> execute(array(':id' => $uid));
    $keyDB = $resultQuery -> fetchColumn(0);

	if($keyDB != $key){
		echo "Error! Incorrect key. Please try again, or contact support. <br />";
		//DEBUG ONLY:
		echo $key . "<br />";
		echo $keyDB . "<br />";
	} else {
		$keySQL = "UPDATE users SET veri=1 WHERE id=" . $uid;
		$odb->query($keySQL);
        header('location: login.php');
	}
?>