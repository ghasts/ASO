<html>
<head><title>注文情報送信</title></head>
<body>

<?php
$uname = $_POST["uname"];
$email = $_POST["email"];
$tellno = $_POST["tellno"];
$zip = $_POST["zip"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];

$addr = $addr1.$addr2.$addr3;

$sumall = $_POST["sumall"];

$receiver = $_POST["receiver"];
$pay = $_POST["pay"];


if($receiver == "another"){

$uname = $_POST["name2"];
$zip = $_POST["zip2"];
$addr1 = $_POST["receiveraddr1"];
$addr2 = $_POST["receiveraddr2"];
$addr3 = $_POST["receiveraddr3"];
$tellno = $_POST["tellno2"];

$addr = $addr1.$addr2.$addr3;
	
}


require_once 'DB.php';

//$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$dsn = 'mysqli://adios:lovelive@enzerus.com/adios';
$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}
}
/*サンプル
$alldata = array(array(1, 'one', 'en'),
                 array(2, 'two', 'to'),
                 array(3, 'three', 'tre'),
                 array(4, 'four', 'fire'));
$sth = $db->prepare('INSERT INTO numbers VALUES (?, ?, ?)');
$db->executeMultiple($sth, $alldata);
*/



//注文分在庫マイナス
$updatestock = "update stock set stock = stock - 1 where stockcode = ?;";


//購入テーブル
$sql = "insert into buy (acccode,paycode,pcode,date,name,zip,address,phone,carriage,tax) values ('16',?,'1',current_date,?,?,?,?,'500','0.08');";   
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($pay,$uname,$zip,$addr,$tellno);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$last_id = mysql_insert_id();

//購入詳細テーブル
$sql = "insert into detail (ordercode,goodscode,sizecode,volume);





$db->disconnect();

?>

</body>
</html>