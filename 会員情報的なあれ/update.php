﻿<html>
<head><title>PHP TEST</title></head>
<body>

<?php
$uname = $_POST["uname"];
$email = $_POST["email"];
$sex = $_POST["sex"];
$tellno = $_POST["tellno"];
$pass1 = $_POST["pass1"];
$zip = $_POST["zip"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];

$addr = $addr1.$addr2.$addr3;




require_once 'DB.php';

$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}



$sql = 'select * from account';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}


print('<br>データを追加します。<br><br>');

$sql = "update account set accname=?, pw=?, mail=?, sex=?, zip=?, address=?, phone=? where acccode=?";
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($uname,$pass1,$email,$sex,$zip,$addr,$tellno);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}



$sql = 'select * from account';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}



$db->disconnect();

?>

</body>
</html>