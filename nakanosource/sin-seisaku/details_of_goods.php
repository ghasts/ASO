﻿<?PHP
//ini_set( "display_errors", "Off");

$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//フラグ変数領域
$wflag = 0;
session_start();


$dsn = 'mysql:dbname=adios;host=enzerus.com';

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





if(isset($_GET["gcode"])){
$gcode = htmlspecialchars($_GET["gcode"], ENT_QUOTES,"UTF-8");


$sql = 'select goods.dispflag,goods.goodscode,goods.goods,goods.descript,goods.kind,stock.stock,goods.price from goods left outer join stock on  goods.stockcode = stock.stockcode where goodscode = ?';

$stmt = $dbh->prepare($sql);
$stmt -> execute(array($gcode));

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
<link rel="stylesheet" href="../css/buy_details.css" type="text/css" />

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
         <a href="http://localhost/aso/kaiintouroku.php">新規登録</a></li>
         <li><a href="sample1.html">ログイン</a></li>
         <li><a href="sample2.html">ご利用案内</a></li>
         <li><a href="sample3.html">カートを見る</a></li>
         <li><a href="sample4.html">その他（補足的な？）</a></li>
         <!--<li><a href="index.html">u</a></li>--> 
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents">
      <div id="sub">
         <div class="section">
            <h2>カテゴリから探す</h2>
            <ul>
               <li><a href="../php/sneakers.php">スニーカー</a></li>
               <li><a href="../php/sandals.php">サンダル</a></li>
               <li><a href="../php/leather_shoes.php">レザーシューズ</a></li>
               <li><a href="sample4.html">ビジネスシューズ</a></li>
               <li><a href="sample5.html">ローファー</a></li>
               <li><a href="sample6.html">パンプス</a></li>
               <li><a href="sample7.html">ブーツ</a></li>
               <li><a href="sample8.html">スポーツシューズ</a></li>
               <li><a href="sample9.html">ウォーキング</a></li>
               <li><a href="sample10.html">キッズ</a></li>
　　　　　　　          </ul>
         </div><!-- /.section -->
       </div><!-- /#sub -->

      	<div id="detail_customize">
		<br>
        <?PHP
if($disp == 0){
	print('phase:no item');
}else{

if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
if($result['dispflag'] == 0){


}else{
	
?>
		<form action="cart.php" method="post">
        <!-- goods option -->
        <input type="hidden" name="goodscode" value="<?php print($result['goodscode'])?>">
        
        
        <!-- goods end -->
		<h2><?php print($result['goods'])?></h2> 
			<div id="detail_Left">
			<img src="http://g-ec2.images-amazon.com/images/G/09/kindle/dp/2013/KT/feature-wifi._V354909594_.jpg" width="300" height="360" alt="sample" />
			</div><!-- /#detailLeft -->

			<div id="detail_Right1">
			<dl>   
			<dd><input type="hidden" name="gname" value="<?php print($result['goods'])?>" />商品名:<?php print($result['goods']) ?></dd>  
			<dd>価格：&yen; <?php print($result['price'])?></dd>
            <dd>サイズ：<select name="goodssize">
<!-- サイズ 在庫loop -->
<?php
		  $sql2 = 'select stock.stock,size.size,size.sizecode from goods,stock,size where goods.stockcode = stock.stockcode and stock.sizecode = size.sizecode and goods.goodscode = ?';
		  $sizestmt = $dbh->prepare($sql2);
          $sizestmt -> execute(array($gcode));
		
          while($res = $sizestmt->fetch(PDO::FETCH_ASSOC)){

if($res['stock'] == 0){
	//在庫が0のときはoptionのdisableによる在庫なし表示。選択不可になります。
?>
<option value="0" disabled="disabled">在庫なし:<?php print($res['size'])?>cm</option>
<?php
}else{
	//在庫ありの商品のプルダウン。
?>

<option value="<?php print($res['sizecode'])?>"><?php print($res['size'])?>cm</option>

<?php
}
 }
						
?>			</select>
			<dd>数量:<input type="number" name="quant" min="1" value="1"/></dd>
			<dd><br> <input type="image" src="cart.jpg" alt="ショッピングカート"></dd>  
			</dd>
            </form>
            			
			</div><!-- /#detailRight2 -->

			<div id="detail_Right2">
			<dl>
			<dd>[商品説明]</dd>
			<dd><?php print($result['descript']) ?></dd>
			</div><!-- /#detailRight2 -->

		</div><!-- /#detail_customize -->
<?php
}
}
}
?>
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

