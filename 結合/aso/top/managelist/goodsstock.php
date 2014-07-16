<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>追加</title>
</head>
<body>
<?php
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';
$dsn = 'mysql:dbname=adios;host=172.20.17.216';

$goods=$_POST["goods"];
$volume=$_POST["volume"];
$stockcode='';
$stock='';

try{
	$dbh = new PDO($dsn, $user, $password);
$sql = 'update stock set stock = ? where id = ?';
    $stmt = $dbh->prepare($sql);

$stmt->execute(array($volume,$size));


//何を追加したか書く
print('<table><tr><th>商品名</th><th>追加在庫数</th></tr><tr><td>'.$goods.'</td><td>'.$volume.'</td></tr></table>');


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