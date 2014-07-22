<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<?php
$host = 'enzerus.com';
$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';

$goods=$_POST["goods"];
$kind=$_POST["kind"];
$price=$_POST["price"];
$size=$_POST["size"];
$descript=$_POST["descript"];
$stockcode='';
$kindt='';
$goodsm=99999999;//stockcodeに仮に入れる値。


try{
	$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES utf8');

		$sql = 'SELECT kind from kind where kindcode =?';
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array($kind));

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $kindt=$result['kind'];
		
		}
		

		/*	  どっかで。

		$sql = ('SELECT max(goodscode) as maxx from goods');
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array());


		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $goodsm=($result['maxx']);
		
		}*/
$filepath = 'C:/xampp/htdocs/aso/images/';
$upfile = $filepath.basename($_FILES['userfile']['name']);
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile)){
print(basename($_FILES['userfile']['name']).'のアップロードが正常に行われました。');

}else{
print('失敗');
}
$upfile=substr($upfile,15);
    $sql = "insert into goods (goods,kind,descript,stockcode,price,images,kindcode) VALUES (?,?,?,?,?,?,?)";
$stmt = $dbh->prepare($sql);
$stmt->execute(array($goods,$kindt,$descript,$goodsm,$price,$upfile,$kind));

$sql = ('SELECT max(goodscode) as maxx from goods');
$stmt = $dbh->prepare($sql);
$stmt -> execute(array());


while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
 $goodsm=($result['maxx']);

}
$sql = ('update goods set stockcode = ? where goodscode = ?');
$stmt = $dbh->prepare($sql);
$stmt->execute(array($goodsm,$goodsm));

for($cnt=1; $cnt<=5; $cnt++){
$sql = "insert into stock (stockcode,sizecode) VALUES (?,?)";
$stmt = $dbh->prepare($sql);
$stmt->execute(array($goodsm,$cnt));
}

$sql = 'select goods.stockcode as stkcode,goodscode,goods,kind,descript,FORMAT(price,0) as pri,size from goods join stock on goods.stockcode=stock.stockcode join size on size.sizecode = stock.sizecode order by stkcode asc,size asc';
$stmt = $dbh->prepare($sql);
$stmt->execute(array());
print('<p>商品追加が完了しました。 ※サイズ毎に在庫の集計をしています。</p><table border="1">');
print('<tr><th>型番</th><th>商品名</th><th>分類</th><th>商品説明</th><th>価格</th><th>サイズ</th></tr>');
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//$stockcode=($result['stkcode']);
	//$size=($result['size']);
	print('<tr>');
	print('<td>'.$result['goodscode'].'</td>');
    print('<td>'.$result['goods'].'</td>');
	print('<td>'.$result['kind'].'</td>');
	print('<td>'.$result['descript'].'</td>');
	print('<td>'.$result['pri'].'</td>');
	print('<td>'.$result['size'].'</td></tr>');
}

print('</table><form action="../top_page.php" method="post"><input type="submit" value="トップページに戻る" /></form>');
print('<form action="goodsmanage.php" method="post"><input type="submit" value="商品追加・在庫追加画面に戻る" /></form>');
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>
</body>
</html>
