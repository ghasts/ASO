<?PHP

$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';


$dsn = 'mysql:dbname=adios;host=172.20.17.216';

print('phase:DB::OK<br>');


try{
	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');
print($_GET["word"]);
if(isset($_GET["word"])){
$word = htmlspecialchars($_GET["word"], ENT_QUOTES);
}
if(isset($_GET["category"])){
$category = htmlspecialchars($_GET["category"], ENT_QUOTES);
}
if(true){
//検索ワードの変数をwordと設定する。


$sql = ('SELECT * from goods where goods like \'%?\'');

$stmt = $dbh->prepare($sql);
print('phase:1');
$stmt -> execute(array($word));
print($sql);
/*
$sql = ('SELECT * from goods where kind =? ');
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($category));
*/
$disp=0;
}else{
$disp = 1;
}


?>
<!doctype html>
<html>
<head>

</head>
<body>

<form method="get" action="goods.php">

<input type="text" name="word">
<input type="submit" value="検索">


</form>

<?PHP
if($disp == 1){
	print('phase:no item');
}else{
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
if($result['dispflag'] == 0){

}
?>
<p>
商品名:<?php print($result['goods']); ?>
サイズ:<?php print($result['size']); ?>
在庫数:<?php print($result['stockcode']); ?>
カテゴリー:<?php print($result['kind']); ?>
</p><br>


<?php
}
}
?>
</body>
</html>

<?php

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

//mysql_close($link); //close command



?>

