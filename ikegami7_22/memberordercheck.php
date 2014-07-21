
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>入力内容確認</title>
</head>
<body>
<h3>ご注文内容</h3>


<?php
/////////////////////////////////////////
///** 繋がる繋がる　conection!! ******//
////////////////////////////////////////
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$dba = 'adios';


$point = $_POST["point"];
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
<h4>使用ポイント：<?php echo $point; ?></h4>
<?php

if($point!=0){
//ポイントによる値下げ
$sumall = $sumall - $point;
print "<font size=\"5\" color=\"#ff0000\">ポイント差引額 $sumall 円</font>";
}


?>
</form>


<h3>入力した情報の確認</h3>
<p>注文内容を確認してください。</p>
<?php
// 入力値の取得
$uname = $_POST["uname"];
$email = $_POST["email"];
$tellno = $_POST["tellno"];
$zip = $_POST["zip"];
$address = $_POST["address"];


$receiver = $_POST["receiver"];
$pay = $_POST["pay"];


if($pay == "1"){
$payshow = "代金引換";
}

if($receiver == "another"){

$name2 = $_POST["name2"];
$zip2 = $_POST["zip2"];
$receiveraddr1 = $_POST["receiveraddr1"];
$receiveraddr2 = $_POST["receiveraddr2"];
$receiveraddr3 = $_POST["receiveraddr3"];
$tellno2 = $_POST["tellno2"];	
}

?>


<form method="POST" action="memberordersubmit.php">
  <table border="1">
    <tr>
      <td>お名前</td>
<!-- 入力内容の確認表示 -->
      <td><?php echo $uname; ?></td>
    </tr>
    <tr>
      <td>メールアドレス</td>
      <td><?php echo $email; ?></td>
    </tr>
    <tr>
      <td>郵便番号</td>
      <td><?php echo $zip; ?></td>
    </tr>
	<tr>
	  <td>お届け先住所</td>
	  <td><?php echo $address; ?></td>
	</tr>
	<tr>
	  <td>お電話番号</td>
	  <td><?php echo $tellno; ?></td>
	</tr>
</table>



<?php

if($receiver == "another"){

?>
<h3>受取人の情報</h3>
  <table border="1">
    <tr>
      <td>受取人のお名前</td>
      <td><?php echo $name2; ?></td>
    </tr>
    <tr>
      <td>受取人の郵便番号</td>
      <td><?php echo $zip2; ?></td>
    </tr>
	<tr>
	  <td>受取人の都道府県 市区群</td>
	  <td><?php echo $receiveraddr1; ?></td>
	</tr>
	<tr>
	  <td>受取人の町村番地（建物名）</td>
	  <td><?php echo $receiveraddr2; ?> <?php echo $receiveraddr3; ?></td>
	</tr>
	<tr>
	  <td>お電話番号</td>
	  <td><?php echo $tellno2; ?></td>
	</tr>
</table>

<?php
}
?>
<h4>お支払方法：<?php echo $payshow; ?></h4>

        <input type="submit" name="sub1" value="注文確定する">
	<input type="button"  onClick="location.href='memberorder.php'" value="入力画面に戻る">

  
<!-- hiddenフィールド -->
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="zip" value="<?php echo $zip; ?>">
<input type="hidden" name="address" value="<?php echo $address; ?>">
<input type="hidden" name="tellno" value="<?php echo $tellno; ?>">

<input type="hidden" name="pay" value="<?php echo $pay; ?>">
<input type="hidden" name="receiver" value="<?php echo $receiver; ?>">

<input type="hidden" name="point" value="<?php echo $point; ?>">
<input type="hidden" name="sumall" value="<?php echo $sumall; ?>">

<?php
if($receiver == "another"){
?>
<input type="hidden" name="name2" value="<?php echo $name2; ?>">
<input type="hidden" name="zip2" value="<?php echo $zip2; ?>">
<input type="hidden" name="receiveraddr1" value="<?php echo $receiveraddr1; ?>">
<input type="hidden" name="receiveraddr2" value="<?php echo $receiveraddr2; ?>">
<input type="hidden" name="receiveraddr3" value="<?php echo $receiveraddr3; ?>">
<input type="hidden" name="tellno2" value="<?php echo $tellno2; ?>">
<?php
}
?>
</form>
</body>
</html>