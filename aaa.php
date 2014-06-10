<html>
<head><title>PHP TEST</title></head>
<body>

<?php
$uname = $_POST["uname"];
$email = $_POST["email"];
$sex = $_POST["sex"];
$tellno = $_POST["tellno"];
$pass = $_POST["pass1"];
$zip = $_POST["zip"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];




require_once 'DB.php';

$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

print('接続に成功しました<br>');



$sql = 'select * from test';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
    print($row->id);
    print($row->pass);
    print($row->name.'<br>');
}

print('<br>データを追加します。<br><br>');

$sql = "insert into test (id,pass,name) VALUES (?,?,?)";
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($uname,$email,$tellno);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

print('<br>追加後のデータを取得します。<br><br>');

$sql = 'select * from test';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
    print($row->id);
    print($row->name.'<br>');
}

$db->disconnect();

?>

</body>
</html>