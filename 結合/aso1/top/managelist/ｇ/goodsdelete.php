<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PHP TEST</title>
</head>
<body>

<?php
$goodscode = $_POST["goods"];


$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';
try{
	$dbh = new PDO($dsn, $user, $password);
		  $dbh->query('SET NAMES utf8');


$sql = ("update goods set dispflag = '0' where goodscode = ?");
   $stmt = $dbh->prepare($sql);
$stmt->execute(array($goodscode));

$sql = ("select goods,size from goods join stock on goods.stockcode=stock.stockcode join size on size.sizecode=stock.sizecode where goodscode = ?");
   $stmt = $dbh->prepare($sql);
$stmt->execute(array($goodscode));

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
print (($result['goods']).' '.($result['size']).'の商品の情報の非表示化に成功しました。');

}

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}


?>
<p><input type="button" value="非表示化商品選択画面に戻る" onClick="location.href='deletedisplay.php'"></p>
<p><input type="button" value="管理者機能リストに戻る" onClick="location.href='managelist.php'"></p>
</body>
</html>




