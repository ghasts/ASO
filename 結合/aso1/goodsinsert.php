<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<?php
require_once 'DB.php';

$goods=$_POST["goods"];
$kind=$_POST["kind"];
$price=$_POST["price"];
$size=$_POST["size"];
$descript=$_POST["descript"];
$stockcode='';
$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

try{
//    $dbh = new PDO($dsn, $user, $password);
$sql = 'select * from stock';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

    $sql = "insert into stock (price) values (?)";
    
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$data = array($price);
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$sql = 'select * from stock';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
//    print($row->stock);
	$stockcode=$row->stockcode;
    print($row->stockcode.'<br>');
}

    $sql = "insert into goods (goods,kind,size,stockcode) VALUES (?,?,?,?)";
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}

$data = array($goods,$kind,$size,'');
$db->execute($stmt, $data);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$sql = 'select * from goods';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
//    print($row->stock);
	$stockcode=$row->stockcode;
	
    print($row->goods);
	print($row->kind);
	print($row->size);
	print($row->stockcode.'<br>');
}


}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>
</body>
</html>