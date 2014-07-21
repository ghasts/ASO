<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>レジ画面</title>

<?php

session_start();
require_once 'DB.php';

//$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$dsn = 'mysqli://adios:lovelive@enzerus.com/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}



$sql = "select accpoint from account where acccode=".$_SESSION['acccode'];
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){

	$accpoint = $row->accpoint;
}

?>

<script type="text/javascript">
<!--



function numOnly() {
   m = String.fromCharCode(event.keyCode);
   if("0123456789\b\r".indexOf(m, 0) < 0) return false;



   return true;
}

function entryChange1(){
radio = document.getElementsByName('receiver')
if(radio[0].checked) {
//フォーム
document.getElementById('another').style.display = "none";
}else if(radio[1].checked) {
//フォーム
document.getElementById('another').style.display = "";

}
}
window.onload = entryChange1;

function chkHissu(frm){

var receiver = document.getElementsByName("receiver");
for(i=0; i<receiver.length; i++){
 if(receiver[i].checked){
 receiver = receiver[i].value;
 }


			if(document.form1.point.value > <?php print ($accpoint); ?>){
				alert("使用するポイントの値が不正です。");
				return false;
      		  }


		if( receiver == "another"){	
				if(document.form1.name2.value == ""){
					alert("受取人のお名前を入力してください。");
				return false;
				}

				if(document.form1.zip2.value == ""){
					alert("受取人の郵便番号を入力してください。");
				return false;
				}

				if(document.form1.receiveraddr1.value == ""){
					alert("受取人の都道府県 市区郡を入力してください。");
				return false;
				}

				if(document.form1.receiveraddr2.value == ""){
					alert("受取人の町村 番地を入力してください。");
				return false;
				}

				if(document.form1.tellno2.value == ""){
					alert("受取人の電話番号を入力してください。");
				return false;
				}
			}
}
        /* 必須入力項目が全て入力されている場合はtrueを返してフォーム送信 */
        return true;
    }
// -->





</script>



 </head>
	<body>

<?php






?>



	<h3>ご注文内容</h3>

<!-- カートの内容を持ってきて表示する -->
<!-- カートさん　　　　　入りまーす。 -->
<?php
require('cart_extract.php');
?>

<!-- カートさん　	ここまでです。-->

	<form method="POST" action="memberordercheck.php"onsubmit="return chkHissu(this)" name="form1" >

<?php

$sql = "select accname,mail,zip,address,phone,accpoint from account where acccode=".$_SESSION['acccode'];
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}


while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
    echo"<input type=hidden name=\"uname\" value=$row->accname>";
	echo"<input type=hidden name=\"email\" value=$row->mail>";
	echo"<input type=hidden name=\"zip\" value=$row->zip>";
	echo"<input type=hidden name=\"address\" value=$row->address>";
	echo"<input type=hidden name=\"tellno\" value=$row->phone>";
	
}

$sql = "select accname,accpoint from account where acccode=".$_SESSION['acccode'];
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){

	echo"$row->accname";
	echo"さんの保有ポイントは";
	echo"$row->accpoint";
	echo"ポイントです。<br><br>";

	echo"<INPUT type=text onkeyDown=\"return numOnly()\" name=\"point\" value=\"0\">ポイント使用して値引きする";
}



?>


	<h3>お届け先選択</h3>
	<input type="radio" name="receiver" value="buyer" checked="checked" onclick="entryChange1();">購入者の住所へ送る<br>
	<input type="radio" name="receiver" value="another" onclick="entryChange1();">別の住所へ送る<br><br>

	<table id="another" border="1">
			<th colspan="2">受取人の情報の入力</th>
			<tr>
				<td>受取人お名前  <font size="1" color="#ff0000">必須</font></td>
				<td><input type="text" size = "30" name="name2"></td>
			</tr>
	<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
			<tr>
				<td>郵便番号  <font size="1" color="#ff0000">必須</font></td> 
				<td><input onkeyup="AjaxZip3.zip2addr(this,'','receiveraddr1','receiveraddr1','receiveraddr2','receiveraddr2');" name="zip2" maxlength="7" type="text" />
				<br /><font size="2">（例）1000000</font>
				</td>
			</tr>
			<tr>
				<td>都道府県 市区群  <font size="1" color="#ff0000">必須</font></td>
				<td><input name="receiveraddr1" size="30" type="text" />
				<br /><font size="2">（例）東京都新宿区</font>
				</td>
			</tr>
			<tr>
				<td>町村番地  <font size="1" color="#ff0000">必須</font></td>
				<td><input name="receiveraddr2" size="30" type="text" />
				<br /><font size="2">（例）西新宿1-1-1</font>
				</td>
			</tr>
			<tr>
				<td>建物名（部屋番号）</td>
				<td><input name="receiveraddr3" type="text" size="30">
				<br /><font size="2">（例）西新宿マンション204</font>
				</td>
			</tr>
			<tr>
				<td>お電話番号  <font size="1" color="#ff0000">必須</font></td>
				<td><input name="tellno2" type="text" maxlength="11">
				<br />	<font size="2">（例）0300000000</font>
			</tr>
				</td>
		</table>


	<h3>お支払方法選択</h3>
	<input type="radio" name="pay" value="1" checked="checked">代金引換<br><br>

	<input type="submit" value="確認する" onclick=""><input type="reset" value="キャンセル"><br><br>

</form>




	
	</body>
</html>