<?PHP
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 3600, '/');
}

if(isset($_COOKIE["email"]) and isset($_COOKIE["password"])){
setcookie("email","",time() - 3600);
setcookie("password","",time() - 3600);
session_destroy();
print('����Ƀ��O�A�E�g�ł��܂����B');
}else{
print('���O�C������ۑ����Ȃ��������A���Ƀ��O�A�E�g����Ă��܂��B�M���̓��O�C������]���܂����H');
session_destroy();

}
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<html>
<head>

</head>
<body>
<a href='/oresource/adios.html'>���O�C����</a>


</body>
</html>