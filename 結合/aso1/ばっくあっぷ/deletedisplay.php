<html>
<head><title>PHP TEST</title></head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<body>


<h3>販売サイトから非表示化したい商品を選択して「非表示化する」ボタンをクリックしてください。</h3>
<?php

require_once 'DB.php';

$dsn = 'mysqli://adios:lovelive@enzerus.com/adios';

$db = DB::connect($dsn);
if (PEAR::isError($db)) {
    die($db->getMessage());
}

$sql = 'select * from goods;';
$res =& $db->query($sql);
if (PEAR::isError($res)) {
    die($res->getMessage());


}
echo '<form method="POST" action="goodsdelete.php">';
echo '<select name=goods>\n';
while ($row =& $res->fetchRow(DB_FETCHMODE_OBJECT)){
$goodscode = $row->goodscode;
echo "<option value=\"$goodscode\">$row->goods $row->size</option>";
}
echo '</select><input type="submit" value="非表示化する"></form>';







$db->disconnect();

?>
<p><input type="button" value="戻る" onClick="location.href='managelist.php'"></p>
</body>
</html>




