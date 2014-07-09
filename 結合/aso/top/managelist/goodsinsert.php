<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<?php
require_once 'DB.php';

$goods=$_POST["goods"];
$kind=$_POST["kind"];
$price=$_POST["price"];
$size=$_POST["size"];
$stockcode='';



$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

try{
//    $dbh = new PDO($dsn, $user, $password);
$sql = 'select * from stock';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

    $sql = "insert into stock (price) values (?)";
    
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$data = array($price);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$sql = 'select * from stock';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}


    $sql = "insert into goods (goods,kind,size,stockcode) VALUES (?,?,?,?)";
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($goods,$kind,$size,$stockcode);
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
	print('<td>'.$row->size.'</td>');
//	print('<td>'.$row->stockcode.'</td>');
	print('</tr>');
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