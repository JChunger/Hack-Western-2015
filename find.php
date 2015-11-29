<?php
require_once('includes/main.php');
session_start();
if (!isset($_SESSION['username'])) {
   header("location: login.php");
    
}
$btcval = file_get_contents('https://api.bitcoinaverage.com/ticker/CAD/last');
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
              <div id="notif"></div>
               <?php
                $gnore = $odb -> prepare("SELECT * FROM `services` WHERE city = :city AND closed = 0 AND uid != :uid");
                $gnore -> execute(array(":city" => $_SESSION['city'], ":uid" => $_SESSION['ID']));
while ($meow = $gnore -> fetch(PDO::FETCH_ASSOC)) {
    ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                      <div class="caption">
                        <h3><?php echo $meow['title']; ?></h3>
                        <br>
                        <label for="">Description</label>
                        <p><?php echo $meow['description']; ?></p>
                        <hr>
                        <label for="">Location</label>
                        <p><?php echo $meow['address']; ?></p>
                        <hr>
                        <label for="">Date</label>
                        <p><?php echo date('d-m-Y',$meow['date']); ?></p>
                        <hr>
                        <label for="">Price:</label>
                        <p><?php echo round($btcval * ($meow['amount']/100000000), 2); ?> CAD - <?php  echo $meow['amount']/100000000; ?> BTC</p>
                        <p><button type="button" href="#" class="btn btn-primary" onclick="sendmsg(<?php echo $meow['ID']; ?>)">Request!</button></p>
                      </div>
                    </div>
                  </div>
            <?php } ?>
                </div>            
            </div>
	    </div>
	</div>
	
	<script type="text/javascript">
    function sendmsg(crit) {

        $.ajax({
            url: "sendmsg.php",
            data: { id: crit,},
            dataType: "html",
            success: function(pinfo) {
                document.getElementById("notif").innerHTML = pinfo;
            }
        }
        );   
    }
</script>
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
