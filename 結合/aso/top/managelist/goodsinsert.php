<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<?php
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';
$dsn = 'mysql:dbname=adios;host=172.20.17.216';

$goods=$_POST["goods"];
$kind=$_POST["kind"];
$price=$_POST["price"];
$size=$_POST["size"];
$descript=$_POST["descript"];
$stockcode='';
$kindt='';
$goodsm='';


try{
	$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES utf8');

		/*	  
		$sql = 'select acccode,accname,pw,mail from account';
		$stmt = $dbh->query($sql);
		*/

		$sql = 'SELECT kind from kind where kindcode =?';
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array($kind));

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $kindt=$result['kind'];
		
		}
		

		/*	  
		$sql = 'select acccode,accname,pw,mail from account';
		$stmt = $dbh->query($sql);
		*/

		$sql = ('SELECT max(goodscode)+1 as maxx from goods');
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array());


		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $goodsm=($result['maxx']);
		
		}
//    $dbh = new PDO($dsn, $user, $password);
/*
$sql = 'select kind from kindcode';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
*/
 /*   $sql = "insert into goods (price) values (?)";
    
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$data = array($price);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
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


$sql = 'select stockcode,goodscode,goods,kind,descript,FORMAT(price,0) as pri from goods';
$stmt = $dbh->prepare($sql);
$stmt->execute(array());
print('<p>商品追加が完了しました。</p><table border="1">');
print('<tr><th>型番</th><th>商品名</th><th>分類</th><th>商品説明</th><th>価格</th><th>サイズ</th></tr>');
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
//    print($row->stock);
	$stockcode=$result['stockcode'];
	print('<tr>');
	print('<td>'.$result['goodscode'].'</td>');
    print('<td>'.$result['goods'].'</td>');
	print('<td>'.$result['kind'].'</td>');
	print('<td>'.$result['descript'].'</td>');
	print('<td>'.$result['pri'].'</td>');
	
//	print('<td>'.$row->size.'</td>');
//	print('<td>'.$row->stockcode.'</td>');
	//print('');
}


    $sql = "insert into stock (stockcode,sizecode) VALUES (?,?)";
$stmt = $dbh->prepare($sql);


$stmt->execute(array($stockcode,$size));



		/*	  
		$sql = 'select acccode,accname,pw,mail from account';
		$stmt = $dbh->query($sql);
		*/

		$sql = 'SELECT size from size where sizecode =?';
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array($size));

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
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
