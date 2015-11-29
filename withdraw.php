<?php
require_once('includes/main.php');
session_start();
if (!isset($_SESSION['username'])) {
   header("location: login.php");
    
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
	    <link rel="shortcut icon" href="favicon.ico" />
		<title>
		  
		    BitFor.Me - Post Task
		  
		</title>
	
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,400italic,700italic' rel='stylesheet' type='text/css'>
		
		<!-- Extras -->
		<link href="assets/css/animate.css" rel="stylesheet">
		<link href="assets/css/prettyPhoto.css" rel="stylesheet">
		<link href="assets/css/stylehome.css" rel="stylesheet">
	</head>
	<body>
	
	<?php include('nav.php') ?>
	
	<!-- Start Hero Section
	================================================== -->
	<div style="margin-top: 10%;" class="container">
	    <div class="row">
        
	        <div class="panel panel-success">
                 <div class="panel-heading">Withdraw BTC!</div>
                    <div class="panel-body">
                       <form method="post">
                         <div class="col-lg-6">
                          <?php
                            $lim = $odb -> query("SELECT SUM(amount) FROM `services` WHERE uid = '".$_SESSION['ID']."' AND status < 2 AND closed = 0"); 
                            $lim = $lim -> fetchColumn(0);
                            if (isset($_POST['with'])) {
                                $valit = floatval($_POST['killag']*100000000);
                                $addyb = strip_tags(htmlentities($_POST['btcaddy']));
                                $meowz = array();
                                if (empty($valit) || empty($addyb)) {
                                    $meowz[] = 'Please enter a value!';
                                }
                                if ($valit > ($tree - $lim)) {
                                    $meowz[] = 'You Cant withdraw that much. Some is in hold due to running services.';
                                }
                                if ($valit < 1) {
                                    $meowz[] = 'Please use a value more than 1';
                                }
                                if (empty($meowz)) {
                                    $irt = $odb -> prepare('UPDATE `users` SET `balance` = :bal WHERE ID = :id');
                                    $irt -> execute(array(':bal' => $tree - $valit , ':id' => $_SESSION['ID']));
                                    $iho = file_get_contents('https://blockchain.info/merchant/@identifier/payment?password=**************&to='.$addyb.'&amount='.$valit.'');
                                    echo '<div class="alert alert-success"> Deposit was successful</div>';
                                    
                                }
                                else {
                                    echo '<div class="alert alert-danger">Fix the Following: <br>';
                                    foreach($meowz as $meowz1) {
                                        echo $meowz1, '<br>';
                                    }
                                    echo ' </div>';
                                
                                }
    

                        }

                        ?>
                            <p><?php 
                            echo 'On Hold: ', print number_format($lim/100000000, 8);

                                    echo '<br> Max Withdraw: ',print number_format( $ighh - $lim/100000000, 8);
                                ?></p>
                                
                        <div style="WIDTH:100%;" class="input-group">
                         <label for="btcd">Address:</label>
                          <input  name="btcaddy" type="text" class="form-control" placeholder="Bitcoin Address">
                             </div>
                         <label for="btcd">Amount (BTC):</label>
                        <div style="WIDTH:100%;" class="input-group">
                         
                          <input name="killag" type="text" class="form-control" placeholder=".01">
                          <span class="input-group-btn">
                            <button name="with" class="btn btn-default" type="submit">Withdraw!</button>
                          </span>
                        </div><!-- /input-group -->
                      </div><!-- /.col-lg-6 -->
                        
                                             
                        </form>
                        </div>
                    </div>
                </div>            
            </div>
	    </div>
	</div>
	
	
	
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
