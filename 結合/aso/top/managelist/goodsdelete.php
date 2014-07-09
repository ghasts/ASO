<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PHP TEST</title>
</head>
<body>

<?php
$goodscode = $_POST["goods"];


require_once 'DB.php';


$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}






$sql = "update goods set dispflag = '0' where goodscode = $goodscode;";
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$sql = "select goods,size from goods where goodscode = $goodscode;";
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
echo "'$row->goods' '$row->size'の商品の情報の非表示化に成功しました。";

}


$db->disconnect();

?>
<p><input type="button" value="非表示化商品選択画面に戻る" onClick="location.href='deletedisplay.php'"></p>
<p><input type="button" value="管理者機能リストに戻る" onClick="location.href='managelist.php'"></p>
</body>
</html>




