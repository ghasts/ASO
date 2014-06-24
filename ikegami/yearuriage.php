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




require_once 'DB.php';


$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}


$sql = "select sum(volume*price) as sum from detail join goods on detail.goodscode=goods.goodscode join stock on goods.stockcode=stock.stockcode join buy on detail.ordercode=buy.ordercode where buy.date >= $start and buy.date <= $finish;";
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

echo '<h3>',$year,'年度の売上は';

while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
    print($row->sum);
}
echo '円です。</h3>';

echo '<br><br><br><br><br><br>';
$sql = "select goods.goods, sum(volume*price) as sum from detail join goods on detail.goodscode=goods.goodscode join stock on goods.stockcode=stock.stockcode join buy on detail.ordercode=buy.ordercode where buy.date >= $start and buy.date <= $finish GROUP BY goods.goods;";
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}



echo '<table border=4>';
echo '<tr bgcolor="#cccccc">';
echo '<th colspan=2>';
echo $year,'年度の商品別売上';
echo '</th></tr>';

while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
	echo '<tr><td>';
	echo($row->goods);
	echo '</td><td>';
    echo($row->sum);
	echo '円</td></tr>';
}

echo '</table>';


$db->disconnect();

?>

</body>
</html>




