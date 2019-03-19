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

 $camp_id=isset($_POST['camp_id']) ? intval($_POST['camp_id']) : 0;

 if (isset($_POST['camp_name']) and !empty($camp_id)){

    $name = $_POST['camp_name'];
    $address = $_POST['camp_address'];
    $city = $_POST['city'];
    $dist = $_POST['dist'];
    $location = $_POST['camp_location'];
    $tel = $_POST['camp_tel'];
    $fax = $_POST['camp_fax'];
    $email = $_POST['camp_email'];
    $ownerName = $_POST['camp_ownerName'];
    $openTime = $_POST['camp_openTime'];
    $target = $_POST['camp_target'];

    $result['post']=$_POST;//做echo檢查

    if(empty($name)or empty($address) or empty($email)){
        $result['errorCode']=400;
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }

    //檢查email格式
    if(! filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result['errorCode']=405;
        $result['errorMsg']='email格式錯誤';
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }

     // 1. 修改資料之前可以先確認該筆資料是否存在
     // 2. Email 有沒有跟別筆的資料相同

     $s_sql="SELECT * FROM`campsite_list`  WHERE `camp_id`=? OR `camp_email`=? ";
     $s_stmt=$pdo->prepare($s_sql);
     $s_stmt->execute([$camp_id,$_POST['camp_email']]);

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
            $result['errorMsg']='email已存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        case 1://只找到email
        $row = $s_stmt->fetch($pdo::FETCH_ASSOC);
        if($row['camp_id']!=$camp_id){
            $result['errorCode']=430;
            $result['errorMsg']='該筆資料不存在';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            exit;
        }



     }

    $sql= "UPDATE `campsite_list` SET 
            `camp_name`=?,
            `camp_address`=?, 
            `camp_location`=?, 
            `camp_tel`=?, 
            `camp_fax`=?, 
            `camp_email`=?, 
            `camp_ownerName`=?, 
            `camp_openTime`=?, 
            `camp_target`=?, 
            `city`=?, 
            `dist`=?
       
            WHERE `camp_id`=? ";

     //利用try catch來處理PDO的錯誤
    try{
        //準備執行
        $stmt=$pdo->prepare($sql);

        //執行$stmt，回傳陣列內容
        $stmt->execute([
            $_POST['camp_name'],
            $_POST['camp_address'],
            $_POST['camp_location'],
            $_POST['camp_tel'],
            $_POST['camp_fax'],
            $_POST['camp_email'],
            $_POST['camp_ownerName'],
            $_POST['camp_openTime'],
            $_POST['camp_target'],
            $_POST['city'],
            $_POST['dist'],
            $camp_id

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
