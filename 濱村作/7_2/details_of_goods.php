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

<?php
require_once 'DB.php';

$dsn ='mysqli://adios:lovelive@172.20.17.216/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
	die($db->getmessage());
}

$sql = 'select * from goods';
$res = & $db->query($sql);
if (PEAR::isError($res))  {
	die($res->getMessage());

}
?>
<div id="top">
   <div id="headWrap">
      <div id="header">
         <h1><a href="index.html"><img src="../img/images/logo.png" alt="" /></a></h1>
         <div id="pr">
            <p>アディオスシューズオンライン</p>
         </div>
         <div id="gnavi">
            <ul>
            <li>ようこそゲスト（顧客名）様</li><br> 
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
		<h2>商品名(サンプル)</h2> 
			<div id="detail_Left">
			<img src="http://localhost/adios/img/top_page_shoes/shoes.jpeg" width="300" height="360" alt="sample" />
			</div><!-- /#detailLeft -->

			<div id="detail_Right1">
			<dl>   
			<dd>商品名</dd>  
			<dd>価格：&yen;200,000</dd>  
			<dd>サイズ：<select name="靴サイズ">
						<option value="sample">sample</option>
						<option value="sample2">sample2</option>
						<option value="sample3">sample3</option>
						</select>
			<dd><br> <a href="#"><img src="../img/images/buy.jpg" alt="ショッピングカート" /></a></dd>  
			</dl>			
			</div><!-- /#detailRight2 -->

			<div id="detail_Right2">
			<dl>
			<dd>[商品説明]</dd>
			<dd>サンプルでーーす。</dd>
			</div><!-- /#detailRight2 -->

		</div><!-- /#detail_customize -->

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