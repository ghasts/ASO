<?PHP
ini_set( "display_errors", "Off");

$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';

//メニュー弄るのに使います
//$name=null;
$pathreg=null;
$pathacc=null;
$logreg=null;
$logacc=null;
$imgpath='#';//画像のファイルﾊﾟｽが入ります
//フラグ変数領域
$acflag=0;
session_start();

$Fkind = "ビジネスシューズ";
//大元のフラグを設定することにより、sqlの見栄え、変更のしやすさを向上。


try{
	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');
	  //ユーザー取得用
	  if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
		  $sql = 'select accname,pw from account where mail = ?';
		  $stmt = $dbh->prepare($sql);
		  $stmt -> execute(array($_COOKIE['email']));
		  $result = $stmt->fetch(PDO::FETCH_ASSOC);
		  if(MD5($result['pw']) == $_COOKIE['password']){
			  $accname = $result['accname'];
			  $acflag = 1;
			  }else{
			  $acflag = 0;
			  setcookie("email","",time() - 3600);
			  setcookie("password","",time() - 3600);
			  session_destroy();
		  }
	  }else if(isset($_SESSION['acccode'])){
		  $sql = 'select accname from account where acccode = ?';
		  $stmt = $dbh->prepare($sql);
		  $stmt -> execute(array($_SESSION['acccode']));
		  $result = $stmt->fetch(PDO::FETCH_ASSOC);
		  $accname = $result['accname'];
		  $acflag = 1;
	  }else{
	  	  $acflag = 0;
  	  }

	  if($acflag==1){//ログイン維持状態
		$pathreg="\"/aso/top/nakano/login.php\"";
		$logreg="アカウント操作";
		$pathacc="\"/aso/top/nakano/logout.php\"";
		$logacc="ログアウト";
	  }else{//ログアウト状態
		$pathreg="\"/aso/topnakano/kaiintouroku.php\"";
		$logreg="新規登録";
		$pathacc="\"/aso/top/nakano/adios.php\"";
		$logacc="ログイン";

	  }




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="../../css/page.css" type="text/css" />
<link rel="stylesheet" href="../../css/buy.css" type="text/css" />

<title>ADIOS_ONLINE_SHOP</title>
</head>
<body>
<div id="top">
   <div id="headWrap">
      <div id="header">
         <h1><a href="/aso/top/top_page.php"><img src="../../img/images/logo.png" alt="" /></a></h1>
         <div id="pr">
            <p>アディオスシューズオンライン</p>
         </div>
         <div id="gnavi">
            <ul>
            <?php if($acflag == 1){ print('こんにちは、'.$accname."様");}else{print("ログインされていません。");?>
            <a href="/aso/top/nakano/adios.php">ログインはこちらをクリック。</a><?php } ?><br> 
            <form name="searchform1" id="searchform1" method="get" action="sneakers.php">
			<input name="word" id="keywords1" value="" type="text" />
			<input type="image" src="../../img/images/btn1.gif" alt="検索" name="searchBtn1" id="searchBtn1" />
        <!--    <input type="submit" value="詳細検索" />-->
			</form>           
            </ul>
         </div>
      </div><!-- /#header -->
   </div><!-- /#headWrap -->
   <div id="menu">
      <ul>
         <li class="home">
         <a href=<?php print($pathreg); ?>><?php print($logreg) ?></a></li>
         <li><a href=<?php print($pathacc); ?>><?php print($logacc); ?></a></li>
         <li><a href="/aso/top/top_page.php">トップページ</a></li>
         <li><a href="sample3.html">カートを見る</a></li>
         <li><a href="sample4.html">利用規約</a></li>
         <!--<li><a href="index.html">u</a></li>--> 
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents"><!--ココにソースを書いていく-->

<ul class="ul-list-02">  
<?php

$goods=$_POST["goods"];
$kind=$_POST["kind"];
$price=$_POST["price"];
$size=$_POST["size"];
$descript=$_POST["descript"];
$stockcode='';
$kindt='';
$goodsm=99999999;//stockcodeに仮に入れる値。



		$sql = 'SELECT kind from kind where kindcode =?';
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array($kind));

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $kindt=$result['kind'];
		
		}
		

		/*	  どっかで。

		$sql = ('SELECT max(goodscode) as maxx from goods');
		$stmt = $dbh->prepare($sql);
		$stmt -> execute(array());


		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $goodsm=($result['maxx']);
		
		}*/
