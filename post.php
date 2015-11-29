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
                 <div class="panel-heading">Post Simple Task!</div>
                    <div class="panel-body">
                      <?php
    if(isset($_POST['addbtn'])) {
    $title = strip_tags(htmlentities($_POST['title']));
    $desc = strip_tags(htmlentities($_POST['desc']));
    $address = strip_tags(htmlentities($_POST['address']));
    $amount = intval($_POST['amount']*100000000);
    $krill = array();
    
    if (empty($title) || empty($desc) || empty($address) || empty($amount)){
     $krill[] = 'Please Fill in all the Fields';
    }
    if ($tree > $amount && empty($krill)) {
    $killa = $odb->prepare("INSERT INTO `services` VALUES(NULL, :uid, :title, :desc, :addy, :amount, 0, 0, :city, UNIX_TIMESTAMP())");
    $killa -> execute(array(':uid' => $_SESSION['ID'], ':title' => $title, ':desc' => $desc, ':addy' => $address, ':amount' => $amount, ':city' => $_SESSION['city']));
    echo '<div class="alert alert-success">Your Task has been Posted!</div>';
    }
    else {
        echo '<div class="alert alert-danger">You have insufficiant funds.</div>';
    
    }
}
    
    ?>
                       <form method="post">
                        <div style="width:100%;" class="input-group">
                          <label for="title">Title:</label>
                          <input  name="title" type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
                        </div>
                        <div style="width:100%;" class="input-group">
                          <label for="desc">Description:</label>
                            <textarea  rows="4" cols="50" name="desc" type="text" class="form-control" placeholder="Short description of your task!" aria-describedby="basic-addon1"></textarea>
                            <div style="width:100%;" class="input-group">
                          <label for="address">Address:</label>
                          <input  name="address" type="text" class="form-control" placeholder="Address" aria-describedby="basic-addon1">
                          
                        </div>
                        <div style="width:100%;" class="input-group">
                          <label for="amount">Amount (btc):</label>
                          <input  name="amount" type="text" class="form-control" placeholder="0.1 " aria-describedby="basic-addon1">
                          
                        </div>
                        <br>
                        <button type="submit" name="addbtn" class="btn btn-success btn-lg">Add!</button>                        
                        </form>
                        </div>
                    </div>
                </div>            
            </div>
	    </div>
	</div>
	
	<div class="container">
	    <div class="row">
       	        <div class="panel panel-success">

        <header class="panel-heading">
                          Your posts!
                        </header>
                          <section class="panel">
                        
                        <div class="panel-body">
                            <table class="table table-striped table-bordered">
                               <?php 
if (isset($_POST['delbtn'])) {
    $postd = $_POST['delbtn'];
    $hue = $odb -> query("UPDATE `services` SET closed = 1 WHERE ID = '".$postd."'");
    echo '<div class="alert alert-success">Post has been deleted</div> ';
}

?>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
									<th>Address</th>
									<th>Amount</th>
									<th>Close</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?PHP
								$ez = $odb -> query("SELECT * FROM `services` WHERE `uid` = '".$_SESSION['ID']."' AND `closed` = 0");
								while ($mme = $ez -> fetch(PDO::FETCH_ASSOC)) {
								?>
                                <tr>
                                    <td><?php echo $mme['ID']; ?></td>
                                    <td><?php echo $mme['title']; ?></td>
                                    <td><?php echo $mme['description']; ?></td>
                                    <td><?php echo $mme['address']; ?></td>
                                    <td><?php echo $mme['amount']/100000000; ?></td>
                                    <td><form method="post"><button name="delbtn" value="<?php echo $mme['ID']; ?>" class="btn btn-danger">Close!</button></form></td>
                                </tr>
                                    <?php } ?>
                                </tbody>
								
            </table>
                              </div>
        </section>
        
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
