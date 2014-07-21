<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="../css/top_page.css" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    var setImg = '#viewer';
    var fadeSpeed = 3000;
    var switchDelay = 3500;
    $(setImg).children('img').css({opacity:'0'});
    $(setImg + ' img:first').stop().animate({opacity:'1',zIndex:'20'},fadeSpeed);
    setInterval(function(){
        $(setImg + ' :first-child').animate({opacity:'0'},fadeSpeed).next('img').animate({opacity:'1'},fadeSpeed).end().appendTo(setImg);
    },switchDelay);
});
</script>



<title>ADIOS_ONLINE_SHOP</title>
</head>
<body>
<?php
session_start();
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';


$dsn = 'mysql:dbname=adios;host=172.20.17.216';




try{
	$dbh = new PDO($dsn, $user, $password);
//	  $dbh->query('SET NAMES utf8');
$name=null;
$pathreg=null;
$pathacc=null;
$logreg=null;
$logacc=null;
//$acccode=null;
if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
$acccode=null;
	$sql = ('SELECT acccode from account where mail =?');
	$stmt = $dbh->prepare($sql);
	$stmt -> execute(array($_COOKIE["email"]));
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $acccode = ($result['acccode']);
	}
	$_SESSION['acccode'] = $acccode;
}
if(isset($_SESSION['acccode'])){
	$pathreg="\"nakano/login.php\"";
	$logreg="アカウント操作";
	$pathacc="\"nakano/logout.php\"";
	$logacc="ログアウト";

	$sql = ('SELECT accname from account where acccode =?');
	$stmt = $dbh->prepare($sql);
	$stmt -> execute(array($_SESSION['acccode']));

	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	 $name = ($result['accname']);
	}

}else{
$name="ゲスト";
$pathreg="\"./nakano/kaiintouroku.php\"";
$logreg="新規登録";
$pathacc="\"nakano/adios.php\"";
$logacc="ログイン";
}
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}




if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
print('ログイン状態が維持されています。');
print($_COOKIE["email"].'さんではないですか？');
print('<a href=\'../top_page.php\'>はい、そうです。</a>');
print('<a href=\'no.php\'>いいえ、違います。</a>');
}
?>
<form action="login.php" method="POST">

email:<input type="text" name="email"><br>
pass:<input type="text" name="password"><br>
<input type="checkbox" name="save" values="on"><br>
<input type="submit" value="ログイン">
</form>




</body>
</html>
