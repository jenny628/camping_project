<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';

header('Content-Type:application/json');
 $result=[
    'success'=>false,
    'errorCode'=>0,
    'errorMsg'=>'資料輸入不完整',
    'post'=>[],

 ];

 $campImg_id=isset($_POST['campImg_id']) ? intval($_POST['campImg_id']) : 0;

 if (isset($_POST['camp_name']) and !empty($campImg_id)){

    $camp_name = $_POST['camp_name'];
    $campImg_name = $_POST['campImg_name'];
    $campImg_file = $_POST['campImg_file'];
    $campImg_path = $_POST['campImg_path'];

    $result['post']=$_POST;

    if(empty($camp_name) or empty($campImg_name)){
        $result['errorCode']=400;
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }


  
/*
     $s_sql="SELECT * FROM`campsite_image`  WHERE `campImg_id`=? OR `campImg_name`=? ";
     $s_stmt=$pdo->prepare($s_sql);
     $s_stmt->execute([$campImg_id,$_POST['campImg_name']]);


     switch($s_stmt->rowCount()){
        case 0:
            $result['errorCode']=410;
            $result['errorMsg']='該筆資料不存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        case 2:
            $result['errorCode']=420;
            $result['errorMsg']='圖片已存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        case 1:
        $row = $s_stmt->fetch($pdo::FETCH_ASSOC);
        if($row['campImg_id']!=$campImg_id){
            $result['errorCode']=430;
            $result['errorMsg']='該筆資料不存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        }
     }
*/

    $sql_s= "UPDATE `campsite_image` SET   
            `camp_name`=?,
            `campImg_name`=?,
            `campImg_file`=?,
            `campImg_path`=?            
            WHERE  `campImg_id`=? ";

    try{
      
        $stmt_s=$pdo->prepare($sql_s);

        $stmt_s->execute([
            $_POST['camp_name'],
            $_POST['campImg_name'],
            $_POST['campImg_file'],
            $_POST['campImg_path'],
            $campImg_id

            ]);
        if ($stmt_s->rowCount()==1){
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
  