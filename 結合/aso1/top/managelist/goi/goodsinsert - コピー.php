<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<?php
require_once 'DB.php';
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
$goodsm=0;



$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

try{
	$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES utf8');

		/*	  
		$sql = 'select acccode,accname,pw,mail from account';
		$stmt = $dbh->query($sql);
		*/

		$sql = ('SELECT kind from kind where kindcode =?');
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array($kind));

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $kindt=$result['kind'];
		
		}
		
	$dbh = new PDO($dsn, $user, $password);
			$dbh->query('SET NAMES utf8');

		/*	  
		$sql = 'select acccode,accname,pw,mail from account';
		$stmt = $dbh->query($sql);
		*/

		$sql = ('SELECT max(goodscode) as maxx from goods');
		$stmt = $dbh->prepare($sql);


		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $goodsm=$result['maxx'];
		
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

    $sql = "insert into goods (goods,kind,descript,stockcode,price,images,kindcode) VALUES (?,?,?,?,?,?,?)";
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($goods,$kindt,$descript,$goodsm+1,$price,upfile,$kind);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$sql = 'select * from goods';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
print('<p>商品追加が完了しました。</p><table border="1">');
print('<tr><th>型番</th><th>商品名</th><th>分類</th><th>サイズ</th></td>');
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
//    print($row->stock);
	$stockcode=$row->stockcode;
	print('<tr>');
	print('<td>'.$row->goodscode.'</td>');
    print('<td>'.$row->goods.'</td>');
	print('<td>'.$row->kind.'</td>');
	print('<td>'.$row->descript.'</td>');
	print('<td>'.$row->price.'</td>');
	
//	print('<td>'.$row->size.'</td>');
//	print('<td>'.$row->stockcode.'</td>');
	//print('');
}


    $sql = "insert into stock (stockcode,sizecode) VALUES (?,?)";
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($stockcode,$size);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}


		$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES utf8');

		/*	  
		$sql = 'select acccode,accname,pw,mail from account';
		$stmt = $dbh->query($sql);
		*/

		$sql = ('SELECT size from size where sizecode =?');
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array($mail));

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 print('<td>'.$result['mail'].'</td></tr>');
		
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