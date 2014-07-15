<!doctype html>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>画像アップロード</title>
</HEAD>
<BODY>
<FORM method="POST" enctype="multipart/form-data" action="upload.php">
	<P>画像アップロード</P>
	画像パス：<INPUT type="file" name="upfile" size="50"><BR>
	<INPUT type="submit" name="submit" value="送信">
</FORM>

<?php

	$host = '172.20.17.216';
$user = 'adios';
$password = 'lovelive';
$db = 'adios';

//フラグ変数領域
$wflag = 0;

	if (count($_POST) > 0 && isset($_POST["submit"])){
	$upfile = $_FILES["upfile"]["tmp_name"];
	if ($upfile==""){
		print("ファイルのアップロードができませんでした。<BR>\n");
		exit;
	
	// ファイル取得
	$imgdat = file_get_contents($upfile);
	$imgdat = mysql_real_escape_string($imgdat);


define( 'DB_HOST', 'enzerus.com' );
define( 'DB_USER','adios' );
define( 'DB_PASS', 'lovelive' );
define( 'DB_NAME', 'adios' );


    // データベースに接続
    $DB = mysql_connect( DB_HOST, DB_USER, DB_PASS );
    mysql_select_db( DB_NAME, $DB );
 
    // 画像の取得
    //$image = file_get_contents( $img_path );
 
    // SQL文の作成
    $sql = sprintf('INSERT INTO images(img) VALUES ($imgdat)');
　　
　　
    $result = mysql_query( $sql );

?>

</BODY>
</HTML>