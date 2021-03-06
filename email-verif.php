<?php
	//Import database info
	require_once 'includes/db.php';

	//Get UserID and Email, hash with random numbers, store result.
	$uid = htmlspecialchars($_GET["uid"]);
	$email = htmlspecialchars($_GET["email"]);
	$key =  hash_hmac("sha512", $uid . hash_hmac("sha512", $email, rand()), rand());
    

	//Send key to database for verification
	$keySQL = $odb -> prepare('UPDATE `users` SET `key1` = :key WHERE `ID` = :id');
	$keySQL -> execute(array(':key' => $key, ':id' => $uid));

	//Email user with key to confirm
	$message = "Thanks for registering with BitFor.me! Please confirm your email address by clicking the following link: http://bitfor.me/email-confirm.php?key=" . $key . "&email=" . $email . "&uid=" . $uid;
	$subject = "Please confirm your BitFor.me email!";
	$headers = "From: admin@bitfor.me" . "\r\n" . "Reply-To: no-reply@bitfor.me" . "\r\n" . "X-Mailer: PHP/" . phpversion();
	mail($email, $subject, $message, $headers);

	echo("Please return to the login page.");
    header('location: login.php')
?>