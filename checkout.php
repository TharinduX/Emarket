<?php 
include "config.php";
session_start();
cart();

if(isset($_POST["submit"])){
    $con=mysqli_connect("localhost","root","","emarketlk");
    $slquery = "SELECT c_id FROM customer WHERE cu_name = '".$_SESSION['uname']."'";
    $result= mysqli_query ($con, $slquery);
    $row = mysqli_fetch_array($result);
    $c_id = $row['c_id'];

    $name=$_POST['name'];
    $address=$_POST['address'];
    $mobile=$_POST['mobile'];
    $city =$_POST['city'];

   if(insert_address($c_id,$name,$address,$mobile,$city)){
			 $con=mysqli_connect("localhost","root","","emarketlk");
			 $sql = "select * from cart c INNER JOIN product p ON (c.p_id = p.p_id)";
			 $result = mysqli_query($con,$sql);
			 while( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ){
require 'php-mailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                               // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'emarketlkshop@gmail.com';                 // SMTP username
$mail->Password = 'em123456*';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('emarketlkshop@gmail.com', 'Registration Success');
$mail->addAddress('jayasankaut@gmail.com','Admin');     // Add a recipient          
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'New Order Placed!';
$mail->Body    = $_SESSION['uname']; '<br>' .$row['p_id']."/" .$row['item']."/".$row['qty']. '<br>';
$mail->AltBody = "Order Placed";
}
if(!$mail->send()) {	



   		     echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "Order placed successfully",type: "success",showConfirmButton: false });';
             echo '}, 1000);</script>'; 			
}else {

			 echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "Error placing order",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>'; 
}

}
}

function addorder(){


}

        //echo  $product_price;
 function cart(){
   
   if(isset($_GET['addcart'])) {
     $con=mysqli_connect("localhost","root","","emarketlk");
     $ip = getip();
     $pro_id = $_GET['addcart'];

     $checkpro = "select * from cart where ip_add = '$ip' AND p_id = '$pro_id'";
     $run_checkpro = mysqli_query($con,$checkpro);


     if(mysqli_num_rows($run_checkpro)>0){


       echo "";


     }else{


               $insertpro = "insert into cart (p_id,ip_add,qty) values ('$pro_id','$ip','1')";  


               $run_insertpro = mysqli_query($con,$insertpro);

               //echo "<script>window.open('','_self')</script>";        



     }



     
    

   }

}

