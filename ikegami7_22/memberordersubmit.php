<html>
<head><title>注文情報送信</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>
<body>

<?php
ini_set( "display_errors", "Off");
session_start();


$uname = $_POST["uname"];
$email = $_POST["email"];
$tellno = $_POST["tellno"];
$zip = $_POST["zip"];
$addr = $_POST["address"];

$usepoint = $_POST["point"];
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

$db->query('SET NAMES utf8');

foreach ($_COOKIE['cartgc'] as $key => $value) {
$gsizeAr = $_COOKIE['cartgsize']; 
$gquantAr = $_COOKIE['cartgk'];
$gsize = "$gsizeAr[$key]";
$gquant = "$gquantAr[$key]";
//注文分在庫マイナス
//$updatestock = "update stock set stock = stock-$gquant where stockcode =$value and sizecode =$gsize";
$updatestock = "update stock  set stock = stock-$gquant where stockcode = $value and sizecode = $gsize";


$stmt = $db->query($updatestock);
if (PEAR::isError($stmt)) {
    die($res->getMessage());
}


}

$usepoint = 100;
//使用ポイント差し引き
$updatepoint = "update account set accpoint = accpoint - $usepoint where acccode= ".$_SESSION['acccode'];
$stmt = $db->query($updatepoint);
if (PEAR::isError($stmt)) {
    die($res->getMessage());
}


//購入テーブル
$accode = $_SESSION['acccode'];
//$sql = "insert into buy (paycode,pcode,date,name,zip,address,phone,carriage,tax) values (?,'1',current_date,?,?,?,?,'500','0.08')";   
$sql = "insert into buy values(null,?,?,1,current_date,?,?,?,?,500,0.08)";
$stmt = $db->prepare($sql);
$data = array($_SESSION['acccode'],$pay,$uname,$zip,$addr,$tellno);
$db->execute($stmt,$data);

if (PEAR::isError($stmt)) {
    die($stmt->getMessage());
}

$last_id = mysql_insert_id();
echo $last_id;

foreach ($_COOKIE['cartgc'] as $key => $value) {
$gsizeAr = $_COOKIE['cartgsize']; 
$gquantAr = $_COOKIE['cartgk'];
$gsize = "$gsizeAr[$key]";
$gquant = "$gquantAr[$key]";


//購入詳細テーブル
$sql = "insert into detail values($last_id,$value,$gsize,$gquant)";
echo $sql;
$stmt = $db->prepare($sql);
if (PEAR::isError($stmt)) {
    die($res->getMessage());
}
}


//ポイント獲得
$getpoint = $sumall * 0.1;
$updatepoint2 = "update account set accpoint = accpoint $getpoint where acccode=".$_SESSION['acccode'];
$stmt = $db->query($updatepoint2);
if (PEAR::isError($stmt)) {
    die($res->getMessage());
}



$db->disconnect();

?>
送信しました。
</body>
</html>