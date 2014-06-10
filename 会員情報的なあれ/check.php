


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>フォーム内容確認</title>
</head>
<body>
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
</body>
</html>