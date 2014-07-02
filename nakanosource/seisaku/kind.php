<?PHP

$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//フラグ変数領域
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
$sql = 'select * from goods where goods like ? and kind like ?';

$word = '%'.$word.'%';
$kind = '%'.$kind.'%';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($word,$kind));

$disp=1;


}else if($wflag == 0){
//検索ワードの変数をwordと設定する。wflagというフラグが１の時検索を実行。



$sql = 'select * from goods where kind like ?';


$kind = '%'.$kind.'%';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($kind));

$disp=1;

}else{
$disp = 0;
}


?>



<!doctype html>
<html>
<head>

</head>
<body>

<form method="get" action="/oresource/kind.php">

<input type="hidden" name="kind" value="<?php if(isset($_GET['tkind']) == 1){ print($_GET['tkind']); } ?>">
<input type="text" name="word">
<input type="submit" value="検索">


</form>
<a href="/oresource/kind.php?word=スニーカー">スニーカー</a>


検索ワード:<?php if(isset($_GET['word']) == 1){ print($_GET['word']);   }?><br>
<?PHP
if($disp == 0){
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

//mysql_close($link); //close command



?>

