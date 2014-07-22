<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>追加</title>
</head>
<body>
<?php
$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';

$goodscode=$_POST["goods"];
$volume=$_POST["volume"];
$sizecode=$_POST["size"];
$stockcode='';
$stock='';//在庫数が入る
$scode='';//DB側のsizecode
$goods='';//商品名が入る

try{
	$dbh = new PDO($dsn, $user, $password);
		  $dbh->query('SET NAMES utf8');
$sql=('select stock.stockcode as stkcode,stock.sizecode as scode,stock,goods from goods join stock on goods.stockcode = stock.stockcode join size on size.sizecode = stock.sizecode where goodscode=? and stock.sizecode=?');
   $stmt = $dbh->prepare($sql);
$stmt->execute(array($goodscode,$sizecode));
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
 $stock=($result['stock']);
 $stockcode=($result['stkcode']);
 $scode=($result['scode']);
 $goods=($result['goods']);
}

$sql = ('update stock set stock = ?+? where stockcode = ? and sizecode = ?');
    $stmt = $dbh->prepare($sql);

$stmt->execute(array($volume,$stock,$stockcode,$scode));


//何を追加したか書く
print('<table border="1"><tr><th>商品名</th><th>追加在庫数</th></tr><tr><td>'.$goods.'</td><td>'.$volume.'</td></tr></table>');


print('<p>在庫追加処理が完了しました。</p><table border="1"><tr><th>商品名</th><th>価格</th><th>サイズ</th><th>在庫数</th></tr>');
$sql=('select goods.stockcode as stkcode,goods,FORMAT(price,0) as pri,size,stock from goods join stock on goods.stockcode=stock.stockcode join size on size.sizecode = stock.sizecode order by stkcode asc,size asc');
$stmt=$dbh->prepare($sql);
$stmt->execute(array());
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	print('<tr><td>'.($result['goods']).'</td>');
	print('<td>'.($result['pri']).'</td>');
	print('<td>'.($result['size']).'</td>');
    print('<td>'.($result['stock']).'</td>');
	print('</tr>');
}
print('</table>');
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>
</body>
</html>