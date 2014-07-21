
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>入力内容確認</title>
</head>
<body>
<h3>ご注文内容</h3>
<!-- カートさん　　　　　入りまーす。 -->
<?php
require('cart_extract.php');
?>

<!-- カートさん　	ここまでです。-->


<h3>入力した情報の確認</h3>
<p>注文内容を確認してください。</p>
<?php
// 入力値の取得
$uname = $_POST["uname"];
$email = $_POST["email"];
$tellno = $_POST["tellno"];
$zip = $_POST["zip"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];

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

<form method="POST" action="ordersubmit.php">
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
	  <td>都道府県 市区群</td>
	  <td><?php echo $addr1; ?></td>
	</tr>
	<tr>
	  <td>町村番地（建物名）</td>
	  <td><?php echo $addr2; ?> <?php echo $addr3; ?></td>
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

  
<!-- hiddenフィールド -->
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="zip" value="<?php echo $zip; ?>">
<input type="hidden" name="addr1" value="<?php echo $addr1; ?>">
<input type="hidden" name="addr2" value="<?php echo $addr2; ?>">
<input type="hidden" name="addr3" value="<?php echo $addr3; ?>">
<input type="hidden" name="tellno" value="<?php echo $tellno; ?>">

<input type="hidden" name="receiver" value="<?php echo $receiver; ?>">

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