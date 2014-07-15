<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
<?php

//////////////////////////////////////////
//*********** Conection *****************
/////////////////////////////////////////


$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

$dsn = "mysql:dbname=$db;host=$host";
$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');
	  
/////////////////////////////////////////
//**************************************
////////////////////////////////////////
?>
</head>
<!-- カート　テーブル　ここから -->
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

 $sumall = 0;
 //合計金額用変数。
 

	





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

<!-- カート　テーブル　ここまで-->

<body>
</body>
</html>