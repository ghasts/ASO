<?php
$host = 'enzerus.com';
$user = 'adios';
$password = 'lovelive';
$dsn = 'mysql:dbname=adios;host=enzerus.com';

try{
	$dbh = new PDO($dsn, $user, $password);
		$dbh->query('SET NAMES utf8');

for($cnt=1; $cnt<=5; $cnt++){
$sql = "insert into stock (stockcode,sizecode) VALUES (?,?)";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(25,$cnt));
}



}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>