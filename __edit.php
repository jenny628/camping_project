<?php
require __DIR__.'/__salepage_connect_db.php';
header('Content-Type: application/json');
$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查           
];
$salepage_id = isset($_POST['salepage_id']) ? intval($_POST['salepage_id']) : 0;
if(isset($_POST['salepage_name']) and !empty($salepage_id))
{
    $salecateid = $_POST['salepage_salecateid'];
    $name = $_POST['salepage_name'];
    $sutprice = $_POST['salepage_suggestprice'];
    $price = $_POST['salepage_price'];
    $cost= $_POST['salepage_cost'];
    $feature = $_POST['salepage_feature'];
    $state = $_POST['salepage_state'];
    $details = $_POST['salepage_proddetails'];
    $result['post'] = $_POST;  // 做 echo 檢查
    if(empty($name) or empty($price)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }
    $sql = "UPDATE `salepage` SET 
                `salepage_salecateid`=?,
                `salepage_name`=?,
                `salepage_suggestprice`=?,
                `salepage_price`=?,
                `salepage_cost`=?,
                `salepage_feature`=?,
                `salepage_state`=?,
                `salepage_proddetails`=?,
                `salepage_image`=?,
                `salepage_quility`=?
                WHERE `salepage_id`=?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['salepage_salecateid'],
            $_POST['salepage_name'],
            $_POST['salepage_suggestprice'],
            $_POST['salepage_price'],
            $_POST['salepage_cost'],
            $_POST['salepage_feature'],
            $_POST['salepage_state'],
            $_POST['salepage_proddetails'],
            $_POST['salepage_image'],
            $_POST['salepage_quility'],
            $salepage_id
        ]);
        if($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料修改錯誤';
        }
    } catch(PDOException $ex){
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);