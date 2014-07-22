<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
<p><input type="file" name="userfile"></p>
<p><input type="submit" value="送信"></p>
</form>
<img src="C:/xammp/htdocs/aso/images/lovelive2.jpg" alt="イラスト1">
<?php 
$test="C:/xammp/htdocs/aso/images/lovelive2.jpg";
print(substr($test,15));
?>
</body>
</html>