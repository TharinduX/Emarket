<?php
include "config.php";
session_start(); 
if(!empty($_GET['logout'])){

	         echo '<script type="text/javascript">';
             echo 'setTimeout(function () { const Toast = Swal.mixin({ toast: true, position: "top-end", showConfirmButton: false, timer: 3000});Toast.fire({ type: "success", title: "Successfully logged out"});';
             echo '}, 1000);</script>';
   }
// Check user login or not
if(!isset($_SESSION['uname'])){
header("location: login.php"); 
}
?>

<?php 
// Code execution starts here when submit
if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){ 
    // Reading form values
    $pname=$_POST['pname'];
    $amount=$_POST['amount'];
    $price=$_POST['price'];
    $description=$_POST['description'];


    if (is_duplicate_name($pname))
    {
        if (add_product($amount,$pname,$price,$description)) {
              upload_photo();
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "New product added successfully",type: "success",showConfirmButton: false });';
             echo '}, 1000);</script>';

            } 
            else {
        }
    }
  }

function is_duplicate_name($pname)
{        
     $con=mysqli_connect("localhost","root","","emarketlk");

     $slquery = "SELECT p_id FROM product WHERE item = '$pname'";
     $selectresult = mysqli_query ($con, $slquery);
     if(mysqli_num_rows($selectresult)>0){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "This products already exists!",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';

       return false;
            }
     // now returns the true- means you can proceed with this mail0
     return true;
}

function upload_photo()
{    

 $statusMsg = '';

$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

     $con=mysqli_connect("localhost","root","","emarketlk");
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
             $query="INSERT into images (file_name, uploaded_on) VALUES ('$targetDir".$fileName."', NOW())";
            $insert =mysqli_query($con, $query);
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }

//else{
   // $statusMsg = 'Please select a file to upload.';


// Display status message
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "$statusMsg!",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';

}

// function for add product
function add_product($amount,$pname,$price,$description) {     
      $con=mysqli_connect("localhost","root","","emarketlk");
      $query = "INSERT INTO product(amount,item,price,description) VALUES ('$amount','$pname','$price','$description')";
      $result = mysqli_query($con, $query);
      if($result){
          return true; // Success
      }
      else {
          return false; // Error somewhere
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add products | E-Market</title>
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
											<li><a href="#">Add products</a></li>
											<li><a href="deleteproducts.php">Delete products</a></li>
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
						<h2>Add New Products</h2>
						<form action="#" form method="post" enctype="multipart/form-data" >
							Product Name: <input type="text" name="pname" placeholder="Product name"/>
							Amount: <input type="text" name="amount" placeholder="Amount"/>
							Price: <input type="text" name="price" placeholder="Price"/>
						    Description: <input type="text" name="description" placeholder="Description"/>
						    Upload Product Image: <input type="file" name="file" accept="image/*"/>
							<button type="submit" name="submit" class="btn btn-default">Add Product</button>
						</form>
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