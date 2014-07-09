<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<html>
<head>

</head>

<body>
<?php

if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
print('ログイン状態が維持されています。');
print($_COOKIE["email"].'さんではないですか？');
print('<a href=\'../top_page.php\'>はい、そうです。</a>');
print('<a href=\'no.php\'>いいえ、違います。</a>');
}
?>
<form action="login.php" method="POST">

email:<input type="text" name="email"><br>
pass:<input type="text" name="password"><br>
<input type="checkbox" name="save" values="on"><br>
<input type="submit" value="ログイン">
</form>




</body>
</html>
