<?PHP

$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//初期化変数。
$wflag = 0;

$dsn = 'mysql:dbname=adios;host=172.20.17.216';

print('phase:DB::OK<br>');


try{
	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');

if(isset($_GET["word"])){
$word = htmlspecialchars($_GET["word"], ENT_QUOTES,"UTF-8");
$wflag = 1;
}
if(isset($_GET["kind"])){
$kind = htmlspecialchars($_GET["kind"], ENT_QUOTES,"UTF-8");

}
if($wflag == 1){
//検索ワードの変数をwordと設定する。


$sql = ('SELECT * from goods where goods like ?');

$stmt = $dbh->prepare($sql);
print('phase:1');

$word = "%".$word."%";

$stmt -> execute(array($word));
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

<form method="get" action="/oresource/seisaku/goods.php">

<input type="text" name="word">
<input type="submit" value="検索">


</form>
検索ワード:<?php if(isset($_GET['word']) == 1){ print($_GET['word']); } ?><br>
<?PHP
if($disp == 1){
	print('phase:no item');
}else{
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
if($result['dispflag'] == 0){

}else{
?>

商品名:<?php print($result['goods']); ?>

サイズ:<?php print($result['size']); ?>

在庫数:<?php print($result['stockcode']); ?>

カテゴリー:<?php print($result['kind']); ?>

<br>


<?php
}
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
$dbh=null;
//mysql_close($link); //close command



?>

