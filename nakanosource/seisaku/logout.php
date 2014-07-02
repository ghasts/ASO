<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<head>

</head>

<body><?PHP
session_start();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 3600, '/');
}

if(isset($_COOKIE["email"]) || isset($_COOKIE["password"])){
setcookie("email","",time() - 3600);
setcookie("password","",time() - 3600);
session_destroy();
print('OK! logout complete!');
}else{
print('not found login date! are you want to login?  ');
setcookie("PHPSESSID", '', time() - 3600, '/');
session_destroy();

}
?>
<a href='/oresource/seisaku/adios.html'>ログインへ</a>


</body>
</html>