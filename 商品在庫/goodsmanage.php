<?php
require_once 'DB.php';
$dsn = 'mysqli://adios:lovelive@172.20.17.216/adios';
$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}


?>
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
				<td><input type="text" size="30" name="goods" />
				</td>
			</tr>
			<tr>
				<td>価格</td>
				<td><input type="text" size = "30" name="price" ></td>
			</tr>
			<tr>
				<td>分類</td>
				<td>
				<select name="kind">
				<?php
					$sql = 'select distinct kind from goods';

					$res =& $db->query($sql);
					if (PEAR::isError($res)) {
					    die($res->getMessage());
					}


					while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
					        print('<option value="'.$row->kind.'">'.$row->kind.'</option>');
					   //     print($row->stockcode);
					    }
				?>
				</select>

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
	<form method="POST" action="./goodsstock.php">
		<p>商品の在庫の追加</p>

	<table border="1">
		<tr>
			<td>商品名</td>
			<td>
			<select name="goods">
				<?php
					$sql = 'select goods from goods';

					$res =& $db->query($sql);
					if (PEAR::isError($res)) {
					    die($res->getMessage());
					}


					while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
					        print('<option value="'.$row->goods.'">'.$row->goods.'</option>');
					   //     print($row->stockcode);
					    }
				?>
				</select>

			</td>
		</tr>
		<tr>	
			<td>追加在庫数</td>
			<td><input type="text" size="30" name="volume" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit"value="確認する" /><input type="reset" value="キャンセル"></td>
		</tr>
	</table>
	</form>
	<?php
//確認画面を挟む　コメント書く
	?>
</body>
</html>