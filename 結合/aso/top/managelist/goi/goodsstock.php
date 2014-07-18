<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>追加</title>
</head>
<body>
<?php
require_once 'DB.php'; 

$goods=$_POST["goods"];
$volume=$_POST["volume"];
$stockcode='';
$stock='';
$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}


try{
//$dbh = new PDO($dsn, $user, $password);
$sql = 'select goods.stockcode,stock from goods join stock on goods.stockcode=stock.stockcode where goods = \''.$goods.'\'';

$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}


while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
        $stockcode=$row->stockcode;
        $stock=$row->stock;
   //     print($row->stockcode);
    }

    $sql = "update stock set stock = ?+".$stock." where stockcode = ?";

$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$data = array($volume,$stockcode);
$db->execute($stmt, $data);

//何を追加したか書く
print('<table><tr><th>商品名</th><th>追加在庫数</th></tr><tr><td>'.$goods.'</td><td>'.$volume.'</td></tr></table>');

$sql = 'select goods,stock,FORMAT(price,0) as pri from stock join goods on stock.stockcode = goods.stockcode';

$res = $db->query($sql);
print('<p>在庫追加処理が完了しました。</p><table border="1"><tr><th>商品名</th><th>在庫数</th><th>価格</th></tr>');
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
	print('<tr><td>'.$row->goods.'</td>');
    print('<td>'.$row->stock.'</td>');
	print('<td>'.$row->pri.'</td>');
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