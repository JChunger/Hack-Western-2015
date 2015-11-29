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
		  
		    BitFor.Me - Inbox
		  
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
              <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#rec" aria-controls="rec" role="tab" data-toggle="tab">Sent Requests</a></li>
    <li role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">Recieved Requests</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="rec">
       <div style="margin-top:1%;" class="container">
        
        <table class="table table-striped table-bordered">
                       
        <thead>
        <tr>
            <th>ID</th>
            <th>Message Sent From You!</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?PHP
        $ez = $odb -> query("SELECT * FROM `inbox` WHERE `from_id` = '".$_SESSION['ID']."' AND `status` < 4 ORDER BY `date` DESC");
        while ($mme = $ez -> fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?php  echo $mme['ID']; ?></td>
            <td><?php  echo $mme['message']; ?></td>
            <td><?php  if ($mme['status'] == 0) {echo '<p class="btn btn-warning">Not Accepted </p>';} else if ($mme['status'] == 1){ echo '<p class="btn btn-primary">Accepted </p>'; }else if ($mme['status'] == 2){ echo '<p class="btn btn-success">Payment Confirmed.</p>'; }else if ($mme['status'] == 3){ echo '<p class="btn btn-danger">Denied.</p>'; } ?></td>
            <td><?php echo date('d-m-Y', $mme['date']); ?></td>
        </tr>
            <?php } ?>
        </tbody>
								
            </table>
        <p>* To get the money, the other users has to confirm delievery. This should be done while face to face! </p>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="sent"><div class="container">
     <div style="margin-top:1%;" class="container">
        <?php
if(isset($_POST['rsub'])) {
    $thingy = $_POST['rsub'];
    $kittycat = 'val'.strval($thingy).'';
    $trillers = $_POST[$kittycat];
     
    $tight = $odb -> prepare('UPDATE `inbox` SET `status` = :stat WHERE ID = :id');
    $tight -> execute(array(":stat" => $trillers, ":id" => $thingy));
    if(intval($trillers) == 2) {
        
        $joe = $odb -> prepare("SELECT * FROM `inbox` WHERE ID = :id");
        $joe -> execute(array(':id' => $thingy));
        $joe1 = $joe ->fetch(PDO::FETCH_ASSOC);
        
        $ur = $odb -> query("SELECT `balance` FROM `users` WHERE ID = '".$joe1['to_id']."'");
        $ur = $ur -> fetchColumn(0);
        $njb = $ur - $joe1['amount'];
        
        $urt = $odb -> query("UPDATE `users` SET `balance` = '".$njb."' WHERE ID = '".$joe1['to_id']."'");
        
        $ur2 = $odb -> query("SELECT `balance` FROM `users` WHERE ID = '".$joe1['from_id']."'");
        $ur2 = $ur2 -> fetchColumn(0);
        $njb2 = $ur2 + $joe1['amount'];
        
        $close = $odb -> query("UPDATE `services` SET `closed` = 1 WHERE ID = '".$joe1['serv_id']."'");
        $urt = $odb -> query("UPDATE `users` SET `balance` = '".$njb2."' WHERE ID = '".$joe1['from_id']."'");
        echo '<div class="alert alert-success"> Balance Transfer Comfirmed!</div>'; 
       
        
        
    }
}

?>
        <table class="table table-striped table-bordered">
                       
        <thead>
        <tr>
            <th>ID</th>
            <th>Message Sent To You!</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
            <th>Submit</th>
        </tr>
        </thead>
        <tbody>
        <?PHP
        $ez1 = $odb -> query("SELECT * FROM `inbox` WHERE `to_id` = '".$_SESSION['ID']."' AND `status` < 3 ORDER BY `date` DESC");
        while ($mme1 = $ez1 -> fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <td><?php  echo $mme1['ID']; ?></td>
            <td><?php  echo $mme1['message']; ?></td>
            <td><?php echo date('d-m-Y', $mme1['date']); ?></td>
            <td><?php  if ($mme1['status'] == 0) {echo '<p class="btn btn-warning">Not Accepted </p>';} else if ($mme1['status'] == 1){ echo '<p class="btn btn-primary">Accepted </p>'; }else if ($mme1['status'] == 2){ echo '<p class="btn btn-success">Payment Confirmed.</p>'; } ?></td>
            <?php if($mme1['status'] !=2) { ?>
            <form method="post"><td><select  class="btn btn-default dropdown-toggle" name="val<?php echo $mme1['ID']; ?>" id=""><option value="1">Accept</option><option value="2">Confirm Delievery</option><option value="3">Deny</option></select></td>
            <td><button value="<?php echo $mme1['ID']; ?>" name="rsub" type="submit" class="btn btn-primary">Submit!</button></td></form>
            <?php  } else {?>
            <td>Done.</td>
            <td>Done.</td>
            <?php } ?>
        </tr>
            <?php } ?>
        </tbody>
								
            </table>
        <p>* To get the money, the other users has to confirm delievery. This should be done while face to face! </p>
        </div>
    </div>
     <td>
           <?php 
            //$ighty = $odb ->query("SELECT `username` FROM `users` WHERE ID = '".$mme['from_id']."'");
            //echo $ighty -> fetchColumn(0);
            ?>
            </td></div></div>
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
