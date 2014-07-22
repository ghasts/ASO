<?php
foreach ($_COOKIE['cartgc'] as $key => $value) {
	
$gsizeAr = $_COOKIE['cartgsize'];	
$gquantAr = $_COOKIE['cartgk'];
$gcode = $value;
$gsize = "$gsizeAr[$key]";
$gquant = "$gquantAr[$key]";

setcookie("cartgc[$key]","",time()-3600*7,'/');
setcookie("cartgk[$key]","",time()-3600*7,'/');
setcookie("cartgsize[$key]","",time()-3600*7,'/');

}
header("Location: cart.php");
exit;	

?>