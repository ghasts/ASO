<?PHP
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 3600, '/');
}

if(isset($_COOKIE["email"]) and isset($_COOKIE["password"])){
setcookie("email","",time() - 3600);
setcookie("password","",time() - 3600);
session_destroy();
print('正常にログアウトできました。');
}else{
print('ログイン情報を保存しなかったか、既にログアウトされています。貴方はログインを希望しますか？');
session_destroy();

}
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<html>
<head>

</head>
<body>
<a href='/oresource/adios.html'>ログインへ</a>


</body>
</html>