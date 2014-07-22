<?php
if(!(isset($_COOKIE['cartq']))){
	$_COOKIE['cartq'] = 0;
}

///////////////////////////////////////////
//**　カート追加のためのコード ***********
/////////////////////////////////////////

if(isset($_POST['goodscode'])){
		$kazu = $_COOKIE['cartq'];
		
     	$gcode = $_POST['goodscode'];
		//print("gocode:$gcode<br>");
		$gname = $_POST['gname'];
		//print("gname:$gname<br>");
		$gsize = $_POST['goodssize'];
		//print("gsize:$gsize<br>");
		$cset = "$gname:size:$gsize";
		//print("aaa:".$cset);
		
	//	$var = $_COOKIE['cartgcode'];
	setcookie("cartgc[$cset]",$gcode,time()+3600*7,'/');
	setcookie("cartgsize[$cset]",$_POST['goodssize'],time()+3600*7,'/');
	setcookie("cartgk[$cset]",$_POST['quant'],time()+3600*7,'/');
	$flag = 0;
}
header("Location: ./cart.php");
?>