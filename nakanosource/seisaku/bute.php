<?PHP
ini_set( "display_errors", "Off");

$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//フラグ変数領域
$wflag = 0;



$dsn = 'mysql:dbname=adios;host=172.20.17.216';

try{
	$dbh = new PDO($dsn, $user, $password);
	  $dbh->query('SET NAMES utf8');
	//ユーザー取得用
	  if(isset($_COOKIE['email'])){
	  $sql = 'select accname from account where mail = ?';
	  $stmt = $dbh->prepare($sql);
	  $stmt -> execute(array($_COOKIE['email']));
	  $result = $stmt->fetch(PDO::FETCH_ASSOC);
	  $accname = $result['accname'];
	  $acflag = 1;
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
	  


if(isset($_GET["word"])){
$word = htmlspecialchars($_GET["word"], ENT_QUOTES,"UTF-8");
$wflag = 1;
}
if(isset($_GET["kind"])){
$kind = htmlspecialchars($_GET["kind"], ENT_QUOTES,"UTF-8");

}
if($wflag == 0){


$sql = 'select goods.dispflag,goods.goods,goods.kind,goods.size,stock.stock,stock.price from goods left outer join stock on  goods.stockcode = stock.stockcode where kind = \'\ブーツ\' ';


$word = '%'.$word.'%';
$kind = '%'.$kind.'%';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($word,$kind));

$disp=1;


}else if($wflag == 1){
//検索ワードの変数をwordと設定する。wflagというフラグが１の時検索を実行。


$sql = 'select goods.dispflag,goods.goods,goods.kind,goods.size,stock.stock,stock.price from goods left outer join stock on  goods.stockcode = stock.stockcode where kind = \'ブーツ\' and goods like ? ';


$word = '%'.$word.'%';
//$kind = '%'.$kind.'%';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($word));

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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<!--<script type="text/javascript">
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
</script>-->

</script>

<title>ADIOS_ONLINE_SHOP</title>
</head>
<body>
<div id="top">
   <div id="headWrap">
      <div id="header">
         <h1><a href="index.html"><img src="../img/images/logo.png" alt="" /></a></h1>
         <div id="pr">
            <p>アディオスシューズオンライン</p>
         </div>
         <div id="gnavi">
            <ul>
             <?php if($acflag != 0){ print($accname."様");}else{print("ログインされていません。");?>
            <a href="login.php">ログインはこちらをクリック。</a><?php } ?><br> 
            <form name="searchform1" id="searchform1" method="get" action="bute.php">
			<input name="word" id="keywords1" value="" type="text" />
			<input type="image" src="../img/images/btn1.gif" alt="検索" name="searchBtn1" id="searchBtn1" />
            <input type="submit" value="詳細検索" />
			</form>           
            </ul>
         </div>
      </div><!-- /#header -->
   </div><!-- /#headWrap -->
   <div id="menu">
      <ul>
         <li class="home">
         <a href="http://localhost/aso/kaiintouroku.php">新規登録</a></li>
         <li><a href="sample1.html">ログイン</a></li>
         <li><a href="sample2.html">ご利用案内</a></li>
         <li><a href="sample3.html">カートを見る</a></li>
         <li><a href="sample4.html">その他（補足的な？）</a></li>
         <!--<li><a href="index.html">u</a></li>--> 
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents">

<ul class="ul-list-02">  
<h2>商品カテゴリ1の商品詳細分類1 [商品掲載サンプル]</h2>  
<?PHP
if($disp == 0){
	print('phase:no item');
}else{
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

if($result['dispflag'] == 0){

}else{
?><!-- //商品情報 -->  
<li>  
<dl>  
<dt><a href="#"><img src="image.jpg" alt="" width="" height="" /></a></dt>  
<dd>商品名<?php print($result['goods']); ?></dd>  
<dd>価格：&yen;<?php print($result['price'])?></dd>
<dd>サイズ:<?php print($result['size']); ?> 
<dd>在庫数:<?php print($result['stock']); ?>
<dd><a href="#">商品詳細ページ</a></dd>  
<dd><a href="#"><img src="../img/images/buy.jpg" alt="ショッピングカート" /></a></dd>  
</dl>  
</li>  
<!-- // 商品情報 -->  
<?php
}
}
}
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

//mysql_close($link); //close command



?>

