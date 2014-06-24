<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>売上集計</title>

 </head>
	<body>
	<h1>売上集計</h1>


<p>集計したいデータを選んでください。</p>


<p>	<form method="POST" action="monthuriage.php" name="form1" >
<?php
echo '<select name=year>\n';
for ($i=2010; $i < date("Y")+1; $i++){
echo "<option value=$i>$i";
}
echo '</select>';
echo '年';
echo '<select name=month>\n';
for ($i=1; $i < 13; $i++){
echo "<option value=$i>$i";
}
echo '</select>';
echo '月';

?>
	<input type="submit" value="月間の売上を集計する">
	</form>
</p>
<br><br><br>
<p>
	<form method="POST" action="yearuriage.php" name="form1" >
<?php
echo '<select name=year>\n';
for ($i=2010; $i < date("Y")+1; $i++){
echo "<option value=$i>$i";
}
echo '</select>';
?>
年度
	<input type="submit" value="この年度の売上を集計する">
	</form>
</p>
	</body>
</html>