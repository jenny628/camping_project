<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';

header('Content-Type:application/json');
 $result=[
    'success'=>false,
    'errorCode'=>0,
    'errorMsg'=>'資料輸入不完整',
    'post'=>[],//做echo檢查

 ];

 $campImg_id=isset($_POST['campImg_id']) ? intval($_POST['campImg_id']) : 0;

 if (isset($_POST['camp_name']) and !empty($campImg_id)){

    $camp_name = $_POST['camp_name'];
    $campImg_name = $_POST['campImg_name'];
    $campImg_file = $_POST['campImg_file'];
   

    $result['post']=$_POST;//做echo檢查

    if(empty($camp_name)or empty($campImg_name)){
        $result['errorCode']=400;
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }


     // 1. 修改資料之前可以先確認該筆資料是否存在
     // 2. Email 有沒有跟別筆的資料相同
/*
     $s_sql="SELECT * FROM`campsite_image`  WHERE `campImg_id`=? OR `campImg_name`=? ";
     $s_stmt=$pdo->prepare($s_sql);
     $s_stmt->execute([$campImg_id,$_POST['campImg_name']]);

     //修改的資料sid不存在，但email已存在，有可能會繼續執行，產生bug
     //case 1避免上述狀況發生，如果填入的sid和表單中已有的sid不相同，就會出現錯誤訊息

     switch($s_stmt->rowCount()){
        case 0://sid和email都找不到
            $result['errorCode']=410;
            $result['errorMsg']='該筆資料不存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        case 2://sid和email都找到
            $result['errorCode']=420;
            $result['errorMsg']='圖片已存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        case 1://只找到email
        $row = $s_stmt->fetch($pdo::FETCH_ASSOC);
        if($row['campImg_id']!=$campImg_id){
            $result['errorCode']=430;
            $result['errorMsg']='該筆資料不存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        }



     }
     */

    $sql= "UPDATE `campsite_image` SET 
            `camp_name`=?,
            `campImg_name`=?, 
            `campImg_file`=?, 
            WHERE `campImg_id`=? ";

     //利用try catch來處理PDO的錯誤
    try{
        //準備執行
        $stmt=$pdo->prepare($sql);

        //執行$stmt，回傳陣列內容
        $stmt->execute([
            $_POST['camp_name'],
            $_POST['campImg_name'],
            $_POST['campImg_file'],
            $campImg_id

            ]);
        if ($stmt->rowCount()==1){
            $result['success']=true;
            $result['errorCode']=200;
            $result['errorMsg']='';
            
        }else{ 
            $result['errorCode']=402;
            $result['errorMsg']='資料沒有修改';
        }
    }catch( PDOException $ex){
        $result['errorCode']=403;
        $result['errorMsg']='資料更新發生錯誤';
    }        
       
        
    }
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
