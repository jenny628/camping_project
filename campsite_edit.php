<?php
//require __DIR__.'/__cred.php';
require __DIR__.'/__connect.php';
 $page_name='campsite_edit';

 $camp_id=isset($_GET['camp_id']) ? intval($_GET['camp_id']):0;
 $sql="SELECT * FROM `campsite_list` WHERE `camp_id`=$camp_id";
 
 $stmt=$pdo->query($sql);

 //防止跳到不存在的頁面，會導回列表頁
 if($stmt->rowCount()==0){
     header('Location:campsite_list.php');
     exit;
 }
 $row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__.'/__html_header.php'; ?>
<?php include __DIR__.'/__html_navbar01.php'; ?>
<style>
.form-group small{
    color:red !important;
}
</style>
<main class="col-10 bg-white">
<aside class="bg-warning">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./camp_list.php">營地列表</a></li>
            <li class="breadcrumb-item"><a href="./campsite_list.php">營地清單</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改營地資料</li>
         </ol>
        </nav>
</aside>

     
      <div class="card" >
        <div class="card-body">
        <div id="info_bar" class="alert alert-success" role="alert" style="display:none"></div>
            <h5 class="card-title">修改資料</h5>
            <form name="form1" method="post" onsubmit="return checkForm();">
                <input type="hidden" name="checkme" value="check123">
                <input type="hidden" name="camp_id" value="<?= $row['camp_id']?>">
                <div class="form-group">
                <label for="camp_name">1.營區名稱</label>
                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder=""
                value="<?= $row['camp_name'] ?>">
                <small id="camp_nameHelp" class="form-text text-muted"></small>
            </div>    
            <div class="form-group">
                <label for="city">2.城市</label>
                <select name="city" id="city" value="<?= $row['city'] ?>"  >
                    <option value="0">請選擇</option>
                    <option value="台北市">臺北市</option>
                    <option value="新北市">新北市</option>
                    <option value="基隆市">基隆市</option>
                    <option value="桃園市">桃園市</option>
                    <option value="新竹縣">新竹縣</option>
                    <option value="新竹市">新竹市</option>
                    <option value="臺中市">臺中市</option>
                    <option value="苗栗縣">苗栗縣</option>
                    <option value="彰化縣">彰化縣</option>
                    <option value="南投縣">南投縣</option>
                    <option value="雲林縣">雲林縣</option>
                    <option value="臺南市">臺南市</option>
                    <option value="高雄市">高雄市</option>
                    <option value="嘉義市">嘉義市</option>
                    <option value="嘉義縣">嘉義縣</option>
                    <option value="屏東縣">屏東縣</option>
                    <option value="臺東縣">臺東縣</option>
                    <option value="花蓮縣">花蓮縣</option>
                    <option value="宜蘭縣">宜蘭縣</option>
            </select>
                
            </div>
            <div class="form-group">
                <label for="dist">3.地區</label>
                <input type="text" class="form-control" id="dist" name="dist" placeholder=""
                value="<?= $row['dist'] ?>">
                <small id="distHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_address">4.地址</label>
                <textarea class="form-control" id="camp_address" name="camp_address" cols="30" rows="3"><?= $row['camp_address'] ?></textarea>
                <small id="camp_addressHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_location">5.經緯度</label>
                <input type="text" class="form-control" id="camp_location" name="camp_location" placeholder=""
                value="<?= $row['camp_location'] ?>">
                <small id="camp_locationHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_tel">6.聯絡電話</label>
                <input type="text" class="form-control" id="camp_tel" name="camp_tel" placeholder=""
                value="<?= $row['camp_tel'] ?>">
                <small id="camp_telHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_fax">7.傳真</label>
                <input type="text" class="form-control" id="camp_fax" name="camp_fax" placeholder=""
                value="<?=  $row['camp_fax'] ?>">
                <small id="camp_faxHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_email">8.電子郵件</label>
                <input type="text" class="form-control" id="camp_email" name="camp_email" placeholder=""
                value="<?= $row['camp_email'] ?>">
                <small id="camp_emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_ownerName">9.聯絡人</label>
                <input type="text" class="form-control" id="camp_ownerName" name="camp_ownerName" placeholder=""
                value="<?= $row['camp_ownerName'] ?>">
                <small id="camp_ownerNameHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_openTime">10.開放時間</label>
                <textarea class="form-control" id="camp_openTime" name="camp_openTime" cols="30" rows="3"><?= $row['camp_openTime'] ?></textarea>
                <small id="camp_openTimeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="camp_target">11.適合對象</label>
                <select name="camp_target" id="camp_target" value="<?= $row['camp_target'] ?>"  >
                    <option value="0">請選擇</option>
                    <option value="小家庭">小家庭</option>
                    <option value="營火晚會">營火晚會</option>
                    <option value="大型派對">大型派對</option>
                    <option value="工商團體">工商團體</option>
            </select>
            </div>
           

                <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>



    </main>
<script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const fields = [
        'camp_name',    
        'city',
        'dist',
        'camp_address',
        'camp_location',
        'camp_tel',
        'camp_fax',
        'camp_email',
        'camp_ownerName',
        'camp_openTime',
        'camp_target'
        ];

        // 拿到每個欄位的參照
        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        console.log(fs);
        console.log('fs.camp_name:', fs.camp_name);


        const checkForm = ()=>{
            let isPassed = true;
            info_bar.style.display = 'none';

            // 拿到每個欄位的值
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);

/*
            let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;

            for(let v of fields){
                fs[v].style.borderColor = '#cccccc';
                document.querySelector('#' + v + 'Help').innerHTML = '';
            }

            if(fsv.name.length < 2){
                fs.camp_name.style.borderColor = 'red';
                document.querySelector('#camp_nameHelp').innerHTML = '請填寫正確的姓名!';

                isPassed = false;
            }
            if(! email_pattern.test(fsv.email)){
                fs.camp_email.style.borderColor = 'red';
                document.querySelector('#camp_emailHelp').innerHTML = '請填寫正確的 Email!';
                isPassed = false;
            }
            
*/

            if(isPassed) {
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('campsite_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if(obj.success){
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料修改成功';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }

                        submit_btn.style.display = 'block';
                    });



            }
            return false;
        };

    </script>
<?php include __DIR__.'/__html_footer.php'; ?>