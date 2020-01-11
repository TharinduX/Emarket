<?php 

// Code execution starts here when submit
if (isset($_POST["submit1"])){ 
    // Reading form values
    $uname=$_POST['username'];
    $email=$_POST['email'];
    $psw=$_POST['psw'];
    $rp_psw=$_POST['psw_repeat'];
    $tp_no=$_POST['tp'];
    $nic=$_POST['nic'];

    if (is_valid_email($email) && is_valid_passwords($psw, $rp_psw) && is_valid_username($uname) && is_valid_phoneno($tp_no) && is_valid_id($nic))
    {
        if (create_user($uname, $email, $psw, $rp_psw, $tp_no, $nic)) {
              //$alert= "New User Registered Successfully.Please login to continue ";

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
$mail->addAddress($email,$uname);     // Add a recipient          
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Registration';
$mail->Body    = '<h2>Congratulations on signing up for <b>E-Market!<b></h2><br><br><p>Thanks for joining our E-Supermarket.<br>E-Market.lk is a latest e-supermarket where you can shop for all your grocery, beverages and household needs online.</p>';
$mail->AltBody = 'Thanks for register with us!';

if(!$mail->send()) {
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "Error Registering User!",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
            echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "New User Registered Successfully.Please login to continue",type: "success",showConfirmButton: false });';
             echo '}, 1000);</script>';

}
              //echo "<script type='text/javascript'>alert('$alert');</script>"; 



            } 
            else {
                //$alert = "Error Registering User!";
          //echo "<script type='text/javascript'>alert('$alert');</script>";
        }
    }
  }

function is_valid_email($email)
{        
     $con=mysqli_connect("localhost","root","","emarketlk");
     $slquery = "SELECT c_id FROM customer WHERE c_email = '$email'";
     $selectresult = mysqli_query ($con, $slquery);
     if(mysqli_num_rows($selectresult)>0){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "This email already exists.",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
       return false;
            }
     // now returns the true- means you can proceed with this mail0
     return true;
}

function is_valid_username($username)
{        
     $con=mysqli_connect("localhost","root","","emarketlk");

     $slquery = "SELECT c_id FROM customer WHERE cu_name = '$username'";
     $selectresult = mysqli_query ($con, $slquery);
     if(mysqli_num_rows($selectresult)>0){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "This username already exists.",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
       return false;
            }
     // now returns the true- means you can proceed with this username
     return true;
}

function is_valid_phoneno($phoneNO)
{        
     $con=mysqli_connect("localhost","root","","emarketlk");

     $slquery = "SELECT c_id FROM customer WHERE c_tp = '$phoneNO'";
     $selectresult = mysqli_query ($con, $slquery);
     if(mysqli_num_rows($selectresult)>0){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "This phone number is registered with another account. Please enter diffrent phone number.",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
       return false;
            }
     // now returns the true- means you can proceed with this username
     return true;
}

function is_valid_id($id)
{        
     $con=mysqli_connect("localhost","root","","emarketlk");

     $slquery = "SELECT c_id FROM customer WHERE c_nic = '$id'";
     $selectresult = mysqli_query ($con, $slquery);
     if(mysqli_num_rows($selectresult)>0){
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "This NIC is registered with another account. Please double check before entering the NIC",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
       return false;
            }
     // now returns the true- means you can proceed with this username
     return true;
}

// function for password verification
function is_valid_passwords($pass, $confirmpass) 
{       
     if ($pass != $confirmpass) {
         // error matching passwords
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "Your passwords does not match. Please type carefully.",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
         return false;
     }
     // passwords match
     return true;
}
// function for creating user
function create_user($username, $email, $password, $cpassword, $tpno, $nicNo) {     
      $con=mysqli_connect("localhost","root","","emarketlk");
      $query = "INSERT INTO customer(cu_name, c_email, c_pw, c_repw, c_tp, c_nic) VALUES ('$username','$email','$password','$cpassword','$tpno','$nicNo')";
      $result = mysqli_query($con, $query);
      if($result){
          return true; // Success
      }
      else {
          return false; // Error somewhere
      }
}
?>
<?php
include "config.php";
 session_start();

if(isset($_POST['login2'])){

    $uname = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    if ($uname != "" && $password != ""){
    	if(isAdmin($uname,$password)){
    		if(isManager($uname,$password)){
    		 $_SESSION['uname'] = $uname;
    		 echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "Login Successfully!",type: "success"}).then(function() {window.location = "manage.php";});';
             echo '}, 1000);</script>';


    		}else{
             $_SESSION['uname'] = $uname;
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "Login Successfully!",type: "success"}).then(function() {window.location = "addproducts.php";});';
             echo '}, 1000);</script>';
             }
    	}


 		else{
        $sql_query = "select count(*) as c_id from customer where cu_name='".$uname."' and c_pw='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['c_id'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Success!",text: "Login Successfully!",type: "success"}).then(function() {window.location = "index.php";});';
             echo '}, 1000);</script>';
             //sleep(5);
           //header('Location: index.html');
        }else{

             echo '<script type="text/javascript">';
             echo 'setTimeout(function () { swal.fire({title:"Error!",text: "Invalid username and password",type: "error",showConfirmButton: false });';
             echo '}, 1000);</script>';
        }
    }

  }

}

function isManager($username,$password){
 $con=mysqli_connect("localhost","root","","emarketlk");
        $sql_query = "select count(*) as admin_id from admin where admin_type ='manager' and admin_uname='$username' and admin_pw='$password'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);        
        $count = $row['admin_id'];

     if($count > 0){
   return true;
 }else{
  return false;}

}

function isAdmin($username,$password){
	     $con=mysqli_connect("localhost","root","","emarketlk");
        $sql_query = "select count(*) as admin_id from admin where admin_uname='$username' and admin_pw='$password'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);        
        $count = $row['admin_id'];

     if($count > 0){
   return true;
 }else{
  return false;}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Market</title>
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
							<a href="index.php"><img src="images/home/logo.png" alt="Home page" /></a>
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
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="" class="active"><i class="fa fa-lock"></i> Login</a></li>
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
										<li><a href="product-details.php">Product Details</a></li> 
										<li><a href="checkout.php">Checkout</a></li> 
										<li><a href="cart.php">Cart</a></li> 
										<li><a href="login.php" class="active">Login</a></li> 
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
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="POST" >
							<input type="text" name="username" placeholder="Username" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" name="login2" id="login" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="POST">
							<input type="text" name="username" placeholder="Username"/>
							<input type="email" name="email" placeholder="Email Address"/>
							<input type="password" name="psw" placeholder="Password"/>
							<input type="password" name="psw_repeat" placeholder="Confirm password"/>
							<input type="text" name="tp" placeholder="Telephone No"/>
							<input type="text" name="nic" placeholder="NIC"/>
							<button type="submit" name="submit1" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
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
								<h2>Matara</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
								</a>
								<p>Keells Super</p>
								<h2>Matara</h2>
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
							<h2>Quick Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Bevarages</a></li>
								<li><a href="">Canned Foods</a></li>
								<li><a href="">Personal Care</a></li>
								<li><a href="">Baby Products</a></li>
								<li><a href="">HouseHold</a></li>
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
					<p class="pull-left">Copyright © 2019 E-Market Inc. All rights reserved.</p>
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