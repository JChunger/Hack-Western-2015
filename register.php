<!DOCTYPE html>
<?php
	require_once('includes/main.php');
session_start();
if (isset($_SESSION['username'])) {
 header('location: post.php');
}
?>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
	    <link rel="shortcut icon" href="favicon.ico" />
		<title>
		  
		    BitFor.me - Sign Up
		  
		</title>
	
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,400italic,700italic' rel='stylesheet' type='text/css'>
		
		<!-- Extras -->
		<link href="assets/css/animate.css" rel="stylesheet">
		<link href="assets/css/prettyPhoto.css" rel="stylesheet">
		<link href="assets/css/stylesign.css" rel="stylesheet">
	</head>
	<body background="assets\images\mainbg.jpg">
	
	<?php //MAKE THIS LOOK LIKE AN ERROR
		if(isset($_POST['btn'])){
			if(empty($_POST['email'])) {
				?><h1>Please enter your email.</h1><?php
			} elseif (empty($_POST['password'])) {
				?><h1>Please enter a password.</h1><?php
			} elseif (empty($_POST['passwordConfirm'])) {
				?><h1>Please confirm your password.</h1><?php
			} elseif (empty($_POST['username'])) {
				?><h1>Please enter a username.</h1><?php
			} elseif ($_POST['password'] != $_POST['passwordConfirm']) {
				?><h1>Passwords do not match - please try again.</h1><?php
			} else {
				$sql = $odb -> prepare("INSERT INTO users (username, password, email, city) VALUES (:username, :password, :email, :city)");
				$sql -> execute(array(':username' => $_POST['username'], ':password' => hash_hmac('sha512', $_POST['password'], 'few!#@$fSFaflF:a^sdD:'), ':email' => $_POST['email'], ':city' => 0));
				
				$resultQuery = $odb -> query("SELECT ID FROM users WHERE email = '" . $_POST['email'] . "'");
				$uid = $resultQuery -> fetchColumn(0);
                echo '<div class="alert alert-success"> Verification Email Has been sent. Loading...</div>'
				?>
				<meta http-equiv="refresh" content="2;email-verif.php?uid=<?php echo($uid); ?>&email=<?php echo($_POST['email']); ?>" > <?php
			}
		}
	?>

	<!-- Start Hero Section
	================================================== -->
	<section id="main" class="section">
		<div class="container">
			<div class="row">
                <div class="bglayer">
                    <p style="color:transparent">d</p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="section-1">
                    	<form class="form-signin" method="POST">
                    		<h2 class="form-signin-heading2">Sign up</h2>
                    		<label for="email" class="sr-only">Email address</label>
                    		<input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                    		<label for="password" class="sr-only">Passwords</label>
                    		<input type="password" name="password" class="form-control" placeholder="Password" required>
                    		<label for="passwordConfirm" class="sr-only">Confirm Password</label>
                    		<input type="password" name="passwordConfirm" class="form-control" placeholder="Password Confirmation" required>
                    		<label text="username" class="sr-only">Username</label>
                    		<input type="text" name="username" class="form-control" placeholder="Username" required>
                            <center><button name="btn" class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button></center>
                    		<center style="margin-top:5px;"><a class="logsign" href="login.php">Already Have an Account? Log in here.</a></center>
                    	</form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="section-2">
                        <h1>About BitFor.me</h1>
                        <br>
                        <img src="svg/BitForMe.svg">
                        <br>
                        <br>
                        <p>BitFor.me is designed as a tool to help people accomplish what they want to more easily and without distractions. It allows people to help out others.</p>
                    </div>
                </div>  
            </div>
        </div>
	</section>
	<!-- ================================================== 
	End Hero -->

	
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery-1.10.2.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/waypoints.min.js"></script>
	<script src="assets/js/jquery.scrollto.min.js"></script>
	<script src="assets/js/jquery.localscroll.min.js"></script>
	<script src="assets/js/jquery.prettyPhoto.js"></script>
	<script src="assets/js/scripts.js"></script>
	</body>
</html>