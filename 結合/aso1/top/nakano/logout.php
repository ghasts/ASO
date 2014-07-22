<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<head>

</head>

<body><?PHP
session_start();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 3600, '/aso');
}

if(isset($_COOKIE["email"]) || isset($_COOKIE["password"])){
setcookie("email","",time() - 3600,'/aso');
setcookie("password","",time() - 3600,'/aso');
session_destroy();
header("Location: /aso/top/top_page.php");
print('OK! logout complete!');
}else{
print('not found login date! are you want to login?  ');
setcookie("PHPSESSID", '', time() - 3600, '/aso');
session_destroy();

}
?>


<a href='../top_page.php'>ログインへ</a>


</body>
</html>