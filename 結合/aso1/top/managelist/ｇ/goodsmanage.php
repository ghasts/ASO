<?php
$host = 'enzerus.com';
$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';
try{
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>商品追加</title>
</head>

<body>
	<form method="POST" action="goodsinsert.php" enctype="multipart/form-data">
	<p>追加する商品の情報を入力　※サイズ毎に商品の追加をする必要はありません。</p>
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
					$sql = ('select kindcode,kind from kind');
					$stmt = $dbh->prepare($sql);
					$stmt -> execute(array());
					while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				        print('<option value="'.($result['kindcode']).'">'.($result['kind']).'</option>');
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
					$sql = ('select distinct sizecode,size from size');
					$stmt = $dbh->prepare($sql);
					$stmt -> execute(array());
					while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					        print('<option value="'.($result['sizecode']).'">'.($result['size']).'</option>');
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
					$sql = ('select goodscode,goods from goods');
					$stmt = $dbh->prepare($sql);
					$stmt -> execute(array());
					while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					        print('<option value="'.($result['goodscode']).'">'.($result['goods']).'</option>');
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
					$sql = ('select distinct sizecode,size from size');
					$stmt = $dbh->prepare($sql);
					$stmt -> execute(array());
					while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					        print('<option value="'.($result['sizecode']).'">'.($result['size']).'</option>');
					   //     print($row->stockcode);
					    }
	}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
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
</body>
</html>