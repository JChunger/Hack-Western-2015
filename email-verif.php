<?php
	//Get UserID and Email, hash with random numbers, store result.
	$uid = htmlspecialchars($_POST["uid"]);
	$email = htmlspecialchars($_POST["email"]);
	$key =  hash_hmac("sha512", $uid . hash_hmac("sha512", $email, rand()), rand());

	//Email user with key to confirm
	$message = "Thanks for registering with BitFor.me! Please confirm your email address by clicking the following link: http://bitfor.me/email-confirm.php&key=" . $key . "&email=" . $email;
	$subject = "Please confirm your BitFor.me email!"
	$headers = "From: admin@bitfor.me" . "\r\n" . "Reply-To: no-reply@bitfor.me" . "\r\n" . "X-Mailer: PHP/" . phpversion();
	mail($email, $subject, $message, $headers;
?>