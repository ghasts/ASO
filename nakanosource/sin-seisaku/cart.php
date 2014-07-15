<?php 
//ini_set( "display_errors", "Off");
//setcookie("cartq",0);
if(!(isset($_COOKIE['cartq']))){
	$_COOKIE['cartq'] = 0;
}

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
	setcookie("cartgc[$cset]",$gcode);
	setcookie("cartgsize[$cset]",$_POST['goodssize']);
	setcookie("cartgk[$cset]",$_POST['quant']);
	
		
/*		print($set.$var[7]);
	if(!(isset($_COOKIE['cartgcode["$set"]']))){
		print($_COOKIE['cartgcode['.$set.']']);
		if($_COOKIE['cartgcode[$set]'] == $set){
				 setcookie("cartgq[$set]",$_COOKIE['cartgq[$set])']+$_POST['quant']);
		}else{
		setcookie("cartlist[$kazu]",$set);
		setcookie("cartgcode[$set]",$_POST['goodscode']);
		setcookie("cartgsize[$set]",$_POST['goodssize']);
		setcookie("cartgq[$set]",$_POST['quant']);
		setcookie("cartq",$kazu+1);
		$_POST = array();
		}
	}else{
	 setcookie("cartgq[$set]",$_COOKIE['cartgq[$set])']+$_POST['quant']);
	}

*/



//ini_set( "display_errors", "Off");

$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//フラグ変数領域
$wflag = 0;
session_start();


$dsn = 'mysql:dbname=adios;host=enzerus.com';

	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');
	  //ユーザー取得用
	  if(isset($_COOKIE['email'])){
	  $sql = 'select accname from account where mail = ?';
	  $stmt = $dbh->prepare($sql);
	  $stmt -> execute(array($_COOKIE['email']));
	  $result = $stmt->fetch(PDO::FETCH_ASSOC);
	  $accname = $result['accname'];
	  $acflag = 1;
	  }else if(isset($_SESSION['acccode'])){
	  $sql = 'select accname from account where acccode = ?';
	  $stmt = $dbh->prepare($sql);
	  $stmt -> execute(array($_SESSION['acccode']));
	  $result = $stmt->fetch(PDO::FETCH_ASSOC);
	  $accname = $result['accname'];
	  $acflag = 1;
	  }else{
		  $acflag = 0;
	
	  }










?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>cart</title>
</head>

<body>
<div>
<table border="1" align=center>
<tr bgcolor="#cccccc">
  <th></th>
  <th>商品イメージ</th>
  <th>商品名</th>
  <th>価格</th>
  <th>サイズ</th>
  <th>数量</th>
  <th>小計</th>
  <th>削除</th>
 </tr>
 
 <!-- カート ループ　ここから -->
 <?php
 $glist = $_COOKIE['cartq'];
 $sumall = 0;
 

	





// ,$_COOKIE['$gsize'])
foreach ($_COOKIE['cartgc'] as $key => $value) {
	
$gsizeAr = $_COOKIE['cartgsize'];	
$gquantAr = $_COOKIE['cartgk'];
$gcode = $value;

//$gcode = $_COOKIE["cart[$value]"];
$gsize = "$gsizeAr[$key]";
$gquant = "$gquantAr[$key]";

$sql = 'select size.size,goods.dispflag,goods.goodscode,goods.goods,goods.descript,goods.kind,stock.stock,goods.price from size,goods left outer join stock on  goods.stockcode = stock.stockcode where goods.goodscode = ? and stock.sizecode =? and size.sizecode =?';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($gcode,$gsize,$gsize));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>
<tr>
	<th></th>
	<th><?php print("")?> </th>
    <th><?php print($result['goods']) ?></th>
    <th>&yen;<?php $price = $result['price'];  print($result['price']);?></th>
    <th><?php print($result['size']."cm")?></th>
    <th><input type="text" size="1" style="text-align:left" value="
	<?php print($gquant)?>" name="数量">
    <input type="button" value="変更" onClick=""></th>
    <th>&yen;<?php $sum = $price * $gquant; $sumall = $sumall + $sum; print($sum);?></th>
	<th><input type="button" value="削除"></th>
</tr> 
<?php
}


?>
<!--　カート　ループ　ここまで -->
<tr class="">
                  <td colspan="5" align="right">商品合計</td>
                  <td colspan="2" align="right"><?php print($sumall)?>円</td>
                </tr>
  
</table>
</div>

</body>
</html>