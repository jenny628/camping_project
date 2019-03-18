<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';
 $page_name='campsite_insert';
    $name = '';
    $address = '';
    $city = '';
    $dist = '';
    $location = '';
    $tel = '';
    $fax ='';
    $email = '';
    $ownerName = '';
    $openTime = '';
    $target = '';
 //isset檢查變數是否設置
 if (isset($_POST['checkme'])){

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

$sql="INSERT INTO `campsite_list`(
     `camp_name`, `camp_address`, `camp_location`, `camp_tel`, `camp_fax`, `camp_email`, `camp_ownerName`, `camp_openTime`, `camp_target`, `city`, `dist`
    ) VALUES (
        ?,?,?,?,?,?,?,?,?,?,?
        )";
    

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
            $_POST['dist']

            ]);
        if ($stmt->rowCount()==1){
            $success=true;
            $msg=[
                'type'=>'success',
                'info'=>'資料新增成功'
            ];
        }else{
            $msg=[
                'type'=>'danger',
                'info'=>'資料新增錯誤'
            ];
        }
    }catch( PDOException $ex){
        $msg=[
            'type'=>'danger',
            'info'=>'Email重複輸入'
        ];
    }        
       
        
    }


?>
<?php include __DIR__.'/__html_header.php'; ?>
<?php include __DIR__.'/__html_navbar01.php'; ?>
<style>
.form-group small{
    color:red !important;
}
</style>
<main class="col-9 bg-white">
<aside class="bg-warning">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">營地列表</a></li>
            <li class="breadcrumb-item"><a href="./campsite_list.php">營地清單</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增營地資料</li>
         </ol>
        </nav>
</aside>
      <div class="card" >
        <div class="card-body">
            <h5 class="card-title">新增資料
                <?php if (isset( $msg)):?>
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                <?= $msg['info'] ?>
                </div>
                <?php endif ?>

            </h5>
            <form name="form1" method="post" onsubmit="return checkForm()">
            <input type="hidden" name="checkme" value="check123">
            <div class="form-group">
                <label for="camp_name">1.營區名稱</label>
                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder=""
                value="<?= $name ?>">
                <small id="camp_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_address">2.地址</label>
                <textarea class="form-control" id="camp_address" name="camp_address" cols="30" rows="3"><?= $address ?></textarea>
                <small id="camp_addressHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="city">3.城市</label>
                <input type="text" class="form-control" id="city" name="city" placeholder=""
                value="<?= $city ?>">
                <small id="cityHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="dist">4.地區</label>
                <input type="text" class="form-control" id="dist" name="dist" placeholder=""
                value="<?= $dist ?>">
                <small id="distHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_location">5.經緯度</label>
                <input type="text" class="form-control" id="camp_location" name="camp_location" placeholder=""
                value="<?= $location ?>">
                <small id="camp_locationHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_tel">6.聯絡電話</label>
                <input type="text" class="form-control" id="camp_tel" name="camp_tel" placeholder=""
                value="<?= $tel ?>">
                <small id="camp_telHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_fax">7.傳真</label>
                <input type="text" class="form-control" id="camp_fax" name="camp_fax" placeholder=""
                value="<?=  $fax ?>">
                <small id="camp_faxHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_email">8.電子郵件</label>
                <input type="text" class="form-control" id="camp_email" name="camp_email" placeholder=""
                value="<?= $email ?>">
                <small id="camp_emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_ownerName">9.聯絡人</label>
                <input type="text" class="form-control" id="camp_ownerName" name="camp_ownerName" placeholder=""
                value="<?= $ownerName ?>">
                <small id="camp_ownerNameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_openTime">10.開放時間</label>
                <textarea class="form-control" id="camp_openTime" name="camp_openTime" cols="30" rows="3"><?= $openTime ?></textarea>
                <small id="camp_openTimeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_target">11.適合對象</label>
                <textarea class="form-control" id="camp_target" name="camp_target" cols="30" rows="3"><?= $target ?></textarea>
                <small id="targetHelp" class="form-text text-muted"></small>
            </div>
           
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>



  
</main>
<script>
const fields=[
        'camp_name',
        'camp_address',
        'city',
        'dist',
        'camp_location',
        'camp_tel',
        'camp_fax',
        'camp_email',
        'camp_ownerName',
        'camp_openTime',
        'camp_target'
    ];

    //取得表單的欄位的參照
const fs={};
    for(let v of fields ){
        fs[v]=document.form1[v];
    }
    console.log(fs);
    console.log('fs.name:', fs.name);

//檢查表格內容是否填寫
const checkForm=()=>{
    let isPassed=true;
    
    const fsv = {};
           for(let v of fields){                
               fsv[v] = fs[v].value;
           }
            console.log(fsv);


    //填入表單裡email的格式
    let email_pattern=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    //填入表單裡手機的格式
    let mobile_pattern=/^09\d{2}\-?\d{3}\-?\d{3}$/;

    for(let v of fields){
                fs[v].style.borderColor = '#cccccc';
                document.querySelector('#' + v + 'Help').innerHTML = '';
            }

            if(fsv.name.length < 2){
                fs.name.style.borderColor = 'red';
                document.querySelector('#camp_nameHelp').innerHTML = '請填寫正確的姓名!';

                isPassed = false;
            }
            if(! email_pattern.test(fsv.email)){
                fs.email.style.borderColor = 'red';
                document.querySelector('#camp_emilHelp').innerHTML = '請填寫正確的 Email!';
                isPassed = false;
            }
          

            return isPassed;
        };

</script>
<?php include __DIR__.'/__html_footer.php'; ?>