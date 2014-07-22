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
		$pathreg="\"/aso/top/nakano/kaiintouroku.php\"";
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
<link rel="stylesheet" href="/aso/css/top_page.css" type="text/css" />
<link rel="stylesheet" href="/aso/css/buy.css" type="text/css" />
<script language="javascript">
function change(set){
	quant = prompt("数を変更します。数値を入力してください。")
	if(quant <= 0){
	alert('正しい数を入れてください。削除の場合は削除ボタンをお願いします。');
	}else{
	var row = "cartgk[" +  set + "]" + "=" + quant + ";path=/";
	document.cookie = row;
	
	document.cart_form.submit();
	}
}
function dead(set){
	
	var gk = "cartgk[" +  set + "]" + "=" + "" + ";expires=Fri, 11-Nov-1999 11:11:11 GMT;path=/";
	//kazu!
	var gc = "cartgc[" +  set + "]" + "=" + "" + ";expires=Fri, 11-Nov-1999 11:11:11 GMT;path=/";
	//code
	var gsize = "cartgsize[" +  set + "]" + "=" + "" + ";expires=Fri, 11-Nov-1999 11:11:11 GMT;path=/";
	//size
	document.cookie = gk;
	document.cookie = gc;
	document.cookie = gsize;
	document.cart_form.submit();
	
}
function alldead(set){
	location.href="delete_cart.php";

}

</script>


<title>ADIOS_ONLINE_SHOP</title>
</head>
<body>
<div id="top">
   <div id="headWrap">
      <div id="header">
         <h1><a href="/aso/top/top_page.php"><img src="/aso/img/images/logo.png" alt="" /></a></h1>
         <div id="pr">
            <p>アディオスシューズオンライン</p>
         </div>
         <div id="gnavi">
            <ul>
            <?php if($acflag == 1){ print('こんにちは、'.$accname."様");}else{print("ログインされていません。");?>
            <a href="/aso/top/nakano/adios.php">ログインはこちらをクリック。</a><?php } ?><br> 
            <form name="searchform1" id="searchform1" method="get" action="sneakers.php">
			<input name="word" id="keywords1" value="" type="text" />
			<input type="image" src="/aso/img/images/btn1.gif" alt="検索" name="searchBtn1" id="searchBtn1" />
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
         <li><a href="cart.php">カートを見る</a></li>
         <li><a href="sample4.html">利用規約</a></li>
         <!--<li><a href="index.html">u</a></li>--> 
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents"><!--ココにソースを書いていく-->

<ul class="ul-list-02">  
<?php 


//フラグ変数領域
$wflag = 0;



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



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>cart</title>
</head>

<body>
<div>
<table border="1" align=center>
<tr bgcolor="#cccccc">
 
  <th>商品イメージ</th>
  <th>商品名</th>
  <th>価格</th>
  <th>サイズ</th>
  <th>数量</th>
  <th>小計</th>
  <th>削除</th>
  <th>カート内削除</th>
 </tr>
 
 <!-- カート ループ　ここから -->
 <form name="cart_form">
 <?php
 $sumall = 0;
 $count=0;
 

if(!(isset($_COOKIE['cartgc']))){
  print("カートには何も入ってないです。");
  
	}else{
// クッキーに商品の情報が入っているとき。
foreach ($_COOKIE['cartgc'] as $key => $value) {
	
$gsizeAr = $_COOKIE['cartgsize'];	
$gquantAr = $_COOKIE['cartgk'];
$gcode = $value;

//$gcode = $_COOKIE["cart[$value]"];
$gsize = "$gsizeAr[$key]";
$gquant = "$gquantAr[$key]";

$sql = 'select size.size,goods.dispflag,goods.goodscode,goods.goods,goods.descript,goods.kind,stock.stock,goods.price from size,goods left outer join stock on  goods.stockcode = stock.stockcode where goods.goodscode = ? and stock.sizecode =? and size.sizecode =?';
$stmt = $dbh->prepare($sql);
$stmt -> execute(array($gcode,$gsize,$gsize));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$count++;
 ?>
<tr>
	
	
	<th><?php print(""); ?> </th>
    <th><a href="details_of_goods.php?gcode=<?php print($result['goodscode']); ?>"><?php print($result['goods']); ?></a></th>
    <th>&yen;<?php $price = $result['price'];  print($result['price']);?></th>
    <th><?php print($result['size']."cm"); ?></th>
    <th> <?php print($gquant); ?> <input type="button" value="変更" onClick="change('<?php print($key); ?>')"></th>
    <th>&yen;<?php $sum = $price * $gquant; $sumall = $sumall + $sum; print($sum); ?></th>
	<th><input type="button" value="削除" onClick="dead('<?php print($key); ?>')"></th>
    <th><input type="button" value="ALL DELETE" onClick="alldead(0)"></th>
</tr> 
<?php


}

}
?>
<!--　カート　ループ　ここまで -->
<tr class="">
				  <td colspan="2">カートの商品数:<?php print($count)?></td>
                  <td colspan="4" align="right">商品合計</td>
                  <td colspan="2" align="right"><?php print($sumall)?>円</td>
                </tr>
  
</table>
</form>
</div>
<a href="./buy/memberorder.php">メンバー購入</a>

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
               <li><a href="/aso/top/sneakers.php">スニーカー</a></li>
               <li><a href="/aso/top/sandals.php">サンダル</a></li>
               <li><a href="/aso/top/rezer.php">レザーシューズ</a></li>
               <li><a href="/aso/top/business.php">ビジネスシューズ</a></li>
               <li><a href="/aso/top/rofer.php">ローファー</a></li>
               <li><a href="/aso/top/panpus.php">パンプス</a></li>
               <li><a href="/aso/top/bute.php">ブーツ</a></li>
               <li><a href="/aso/top/sport.php">スポーツシューズ</a></li>
               <li><a href="/aso/top/walk.php">ウォーキング</a></li>
               <li><a href="/aso/top/kids.php">キッズ</a></li>
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
