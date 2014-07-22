













<html>
<head><title>PHP TEST</title></head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<body>


<h3>販売サイトから非表示化したい商品を選択して「非表示化する」ボタンをクリックしてください。</h3>
<?php

$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';

try{
	$dbh = new PDO($dsn, $user, $password);
		  $dbh->query('SET NAMES utf8');

$sql = ('select * from goods');
$stmt=$dbh->prepare($sql);
$stmt->execute(array());

echo '<form method="POST" action="goodsdelete.php">';
echo '<select name=goods>\n';
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
$goodscode = ($result['goodscode']);
print('<option value="'.$goodscode.'">'.($result['goods']).($result['size']).'</option>');
}
echo '</select><input type="submit" value="非表示化する"></form>';

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}


?>
<p><input type="button" value="戻る" onClick="location.href='managelist.php'"></p>
</body>
</html>




