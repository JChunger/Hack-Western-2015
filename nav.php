<!-- Start Header
	================================================== -->
	<header id="header" class="navbar navbar-inverse navbar-fixed-top" role="banner">
	  <div class="container">
	    <div class="navbar-header">
	      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <!-- Your Logo -->
	      <a href="" class="navbar-brand"><img class="logo1" src="assets/images/BitForMe-72.png"></a>
	    </div>
	    <!-- Start Navigation -->
	    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	      <ul class="nav navbar-nav">
              <?php if(!isset($_SESSION['username'])) { ?>
	        <li>
	          <a href="login.php">Log In</a>
	        </li>
	        <li>
	          <a href="register.php">Sign Up</a>
	        </li>
              <?php } else {
				$check1 = $odb -> query("SELECT `balance` FROM `users` WHERE ID = '".$_SESSION['ID']."'");
				$tree = $check1 -> fetchColumn(0);
              
              
              ?>
                  <li>
                  <a href="post.php">Post</a>
                </li>
                <li>
                  <a href="find.php">Find</a>
                </li>
                <li>
                  <a href="inbox.php">Inbox <span class="label label-primary"><b><?php $gti = $odb -> query("SELECT COUNT(*) FROM `inbox` WHERE `from_id` = '".$_SESSION['ID']."' AND status < 2"); $gti = $gti -> fetchColumn(0); $gti2 = $odb -> query("SELECT COUNT(*) FROM `inbox` WHERE `to_id` = '".$_SESSION['ID']."' AND status < 2"); $gti2 = $gti2 -> fetchColumn(0); echo intval($gti )+ intval($gti2);?></b></span></a>
                </li>
                
                <li>
                    <a href="deposit.php">Deposit</a>
                </li>
                <li>
                    <a href="withdraw.php">Withdraw</a>
                </li>
                <li>
                    <a >Balance: <?php $ighh = $tree/100000000; print number_format($ighh, 8);
; ?> BTC</a>
                </li>
                <li>
                  <a href="logout.php">Logout</a>
                </li>
              
              <?php } ?>
	      </ul>
	    </nav>
	  </div>
	</header>
	<!-- ==================================================
	End Header -->