<?php
include __DIR__ . '/__connect.php';
header('Content-Type: application/json');
$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '',
    'post' => []
];
if (isset($_POST['checkme'])) {
    $camp_name = $_POST['camp_name'];
    $campImg_name = $_POST['campImg_name'];
    $campImg_file =$_POST['campImg_file'];
    $result['post'] = $_POST;
    if (empty($camp_name) or empty($campImg_name)) {
        $result['errorCode'] = 400;
        $result['errorMsg'] = '資料輸入不完全';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $folder = "upload/"; 
    $file = sha1($_FILES['my_file']['name']); 
    $image_path = $folder.$file; 

    $sql ="INSERT INTO `campsite_image`
        ( `camp_image`, `camp_name`, `campImg_name`, `campImg_file`, `campImg_path`) 
        VALUES (?,?,?,?,?)";

    try {
        $stmt = $pdo->prepare($sql);
        
        if (move_uploaded_file($_FILES['my_file']['tmp_name'], $image_path)) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '圖片新增成功';
        } else {
            $result['errorCode'] = 401;
            $result['errorMsg'] = '圖片暫存檔無法搬移';
        }
        $stmt->execute([
            $image_path,
            $_POST['camp_name'],
            $_POST['campImg_name'],
            $_POST['campImg_file'],
            $_POST['campImg_path'],
        ]);
        if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '資料新增成功';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料新增錯誤';
        }
    } catch (PDOException $ex) {
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料輸入錯誤';
    }
    
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);