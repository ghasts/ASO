<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PHP TEST</title>
</head>
<body>

<?php
$year = $_POST["year"];
$year2 = $year + 1;

$start = "'$year-04-01'";
$finish = "'$year2-03-31'";
$outsum='0';//出力用変数
$outgoods='売上なし';//出力用変数
$flg='0';//売上があったかなかったかのflag　あったら１　なかったら０

$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';
try{
	$dbh = new PDO($dsn, $user, $password);
		  $dbh->query('SET NAMES utf8');


$sql = ('select sum(volume*price) as sum from detail join goods on detail.goodscode=goods.goodscode join stock on goods.stockcode=stock.stockcode join buy on detail.ordercode=buy.ordercode where buy.date >= ? and buy.date <= ?');
$stmt=$dbh->prepare($sql);
$stmt->execute(array($start,$finish));

echo '<h3>',$year,'年度の売上は';

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $outsum=($result['sum']);
}
if($outsum==''){//select文でレコードが１件も取れなかったときの処理
$outsum='0';//合計金額が0であることを明示
$flg='0';//売上がないから。
}
print($outsum.'円です。</h3>');

echo '<br><br>';
$sql = ('select goods.goods, sum(volume*price) as sum from detail join goods on detail.goodscode=goods.goodscode join stock on goods.stockcode=stock.stockcode join buy on detail.ordercode=buy.ordercode where buy.date >= ? and buy.date <= ? GROUP BY goods.goods');
$stmt=$dbh->prepare($sql);
$stmt->execute(array($start,$finish));

echo '<table border=4>';
echo '<tr bgcolor="#cccccc">';
echo '<th colspan=2>';
echo $year,'年度の商品別売上';
echo '</th></tr>';

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<tr><td>';
	echo(($result['goods']));
	echo '</td><td>';
    echo(($result['sum']));
	echo '円</td></tr>';
}
if($flg=='0'){//売上がなかったときの処理（これがないと売上がないとき　テーブルのヘッダだけが表示され非常に不自然。
	print ('<tr><td>');
	print($outgoods);
	print ('</td><td>');
    print($outsum);
	print ('円</td></tr>');
}
echo '</table>';
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}



?>
<p><input type="button" value="戻る" onClick="location.href='syuukeitop.php'"></p>
<p><input type="button" value="管理者機能リストに戻る" onClick="location.href='managelist.php'"></p>

</body>
</html>




