<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>商品追加</title>
</head>

<body>
	<form method="POST" action="goodsinsert.php" >
	<p>追加する商品の情報を入力</p>
		<table border="1">
			<tr>
				<td>商品名</td>
				<td><input type="text" size = "30" name="goods"></td>
			</tr>
			<tr>
				<td>値段</td>
				<td><input type="text" size = "30" name="price" ></td>
			</tr>
			<tr>
				<td>分類</td>
				<td><input type="text" size="30" name="kind">
				</td>
			</tr>
			<tr>
				<td>サイズ</td>
				<td><input type="text" size="30" name="size">
			</tr>
		
			<tr>
				<td colspan="2"><input type="submit" value="確認する" onclick=""><input type="reset" value="キャンセル"></td>
			</tr></table>
	</form>

</body>
</html>