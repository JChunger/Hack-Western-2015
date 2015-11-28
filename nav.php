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
	          <a href="indexsign.php">Sign Up</a>
	        </li>
              <?php } else {?>
                  <li>
                  <a href="post.php">Post</a>
                </li>
                <li>
                  <a href="find.php">Find</a>
                </li>
                <li>
                  <a href="inbox.php">Inbox</a>
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