$filepath = 'C:/xampp/htdocs/aso/images/';
$upfile = $filepath.basename($_FILES['userfile']['name']);
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile)){
print(basename($_FILES['userfile']['name']).'のアップロードが正常に行われました。');

}else{
print('失敗');
}
$upfile=substr($upfile,15);
    $sql = "insert into goods (goods,kind,descript,stockcode,price,images,kindcode) VALUES (?,?,?,?,?,?,?)";
$stmt = $dbh->prepare($sql);
$stmt->execute(array($goods,$kindt,$descript,$goodsm,$price,$upfile,$kind));

$sql = ('SELECT max(goodscode) as maxx from goods');
$stmt = $dbh->prepare($sql);
$stmt -> execute(array());


while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
 $goodsm=($result['maxx']);

}
$sql = ('update goods set stockcode = ? where goodscode = ?');
$stmt = $dbh->prepare($sql);
$stmt->execute(array($goodsm,$goodsm));

for($cnt=1; $cnt<=5; $cnt++){
$sql = "insert into stock (stockcode,sizecode) VALUES (?,?)";
$stmt = $dbh->prepare($sql);
$stmt->execute(array($goodsm,$cnt));
}

$sql = 'select goods.stockcode as stkcode,goodscode,goods,kind,descript,FORMAT(price,0) as pri,size from goods join stock on goods.stockcode=stock.stockcode join size on size.sizecode = stock.sizecode order by stkcode asc,size asc';
$stmt = $dbh->prepare($sql);
$stmt->execute(array());
print('<p>商品追加が完了しました。 ※サイズ毎に在庫の集計をしています。</p><table border="1">');
print('<tr><th>型番</th><th>商品名</th><th>分類</th><th>商品説明</th><th>価格</th><th>サイズ</th></tr>');
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	//$stockcode=($result['stkcode']);
	//$size=($result['size']);
	print('<tr>');
	print('<td>'.$result['goodscode'].'</td>');
    print('<td>'.$result['goods'].'</td>');
	print('<td>'.$result['kind'].'</td>');
	print('<td>'.$result['descript'].'</td>');
	print('<td>'.$result['pri'].'</td>');
	print('<td>'.$result['size'].'</td></tr>');
}

print('</table><form action="../top_page.php" method="post"><input type="submit" value="トップページに戻る" /></form>');
print('<form action="goodsmanage.php" method="post"><input type="submit" value="商品追加・在庫追加画面に戻る" /></form>');
?>

</ul>  
   <!--<div id="viewer">
	<img src="../img/top_page_shoes/shoes.jpeg" width="700" height="450" alt="" />
	<img src="../img/top_page_shoes/shoes2.jpeg" width="700" height="450" alt="" />
	<img src="../img/top_page_shoes/shoes3.jpeg" width="700" height="450" alt="" />
	<img src="../img/top_page_shoes/shoes4.jpeg" width="700" height="450" alt="" />
	</div>--><!--/#viewer-->
	
      <div id="sub">
         <div class="section">
            <h2>カテゴリから探す</h2>
           <ul>
               <li><a href="../sneakers.php">スニーカー</a></li>
               <li><a href="../sandals.php">サンダル</a></li>
               <li><a href="../rezer.php">レザーシューズ</a></li>
               <li><a href="../business.php">ビジネスシューズ</a></li>
               <li><a href="../rofer.php">ローファー</a></li>
               <li><a href="../panpus.php">パンプス</a></li>
               <li><a href="../bute.php">ブーツ</a></li>
               <li><a href="../sport.php">スポーツシューズ</a></li>
               <li><a href="../walk.php">ウォーキング</a></li>
               <li><a href="../kids.php">キッズ</a></li>
         </ul>
         </div><!-- /.section -->
       </div><!-- /#sub -->
       
      <div id="pageTop"><!---->
       <a> </a>
      </div><!-- /#pageTop -->
   </div><!-- /#contents -->
   <div id="footer">
      <div id="footMenu">
         <ul>
            <li><a href="sample1.html">会社概要</a></li>
            <li><a href="sample2.html">お問い合わせ</a></li>
            <li><a href="sample3.html">プライバシーポリシー</a></li>
         </ul>
      </div><!-- /#footerMenu -->
      <div class="copyright">Copyright c 2014 Adios, Inc. All rights reserved</div>
   </div><!-- /#footer -->
</div><!-- /#top -->
</body>
</html>
<?php

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
$dbh = null;
//mysql_close($link); //close command



?>


























