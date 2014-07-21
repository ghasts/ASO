<?php
/////////////////////////////////////////
///** 繋がる繋がる　conection!! ******//
////////////////////////////////////////
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$dba = 'adios';

//フラグ変数領域
$wflag = 0;
//$dsn = "mysql:dbname=$dba;host=$host";
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
///////////////////////////////////////
///////////////////////////////////////
//***** conection end  ***********////
///////////////////////////////////
?>
<table border="1">
<tr bgcolor="#cccccc">
 
  <th>商品イメージ</th>
  <th>商品名</th>
  <th>価格</th>
  <th>サイズ</th>
  <th>数量</th>
  <th>小計</th>
   </tr>
 
 <!-- カートの中身 ループ　ここから -->
 <form name="cart_form">
 <?php

 $sumall = 0;
 $count=0;
 

if(!(isset($_COOKIE['cartgc']))){
  print("カートには何も入ってないです。");
?>

<meta http-equiv="Refresh" content="10">
<?php
	}else{
// クッキーに商品の情報が入っているとき。
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
$count++;
 ?>
<tr>
	
	<th><?php print("")?> </th>
    
    <th><a href="details_of_goods.php?gcode=<?php print($result['goodscode'])?>">
	<?php print($result['goods']) ?></a></th>
    
    <th>&yen;<?php $price = $result['price'];  print($result['price']);?></th>
    
    <th><?php print($result['size']."cm")?></th>
    
    <th> <?php print($gquant)?></th>
    
    <th>&yen;<?php $sum = $price * $gquant; $sumall = $sumall + $sum; print($sum);?></th>
	
  
</tr> 
<?php
}
}

?>
<!--　カート　ループ　ここまで -->
<tr class="">
				  <td colspan="2">カートの商品数:<?php print($count)?></td>
                  <td colspan="3" align="right">商品合計</td>
                  <td colspan="2" align="right"><?php print($sumall)?>円</td>
                </tr>
  
</table>
</form>


