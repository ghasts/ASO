<html>
<head><title>PHP TEST</title></head>
<body>

<?php
$uname = $_POST["uname"];
require_once 'DB.php';

$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

print('接続に成功しました<br>');

//$db->query('SET NAMES sjis');
//if (PEAR::isError($db)) {
//    die($db->getMessage());
//}

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

$data = array($uname,'my', 'エアコン');
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array('ccc','sql', '扇風機');
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array('ddd','php', '空気清浄機');
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