<?php
include "config.php";
$roll=$_GET["roll"];
$query="DELETE FROM product WHERE p_id =$roll";
mysqli_query($con,$query);
header("location:deleteproducts.php?delete=1"); 
?>