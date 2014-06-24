<?php
session_start();
if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
print('どうやらログインされているようです。');
print($_COOKIE["email"].'さんではないですか？');
}else if(isset($_POST["email"]) || isset($_POST["password"])){


if(isset($_COOKIE["email"])){
$_POST['email'] = $_COOKIE['email'];
$_POST['password'] = $_COOKIE['password'];
$_POST['save'] = 'on';
$mail = htmlspecialchars($_POST["email"], ENT_QUOTES);
$pass = htmlspecialchars($_POST["password"], ENT_QUOTES);
$dbset = $mail;

//クッキーにメールアドレスが保存されているとき？
}else if(isset($_POST["email"]) && isset($_POST["password"])){

$mail = htmlspecialchars($_POST["email"], ENT_QUOTES);
$pass = htmlspecialchars($_POST["password"], ENT_QUOTES);
//print('moto:'.$mail.'<BR>'.$pass.'<BR>');

$dbset = $mail;
$pass = MD5($pass);

//ここでは通常通りに取ってくる。




//ここはまだまだですよー。一応クッキーへの保存への対処です。
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';


$dsn = 'mysql:dbname=adios;host=172.20.17.216';




try{
	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');

/*	  
$sql = 'select acccode,accname,pw,mail from account';
$stmt = $dbh->query($sql);
*/

$sql = ('SELECT acccode,accname,pw,mail from account where mail =?');
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($mail));

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
 $mailadd = ($result['mail']);
 $password = ($result['pw']);
 $name = ($result['accname']);
 $acccode = ($result['acccode']);
}

if($mailadd == $mail and MD5($password) == $pass){
print('ログイン成功..ようこそ'.$name.'さん！　<BR>');

session_regenerate_id(TRUE);
$_SESSION['acccode'] = $acccode;

if(isset($_POST['save'])){
//ﾁｪｯｸボックスにONが入っていたときに保存するような処理ですねこれ。
print('今後のログインは７日間保存されます。');
setcookie('email',$mail,time()+60*60*24*7);
setcookie('password',$pass,time()+60*60*24*7);



}else{
print('ログイン情報は保存されませんでした！');

}
}else{

print('ログイン失敗です。');

if(isset($_COOKIE["email"]) and isset($_COOKIE["password"])){
setcookie("email","",time() - 3600);
setcookie("password","",time() - 3600);


}
}
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

//mysql_close($link); //close command

$dbh = null;
//else 占め
}else{
print("うぉーにん！不正なアクセスが行われました。");


}



}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<head>

</head>
<body>
<input type="button"   value="ログアウト" onClick="location.href='/oresource/logout.php'">
<input type="button" value="会員情報の変更" onClick="location.href='/oresource/ac/henkou.php'">
<input type="button" value="検索画面" onClick="location.href='/oresource/goods.php'
">



</body>
</html>
