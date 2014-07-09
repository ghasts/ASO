<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>てんぷれ</title>
</head>
<body>
<?php
//if(isset($_FILES['userfile'])){
//print $_FILES['userfile']['error'];
//}


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