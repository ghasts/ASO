<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>新規登録</title>

<script type="text/javascript">
<!--
function chkHissu(frm){
        /* 必須入力のname属性 */
        var hissu=Array("uname","sex","email","pass1","pass2","zip","addr1","addr2","teelno");
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

			if(document.form1.pass1.value != document.form1.pass2.value){
				alert("再確認用パスワードが一致しません");
				return false;
			}
        }
        /* 必須入力項目が全て入力されている場合はtrueを返してフォーム送信 */
        return true;
    }
// -->
</script>



 </head>
	<body>
	<h1>会員情報変更</h1>


<p>必要事項を入力して「確認する」ボタンをクリックしてください。</p>

	<form method="POST" action="check2.php"onsubmit="return chkHissu(this)" name="form1" >
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
				<td>都道府県 市区群</td>
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
				<td><input name="tellno" type="text" maxlength="10">
				<br />	（例）0300000000

				</td>
			<tr>
				<td colspan="2"><input type="submit" value="確認する" onclick=""><input type="reset" value="キャンセル"></td>
			</tr>
	</form>

	
	</body>
</html>