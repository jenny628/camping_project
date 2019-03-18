<?php
$db_host='localhost';
$db_name='camp';
$db_user='root';
$db_pass='password';

$dbn="mysql:host={$db_host};dbname={$db_name}";


try{
    $pdo = new PDO ($dbn,$db_user,$db_pass);
    $pdo->query("SET NAMES utf8");//顯示中文字
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//除錯

}catch(PDOExpection $ex){
    echo 'Error:'.$ex->getMassage();
}
if (! isset($_SESSION)){
    session_start();
}