<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';

//GET取得的值會顯示在URL上
 $camp_id=isset($_GET['camp_id'])?intval($_GET['camp_id']):0;//intval將字串轉換成整數值
 $pdo->query("DELETE FROM `campsite_list` WHERE `camp_id`= $camp_id");
 $goto='campsite_list.php';
//$_SERVER['HTTP_REFERER']取得當前頁面的前一頁url
if(isset($_SERVER['HTTP_REFERER'])){
    $goto=$_SERVER['HTTP_REFERER'];
}
//資料刪除後會自動轉向回到資料列表的頁面
header("Location:$goto");