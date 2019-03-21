<?php
require __DIR__.'/__connect.php';

header('Content-Type:application/json');
 $result=[
    'success'=>false,
    'errorCode'=>0,
    'errorMsg'=>'資料輸入不完整',
    'post'=>[],//做echo檢查

 ];
 if (isset($_POST['checkme'])){
    $camp_name = $_POST['camp_name'];
    $campImg_name = $_POST['campImg_name'];
    $campImg_file =$_POST['campImg_file'];
    $campImg_path =$_POST['campImg_path'];

    $result['post']=$_POST;//做echo檢查
    
    if(empty( $camp_name)or empty($campImg_name) ){
        $result['errorCode']=400;
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }


    $sql ="INSERT INTO `campsite_image`
    ( `camp_image`, `camp_name`, `campImg_name`, `campImg_file`, `campImg_path`) 
    VALUES (?,?,?,?,?)";
    try{
        //準備執行
        $stmt=$pdo->prepare($sql);

        //執行$stmt，回傳陣列內容
        $stmt->execute([
            $_POST['camp_image'],
            $_POST['camp_name'],
            $_POST['campImg_name'],
            $_POST['campImg_file'],
            $_POST['campImg_path'],

            ]);
        if ($stmt->rowCount()==1){
            $result['success']=true;
            $result['errorCode']=200;
            $result['errorMsg']='';
            
        }else{ 
            $result['errorCode']=402;
            $result['errorMsg']='資料新增錯誤';
        }
    }catch( PDOException $ex){
        $result['errorCode']=403;
        $result['errorMsg']='Email重複輸入';
    }        
       
        
    }
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
