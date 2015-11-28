<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
	
		<title>

		    BitFor.me - Login
		  
		</title>
	
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,400italic,700italic' rel='stylesheet' type='text/css'>
		
		<!-- Extras -->
		<link href="assets/css/animate.css" rel="stylesheet">
		<link href="assets/css/prettyPhoto.css" rel="stylesheet">
		<link href="assets/css/stylelog.css" rel="stylesheet">
	</head>
	<body background="assets\images\mainbg.jpg">
	
        <?php
if (isset($_POST['logbtn'])) {
    $meow = strip_tags(htmlentities($_POST['uname']));
    $kitty = strip_tags(htmlentities($_POST['pword']));
    $error = array();
    
    $que1 = $odb -> prepare('SELECT * FROM `users` WHERE username = :uname');
    $que1 -> execute(array(':uname' => $meow));
    $check = $que1 -> fetch(PDO::FETCH_ASSOC);
    
    if (empty($meow) || empty($kitty)) {
        $error[] = 'Please fill in all the fields!';
    
    }
    if (strlen($kitty) < 3) {
        $error[] = 'Password has to be longer than 4 characters';
    }
    if (!$check) {
        $error[] = 'Invalid name';
    }
    if ($check['veri'] == 0) {
        $error[] = 'Verify your email!';
        
    }
    if (empty($error)) {
        echo 'success';
        $login = $odb -> prepare("SELECT * FROM `users` WHERE username = :uname AND password = :pword");
        $login -> execute(array(":uname" => $meow, ":pword" => (hash_hmac('sha512', $kitty, 'few!#@$fSFaflF:a^sdD:'))));
        $sqllog = $login -> fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['username'] = $sqllog['username'];
        $_SESSION['ID'] = $sqllog['ID'];
        $_SESSION['city'] = $city;
        $gg = $odb -> prepare("UPDATE `users` SET last_ip = :lip AND city = :citty WHERE ID = :id");
        $gg -> execute(array('lip'=> $_SERVER['REMOTE_ADDR'], ":citty" => $city, ":id" => $_SESSION['ID']));
        echo '<meta http-equiv="refresh" content="3;url=post.php">';
        
        
    
    }
    else {
        echo '<div class="alert alert-danger">';
        foreach($error as $mir) {
            echo $mir,'<br>';
        }
        echo '</div>';
    }
}


?>
    
	<!-- Start Hero Section
	================================================== -->
	<section id="main" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
                      <div class="wrapper">
                        <div class="bglayer">
                            <p style="color:#ff9900">d</p>
                        </div>
                        <form class="form-signin">       
                        <h2 class="form-signin-heading">Login</h2>
                        <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
                        </form>
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
