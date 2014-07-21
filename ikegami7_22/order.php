<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>レジ画面</title>

<script type="text/javascript">
<!--


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
        /* 必須入力のname属性 */
        var hissu=Array("uname","email","zip","addr1","addr2","tellno");
        /* アラート表示用 */
        var hissu_nm = Array("名前","メールアドレス","郵便番号","都道府県 市区郡","町村 番地","電話番号");
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

		

            if(document.form1.tellno.value.length < 10 || document.form1.tellno.value.length >11){
				/*電話番号の桁が10または11でない場合*/
				alert("電話番号の桁が不正です");
				return false;
		}


var receiver = document.getElementsByName("receiver");
for(i=0; i<receiver.length; i++){
 if(receiver[i].checked){
 receiver = receiver[i].value;
 }
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
	<h3>ご注文内容</h3>

<!-- カートの内容を持ってきて表示する -->
<!-- カートさん　　　　　入りまーす。 -->
<?php
require('cart_extract.php');
?>

<!-- カートさん　	ここまでです。-->


	<h3>購入者情報入力</h3>


<p>必要事項を入力して「確認する」ボタンをクリックしてください。</p>

	<form method="POST" action="ordercheck.php"onsubmit="return chkHissu(this)" name="form1" >
		<table border="1">
			<tr>
				<td>お名前  <font size="1" color="#ff0000">必須</font></td>
				<td><input type="text" size = "30" name="uname"></td>
			</tr>
			<tr>
				<td>メールアドレス  <font size="1" color="#ff0000">必須</font></td>
				<td><input type="text" size="30" name="email">
				<br />
				<font size="2">（半角英数）（例）yamada@example.co.jp </font>
				</td>
			</tr>

	<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
			<tr>
				<td>郵便番号  <font size="1" color="#ff0000">必須</font></td> 
				<td><input onkeyup="AjaxZip3.zip2addr(this,'','addr1','addr1','addr2','addr2');" name="zip" maxlength="7" type="text" />
				<br /><font size="2">（例）1000000</font>
				</td>
			</tr>
			<tr>
				<td>都道府県 市区群  <font size="1" color="#ff0000">必須</font></td>
				<td><input name="addr1" size="30" type="text" />
				<br /><font size="2">（例）東京都新宿区</font>
				</td>
			</tr>
			<tr>
				<td>町村番地  <font size="1" color="#ff0000">必須</font></td>
				<td><input name="addr2" size="30" type="text" />
				<br /><font size="2">（例）西新宿1-1-1</font>
				</td>
			</tr>
			<tr>
				<td>建物名（部屋番号）</td>
				<td><input name="addr3" type="text" size="30">
				<br /><font size="2">（例）西新宿マンション204</font>
				</td>
			</tr>
			<tr>
				<td>お電話番号  <font size="1" color="#ff0000">必須</font></td>
				<td><input name="tellno" type="text" maxlength="11">
				<br />	<font size="2">（例）0300000000</font>

				</td>

	</table>
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