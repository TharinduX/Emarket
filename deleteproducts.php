<?php 
include "config.php";
session_start(); 
if(!empty($_GET['delete'])){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "Item deleted successfully!",type: "success",showConfirmButton: false });';
             echo '}, 1000);</script>';
}
if(!isset($_SESSION['uname'])){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Login error!",text: "Please login to continue",type: "information"}).then(function() {window.location = "login.php";});';
             echo '}, 1000);</script>';
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Delete products | E-Market</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/sweetalert2.min.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +94710401417</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@emarketlk.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Sri Lanka
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Sri Lanka</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									LKR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Sri Lankan Rupee</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i><?php if(isset($_SESSION['uname'])) {echo $_SESSION['uname'];} else {echo 'Account';} ?></a></li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><?php if(isset($_SESSION['uname'])) {echo '<a href="logout.php">';} else {echo '<a href="login.php"';} ?><i class="fa fa-lock"></i><?php if(isset($_SESSION['uname'])) {echo "Logout";} else {echo "Login";} ?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
					</div>
				</div>
				</div>
			</div>
	</header>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Admin Options</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
									<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Manage Orders
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Add Orders</a></li>
											<li><a href="">Delete Orders</a></li>
											<li><a href="">View Orders</a></li>
											<li><a href="">Site Status</a></li>
											<li><a href="addriders.php">Add Riders</a></li>
										</ul>
									</div>
								</div>
							</div>
                                <div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Manage Products
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="addproducts.php">Add products</a></li>
											<li><a href="#">Delete products</a></li>
											<li><a href="updateproducts.php">Update products</a></li>
											<li><a href="viewproducts.php">All Products</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div><!--/category-products-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-offset-1">
					<div class="col-sm-6">
						<div class="signup-form"><!--sign up form-->
						<h2>Search Products</h2>
						<form name="search" method="post"><table style=" border:1px solid silver" cellpadding="10px" cellspacing="0px"align="center"><tr><td colspan="4" style="background:#FE980F; color:#FFFFFF; font-size:20px">Search</td></tr><tr><td>Enter Search Keyword</td><td><input type="text" name="search" size="40" /></td><td><input type="submit" value="Search" /></td></tr><tr bgcolor="#666666" style="color:#FFFFFF"><td>Product ID</td><td>Item name</td><td>Product Price</td><td>&nbsp;</td><?php
						if (isset($_POST["search"])){
						$search=$_POST["search"];
						$flag=0;
						$query="select * from product where item like '%$search%'";
						$result=mysqli_query($con,$query);
						while ($row = mysqli_fetch_array($result)) {
						$flag=1;
						echo "<tr ><td>",$row[0],"</td><td>",$row[2],"</a></td><td>",$row[4],"</td><td><a href='updateproducts.php'>Update</a> | <a href='delete.php?roll=",$row[0],"'>Delete</a></td></tr>";
					}
						if($flag==0)
							echo "<tr><td colspan='3' align='center' style='color:red'>Record not found</td></tr>"; 
}
?>
						<tr><td colspan="4">&nbsp;</td></tr><tr bgcolor="#CCCCCC"><th colspan="4" align="right"><a href="addproducts.php">Add Record</a></th></tr></table></form>

					</div><!--/sign up form-->
				</div>
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-market</h2>
							<p>E-Market.lk is a latest e-supermarket where you can shop for all your grocery, beverages and household needs online.</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
								</a>
								<p>Cargills Food City</p>
								<h2>Matara </h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
								</a>
								<p>Keels Super</p>
								<h2>Matara </h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
								</a>
								<p>Arpico Supercentre</p>
								<h2>Matara</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
								</a>
								<p>Lanka Sathosa</p>
								<h2>Matara</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="contact-us.php">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Bevarages</a></li>
								<li><a href="#">Canned Foods</a></li>
								<li><a href="#">Personal Care</a></li>
								<li><a href="#">Baby Products</a></li>
								<li><a href="#">Household</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2019 E-Market. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.tharindu.ml">Tharindu</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script src="dist/sweetalert2.min.js"></script>
</body>
</html>