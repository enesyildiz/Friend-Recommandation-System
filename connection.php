<?php

$dbname = "eng_project_4";
$dbuser="root";
$dbpass="";
$host="localhost";



    $db = new PDO("mysql:dbname=$dbname;
port=3306;
host=$host", $dbuser, $dbpass);
try{  $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
//echo 'success';
}catch(PDOException  $e){
    echo 'hata';
    print $db->errorCode();
}

?>