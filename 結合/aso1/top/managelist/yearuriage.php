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
         <li><a href="cart.php">カートを見る</a></li>
         <li><a href="sample4.html">利用規約</a></li>
         <!--<li><a href="index.html">u</a></li>--> 
        </ul>
   </div><!-- /#menu -->
   
   <div id="contents"><!--ココにソースを書いていく-->

<ul class="ul-list-02">  
<?php
$year = $_POST["year"];
$year2 = $year + 1;

$start = "'$year-04-01'";
$finish = "'$year2-03-31'";
$outsum='0';//出力用変数
$outgoods='売上なし';//出力用変数
$flg='0';//売上があったかなかったかのflag　あったら１　なかったら０

$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';
try{
	$dbh = new PDO($dsn, $user, $password);
		  $dbh->query('SET NAMES utf8');


$sql = ('select sum(volume*price) as sum from detail join goods on detail.goodscode=goods.goodscode join stock on goods.stockcode=stock.stockcode join buy on detail.ordercode=buy.ordercode where buy.date >= ? and buy.date <= ?');
$stmt=$dbh->prepare($sql);
$stmt->execute(array($start,$finish));

echo '<h3>',$year,'年度の売上は';

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $outsum=($result['sum']);
}
if($outsum==''){//select文でレコードが１件も取れなかったときの処理
$outsum='0';//合計金額が0であることを明示
$flg='0';//売上がないから。
}
print($outsum.'円です。</h3>');

echo '<br><br>';
$sql = ('select goods.goods, sum(volume*price) as sum from detail join goods on detail.goodscode=goods.goodscode join stock on goods.stockcode=stock.stockcode join buy on detail.ordercode=buy.ordercode where buy.date >= ? and buy.date <= ? GROUP BY goods.goods');
$stmt=$dbh->prepare($sql);
$stmt->execute(array($start,$finish));

echo '<table border=4>';
echo '<tr bgcolor="#cccccc">';
echo '<th colspan=2>';
echo $year,'年度の商品別売上';
echo '</th></tr>';

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<tr><td>';
	echo(($result['goods']));
	echo '</td><td>';
    echo(($result['sum']));
	echo '円</td></tr>';
}
if($flg=='0'){//売上がなかったときの処理（これがないと売上がないとき　テーブルのヘッダだけが表示され非常に不自然。
	print ('<tr><td>');
	print($outgoods);
	print ('</td><td>');
    print($outsum);
	print ('円</td></tr>');
}
echo '</table>';
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}



?>
<p><input type="button" value="戻る" onClick="location.href='syuukeitop.php'"></p>
<p><input type="button" value="管理者機能リストに戻る" onClick="location.href='managelist.php'"></p>
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
