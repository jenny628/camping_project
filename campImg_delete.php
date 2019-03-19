<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';

//GET取得的值會顯示在URL上
$campImg_id=isset($_GET['campImg_id'])?intval($_GET['campImg_id']):0;//intval將字串轉換成整數值
 $pdo->query("DELETE FROM `campsite_image` WHERE `campImg_id`= $campImg_id");
 $goto='campImg_list.php';

if(isset($_SERVER['HTTP_REFERER'])){
    $goto=$_SERVER['HTTP_REFERER'];
}

header("Location:$goto");