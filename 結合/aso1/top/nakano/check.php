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

<title>フォーム内容確認</title>
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
<h1>入力した情報の確認</h1>
<p>内容を確認してください。</p>
<?php
// 入力値の取得
$uname = $_POST["uname"];
$email = $_POST["email"];
$sex = $_POST["sex"];
$tellno = $_POST["tellno"];
$pass1 = $_POST["pass1"];
$zip = $_POST["zip"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];

?>
<form method="POST" action="submit.php">
  <table border="1">
    <tr>
      <td>お名前</td>
<!-- 入力内容の確認表示 -->
      <td><?php echo $uname; ?></td>
    </tr>

	<tr>
		<td>性別</td>
		<td><?php echo $sex; ?></td>
	</tr>

    <tr>
      <td>メールアドレス</td>
      <td><?php echo $email; ?></td>
    </tr>
    <tr>
      <td>郵便番号</td>
      <td><?php echo $zip; ?></td>
    </tr>
	<tr>
	  <td>都道府県 市区群</td>
	  <td><?php echo $addr1; ?></td>
	</tr>
	<tr>
	  <td>町村番地（建物名）</td>
	  <td><?php echo $addr2; ?> <?php echo $addr3; ?></td>
	</tr>
	<tr>
	  <td>お電話番号</td>
	  <td><?php echo $tellno; ?></td>
	</tr>
    <tr>
      <td colspan="2">
<input type="hidden" name="pass1" value="<?php echo $pass1; ?>">
        <input type="submit" name="sub1" value="送信する">
      </td>
    </tr>
  </table>
<!-- hiddenフィールド -->
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="sex" value="<?php echo $sex; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="pass1" value="<?php echo $pass1; ?>">
<input type="hidden" name="zip" value="<?php echo $zip; ?>">
<input type="hidden" name="addr1" value="<?php echo $addr1; ?>">
<input type="hidden" name="addr2" value="<?php echo $addr2; ?>">
<input type="hidden" name="addr3" value="<?php echo $addr3; ?>">
<input type="hidden" name="tellno" value="<?php echo $tellno; ?>">

</form>

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
