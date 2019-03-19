<?php
 $upload_dir=__DIR__.'/upload/';
 //指定檔案上傳到的資料夾
 $upload_file=$upload_dir.$_FILES['my_file']['name'];
 //設定新資料夾的位置

 //如果沒有上傳檔案，則不繼續執行程式
 if(empty ($_FILES['my_file'])){
     exit;
 }
 $goto='campImg_list.php';
 //move_uploaded_file()將上傳的文件移動到新位置
 //執行成功，顯示檔名、類型、大小
if(move_uploaded_file($_FILES['my_file']['tmp_name'],$upload_file)){
    if(isset($_SERVER['HTTP_REFERER'])){
        $goto=$_SERVER['HTTP_REFERER'];
    }
}
header("Location:$goto");
