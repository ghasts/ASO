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
<script type="text/javascript">
<!--
function chkHissu(frm){
        /* 必須入力のname属性 */
        var hissu=Array("uname","sex","email","pass1","pass2","zip","addr1","addr2","tellno");
        /* アラート表示用 */
        var hissu_nm = Array("名前","性別","メールアドレス","パスワード","パスワード","郵便番号","都道府県 市区群","町村 番地","電話番号");
        /* 必須入力の数 */
        var len=hissu.length;
        for(i=0; i<len; i++){
            var obj=frm.elements[hissu[i]];
            /* テキストボックス or テキストエリアが入力されているか調べる */
            if(obj.type=="text" || obj.type=="textarea" || obj.type=="password"){
                if(obj.value==""){
                    /* 入力されていなかったらアラート表示 */
                    alert(hissu_nm[i]+"は必須入力項目です");
                    /* 未入力のエレメントにフォーカスを当てる */
                    frm.elements[hissu[i]].focus();
                    return false;
                }
            }else{
                /* radioボタンがチェックされているか調べる */
                for(var j=0, chk=0; j<obj.length; j++){
                    /* チェックされていたらchkフラグをプラス */
                    if(obj[j].checked) chk++;
                }
                if(chk==0){
                    /* 1つもチェックされていない場合はfalseを返してフォーム送信しない */
                    alert(hissu_nm[i]+"は必須入力項目です");
                    return false;
                }
            }
			

			if (!document.form1.email.value.match(/^[A-Za-z0-9]+[\w-]+@[\w\.-]+\.\w{2,}$/)){
			/*メールアドレスが不正の場合*/
			alert("メールアドレスをご確認ください。");
			return false;
			}

			if(document.form1.pass1.value.length < 8){
				/*パスワードが８文字以下の場合はfalseを返してフォームを送信しない */
				alert("パスワードの文字数が不正です");
				return false;
      		  }

			if(document.form1.pass1.value != document.form1.pass2.value){
				/*パスワードと確認用パスワードが一致しない場合はfalseを返してフォームを送信しない */
				alert("再確認用パスワードが一致しません");
				return false;
			}
			
		

            if(document.form1.tellno.value.length < 10 || document.form1.tellno.value.length >11){
				/*電話番号の桁が10または11でない場合*/
				alert("電話番号の桁が不正です");
				return false;
		}
}
        /* 必須入力項目が全て入力されている場合はtrueを返してフォーム送信 */
        return true;
    }
// -->
</script>

<title>新規登録</title>
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
	<h1>新規登録</h1>


<p>必要事項を入力して「確認する」ボタンをクリックしてください。</p>

	<form method="POST" action="check.php"onsubmit="return chkHissu(this)" name="form1" >
		<table border="1">
			<tr>
				<td>お名前</td>
				<td><input type="text" size = "30" name="uname"></td>
			</tr>
			<tr>
				<td>性別</td>
				<td>男<input type="radio" name="sex" value="男性">　女<input type="radio" name="sex" value="女性"></td>
			</tr>
			<tr>
				<td>メールアドレス</td>
				<td><input type="text" size="30" name="email">
				<br />
				（半角英数）（例）yamada@example.co.jp
				</td>
			</tr>
			<tr>
				<td>パスワード</td>
				<td><input type="password" size="30" name="pass1">
					<br />
					（8文字以上の半角英数記号）（例）1-kmb!ja</td>
			</tr>
			<tr>
				<td>パスワード再確認</td>
				<td><input type="password" size="30" name="pass2"></td>
			<tr>
	<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
			<tr>
				<td>郵便番号</td> 
				<td><input onkeyup="AjaxZip3.zip2addr(this,'','addr1','addr1','addr2','addr2');" name="zip" maxlength="7" type="text" />
				<br />（例）1000000
				</td>
			</tr>
			<tr>
				<td>都道府県 市区郡</td>
				<td><input name="addr1" size="30" type="text" />
				<br />（例）東京都新宿区
				</td>
			</tr>
			<tr>
				<td>町村番地</td>
				<td><input name="addr2" size="30" type="text" />
				<br />（例）西新宿1-1-1
				</td>
			</tr>
			<tr>
				<td>建物名（部屋番号）</td>
				<td><input name="addr3" type="text" size="30">
				<br />（例）西新宿マンション204
				</td>
			</tr>
			<tr>
				<td>お電話番号</td>
				<td><input name="tellno" type="text" maxlength="11">
				<br />	（例）0300000000

				</td>
			<tr>
				<td colspan="2"><input type="submit" value="確認する" onclick=""><input type="reset" value="キャンセル"></td>
			</tr></table>
	</form>
	<form action="../top_page.php"><input type="submit" value="トップページ"></form>

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










