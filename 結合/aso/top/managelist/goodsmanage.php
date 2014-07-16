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
	<form method="POST" action="goodsinsert.php" enctype="multipart/form-data">
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
					$sql = 'select * from kind';

					$res =& $db->query($sql);
					if (PEAR::isError($res)) {
					    die($res->getMessage());
					}


					while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
					        print('<option value="'.$row->kindcode.'">'.$row->kind.'</option>');
					   //     print($row->stockcode);
					    }
				?>
				</select>

				</td>
			</tr>
			<tr>
				<td>説明文</td>
				<td><input type="text" size="30" name="descript"></td>
			</tr>
			<tr>
				<td>サイズ</td>
				<td>
								<select name="size">
				<?php
					$sql = 'select distinct sizecode,size from size';

					$res =& $db->query($sql);
					if (PEAR::isError($res)) {
					    die($res->getMessage());
					}


					while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
					        print('<option value="'.$row->sizecode.'">'.$row->size.'</option>');
					   //     print($row->stockcode);
					    }
				?>
				</select></td>

			</tr>
			<tr>
				<td>画像</td>
				<td>
					<p><input type="file" name="userfile"></p>
				</td>
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
				<td>サイズ</td>
				<td>
								<select name="size">
				<?php
					$sql = 'select distinct sizecode,size from size';

					$res =& $db->query($sql);
					if (PEAR::isError($res)) {
					    die($res->getMessage());
					}


					while($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
					        print('<option value="'.$row->sizecode.'">'.$row->size.'</option>');
					   //     print($row->stockcode);
					    }
				?>
				</select></td>

			</tr>
		<tr>
			<td colspan="2"><input type="submit"value="確認する" /><input type="reset" value="キャンセル"></td>
		</tr>
	</table>
	</form>
	<input type="button" value="戻る" onClick="location.href='managelist.php'">
	
	<?php
//確認画面を挟む　コメント書く
	?>
</body>
</html>