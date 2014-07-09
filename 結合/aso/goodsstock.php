<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>追加</title>
</head>
<body>
<?php
require_once 'DB.php'; 

$goods=$_POST["goods"];
$volume=$_POST["volume"];
$stockcode='';
$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}


try{
//$dbh = new PDO($dsn, $user, $password);
$sql = 'select stockcode from goods where goods =\''.$goods.'\'';
print($sql);
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}


while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
        $stockcode=$row->stockcode;
        print($row->stockcode);
    }
print('ああああ'.$stockcode.'ああああ');
    $sql = "update stock set stock = stock + ? where stockcode = ?";
    
$stmt = $db->prepare($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$data = array($volume,$stockcode);
$db->execute($stmt, $data);




$sql = 'select * from stock';

$res = $db->query($sql);
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
	print('stockcode:'.$row->stockcode);
    print(' stock:'.$row->stock);
	print(' price:'.$row->price);
	print('<br>');
}

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>
</body>
</html>