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
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">BTC Deposite</h4>
      </div>
      <div class="modal-body">
        <div style="font-size:14px;" id="btcpayment"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        
	        <div class="panel panel-success">
                 <div class="panel-heading">Deposite BTC!</div>
                    <div class="panel-body">
                       <form method="post">
                         <div class="col-lg-6">
                             <label for="btcd">Amount (CAD):</label>
                        <div class="input-group">
                         
                          <input id="price" type="text" class="form-control" placeholder="1">
                          <span class="input-group-btn">
                            <button data-toggle="modal" data-target="#myModal" onclick="getbtc()" class="btn btn-default" type="button">Deposite!</button>
                            
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
	
	
	<script type="text/javascript">
    function getbtc() {
        var pme = document.getElementById('price').value 
        $.ajax({
            url: "order.php",
            data: { price: pme,},
            dataType: "html",
            success: function(pinfo) {
                document.getElementById("btcpayment").innerHTML = pinfo;
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
