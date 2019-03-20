<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';
$page_name='campImg_insert';
$camp_name = '';
$campImg_name = '';
$campImg_file = '';
  
 //isset檢查變數是否設置
if (isset($_POST['checkme'])){

    $camp_name = $_POST['camp_name'];
    $campImg_name = $_POST['campImg_name'];
    $campImg_file = $_POST['campImg_file'];


$sql="INSERT INTO `campsite_image`(
     `camp_name`, `campImg_name`, `campImg_file`
    ) VALUES (
        ?,?,?
        )";
    

    try{
        //準備執行
        $stmt=$pdo->prepare($sql);

        //執行$stmt，回傳陣列內容
        $stmt->execute([
            $_POST['camp_name'],
            $_POST['campImg_name'],
            $_POST['campImg_file'],

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
            'info'=>'重複輸入'
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
            <li class="breadcrumb-item"><a href="./camp_list.php">營地列表</a></li>
            <li class="breadcrumb-item"><a href="./campImg_list.php">營地圖片清單</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增圖片資料</li>
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
            <form name="form1" method="post" onsubmit="return checkForm()" >
            <input type="hidden" name="checkme" value="check123">
            <div class="form-group">
                <label for="camp_name">1.營區名稱</label>
                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder=""
                value="<?= $camp_name ?>">
                <small id="camp_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="campImg_name">2.圖片名稱</label>
                <input type="text" class="form-control" id="campImg_name" name="campImg_name" placeholder=""
                value="<?= $campImg_name ?>">
                <small id="campImg_nameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="campImg_file">3.資料夾</label>
                <input type="text" class="form-control" id="campImg_file" name="campImg_file" placeholder=""
                value="<?= $campImg_file ?>">
                <small id="campImg_fileHelp" class="form-text text-muted"></small>
            </div>
            <!-- <div class="form-group">
                <label for="upload_image">4.上傳圖片</label>
                <input type="file" name="my_file">
            </div> -->
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <form action="image_upload.php" method="post" enctype="multipart/form-data" onSubmit="return InputCheck(this)">
            <label>
                圖片：
                <input type="file" name="file" id="file">
            </label>
            
            <br>
        
            <button type="submit" id="submit">新增</button>
            </form>
            
            
           

    </form>
        </div>
        </div>
 
</main>

<script>
/*
const fields=[
        'camp_name',
        'campImg_name',
        'campImg_file',
        
    ];

    //取得表單的欄位的參照
const fs={};
    for(let v of fields ){
        fs[v]=document.form1[v];
    }
    console.log(fs);
    console.log('fs.camp_name:', fs.camp_name);

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
       
*/
</script>
<?php include __DIR__.'/__html_footer.php'; ?>