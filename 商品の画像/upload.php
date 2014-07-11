<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>画像のアップロード</title>
</head>
<body>
<?php
//if(isset($_FILES['userfile'])){
//print $_FILES['userfile']['error'];
//}

//サーバに画像を上げる。
$filepath = 'C:/xampp/htdocs/aso/images/';
$upfile = $filepath.basename($_FILES['userfile']['name']);
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile)){
print(basename($_FILES['userfile']['name']).'のアップロードが正常に行われました。');

}else{
print('失敗');
}
?>
</body>
</html>