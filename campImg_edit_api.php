<?php
require __DIR__.'/__connect.php';

header('Content-Type:application/json');
 $result=[
    'success'=>false,
    'errorCode'=>0,
    'errorMsg'=>'資料輸入不完整',
    'post'=>[],

 ];

 $campImg_id=isset($_POST['campImg_id']) ? intval($_POST['campImg_id']) : 0;

 if (isset($_POST['campImg_id'])){  
    $camp_image = $_POST['camp_image'];
    $camp_name = $_POST['camp_name'];
    $campImg_name = $_POST['campImg_name'];
    $campImg_file = $_POST['campImg_file'];
    // $campImg_path = $_POST['campImg_path'];
    $result['post']=$_POST;
    if(empty($camp_name) or empty($campImg_name)){
        $result['errorCode']=400;
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }


    $sql_s= "UPDATE `campsite_image` SET 
            `camp_image`=?,
            `camp_name`=?,
            `campImg_name`=?,
            `campImg_file`=?
            -- `campImg_path`=?,            
            WHERE  `campImg_id`=? ";

    try{
      
        $stmt=$pdo->prepare($sql_s);

        $stmt->execute([ 
            $_POST['camp_image'],
            $_POST['camp_name'],
            $_POST['campImg_name'],
            $_POST['campImg_file'],
            // $_POST['campImg_path'],
            $_POST['campImg_id']


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
  