<?php
session_start();
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 3600,'/aso');
}

if(isset($_COOKIE["email"]) or isset($_COOKIE["password"])){
setcookie("email","",time() - 3600,'/aso');
setcookie("password","",time() - 3600,'/aso');
session_destroy();

}else{

session_destroy();

}
header("Location: ./adios.php");
?>