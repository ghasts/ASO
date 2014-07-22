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
$wflag = 0;
$acflag=0;
session_start();

$Fkind = "ブーツ";
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
		$pathreg="\"nakano/login.php\"";
		$logreg="アカウント操作";
		$pathacc="\"nakano/logout.php\"";
		$logacc="ログアウト";
	  }else{//ログアウト状態
		$pathreg="\"./nakano/kaiintouroku.php\"";
		$logreg="新規登録";
		$pathacc="\"nakano/adios.php\"";
		$logacc="ログイン";

	  }



if(isset($_GET["word"])){
$word = htmlspecialchars($_GET["word"], ENT_QUOTES,"UTF-8");
$wflag = 1;
}
if(isset($_GET["kind"])){
$kind = htmlspecialchars($_GET["kind"], ENT_QUOTES,"UTF-8");
}
if($wflag == 0){


$sql = "select goods.dispflag,goods.goodscode,goods.goods,goods.kind,goods.images,goods.price from goods where kind = ? ";


$word = '%'.$word.'%';
$kind = '%'.$kind.'%';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($Fkind));

$disp=1;


}else if($wflag == 1){
//検索ワードの変数をwordと設定する。wflagというフラグが１の時検索を実行。


$sql = "select goods.dispflag,goods.goodscode,goods.goods,goods.kind,goods.images,goods.price from goods where kind = ? and goods like ? ";


$word = '%'.$word.'%';
//$kind = '%'.$kind.'%';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($Fkind,$word));

$disp=1;

}else{
$disp = 0;
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
<link rel="stylesheet" href="../css/top_page.css" type="text/css" />
<link rel="stylesheet" href="../css/buy.css" type="text/css" />

<title>ADIOS_ONLINE_SHOP</title>
</head>
<body>
<div id="top">
   <div id="headWrap">
      <div id="header">
         <h1><a href="./top_page.php"><img src="../img/images/logo.png" alt="" /></a></h1>
         <div id="pr">
            <p>アディオスシューズオンライン</p>
         </div>
         <div id="gnavi">
            <ul>
            <?php if($acflag == 1){ print('こんにちは、'.$accname."様");}else{print("ログインされていません。");?>
            <a href="./nakano/adios.php">ログインはこちらをクリック。</a><?php } ?><br> 
            <form name="searchform1" id="searchform1" method="get" action="sneakers.php">
			<input name="word" id="keywords1" value="" type="text" />
			<input type="image" src="../img/images/btn1.gif" alt="検索" name="searchBtn1" id="searchBtn1" />
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
         <li><a href="/aso/top/cart.php">カートを見る</a></li>
         <li><a href="sample4.html">利用規約</a></li>
         <!--<li><a href="index.html">u</a></li>--> 
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents">

<ul class="ul-list-02">  
<h2>商品カテゴリ1の商品詳細分類1 [商品掲載サンプル]</h2><!-- //商品情報 -->  
<?PHP
if($disp == 0){
	print('phase:no item');
}else{
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){//ココから商品の表示--------------------------------------------------------------------------------------
//↓,↑のもとになるselect文
//$sql = "select goods.dispflag,goods.goodscode,goods.goods,goods.kind,goods.images,goods.price from goods where kind = ? ";(wflag==0
//$sql = "select goods.dispflag,goods.goodscode,goods.goods,goods.kind,goods.images,goods.price from goods where kind = '$Fkind' and goods like ? ";(wflag==1
if($result['dispflag'] == 0){
}else{
?>
<li>  
<dl>  
<dt><a href="#"><img src=<?php print('"'.($result['images']).'"'); ?> alt="" width="175" height="100" /></a></dt>  
<dd>商品名<?php print($result['goods']); ?></dd>  
<dd>価格：&yen;<?php print($result['price'])?></dd>
<dd><a href="details_of_goods.php?gcode=<?php print($result['goodscode'])   ?>">商品詳細ページ</a></dd>  
<dd><a href="#"><img src="../img/images/buy.jpg" alt="ショッピングカート" /></a></dd>  
</dl>  
</li>  
<!-- // 商品情報 -->  
<?php
}//if($result['dispflag'] == 0){の閉じ
}//while($result = $stmt->fetch(PDO::FETCH_ASSOC)){の閉じ----------------------------------------------------------------------------------------------------
}//if($disp == 0){の閉じ
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
               <li><a href="sneakers.php">スニーカー</a></li>
               <li><a href="sandals.php">サンダル</a></li>
               <li><a href="rezer.php">レザーシューズ</a></li>
               <li><a href="business.php">ビジネスシューズ</a></li>
               <li><a href="rofer.php">ローファー</a></li>
               <li><a href="panpus.php">パンプス</a></li>
               <li><a href="bute.php">ブーツ</a></li>
               <li><a href="sport.php">スポーツシューズ</a></li>
               <li><a href="walk.php">ウォーキング</a></li>
               <li><a href="kids.php">キッズ</a></li>
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