function getip(){

   $ip = $_SERVER['REMOTE_ADDR'];


   if(!empty($_SERVER['HTTP_CLIENT_IP'])){
     
     $ip = $_SERVER['HTTP_CLIENT_IP'];


   }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];


   }

    return $ip;
}


 ?>

 <?php
 
 $ip = getip();
 

 
 if(isset($_GET['removeitem'])){
 
     $prod_id = $_GET['removeitem'];

       $delete_product = "delete from cart where p_id='$prod_id' AND ip_add='$ip'";
       $run_delete = mysqli_query($con, $delete_product);
       if($run_delete){
       
		      echo '<script type="text/javascript">';
             echo 'setTimeout(function () { const Toast = Swal.mixin({ toast: true, position: "top-end", showConfirmButton: false, timer: 3000});Toast.fire({ type: "success", title: "Removed 1 item"});';
             echo '}, 1000);</script>';  
       
       }
   
 
 }

 function insert_address($id,$uname,$address,$mobile,$city){
	 $con=mysqli_connect("localhost","root","","emarketlk");
      $query = "INSERT INTO delivery_address(c_id, name, address, mobile, city) VALUES ('$id','$uname','$address','$mobile','$city')";
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
    <title>Checkout | E-Market</title>
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
					<div class="col-sm-6">
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
								<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
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
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.php">Product Details</a></li> 
										<li><a href="checkout.php" class="active">Checkout</a></li> 
										<li><a href="cart.php">Cart</a></li> 
										<li><a href="login.php">Login</a></li> 
                                    </ul>
                                </li> 
								<li><a href="contact-us.php">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Remove items</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
						   $total = 0;

   $ip = getip();

   $price = "select * from cart where ip_add = '$ip'";

   $run_price = mysqli_query($con,$price) ;

   while($pprice = mysqli_fetch_array($run_price)){

      $pro_id = $pprice['p_id'];
      
      $prod_price = "select * from product p JOIN images i ON (p.p_id = i.p_id) where p.p_id = '$pro_id'";

      $run_pro_price = mysqli_query($con,$prod_price);


      while($ppprice = mysqli_fetch_array($run_pro_price)){

        $product_price = array($ppprice['price']);
        $product_title = $ppprice['item']; 
        $product_id = $ppprice['p_id'];
        $product_image = $ppprice['file_name'];
        $single_price = $ppprice['price'];
         

         $price_sum = array_sum($product_price);

         $total +=$price_sum;

  ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="<?php echo "$product_image" ?>" alt="" width= "90" height= "110"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $product_title ?></a></h4>
								<p>Item ID: <?php echo $product_id ?></p>
							</td>
							<td class="cart_price">
								<p>Rs.<?php echo $single_price ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>

							<td class="cart_delete">
								<a class="cart_quantity_delete" href="checkout.php?removeitem=<?php echo $product_id ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr> 
					 <?php 

					}
				}

						?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>Rs.<?php echo $total ?></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>FREE</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>Rs.<?php echo $total ?></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php 
			if(!isset($_SESSION['uname'])){
			echo "<div class='shopper-informations'>
				<div class='step-one'>
					<h2 class='heading'>Step 1 (Signup/Already have an account??)</h2>
				</div>
				<div class='row'>
					<div class='col-sm-5'>
						<div class='shopper-info'>
							<p>New User Signup!</p>
							<form>
								<input type='text' placeholder='User Name *' required>
								<input type='text' placeholder='Email *' required>
								<input type='password' placeholder='Password *' required>
								<input type='password' placeholder='Confirm password *' required>
								<input type='submit' value='Submit' name='signup_submit' class='btn btn-primary'>
							</form>
						</div>
					</div>
					<div class='col-sm-2 '>
						<div class='shopper-info' style='margin-left:50px;''>
							<p style='color: #fff' class='or'>OR</p>
						</div>
					</div>
					<div class='col-sm-5 clearfix'>
						<div class='shopper-info'>
							<p>Login to your account</p>
								<form>
									<input type='text' placeholder='Email *' required>
									<input type='password' placeholder='password *' required>
									<input type='submit' name='login_submit' value='Submit' class='btn btn-primary'>
								</form>	
						</div>
					</div>					
				</div>
			</div> ";
}
  			?>
  			<?php 
  			if(isset($_SESSION['uname'])){

			echo "<div class='shopper-informations'>
				<div class='step-one'>
					<h2 class='heading'>Step 2 (Enter Your Delivery Address..)</h2>
				</div>
				<div class='row'>
					<div class='col-sm-6'>
						<div class='shopper-info'>
							<p>Delivery Address</p>
								<form method='post'>
									<input type='text' name='name' placeholder='Name'>
									<input type='text' name='address' placeholder='Address *''>
									<input type='text' name='mobile' placeholder='Mobile Phone *''>
								  <select name= 'city'style='padding:10px'>
                                  <option value='Matara'>Matara</option>
								  <option value='Hakmana'>Hakmana</option>
								  <option value='Dickwella'>Dickwella</option>
								  <option value='Weligama'>Weligama</option>
								  <option value='Mirissa'>Mirissa</option>
									</select>
									<br><br>
									<input type='submit' name='submit' value='Submit' class='btn btn-primary'>
								</form>
						</div>
					</div>					
				</div>
			</div>";
		}
			?>

		</div>
	</section> <!--/#cart_items-->

	

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
								<li><a href="">Contact Us</a></li>
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
							<h2>About E-market</h2>
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
					<p class="pull-left">Copyright © 2019 E-Market Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.tharindu.ml">Tharindu</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script src="dist/sweetalert2.min.js"></script>
</body>
</html>