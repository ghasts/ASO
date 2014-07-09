<?php
session_start();
session_regenerate_id(TRUE);
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';
$mail = null;
$acccode=null;
$flg = null;

$dsn = 'mysql:dbname=adios;host=172.20.17.216';


if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
	//print('ログイン状態が維持されています。');
	//print($_COOKIE["email"].'さんではないですか？');
	$mail=$_COOKIE["email"];
	try{
		$dbh = new PDO($dsn, $user, $password);
		  $dbh->query('SET NAMES utf8');

	$sql = ('SELECT acccode,accname,pw,mail from account where mail =?');
	$stmt = $dbh->prepare($sql);
	$stmt -> execute(array($mail));

	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	 $acccode = ($result['acccode']);
	}


	$_SESSION['acccode'] = $acccode;
	}catch (PDOException $e){
		    print('Error:'.$e->getMessage());
		    die();
	}
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
		//print('ようこそ'.$name.'さん！　<BR>');


			$_SESSION['acccode'] = $acccode;

			if(isset($_POST['save'])){
				//ﾁｪｯｸボックスにONが入っていたときに保存するような処理ですねこれ。
				//print('今後のログインは７日間保存されます。');
				setcookie('email',$mail,time()+3600*24*7,'/aso');
				setcookie('password',$pass,time()+3600*24*7,'/aso');
				header("Location: ../top_page.php");


			}else{
				header("Location: ../top_page.php");
				//print('ログイン情報は保存されませんでした！');クッキー無効のとき

			}
		}else{

			print('ログインされていません。');

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

<?php
if(isset($_SESSION['acccode'])){
$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';
$dsn = 'mysql:dbname=adios;host=172.20.17.216';
try{
	
	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');

$sql = ('SELECT mflg from account where acccode =?');
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($_SESSION['acccode']));

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
 $flg = ($result['mflg']);
}
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
print('<br>');
print('<input type="button" value="ログアウト" onClick="location.href=\'logout.php\'">');
print('<input type="button" value="会員情報の変更" onClick="location.href=\'henkou.php\'">');
print('<input type="button" value="検索画面" onClick="location.href=\'goods.php\'">');
if($flg=='1'){
print('<input type="button" value="管理者機能" onClick="location.href=\'../managelist/managelist.php\'">');
}
}

?>
<form action="../top_page.php" method="POST">
<input type="submit" value="トップページへ戻る">
</form>
</body>
</html>
