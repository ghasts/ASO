<?php
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//フラグ変数領域
$wflag = 0;



$dsn = 'mysql:dbname=adios;host=172.20.17.216';

print('phase:DB::OK<br>');



	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');



$sql = 'select goods.goods,goods.kind,goods.size,stock.stock,stock.price from goods,stock goods.stockcode = stock.stockcode where goods.kind = \'スニーカー\'';
$res = $dbh->prepare($sql);
//フィールドの数を取得する
$numFields = mysql_num_fields($res);
//フィールド名を格納する配列を用意する
$nameFields = array();
for($i=0;$i<$numFields;$i++){
$nameFields[] = mysql_field_name($res, $i);
}



?>

<?php
$link = mysql_connect($host,$user,$password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db($db)) {
    die('Could not select database: ' . mysql_error());
}
$result = mysql_query('select goods.goods,goods.kind,goods.size,stock.stock,stock.price from goods left outer join stock on  goods.stockcode = stock.stockcode where price = 5000 ');
if (!$result) {
    die('Could not query:' . mysql_error());
}
echo mysql_field_name($result, 3); // 3 番目の employee の name を出力する

mysql_close($link);
?>