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
<script type="text/javascript" src="/aso/js/jquery-1.5.2.min.js"></script>
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
$host = 'enzerus.com';
$user = 'adios';
$password = 'lovelive';
//$db = 'adios';


$dsn = 'mysql:dbname=adios;host=enzerus.com';




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


?>
<div id="top">
   <div id="headWrap">
      <div id="header">
         <h1><a href="./top_page.php"><img src="../img/images/logo.png" alt="" /></a></h1>
         <div id="pr">
            <p>アディオスシューズオンライン</p>
         </div>
         <div id="gnavi">
            <ul>
            <li>ようこそ、<?php print($name); ?>様</li><br> 
            <form name="searchform1" id="searchform1" method="get" action="#">
			<input name="keywords1" id="keywords1" value="" type="text" />
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
         <li><a href="sample2.html">ご利用案内</a></li>
         <li><a href="sample3.html">カートを見る</a></li>
         <li><a href="sample4.html">利用規約</a></li>
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents">
   <div id="viewer">
	<img src="../img/top_page_shoes/shoes.jpeg" width="700" height="450" alt="" />
	<img src="../img/top_page_shoes/shoes2.jpeg" width="700" height="450" alt="" />
	<img src="../img/top_page_shoes/shoes3.jpeg" width="700" height="450" alt="" />
	<img src="../img/top_page_shoes/shoes4.jpeg" width="700" height="450" alt="" />
	</div><!--/#viewer-->

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
      <div id="pageTop">
         <a> </a>
      </div><!-- /#pageTop -->
   </div><!-- /#contents -->
   <div id="footer">
      <div id="footMenu">
         <ul>
            <li><a href="sumple1.html">会社概要</a></li>
            <li><a href="sumple2.html">お問い合わせ</a></li>
            <li><a href="sumple3.html">プライバシーポリシー</a></li>
         </ul>
      </div><!-- /#footerMenu -->
      <div class="copyright">Copyright c 2014 Adios, Inc. All rights reserved</div>
   </div><!-- /#footer -->
</div><!-- /#top -->
</body>
</html>